<?php

namespace 	Server\Controller;//指定空间
use 		Think\Controller;

class SendemailController extends Controller 
{


	// 找回密码(提供参数考虑前台用户和后台用户)
	public function getBackPwd()
	{	

		
		$where['admin_email']=$rootemail=I('post.rootemail');
		$where['name'] = $name = I('post.rootname');

		$pattern='/^[0-9A-Za-z-\._]+@\w+(\.(\w){1,3}){1,3}$/';

		$subject=$rootemail;

		if(!preg_match($pattern, $subject)){
			$this->redirect(U('Server/Admin'));
			die;
		}else{
			$tplObj = M('sys_email_templates');
			$tpl_status = $tplObj->field('subject,content,status')->where($where)->find();
			if($tpl_status['status']){
				//发邮件
				$to = $rootemail;//接收邮件邮箱
                $subject = $tpl_status['subject'];
                $content = $tpl_status['content'];//模板中包含标示

                // 自定义邮件发送内容
                $url = 'http://'.I('server.HTTP_HOST').__APP__.__CONTROLLER__.'/repwd/code/'.think_encrypt($to);//此处加密未随机待完善
                $username   = '您于' . date('Y年m月d分 H时i分s秒') . '申请找回密码<strong style="color:#00acff;">' . $rootemail. '</strong>';
                $sy_webname = C('site_name');
                $url        ='<a href="' . $url .'">' . $url . '</a>';
                $sy_webcopyright = C('copyright');
                
                // 邮件内容正则
                $pattern = array(
                    '/{sy_webname}/','/{sy_webcopyright}/', '/{username}/', '/{url}/'
                );
                $replacement    = array($sy_webname, $sy_webcopyright, $username, $url);

                //替换模板中标签成实际内容
                $newSubject     = preg_replace($pattern, $replacement, $subject);
                $newContent     = preg_replace($pattern, $replacement, $content);
                //dump($newSubject);
                //dump($newContent);exit;
				$email = sendEMail($to, $newSubject, $newContent);
				//发送成功直接修改数据密码
				if($email){
                    //修改发送邮件时间，便用于邮件过期处理
					$Model = M('root_admin');
                    $Model->where("name='{$name}'")->setField('this_time',time());

				}else{
					$this->success('邮件发送失败，返回重试',U('Server/Admin'),3);
				}
			}else{
				$this->error('管理员关闭找回密码功能',U('Server/Admin'),3);
			}
			

		}
		//考虑调试邮箱登陆接口（未尝试过）
        $this->success('请查收您的邮件',U('Admin/index'),3);

        /*
		$to ='zyajf1314@163.com';
		$subject = '主题';
		$content = '内容';
		$email = sendEMail($to, $subject, $content);*/

		//dump($email);
	}



    /**
     * 用户邮箱验证
     * @return void
     */
    public function repwd()
    {

        $repwd = I('post.repwd');

        $code = I('get.code');
        $email =think_decrypt($code);//解密(此处未考虑加密时随机性，发送邮件链接会一致)
        $Model = M('root_admin');
        
        if(!empty($email)){
            $emailTime = $Model->field('this_time')->where("admin_email='{$email}'")->find();
            $eTime = $emailTime['this_time'];
            $nowTime = time();
            $timed = $nowTime - $eTime;
            //邮件是否过期     
            if ($timed > 86400 && empty($repwd))//24*60*60
            {
                $this->error('验证邮件已过期',U('Admin/index'));
            }

             $this->display('Admin:repwd');   

        }
        else
        {
           //执行修改密码操作
            $re=I('post.pwd');
            $pw=I('post.repwd');
            $rname= I('post.rootname');
            if($re!=$pw){
                $this->error('两次输入密码不一致');
                exit;
            }
            //自定义加密函数
            $p = mypwd($repwd);
            $result=$Model->where("name='{$rname}'")->setField('pwd',$p);
            if($result){
                 $this->success('找回密码成功,请登陆',U('Admin/index'),3);
            }

        }  

    }

	
}
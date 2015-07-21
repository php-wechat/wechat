<?php

namespace 	Server\Controller;//指定空间
use 		Think\Controller;

class SendemailController extends Controller 
{


	// 找回密码(提供参数考虑前台用户和后台用户)
	public function getBackPwd()
	{	

		
		$where['admin_email']=$rootemail=I('post.rootemail');
		$where['name'] = I('post.rootname');

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
				$to = $rootemail;
				$subject = $tpl_status['subject'];
				$content = $tpl_status['content'];
				$email = sendEMail($to, $subject, $content);
				//发送成功直接修改数据密码
				if($email){
					echo '修改操作';
				}else{
					$this->success('修改密码失败',U('Server/Admin'),3);
				}
			}else{
				$this->error('管理员关闭找回密码功能',U('Server/Admin'),3);
			}
			

		}




		/*
		$to ='zyajf1314@163.com';
		$subject = '主题';
		$content = '内容';
		$email = sendEMail($to, $subject, $content);*/

		dump($email);
	}

	
}
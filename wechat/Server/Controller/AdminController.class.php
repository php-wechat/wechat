<?php


namespace Server\Controller;
use Think\Controller;
class AdminController extends Controller {

    //加载登陆界面
    public function index(){
	    $this->display('index');
   }


   //检测登陆
   public function checkLogin()
   {
        
        $admin = D('root_admin');

        //echo mypwd('1234asdf');exit;

        // 用户名和密码是否验证通过
        $data['name'] = I('post.username');
        $data['pwd'] = I('post.password', '', 'mypwd');
        $code = I('post.code');

        $res = $admin->field('id,enabled,this_time,login_nums')->where($data)->find();
        //dump($res);

        if (!$res['enabled'])
        {
            $this->error('你的帐户已禁止，请联系管理员.');
            exit;
        }

        /*移动到单独的方法里面了
        // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
        $verify = new \Think\Verify();
        $verifycode = $verify->check($code);
        if (!$verifycode) {                                                        
            $this -> error('您输入验证码有误！');
            exit;
        }*/


        if ($res) 
        {
            // 将用户的登录信息保存在SESSION中
            session(C('ROOT_ADMIN_ID'), $res['id']);                  // 用户ID
            session(C('ROOT_ADMIN_NAME'), $data['name']);     // 用户名
            session('enabled', $res['enabled']);          // 用户状态
            session('isLogin', true);                   // 是否为登录状态
            //dump(session());exit;
            // 当“记住密码”项不为空时，使用Cookie存储用户信息
            $remember = I('post.remember');
            if ( ! empty($remember)) 
            {

                // 检查用户是否登录的一个加密字符串，将在验证用户是否登录时比对
                $xyz_symbol = md5('XYZ');

                cookie(C('ROOT_ADMIN_ID'), $res['id'], array('prefix' => 'xyz_', 'expire' => 7*24*60*60));
                cookie(C('ROOT_ADMIN_NAME'), $data['name'], array('prefix' => 'xyz_', 'expire' => 7*24*60*60));
                cookie('enabled', $res['enabled'], array('prefix' => 'xyz_', 'expire' => 7*24*60*60));
                cookie('symbol', $xyz_symbol, array('prefix' => 'xyz_', 'expire' => 7*24*60*60));
            } 

            // 修改管理此次登录的状态
            $upData['last_time'] = time();
            $upData['ip'] = get_client_ip();//系统函数中已定义好
            $upData['login_nums'] = $res['login_nums'] + 1;//登陆次数

            $admin->where('id = ' . $res['id'])->save($upData);//执行修改

            // 登录成功，跳转到主页
            $this->success('欢迎回来：' . $data['name'], U('System/index'));

        } else {
            $this->error('用户名或密码错误！');
        }



   }

    // 输出验证码
    public function verify()
    {
        $config =    array(    
            'fontSize'    =>    40,    // 验证码字体大小    
            'length'      =>    4,     // 验证码位数    
            'useNoise'    =>    true, // 关闭验证码杂点
            
            'codeSet'    => '0123456789',// 设置验证码字符为纯数字
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }


    //检测用户是否存在
    public function checkuser()
    {
        if(I('post.username')){             
            $where['name']=$name=I('post.username');

        }else{
            $where['name']=$name=I('post.rootname');
        }
       
        //dump($_POST);
        session('login_name',$name);//验证对应用户的密码

        $result = M("root_admin")->where($where)->find();
      
        echo empty($result)?false:true;
    }

    //检测密码
    public function checkpass()
    {
        $where['name']=session('login_name');
        $where['pwd'] = I('post.password','', 'mypwd');
        $result = M("root_admin")->where($where)->find();
      
        echo empty($result)?false:true;
    }


    //检测验证码
    public function checkcode()
    {
        $code=I('post.code');

        $verify = new \Think\Verify();
        $verifycode = $verify->check($code);

        echo empty($verifycode)?false:true;
    }

     //检测邮箱是否存在
    public function checkemail()
    {
        $where['name']=session('login_name');
        $where['admin_email'] =I('post.rootemail');
        $result = M("root_admin")->where($where)->find();

        echo empty($result)?false:true;
    }


    //退出
    public function loginout()
    {
        session(C('ROOT_ADMIN_ID'),null);                  // 用户ID
        session(C('ROOT_ADMIN_NAME'),null);     // 用户名
        session('enabled',null);          // 用户状态
        session('isLogin',null); 
        session('login_name',null);                  // 是否为登录状态
        //$this->success('你已经成功退出！',U("Admin/index"));
        //sleep(2);
        $url = U("Admin/index");
        echo "<script>window.top.location.href='{$url}';</script>";
    }


}

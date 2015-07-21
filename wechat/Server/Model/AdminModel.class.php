<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{
	//重新定义数据库表
	protected $tableName = 'root_admin'; 
	
	//自动验证
	protected $_validate = array(     
		array('name','require','用户名必须！'), //默认情况下用正则进行验证
		array('name','','帐号名称已经存在！',0,'unique',3), // 在新增的时候验证name字段是否唯一 
		array('admin_email','','该邮箱已经存在！',0,'unique',3), 
	);
	
	//自动完成  (添加管理员需要功能)
	protected $_auto = array (          
		array('enabled','1'),  // 新增的时候把enabled字段设置为1    
		array('pwd','mypwd',1,'function') , // 对pwd字段在新增时使pwd函数处理  
		array('addtime','time',1,'function'),//新增时 
    );

    //字段映射
    protected $_map = array(         
     	'username' =>'name', // 把表单中name映射到数据表的username字段  
      	'password'  =>'pwd',   // 把表单中的mail映射到数据表的email字段 
        'email'  =>'admin_email',   // 把表单中的mail映射到数据表的email字段 
    );
	
}
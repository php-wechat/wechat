<?php
header("Content-type: text/html; charset=utf-8"); 
/**
 * 方便打印，直接pp($arr1,$arr2,$arr3) 可以分别打印出三个或则多个数组、对象等
 */
function pp()
{
    $arr = func_get_args();
    echo '<pre>';
    foreach($arr as $val){
        print_r($val);
        echo '</pre>';
        echo '<pre>';
    }
    echo '</pre>';
    die();
}



/**
 * 加密算法
 */
function mypwd($pwd){
    return MD5(sha1($pwd).'xyz');
}


/**
     * 邮件发送函数
     * @param $to           收件人邮箱
     * @param $subject      信件主题标题
     * @param $content      信件内容
     * @return              布尔值
     */
    function sendEMail($to, $subject, $content) {

        //加载进来
         Vendor('PHPMailer.PHPMailerAutoload');
         
         $mail = new PHPMailer(); 
         //dump($mail);               
         $mail->IsSMTP();                        // Set mailer to use SMTP
         $mail->Host        = C('email_server');     // Specify main and backup SMTP servers
         $mail->SMTPAuth    = true;             // Enable SMTP authentication
         $mail->Username    = C('email_user');           //SMTP username
         $mail->Password    = C('email_pwd');           //SMTP password
         //$mail->SMTPSecure = 'tls';               // Enable TLS encryption, `ssl` also accepted
         //$mail->Port = 587;                        // TCP port to connect to
         $mail->From        = C('email_form');         
         $mail->FromName    = C('site_name');            
         $mail->AddAddress($to,C('email_toname'));          // Add a recipient
         //$mail->AddAddress($to);         // Name is optional
         $mail->WordWrap    = C('email_WordWrap'); 
         //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
         //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name                 
         $mail->Encoding    = base64;
         $mail->IsHTML      =C('email_html');                   // Set email format to HTML
         $mail->CharSet     =C('email_char');               
         $mail->Subject     =$subject;              
         $mail->Body        = $content;                
         $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; //Format does not support HTML alternate text
        
         if(!$mail->Send()) {
            return false;
            //底下是错误信息，开发中用于测试
            //return "Mailer Error: " . $mail->ErrorInfo;    
         } else {
            //echo "成功了";
            return true;
         }
    }


/**
 * //截取字符串方法  中英
 * @param string $data 要截取字符串
 * @param int $start 开始位置
 * @param int    $length 结束位置
 * @return string  截取后字符串
 *备注//模板使用方式：{$vo.title|getSubstr=1,10}
 */
function getSubstr($string, $start, $length) {
    if(mb_strlen($string,'utf-8')>$length){
        $str = mb_substr($string, $start, $length,'utf-8'); 
        return $str.'...';
    }else{
        return $string;
    }
}


/**
 * 系统加密方法
 * @param string $data 要加密的字符串
 * @param string $key 加密密钥
 * @param int    $expire 过期时间 单位 秒
 * @return string
 */
function think_encrypt($data, $key = '', $expire = 0)
{
    $key = md5($key);
    $data = base64_encode($data);
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    $char = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    $str = sprintf('%010d', $expire ? $expire + time() : 0);

    for ($i = 0; $i < $len; $i++) {
        $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1))) % 256);
    }
    return str_replace(array('+', '/', '='), array('%', '_', ''), base64_encode($str));
}

/**
 * 系统解密方法
 * @param  string $data 要解密的字符串 （必须是think_encrypt方法加密的字符串）
 * @param  string $key 加密密钥
 * @return string
 */
function think_decrypt($data, $key = '')
{
    $key = md5($key);
    $data = str_replace(array('%', '_'), array('+', '/'), $data);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    $data = base64_decode($data);
    $expire = substr($data, 0, 10);
    $data = substr($data, 10);

    if ($expire > 0 && $expire < time()) {
        return '';
    }
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    $char = $str = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    for ($i = 0; $i < $len; $i++) {
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        } else {
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return base64_decode($str);
}



/**
 * @content socketLog函数
 * @param $log
 * @param string $type
 * @param string $css
 * @return mixed|void
 * @throws Exception
 */
function slog($log,$type='log',$css='')
{

    if(is_string($type))
    {
        $socket = \Think\SocketLog::getInstance();

        $type=preg_replace_callback('/_([a-zA-Z])/',create_function('$matches', 'return strtoupper($matches[1]);'),$type);
        if(method_exists($socket,$type) || in_array($type,\Think\SocketLog::$log_types))
        {
            return call_user_func(array($socket,$type),$log,$css);
        }
    }

    if(is_object($type) && 'mysqli'==get_class($type))
    {
        return \Think\SocketLog::mysqlilog($log,$type);
    }

    if(is_resource($type) && ('mysql link'==get_resource_type($type) || 'mysql link persistent'==get_resource_type($type)))
    {
        return \Think\SocketLog::mysqllog($log,$type);
    }

    if(is_object($type) && 'PDO'==get_class($type))
    {
        return \Think\SocketLog::pdolog($log,$type);
    }

    throw new Exception($type.' is not SocketLog method');
}



/**
 * @content 转换字节数为其他单位
 * @param $filesize
 * @return string
 */
function sizecount($filesize) {
    if ($filesize >= pow(1024,3)) {
        $filesize = round($filesize / pow(1024,3), 2) .' GB';
    } elseif ($filesize >= pow(1024,2)) {
        $filesize = round($filesize / pow(1024,2), 2) .' MB';
    } elseif($filesize >= pow(1024,1)) {
        $filesize = round($filesize / pow(1024,1), 2) . ' KB';
    } else {
        $filesize = $filesize.' Bytes';
    }
    return $filesize;
}

?>

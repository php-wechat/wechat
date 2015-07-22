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
     $mail->Username    = C('email_form');           //SMTP username
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

<?php
namespace Server\Controller;
use Think\Controller;
use Think\Db;


class DataBackController extends BaseController {

    public function index()
    {
        $Db    = Db::getInstance();
        $list  = $Db->query('SHOW TABLE STATUS');
        $list  = array_map('array_change_key_case', $list);

        $this->assign('list', $list);
        $this->display();
    }


    /**
     * 备份数据库
     * @param  String  $tables 表名
     * @param  Integer $id     表ID
     * @param  Integer $start  起始行数
     */
    public function export($tables = null, $id = null, $start = null)
    {
        if(IS_POST && !empty($tables) && is_array($tables)){ //初始化
            //读取备份配置
            //压缩备份文件需要PHP环境支持gzopen,gzwrite函数
            $config = array(
                'path'     => rtrim(C('DATA_BACKUP_PATH'),'/') . DIRECTORY_SEPARATOR,
                'part'     => C('DATA_BACKUP_PART_SIZE'),
                'compress' => C('DATA_BACKUP_COMPRESS'),
                'level'    => C('DATA_BACKUP_COMPRESS_LEVEL'),
            );

            if(!file_exists($config['path']))
            {
                if(!mkdir($config['path'])){
                    $msg = $config['path'].'备份创建失败，请手动创建';
                    echo json_encode(array('status' => 'error','msg' => $msg));die();
                }else{
                    chmod($config['path'],0777);
                }
            }

            //检查是否有正在执行的任务
            $lock = "{$config['path']}backup.lock";
            if(is_file($lock))
            {
                $msg = '检测到有一个备份任务正在执行，请稍后再试！';
                echo json_encode(array('status' => 'error','msg' => $msg));die();
            }else {
                //创建锁文件
                file_put_contents($lock, NOW_TIME);
            }

            //检查备份目录是否可写
            if(!is_writeable($config['path']))
            {
                $msg =  $config['path'].'备份目录不可写，请设置权限！';
                echo json_encode(array('status' => 'error','msg' => $msg));die();
            }

            session('backup_config', $config);

            //生成备份文件信息
            $file = array(
                'name' => date('Ymd-His', NOW_TIME),
                'part' => 1,
            );

            session('backup_file', $file);

            //缓存要备份的表
            session('backup_tables', $tables);

            //创建备份文件
            $Database = D('Database','Service');
            $Database->getInstance($file, $config);
            if(false !== $Database->create()){
                $msg =  '初始化成功！';
                echo json_encode(array('status' => 'success','msg' => $msg,'id'=>'0','start'=>'0'));die();
            } else {
                $msg =  '初始化失败，备份文件创建失败！';
                echo json_encode(array('status' => 'error','msg' => $msg));die();
            }

        }elseif (IS_GET && is_numeric($id) && is_numeric($start)) { //备份数据
            $tables = session('backup_tables');
            //备份指定表
            $Database = D('Database','Service');
            $Database->getInstance(session('backup_file'),session('backup_config'));
            $start  = $Database->backup($tables[$id], $start);

            if(false === $start){ //出错
                $msg =  '未知原因，备份出错！';
                echo json_encode(array('status' => 'error','msg' => $msg));die();
            } elseif (0 === $start) { //下一表

                if(isset($tables[++$id])){

                    $msg = '备份成功';
                    echo json_encode(array('status' => 'success','msg' => $msg,'id'=>$id,'start'=>'0'));die();

                } else { //备份完成，清空缓存
                    unlink(session('backup_config.path') . 'backup.lock');
                    session('backup_tables', null);
                    session('backup_file', null);
                    session('backup_config', null);
                    $msg = '备份成功';
                    echo json_encode(array('status' => 'success','msg' => $msg));die();
                }

            } else {
                $rate = floor(100 * ($start[0] / $start[1]));
                $msg = '正在备份'.$rate;
                echo json_encode(array('status' => 'success','msg' => $msg,'id'=>$id,'start'=> $start[0]));die();

            }

        } else { //出错
            echo json_encode(array('status' => 'error','msg' => '参数错误！'));die();
        }
    }


    public function import()
    {
        //列出备份文件列表
        $path = C('DATA_BACKUP_PATH');
        $flag = \FilesystemIterator::KEY_AS_FILENAME;
        $glob = new \FilesystemIterator($path,  $flag);

        $list = array();
        foreach ($glob as $name => $file) {
            if(preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql(?:\.gz)?$/', $name)){
                $name = sscanf($name, '%4s%2s%2s-%2s%2s%2s-%d');

                $date = "{$name[0]}-{$name[1]}-{$name[2]}";
                $time = "{$name[3]}:{$name[4]}:{$name[5]}";
                $part = $name[6];

                if(isset($list["{$date} {$time}"])){
                    $info = $list["{$date} {$time}"];
                    $info['part'] = max($info['part'], $part);
                    $info['size'] = $info['size'] + $file->getSize();
                } else {
                    $info['part'] = $part;
                    $info['size'] = $file->getSize();
                }
                $extension        = strtoupper(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
                $info['compress'] = ($extension === 'SQL') ? '-' : $extension;
                $info['time']     = strtotime("{$date} {$time}");

                $list["{$date} {$time}"] = $info;
            }
        }

        //渲染模板
        $this->assign('list', $list);
        $this->display();
    }



    public function huanyuan($time =0)
    {
        if($time)
        {
            //获取备份文件信息
            $name  = date('Ymd-His', $time) . '-*.sql*';
            $path  = rtrim(C('DATA_BACKUP_PATH'),'/') . DIRECTORY_SEPARATOR . $name;
            $files = glob($path);
            $list  = array();
            foreach($files as $name){
                $basename = basename($name);
                $match    = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
                $gz       = preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql.gz$/', $basename);
                $list[$match[6]] = array($match[6], $name, $gz);
            }
            ksort($list);
            //检测文件正确性
            $last = end($list);

            if(count($list) === $last[0]){


                $backup_config = array(
                    'path'     => rtrim(C('DATA_BACKUP_PATH'),'/') . DIRECTORY_SEPARATOR,
                    'compress' => $list['1']['2']);
                $db = D('Database','Service');
                $db->getInstance($list['1'],$backup_config);
                $start = $db->import('0');

                if(false === $start){
                    $this->error('还原数据出错！');

                } else {
                    $this->success("还原数据成功！");
                }


            } else {

                $this->error('备份文件可能已经损坏，请检查！');
            }

        }else{
            $this->error('参数错误！');
        }
    }



    /**
     * 删除备份文件
     * @param  Integer $time 备份时间
     */
    public function del($time = 0){
        if($time){
            $name  = date('Ymd-His', $time) . '-*.sql*';
            $path  = rtrim(C('DATA_BACKUP_PATH'),'/') . DIRECTORY_SEPARATOR . $name;

            array_map("unlink", glob($path));
            if(count(glob($path))){
                $this->error('备份文件删除失败，请检查权限！');

            } else {

                $this->success('备份文件删除成功！');
            }
        } else {

            $this->error('参数错误！');
        }


    }

}

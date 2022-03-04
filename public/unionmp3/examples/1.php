<?php
//error_reporting(0);
        $data = json_decode(file_get_contents('php://input'), true);
        // foreach ($data['url'] as $value) {
        // echo $value;
        // }
        $urlarr=$data['url'];
        $firsturl=str_replace("https://cdn.qxxpz.top/","",$urlarr[0]);
        unset($urlarr[0]);
        require_once __DIR__ . '/../autoload.php';
        use Qiniu\Auth;
        use Qiniu\Processing\PersistentFop;
        $auth = new Auth('F_7GvkYqhftwwtOtY-shsiVFrEWdWTxoBD9MPxUL', 'VbbTdhpKTxlqK3L2ElGELIBdT4fR0naHUFuR5GF8');
        $bucket = 'sxmuseum';
        //转码是使用的队列名称。 
        $pipeline = 'seddon';
        //$key = time().rand(10000,99999).".mp4";
        //$key = $_FILES['videoname']['tmp_name'];
        $key = $firsturl;
        //转码完成后通知到你的业务服务器。
        $notifyUrl = '';
        $pfop = new PersistentFop($auth, $bucket, $pipeline, $notifyUrl);
        $fops = 'avconcat/2/format/mp3';
        //$urlarr = array('http://cdn.qxxpz.top/test/2.mp3','http://cdn.qxxpz.top/test/3.mp3');
        foreach ($urlarr as $value) {
        $value = \Qiniu\base64_urlSafeEncode($value);
        $fops = $fops.'/'.$value;
        }
        //可以对转码后的文件进行使用saveas参数自定义命名，当然也可以不指定文件会默认命名并保存在当间。
        $time=time().rand(10000,99999);
        $fops = $fops.'|saveas/'.\Qiniu\base64_urlSafeEncode("sxmuseum:union/union".$time.".mp3");
        list($id, $err) = $pfop->execute('sxmuseum',$key, $fops);
        if ($err != null) {
            print_r($err);
        } else {
            header('Content-Type:application/json; charset=utf-8');
            $arr = array('url'=>'https://cdn.qxxpz.top/union/union'.$time.'.mp3');
            exit(json_encode($arr)); 
            //echo "PersistentFop Id: $id\n";
        }
<?php
// require('../autoload.php');
//         $auth = new Auth('F_7GvkYqhftwwtOtY-shsiVFrEWdWTxoBD9MPxUL', 'VbbTdhpKTxlqK3L2ElGELIBdT4fR0naHUFuR5GF8');
//         $bucket = 'sxmuseum';
//         //转码是使用的队列名称。 
//         $pipeline = '';
//         //$key = time().rand(10000,99999).".mp4";
//         //$key = $_FILES['videoname']['tmp_name'];
//         $key = '/test/1.mp3';
//         //转码完成后通知到你的业务服务器。
//         $notifyUrl = 'http://375dec79.ngrok.com/notify.php';
//         $pfop = new PersistentFop($auth, $bucket, $pipeline, $notifyUrl);
//         $encodedUrl1 = $this->base64_urlSafeEncode('http://cdn.qxxpz.top/test/2.mp3');
//         $encodedUrl2 = $this->base64_urlSafeEncode('http://cdn.qxxpz.top/test/3.mp3');
//         $fops = 'avconcat/2/format/mp3/'.$encodedUrl1.'/'.$encodedUrl2;
//         //可以对转码后的文件进行使用saveas参数自定义命名，当然也可以不指定文件会默认命名并保存在当间。
//         $fops = $fops.'|saveas/'.$this->base64_urlSafeEncode("xxx:seddon.mp3");
//         list($id, $err) = $pfop->execute($key, $fops);
//         echo "合成结果：";
//         if ($err != null) {
//             print_r($err);
//         } else {
//             echo "PersistentFop Id: $id\n";
//         }
        echo base64_decode('http://cdn.qxxpz.top/test/2.mp3');
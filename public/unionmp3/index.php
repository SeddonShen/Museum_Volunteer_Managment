<?php
$config = array(
        'secrectKey'     => 'VbbTdhpKTxlqK3L2ElGELIBdT4fR0naHUFuR5GF8', //七牛服务器
        'accessKey'      => 'F_7GvkYqhftwwtOtY-shsiVFrEWdWTxoBD9MPxUL', //七牛用户
        'domain'         => 'cdn.qxxpz.top', //七牛域名
        'bucket'         => 'sxmuseum', //空间名称
    );
    // POST /fetch/<EncodedURL>/to/<EncodedEntryURI> HTTP/1.1
    // Host:           iovip.qbox.me
    // Content-Type:   application/x-www-form-urlencoded
    // Authorization:  Qiniu <AccessToken>
    
    // POST /pfop/ HTTP/1.1
    // Host: api.qiniu.com
    // Content-Type: application/x-www-form-urlencoded
    // Authorization: QBox <AccessToken>
    // bucket=qiniu-ts-demo&key=thinking-in-go.1.mp4&fops=avconcat/2/format/mp4/aHR0cDovL3Rlc3QuY2xvdWRkbi5jb20vdGhpbmtpbmctaW4tZ28uMi5tcDQ=/aHR0cDovL3Rlc3QuY2xvdWRkbi5jb20vdGhpbmtpbmctaW4tZ28uMy5tcDQ=&notifyURL=http://fake.com/qiniu/notify


//function qiniuFetch($baseurl,$key='',$config){
    $iovip='api.qiniu.com';//这是华南
    //对下载地址进行编码
    $bucket = $config['bucket'].':'.$key;
    //密钥配置
    $url = '/pfop/';
    $sign = hash_hmac('sha1', $url . "\n", $config['secrectKey'], true);
    $token = $config['accessKey'] . ':' . base64_urlSafeEncode($sign);
    echo $token;
    // $header = array('Host: '.$iovip, 'Content-Type:application/x-www-form-urlencoded', 'Authorization: QBox ' . $token);
    // $curl = curl_init();
    // curl_setopt($curl, CURLOPT_URL, 'http://'.$iovip . $url);
    // curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($curl, CURLOPT_POSTFIELDS, "");
    // $result = json_decode(curl_exec($curl), true);
    // curl_close($curl);
    // return !empty($result['key']) ? $config['domain'] . $result['key'] : false;
//}
function base64_urlSafeEncode($data){
    $find = array('+', '/');
    $replace = array('-', '_');
    return str_replace($find, $replace, base64_encode($data));
}
// header('Content-Type:application/json; charset=utf-8');
// $downurl=str_replace($config['domain'],"https://cdn.qxxpz.top/",$url);
// $arr = array('url'=>$downurl);
// exit(json_encode($arr)); 


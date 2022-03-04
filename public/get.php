<?php
$config = array(
        'secrectKey'     => 'VbbTdhpKTxlqK3L2ElGELIBdT4fR0naHUFuR5GF8', //七牛服务器
        'accessKey'      => 'F_7GvkYqhftwwtOtY-shsiVFrEWdWTxoBD9MPxUL', //七牛用户
        'domain'         => 'cdn.qxxpz.top', //七牛域名
        'bucket'         => 'sxmuseum', //空间名称
    );
$url = $_POST['url'];
// $url = 'http://devtools.qiniu.com/qiniu.png';
//配置文件地址
$key ='audio/'.time() . '.mp3';
//配置文件后缀名
$url=qiniuFetch($url,$key,$config);
//调用函数并传递返回值
/**
 * @param $url 网络图片
 * @param $key 保存的路径
 * @param $config 配置参数
 */
function qiniuFetch($baseurl,$key='',$config){
    $iovip='iovip-z2.qbox.me';//这是华南
    $encodedURL = base64_urlSafeEncode($baseurl);
    //对下载地址进行编码
    $bucket =empty($key)?$config['bucket']: $config['bucket'].':'.$key;
    //密钥配置
    $encodedEntryURI = base64_urlSafeEncode($bucket);
    $url = '/fetch/' . $encodedURL . '/to/' . $encodedEntryURI;
    $sign = hash_hmac('sha1', $url . "\n", $config['secrectKey'], true);
    $token = $config['accessKey'] . ':' . base64_urlSafeEncode($sign);
    $header = array('Host: '.$iovip, 'Content-Type:application/x-www-form-urlencoded', 'Authorization: QBox ' . $token);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://'.$iovip . $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "");
    $result = json_decode(curl_exec($curl), true);
    curl_close($curl);
    return !empty($result['key']) ? $config['domain'] . $result['key'] : false;
}
function base64_urlSafeEncode($data){
    $find = array('+', '/');
    $replace = array('-', '_');
    return str_replace($find, $replace, base64_encode($data));
}
header('Content-Type:application/json; charset=utf-8');
$downurl=str_replace($config['domain'],"https://cdn.qxxpz.top/",$url);
$arr = array('url'=>$downurl);
exit(json_encode($arr)); 


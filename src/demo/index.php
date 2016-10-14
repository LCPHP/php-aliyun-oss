<?php

require_once '../../../php-aliyun-oss/vendor/autoload.php';

use niklaslu\AliyunOSS;

$aliyunConfig = [

    'access_key_id' => 'H7tlMQ8JJIiqGLYR',
    'access_key_secret' => 'cfk8GkR2VSrLkDYE7mgiHijkpoPSv8',
    'end_point' => 'oss-cn-shenzhen.aliyuncs.com',

    'bucket' => 'we-upload',
    'domain' => 'http://we-upload.oss-cn-shenzhen.aliyuncs.com/',
    'custom' => false
];

$aliyun = new AliyunOSS($aliyunConfig);
$obj = $aliyun->getOss();


$file = 'a.txt';
$filepath = dirname(__FILE__)."/".$file;
if (file_exists($filepath)){

    $res = $aliyun->upload($filepath);

    print_r($res);
}else{

    echo '无此文件';
}

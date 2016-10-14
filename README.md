# php-aliyun-oss
php阿里云上传

#### demo

##### 上传本地文件
```php

use niklaslu\AliyunOSS;

$aliyunConfig = [

    'access_key_id' => '**************',
    'access_key_secret' => '*****************',
    'end_point' => 'oss-cn-shenzhen.aliyuncs.com',

    'bucket' => '*******',
    'domain' => 'http://********.oss-cn-shenzhen.aliyuncs.com/', // 域名
    'custom' => false //custom为true时使用自定义域名
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

```

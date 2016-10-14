<?php
namespace niklaslu;
use OSS\OssClient;
use OSS\Core\OssException;
class AliyunOSS {
    
    private $ossClient;
    
    private $error = '';
    
    private $config = [];
    
    public function __construct($config){
        
        // <您从OSS获得的AccessKeyId>
        $accessKeyId = $config['access_key_id'];
        // <您从OSS获得的access_key_secret>
        $accessKeySecret = $config['access_key_secret'];
        //<您选定的OSS数据中心访问域名，例如oss-cn-hangzhou.aliyuncs.com>
        $endpoint = $config['end_point'];
        
        $this->config = $config;
        
        // 时候自定义域名
        $custom = isset($config['custom']) ? $config['custom'] : false;
        try {
            if ($custom){
                $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint , true);
            }else{
                $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
            }
            
            $this->ossClient = $ossClient;
        } catch (OssException $e) {
            $this->error =  $e->getMessage();
        }
        
    }
    
    public function getOss(){
        
        return $this->ossClient;
        
    }
    
    public function getError(){
        
        return $this->error;
    }
    
    /**
     * 上传
     * @param unknown $file 本地文件
     * @param unknown $path 上传文件夹
     * @param unknown $object 上传文件名
     */
    public function upload($file , $path = 'default' , $object = null ){
        
        $bucket = $this->config['bucket'];
        
        if (!$object){
            $extArr = explode('.', $file);
            $ext = $extArr[count($extArr) - 1];
            
            $object = md5( $file ) . '.' . $ext;
        }
        
        $object = $path . '/' . $object;
        
        try {
            $res = $this->ossClient->uploadFile($bucket, $object, $file);
            
            $result['url'] = isset($this->config['domain'] ) ? $this->config['domain']  . $object : $object ;
            return $result;
        } catch (OssException $e) {
            $this->error =  $e->getMessage();
            return false;
        }
    }
}
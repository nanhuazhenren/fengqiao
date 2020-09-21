<?php
namespace Nanhuazhenren\Fengqiao;
use InvalidArgumentException;

Class Fengqiao
{
    const FENGQIAO_URL_BOX="http://sfapi-sbox.sf-express.com/std/service";
    const FENGQIAO_URL_PROD="https://sfapi.sf-express.com/std/service";

    public $url='';
    public $env='PROD';

    public function __construct($env='PROD')
    {
        //如果不是生产环境使用沙箱链接

        $this->url=($env=='PROD')?self::FENGQIAO_URL_PROD:self::FENGQIAO_URL_BOX;
        $this->env=($env=='PROD')?'PROD':'BOX';

        //$this->loader = $loaderName ?: 'Nanhuazhenren\\Fengqiao\\CreateorderLoader';
    }
    public function http_post($post_data){
        $postdata = http_build_query($post_data);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded;charset=utf-8',
                'content' => $postdata,
                'timeout' => 15 * 60 // 超时时间（单位:s）
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($this->url, false, $context);
    
        return $result;
    }
    public  function getSignature()
    {
        # code...
    }
    public function create_uuid() { //获取UUID
    
        $chars = md5(uniqid(mt_rand(), true));
        $uuid = substr ( $chars, 0, 8 ) . '-'
            . substr ( $chars, 8, 4 ) . '-'
            . substr ( $chars, 12, 4 ) . '-'
            . substr ( $chars, 16, 4 ) . '-'
            . substr ( $chars, 20, 12 );
        return $uuid ;
    }
}
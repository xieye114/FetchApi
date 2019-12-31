<?php
/**
 * Created by PhpStorm.
 * User: yyy12
 * Date: 2019/12/21
 * Time: 16:03
 */

namespace YYY\FetchApi\Pay\Util;

use GuzzleHttp\Client;
class Http
{

    public static function http_post( $url, array $params = [], array $headers=[], $timeout=10 )
    {
        $client = new Client(['verify' => false]);
        try {
            $arr = [
                'form_params' => $params,// 表单数据
                'timeout'     => $timeout,// 单位是秒,0无限等待。
            ] ;
            if ($headers) {
                $arr['headers'] = $headers;
            }
            $res = $client->request( 'POST', $url, $arr );

        } catch ( \Exception $e ) {
            logger()->error($e->getMessage());
            logger()->error( 'post err：' . $url.
                json_encode( $params, JSON_UNESCAPED_UNICODE ) );
            return '';
        }
        return $res->getBody()->getContents();
    }

}


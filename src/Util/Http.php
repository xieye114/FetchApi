<?php
/**
 * Created by PhpStorm.
 * User: yyy12
 * Date: 2019/12/21
 * Time: 16:03
 */

namespace YYY\FetchApi\Pay\Util;


class Http
{
    public static function do_post($url, $params, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}


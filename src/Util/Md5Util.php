<?php
/**
 * Created by PhpStorm.
 * User: yyy12
 * Date: 2019/12/21
 * Time: 16:03
 */

namespace YYY\FetchApi\Pay\Util;


//PHPMD5模拟JavaMD5工具类
class Md5Util
{
    /**
     * 16进制转string拼接
     * @param    array $bytes [description]
     * @return   [type]                          [description]
     */
    public function encodeHexString(array $bytes)
    {
        $LOWER = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];
        $length = count($bytes);
        $charArr = [];
        foreach ($bytes as $value) {
            $value = intval($value);
            $charArr[] = $LOWER[$this->uright(0xF0 & $value, 4)];
            $charArr[] = $LOWER[0x0F & $value];
        }
        return implode("", $charArr);
    }

    /** php 无符号右移 */
    public function uright($a, $n)
    {
        $c = 2147483647 >> ($n - 1);
        return $c & ($a >> $n);
    }

    /**
     * 模拟DigestUtils.md5
     * @param    [string]                   $string 加密字符
     * @return   [array]                    加密之后的byte数组
     */
    public function md5Hex($string)
    {
        return unpack("c*", md5($string, true));
    }

    public function md5Str($str)
    {
        return $this->encodeHexString($this->md5Hex($str));
    }
}




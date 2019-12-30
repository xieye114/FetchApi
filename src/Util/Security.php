<?php
/**
 * Created by PhpStorm.
 * User: yyy12
 * Date: 2019/12/21
 * Time: 16:03
 */

namespace YYY\FetchApi\Pay\Util;


//AES工具类
class Security
{
    // 生成一个 密钥，必须是 16 位长度的数字字符串。
    public static function create_key()
    {
       // foreach ( range() )
        $s=random_int(1,9);// 第一位保证不是0

        // 剩余加15个，总共就是16个数字。
        foreach ( range(1,15) as $v ) {
            $s .= random_int(0,9);
        }
        return $s;

    }


    /*
    *AES加密
    **/
    public static function encrypt($input, $key)
    {
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
        $input = Security::pkcs5_pad($input, $size);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        //2进制数转16进制数并转换成大写字母
        $data = strtoupper(bin2hex($data));
        return $data;
    }

    private static function pkcs5_pad($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    /*
    *AES解密
    **/
    public static function decrypt($sStr, $sKey)
    {
        //截取AES密钥前16位
        $key = substr($sKey, 0, 16);
        $bindata = "";
        //16进制数转2进制
        for ($i = 0; $i < strlen($sStr); $i += 2) {
            $bindata .= chr(hexdec(substr($sStr, $i, 2)));
        }
        $decrypted = mcrypt_decrypt(
            MCRYPT_RIJNDAEL_128,
            $key,
            $bindata,
            MCRYPT_MODE_ECB
        );
        $dec_s = strlen($decrypted);
        $padding = ord($decrypted[$dec_s - 1]);
        $decrypted = substr($decrypted, 0, -$padding);
        return $decrypted;
    }

}


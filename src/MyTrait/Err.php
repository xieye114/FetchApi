<?php

namespace YYY\FetchApi\Pay\MyTrait;


/**
 *
 *
 */
trait Err
{
    private $_err='';// 校验后， 错误信息


    /**
     * 返回错误信息，假如错误，有错误信息。
     */
    public function get_err():string
    {
        return strval($this->_err);

    }


    public function set_err($err)
    {
        $this->_err=$err;
        return false;
    }

}


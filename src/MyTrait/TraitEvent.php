<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/1
 * Time: 12:26
 */

namespace YYY\FetchApi\Pay\MyTrait;



trait TraitEvent
{

    private $_request_status = 0;// 0 顺利。10欠费，20 其余网络故障
    private $_request_word = ''; // 请求状态描述
    private $_result_params = '{}'; //响应的json格式
    private $_result_status = -1; // 结果码，1请求通过，0请求不过，-1对应 请求状态异常
    private $_result_word = '';     // 结果描述，通常是错误信息。
    private $_create_time=0;


    public  function set_event_request_status($request_status)
    {
        $this->_request_status=$request_status;
    }
    public  function set_event_request_word($request_word)
    {
        $this->_request_word = $request_word;
    }

    public  function set_event_result_params($result_params)
    {
        $this->_result_params=$result_params;
    }

    public  function set_event_result_status($result_status)
    {
        $this->_result_status=$result_status;
    }

    public  function set_event_result_word($result_word)
    {
        $this->_result_word=$result_word;
    }
    public  function set_event_create_time()
    {
        $this->_create_time = time();
    }







    //请求状态码：0顺利，10欠费，20 其余网络故障
    public function get_event_request_status()
    {
        return $this->_request_status;
    }

    public function get_event_create_time()
    {
        return $this->_create_time;
    }

    public function get_event_request_word()
    {
        return $this->_request_word;
    }

    public function get_event_result_params()
    {
        return $this->_result_params;
    }

    public function get_event_result_status()
    {
        return $this->_result_status;
    }

    public function get_event_result_word()
    {
        return $this->_result_word;
    }

}

<?php

namespace YYY\FetchApi\Pay\MyInterface;



/**
 *
 *
 */
interface InterfaceEvent
{


    //请求状态码：0顺利，10欠费，20 其余网络故障
    public function get_event_request_status();

    public function get_event_request_word();

    public function get_event_result_params();

    public function get_event_result_status();

    public function get_event_result_word();

    public function get_event_request_params();

    public function get_event_type();

    public function get_event_create_time();




}


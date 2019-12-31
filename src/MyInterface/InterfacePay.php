<?php

namespace YYY\FetchApi\Pay\MyInterface;



use YYY\FetchApi\Pay\RequestData;

/**
 *
 * 本项目的主要接口。
 */
interface InterfacePay extends InterfaceErr, InterfaceApi
{

    /**
     * @param RequestData $requestData
     * @param $amount
     * @return mixed
     */
    public function set_request(RequestData $requestData, $amount );

    // 对方返回的三方订单号。
    public function get_third_order_no();


    // 这是响应时返回的。
    public function get_my_order_no();

    // 这是响应时返回的。
    public function get_my_settle_amount_fen();

    // get 方法返回是否发送成功，布尔。
    // 如果对方接受了请求，为真。


}


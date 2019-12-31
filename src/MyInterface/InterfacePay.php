<?php

namespace YYY\FetchApi\Pay\MyInterface;



use YYY\FetchApi\Pay\RequestData;

/**
 *
 * 接口。
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

}


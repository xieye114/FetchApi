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
     * @param RequestData $requestData   包括了扣款卡，结算卡。
     * @param $amount            转账金额 ，单位元。
     * @return mixed
     */
    public function set_request(RequestData $requestData, $amount );

    // 对方返回的三方订单号。
    public function get_third_order_no();


    // 这是响应时返回的。我方订单号。
    public function get_my_order_no();

    // 这是响应时返回的。结算金额分
    public function get_my_settle_amount_fen();

}


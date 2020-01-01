<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/8
 * Time: 14:50
 */

namespace YYY\FetchApi\Pay;

use YYY\FetchApi\Pay\MyInterface\InterfaceEvent;
use YYY\FetchApi\Pay\MyInterface\InterfacePay;
use YYY\FetchApi\Pay\MyTrait\Err;
use YYY\FetchApi\Pay\MyTrait\TraitEvent;
use YYY\FetchApi\Pay\Util\Md5Util;
use YYY\FetchApi\Pay\Util\RSA;

/**
 *
 * 过程。
 *
 */
class Stub implements InterfacePay, InterfaceEvent
{
    use Err, TraitEvent;

    private $fetch_result;
    private $is_fetch = 0;

    protected $key;     // 密钥。会初始化。仅用于请求并得到响应
    protected $orgNo;   // 机构号。会初始化。仅用于请求并得到响应
    protected $merNo;   // 商户号。会初始化。仅用于请求并得到响应
    protected $action;  // 请求参数，固定。会初始化。仅用于请求并得到响应
    protected $url;     // 请求地址。会初始化。仅用于请求并得到响应

    protected $md5Key;   // 密钥，配置。会初始化。仅用于请求并得到响应
    protected $request_herder; // 固定值。会初始化。仅用于请求并得到响应

    protected $third_order_no = ''; //



    protected $amount = 0; //

    /**
     * @var RequestData
     */
    protected $dataPay; // 包含 了明文请求参数的对象。会初始化。

    /**
     * @var Md5Util
     */
    protected $service_md5Util;// 会初始化。

    /**
     * @var RSA
     */
    protected $service_rsa;  // 会初始化。


    // 这是响应时返回的。
    public function get_third_order_no()
    {
        return random_int(100000,999999);
    }

    // 这是响应时返回的。
    public function get_my_order_no()
    {
        return random_int(100000,999999);
    }

    //
    public function get_my_settle_amount_fen()
    {

        return $this->amount * 100;
    }


    // 实现 事件接口 用。
    public function get_event_type()
    {
        return 3;
    }

    // 实现 事件接口。
    public function get_event_request_params()
    {
        $params = get_object_vars($this->dataPay);
        return json_encode($params, JSON_UNESCAPED_UNICODE);
    }

    // 实现 请求接口。
    public function init()
    {


        return $this;
    }

    // 实现 请求接口。
    public function set_request(RequestData $dataPay, $amount)
    {
        $this->dataPay = $dataPay;
        $this->amount = $amount;
        $this->init();
        return $this;
    }

    public function get()
    {
        $this->fetch();
        return $this->is_valid();
    }

    public function fetch()
    {

    }


    public function is_valid(): bool
    {

        return true;

    }


}

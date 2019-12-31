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
use YYY\FetchApi\Pay\Util\Http;
use YYY\FetchApi\Pay\Util\Md5Util;
use YYY\FetchApi\Pay\Util\RSA;
use YYY\FetchApi\Pay\Util\Security;

/**
 *
 * 过程。
 *
 */
class Api implements InterfacePay, InterfaceEvent
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
     * @var DataPay
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
        return $this->third_order_no;
    }

    // 这是响应时返回的。
    public function get_my_order_no()
    {
        return $this->dataPay->getLinkId();
    }

    //
    public function get_my_settle_amount_fen()
    {
        $amount = $this->dataPay->getSettleAmount();
        return intval($amount);
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
        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
        $this->fetch_result = null;

        $this->url = config('fetchapi-pay.api_pay_daikou_url');
        $this->key = Security::create_key(); //请求的16位AES密钥，
        $this->orgNo = config('fetchapi-pay.api_pay_daikou_org_no');
        $this->merNo = config('fetchapi-pay.api_pay_daikou_mer_no');
        $this->action = "NocardSmsItem";

        $this->md5Key = config('my.api_pay_daikou_md5_key');//md5密钥，生成签名时加盐。

        $this->service_md5Util = new Md5Util();
        $this->service_rsa = new RSA(config_path('private.pem'));

        $this->request_herder = [
            "Content-Type" => "application/json;charset=utf-8",
            "Accept" => "application/json;charset=utf-8"
        ];


        $orderRate = config('my.api_pay_daikou_settle_rate');
        $settleCharge_fen = config('my.api_pay_daikou_settle_charge'); // 单位分

        $amount_yuan = $this->amount;
        $settleAmount = $amount_yuan * 100 - ($amount_yuan * 100 * $orderRate / 100) - $settleCharge_fen;
        // 计算并保存 分。
        $settleAmount = intval($settleAmount);

        $this->dataPay
            ->setOrderRate(strval($orderRate))
            ->setSettleCharge(strval($settleCharge_fen))
            ->setSettleAmount(strval($settleAmount))
            ->setOrderType(10)
            ->setGoodsName('测试商品')
            ->setAmount($amount_yuan * 100)
            ->setNotifyUrl(route('callback_withholding'));

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
        // 初始请求参数，明文。
        $params = get_object_vars($this->dataPay);
        $params = json_encode($params, JSON_FORCE_OBJECT);               //json序列化
        //logger('请求业务参数明文:' . $params);

        $encry = Security::encrypt($params, $this->key);                        //AES加密消息体
        $signParam = $this->orgNo . $this->merNo . $this->action . $encry;
        $sign = $this->service_md5Util->md5Str($signParam . $this->md5Key); //加盐MD5,生成签名
        $privateStr = $this->service_rsa->encryptByPrivateKey($this->key);      //RSA算法加密AES密钥
        // 请求参数，加密，加签名后的 最终形态。
        $params_arr = [
            'orgNo' => $this->orgNo,
            'merNo' => $this->merNo,
            'action' => $this->action,
            'data' => $encry,
            'encryptkey' => $privateStr,
            'sign' => $sign,
        ];

        /********************    下面是处理响应                 *******************/

        $this->set_event_create_time();
        $result = Http::http_post($this->url, $params_arr, $this->request_herder);
        //logger('响应参数：' . $result);
        $respJson = json_decode($result, 1);//json反序列化
        if (!$respJson) {
            $this->set_err('三方接口错误,订单未生成');

            $this->set_event_request_status(20);
            $this->set_event_request_word('网络异常，请求失败');

            return false;
        }
        $this->set_event_result_params($result);

        $this->fetch_result = $respJson;
    }


    public function is_valid(): bool
    {
        // 如果已经有错，直接忽略。
        if ($this->get_err()) {
            return false;
        }

        $respJson = $this->fetch_result;
        $respCode = $respJson['respCode'];                                 //响应码, 可信赖参数。
        $respMsg = $respJson['respMsg'];                                   //响应描述, 可信赖参数。
        $this->set_event_request_word($respMsg);

        if ($respCode != '200') {
            $this->set_event_request_status(20);
            $this->set_err($respMsg . ',订单未生成');
            return false;
        }
        $data = $respJson['data'];                                         //响应业务数据, 可信赖参数。
        $encryptkey = $respJson['encryptkey'];                             //RSA算法加密后的AES密钥, 可信赖参数。
        $aesKey = $this->service_rsa->decryptByPrivateKey($encryptkey);    //RSA解密获取AES密钥
        $data = Security::decrypt($data, $aesKey);                         //AES解密获取业务明文

        $this->set_event_request_status(0);
        $this->set_event_result_params($data);
        $s = "响应码：" . $respCode . "，响应描述：" . $respMsg . "，AES密钥：" . $aesKey . '，响应明文：' . $data;
        //logger($s);

        $data_arr = json_decode($data, 1);
        //{"code":"13170308","msg":"结算金额校验失败,系统校验费率结果不一致[9650]!=[9640]"}
        //{"orderNo":"16119123002504834102","code":"000000","msg":"Success"}
        $code = $data_arr['code'];
        $this->set_event_result_word($data_arr['msg']);
        if ($code != '000000') {
            $this->set_event_result_status(0); // 请求拒绝
            $this->set_err($data_arr['msg']);
            return false;
        }
        $this->set_event_result_status(1); // 请求通过，成功。
        $this->third_order_no = $data_arr['orderNo']; // 保存三方订单号。
        return true;

    }


}

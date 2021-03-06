<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/8
 * Time: 14:50
 */

namespace YYY\FetchApi\Pay;


/**
 * 数据包
 *
 */
class RequestData
{
    public $linkId;
    public $notifyUrl;


    public $cardNo;
    public $cardAccount;
    public $cardPhone;
    public $cardCert;

    public $settleCardNo;
    public $settleCardAccount;
    public $settleCardPhone;
    public $settleCardCert;



    /**
     * @return mixed
     */
    public function getLinkId()
    {
        return $this->linkId;
    }

    public function setLinkId($linkId)
    {
        $this->linkId = $linkId;
        return $this;
    }





    /**
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    public function setNotifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardNo()
    {
        return $this->cardNo;
    }

    public function setCardNo($cardNo)
    {
        $this->cardNo = $cardNo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardAccount()
    {
        return $this->cardAccount;
    }

    public function setCardAccount($cardAccount)
    {
        $this->cardAccount = $cardAccount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardPhone()
    {
        return $this->cardPhone;
    }

    public function setCardPhone($cardPhone)
    {
        $this->cardPhone = $cardPhone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardCert()
    {
        return $this->cardCert;
    }

    public function setCardCert($cardCert)
    {
        $this->cardCert = $cardCert;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSettleCardNo()
    {
        return $this->settleCardNo;
    }

    public function setSettleCardNo($settleCardNo)
    {
        $this->settleCardNo = $settleCardNo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSettleCardAccount()
    {
        return $this->settleCardAccount;
    }

    public function setSettleCardAccount($settleCardAccount)
    {
        $this->settleCardAccount = $settleCardAccount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSettleCardPhone()
    {
        return $this->settleCardPhone;
    }

    public function setSettleCardPhone($settleCardPhone)
    {
        $this->settleCardPhone = $settleCardPhone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSettleCardCert()
    {
        return $this->settleCardCert;
    }

    public function setSettleCardCert($settleCardCert)
    {
        $this->settleCardCert = $settleCardCert;
        return $this;
    }


}

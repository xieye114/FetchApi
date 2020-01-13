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
class RequestAllNew
{

    public $linkId;

    public $orderAmount;


    public $notifyUrl;


    public $cardNo;
    public $cardAccount;
    public $cardPhone;
    public $cardCert;





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
    public function getAmount()
    {
        return $this->orderAmount;
    }

    public function setAmount($amount)
    {
        $this->orderAmount = $amount;
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






}

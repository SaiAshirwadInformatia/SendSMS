<?php
namespace saiashirwadinformatia;

use saiashirwadinformatia\SimpleRest;

class SendSMS
{
    private $authkey;

    private $senderId;

    private $route;

    private $countryCode;

    const URL = "http://saiashirwad.in/";

    const SEND_SMS_URL = 'api/sendhttp.php';

    const BALANCE_CHECK_URL = 'api/balance.php';

    public $simpleRest;

    const TRANSACTION_ROUTE = 'template';

    const PROMOTIONAL_ROUTE = 'default';

    /**
     * @param $authkey
     * @param $countryCode
     * @param $senderId
     * @param $route
     */
    public function __construct($authkey, $countryCode = '91', $senderId = 'SAIMSG', $route = self::TRANSACTION_ROUTE)
    {
        $this->authkey = $authkey;
        $this->simpleRest = new SimpleRest();
        if (!is_null($senderId) and $senderId) {
            $this->senderId = $senderId;
        } else {
            $this->senderId = 'SAIMSG';
        }
        if (!is_null($route) and $route) {
            $this->route = $route;
        } else {
            $this->route = self::TRANSACTION_ROUTE;
        }
        if (!is_null($countryCode) and $countryCode) {
            $this->countryCode = $countryCode;
        } else {
            $this->countryCode = '91';
        }
    }

    /**
     * @param $route
     */
    public function checkBalance($route = null)
    {
        if (is_null($route) or !$route) {
            $route = $this->route;
        }
        $postData = [
            'authkey'  => $this->authkey,
            'type'     => $route,
            'response' => 'json',
        ];

        $output = $this->simpleRest->post(self::URL . self::BALANCE_CHECK_URL, $postData);
        return $output['response'];
    }

    /**
     * @param  $mobile
     * @param  $message
     * @param  $scheduleAt    -           yyyy-mm-dd hh:MM:ss
     * @param  $countryCode
     * @param  null           $senderId
     * @param  null           $route
     * @return mixed
     */
    public function scheduleSMS($mobile, $message, $scheduleAt, $countryCode = null, $senderId = null, $route = null)
    {
        if (is_null($countryCode) or !$countryCode) {
            $countryCode = $this->countryCode;
        }
        if (is_null($senderId) or !$senderId) {
            $senderId = $this->senderId;
        }
        if (is_null($route) or !$route) {
            $route = $this->route;
        }
        $postData = [
            'authkey'  => $this->authkey,
            'mobiles'  => $mobile,
            'message'  => $message,
            'schtime'  => $scheduleAt,
            'country'  => $countryCode,
            'sender'   => $senderId,
            'route'    => $route,
            'response' => 'json',
        ];
        $output = $this->simpleRest->post(self::URL . self::SEND_SMS_URL, $postData);
        return json_decode($output['response'], true);
    }

    /**
     * @param  $mobile
     * @param  $message
     * @param  $countryCode
     * @param  null           $senderId
     * @param  null           $route
     * @return mixed
     */
    public function sendSMS($mobile, $message, $countryCode = null, $senderId = null, $route = null)
    {
        if (is_null($countryCode) or !$countryCode) {
            $countryCode = $this->countryCode;
        }
        if (is_null($senderId) or !$senderId) {
            $senderId = $this->senderId;
        }
        if (is_null($route) or !$route) {
            $route = $this->route;
        }
        $postData = [
            'authkey'  => $this->authkey,
            'mobiles'  => $mobile,
            'message'  => $message,
            'country'  => $countryCode,
            'sender'   => $senderId,
            'route'    => $route,
            'response' => 'json',
        ];
        $output = $this->simpleRest->post(self::URL . self::SEND_SMS_URL, $postData);
        return json_decode($output['response'], true);
    }

    /**
     * @param  $mobile
     * @param  $message
     * @param  $countryCode
     * @param  null           $senderId
     * @return mixed
     */
    public function sendPromotionalSMS($mobile, $message, $countryCode = null, $senderId = null)
    {
        return $this->sendSMS($mobile, $message, $senderId, $countryCode, self::PROMOTIONAL_ROUTE);
    }

    /**
     * @param  $mobile
     * @param  $message
     * @param  $countryCode
     * @param  null           $senderId
     * @return mixed
     */
    public function sendTransactionalSMS($mobile, $message, $countryCode = null, $senderId = null)
    {
        return $this->sendSMS($mobile, $message, $senderId, $countryCode, self::TRANSACTION_ROUTE);
    }
}

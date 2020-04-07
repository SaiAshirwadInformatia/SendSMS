<?php
namespace SaiAshirwadInformatia;

use SaiAshirwadInformatia\Models\Balance;
use SaiAshirwadInformatia\Models\Success;

class SendSMS
{
    /**
     * @var mixed
     */
    private $authkey;

    /**
     * @var mixed
     */
    private $senderId;

    /**
     * @var mixed
     */
    private $route;

    /**
     * @var mixed
     */
    private $countryCode;

    const URL = "http://saiashirwad.in/";

    const SEND_SMS_URL = 'api/sendhttp.php';

    const BALANCE_CHECK_URL = 'api/balance.php';

    /**
     * @var mixed
     */
    public $client;

    const TRANSACTION_ROUTE = 'template';

    const PROMOTIONAL_ROUTE = 'default';

    const OTP_ROUTE = 'otp';

    /**
     * @param $authkey
     * @param $countryCode
     * @param $senderId
     * @param $route
     */
    public function __construct($authkey, $countryCode = null, $senderId = null, $route = null)
    {
        $this->authkey = $authkey;
        $this->client  = new \GuzzleHttp\Client();

        $this->senderId    = $senderId ?? 'SAIMSG';
        $this->route       = $route ?? self::TRANSACTION_ROUTE;
        $this->countryCode = $countryCode ?? '91';
    }

    /**
     * @param $route
     */
    public function checkBalance($route = null)
    {

        $route = $route ?? $this->route;

        $postData = [
            'authkey'  => $this->authkey,
            'type'     => $route,
            'response' => 'json',
        ];

        $output = $this->client->get(self::URL . self::BALANCE_CHECK_URL, ['query' => $postData]);
        $count  = intval($output->getBody()->getContents());
        return new Balance($count);
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
        $countryCode = $countryCode ?? $this->countryCode;
        $senderId    = $senderId ?? $this->senderId;
        $route       = $route ?? $this->route;

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
        $output = $this->client->post(self::URL . self::SEND_SMS_URL, ['form_params' => $postData]);
        return json_decode($output['response']);
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
        $countryCode = $countryCode ?? $this->countryCode;
        $senderId    = $senderId ?? $this->senderId;
        $route       = $route ?? $this->route;

        $postData = [
            'authkey'  => $this->authkey,
            'mobiles'  => $mobile,
            'message'  => $message,
            'country'  => $countryCode,
            'sender'   => $senderId,
            'route'    => $route,
            'response' => 'json',
        ];
        $output   = $this->client->post(self::URL . self::SEND_SMS_URL, ['form_params' => $postData]);
        $response = json_decode($output->getBody()->getContents());
        $success  = new Success($response->type, $response->message);
        return $success;
    }

    /**
     * @param  $mobile
     * @param  $message
     * @param  $countryCode
     * @param  null           $senderId
     * @return mixed
     */
    public function sendPromotional($mobile, $message, $countryCode = null, $senderId = null)
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
    public function sendTransactional($mobile, $message, $countryCode = null, $senderId = null)
    {
        return $this->sendSMS($mobile, $message, $senderId, $countryCode, self::TRANSACTION_ROUTE);
    }
}

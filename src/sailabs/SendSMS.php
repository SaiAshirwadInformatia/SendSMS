<?php
namespace sailabs;

use sailabs\SimpleRest;

class SendSMS
{
    private $authkey;

    const URL = "http://saiashirwad.in/sendhttp.php";

    public $simpleRest;

    /**
     * @param $authkey
     */
    public function __construct($authkey)
    {
        $this->authkey = $authkey;
        $this->simpleRest = new SimpleRest();
    }

    /**
     * @param  $mobile
     * @param  $message
     * @param  $senderId
     * @param  $route
     * @return mixed
     */
    public function sendSMS($mobile, $message, $senderId = 'SAIMSG', $route = 'template')
    {
        $postData = [
            'authkey' => $this->authkey,
            'mobiles' => $mobile,
            'message' => $message,
            'sender'  => $senderId,
            'route'   => $route,
        ];
        $output = $this->simpleRest->post(self::URL, $postData);
        return $output['response'];
    }
}

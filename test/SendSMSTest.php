<?php
use sailabs\SendSMS;

class SimpleRestTest extends PHPUnit_Framework_TestCase
{
    public function testSendSMS()
    {
        $sendSMS = new SendSMS( /* AUTH KEY */);
        $sendSMS->sendSMS('MOBILE_NUMBER', 'MESSAGE');
    }
}

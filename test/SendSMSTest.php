<?php
use sailabs\SendSMS;

class SimpleRestTest extends PHPUnit_Framework_TestCase
{
    public function testSendSMS()
    {
        /* Visit http://saiashirwad.in to generate your Auth Key  */
        $sendSMS = new SendSMS('XYZ' /* AUTH KEY */);
        $sendSMS->sendSMS('MOBILE_NUMBER', 'MESSAGE');
    }
}

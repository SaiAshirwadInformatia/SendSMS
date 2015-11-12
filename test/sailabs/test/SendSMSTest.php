<?php
namespace sailabs\test;

use sailabs\SendSMS;

class SimpleRestTest extends \PHPUnit_Framework_TestCase
{

    /* Visit http://saiashirwad.in to generate your Auth Key  */
    const AUTHKEY = 'AUTH_KEY';

    const SENDERID = 'SAIMSG';

    const ROUTE = SendSMS::TRANSACTION_ROUTE;

    const COUNTRY_CODE = '91';

    private $sendSMS;

    public function setUp()
    {
        $this->sendSMS = new SendSMS(self::AUTHKEY, self::COUNTRY_CODE, self::SENDERID, self::ROUTE);
    }

    public function testSendSMS()
    {
        $response = $this->sendSMS->sendSMS('MOBILE NUMBER', 'MESSAGE HERE');
        $this->assertEquals('success', $response['type']);
    }

    public function testCheckBalance()
    {
        $response = $this->sendSMS->checkBalance(SendSMS::TRANSACTION_ROUTE);
        echo $response;
    }
}

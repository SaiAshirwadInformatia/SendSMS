<?php
namespace SaiAshirwadInformatia\test;

use PHPUnit\Framework\TestCase;
use SaiAshirwadInformatia\SendSMS;

class SimpleRestTest extends TestCase
{

    /* Visit http://saiashirwad.in to generate your Auth Key  */
    const AUTHKEY = '155679AznX2tubxp593ae68e';

    const SENDERID = 'SAIMSG';

    const ROUTE = SendSMS::TRANSACTION_ROUTE;

    const COUNTRY_CODE = '91';

    /**
     * @var mixed
     */
    private $smsClient;

    public function setUp(): void
    {
        $this->smsClient = new SendSMS(self::AUTHKEY, self::COUNTRY_CODE, self::SENDERID, self::ROUTE);
    }

    public function testSendSMS(): void
    {
        $success = $this->smsClient->send('8976379661', 'MESSAGE HERE');
        $this->assertEquals('success', $success->getType());
    }

    public function testCheckBalance(): void
    {
        $balance = $this->smsClient->checkBalance(SendSMS::TRANSACTION_ROUTE);
        $this->assertGreaterThanOrEqual(0, $balance->getCount());
    }
}

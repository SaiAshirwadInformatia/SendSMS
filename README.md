# Send SMS

Send SMS easily anywhere by registering on http://saiashirwad.in and getting API key.

# Usage

### Send SMS

```php
use SaiAshirwadInformatia\SendSMS;

/**
 * Retrieve your key from http://saiashirwad.in/user/#api
 *
 * Connect on support@saiashirwad.com for queries
 */
$apiKey = 'API_KEY';

/**
 * Default is "91"
 */
$countryCode = '91';

/**
 * Seen on receivers phone a 6 characters Sender Id
 *
 * Default is "SAIMSG"
 *
 * Exact length required "6"
 */
$senderId = 'ABCDEF';

/**
 * Please note, this cannot be less than or greater than 6, should be exact 6 characters
 * Available Routes
 *  SendSMS::TRANSACTION_ROUTE => transaction (Received by DND)
 *  SendSMS::PROMOTIONAL_ROUTE => promotional (Ignored by DND)
 *
 * Please note, transaction require's explicit opt-in in your application
 * We may ask you this data, if any complains/reports received
 */
$route = SendSMS::TRANSACTION_ROUTE;

$smsClient = new SendSMS($apiKey, $countryCode, $senderId, $route);

/**
 * Mobile number
 *
 * This can also be comma separate string for multiple phone numbers
 */
$mobile = '8888888888';

/**
 * Message upto 160 characters is considered as "1" credit
 * If it goes beyond the desired limit's credit's are charged accordingly
 */
$message = 'Hello, this is your message!';
$success = $smsClient->send($mobile, $message);

// returns SMS Message Id for tracking
echo $success->getMessage();
```

### Check Balance

```php
use SaiAshirwadInformatia\SendSMS;

/**
 * Retrieve your key from http://saiashirwad.in/user/#api
 *
 * Connect on support@saiashirwad.com for queries
 */
$apiKey = 'API_KEY';

// Default is Transaction route, alternate is SendSMS::PROMOTIONAL_ROUTE
$route = SendSMS::TRANSACTION_ROUTE;

$smsClient = new SendSMS($apiKey);

// Fetch balance for selected route either transaction or promotion
$balance = $smsClient->checkBalance($route);

echo $balance->getCount(); // returns integer of available SMS credits count
```

## For Students / Trail Accounts

Free SMS credits (limited) will be given for college project students from India, drop a mail to support@saiashirwad.com

# License

MIT License

# Copyright

Sai Ashirwad Informatia, 2020

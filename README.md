# Send SMS

Send SMS easily anywhere by registering on http://saiashirwad.in and getting API key.

# Usage

### Send SMS

```
$smsClient = new SendSMS('API_KEY', '91' /* DEFAULT COUNTRY CODE */);
$success = $smsClient->send('8888888888', 'Hello, this is test message');
echo $success->getMessage(); // returns SMS Message Id for tracking
```

### Check Balance

```
$smsClient = new SendSMS('API_KEY', '91' /* DEFAULT COUNTRY CODE */);
$balance = $smsClient->checkBalance();
echo $balance->getCount(); // returns integer of available SMS credits count
```

## For Student

Free limited SMS credits will be given for college project students from India.

# License

MIT License

# Copyright

Sai Ashirwad Informatia, 2020

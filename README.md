# Medkad SMS: ISMS (Laravel Notification Channel)

## Getting started

Please register to your account credentials at [iSMS Official Website](https://www.isms.com.my/register.php).
The API is using Basic Authentication(so ***username*** and ***password*** will do).

## Installation

via composer:

``` bash
composer require medkad/laravel-isms
```

### Publish iSMS Config File

``` bash
php artisan vendor:publish --provider="Medkad\ISMS\ISMSServiceProvider"
```
### Setting up your configuration

Add your ISMS Account credentials to your `config/isms.php`:

```php
// config/isms.php
...
    'username'  =>  env('ISMS_USERNAME', 'medkad'),
    'password'  =>  env('ISMS_PASSWORD', 'password'),
    'url'   =>  env('ISMS_URL', 'https://www.isms.com.my/RESTAPI.php'),
...
```

```php
// .env
...
ISMS_USERNAME=
ISMS_PASSWORD=
ISMS_URL='https://www.isms.com.my/RESTAPI.php'
...
```

In order to let your Notification know which phone are you sending to, the channel will look for the `mobile_number` attribute of the Notifiable model (eg. User model). If you want to override this behaviour, add the `routeNotificationForISMS` method to your Notifiable model.

```php
public function routeNotificationForISMS()
{
    return $this->phone_number;
}
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php

use Medkad\ISMS\ISMS;
use Medkad\ISMS\ISMSChannel;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification
{
    public function via($notifiable)
    {
        return [ISMSChannel::class];
    }

    public function toISMS($notifiable)
    {
        return new ISMS('Your SMS Here!');
    }
}
```
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

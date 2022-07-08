# Medkad SMS: ISMS (Laravel Notification Channel)


## Installation

via composer:

``` bash
composer require medkad/laravel-isms
```

### Setting up your configuration

Add your ISMS Account credentials to your `config/services.php`:

```php
// config/services.php
...
'isms' => [
    'username'  =>  env('ISMS_USERNAME', 'medkad'),
    'password'  =>  env('ISMS_PASSWORD', 'password'),
    'url'   =>  env('ISMS_URL', 'https://www.isms.com.my/RESTAPI.php'),
],
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

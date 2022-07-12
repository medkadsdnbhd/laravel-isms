<?php
namespace Medkad\ISMS;

use Medkad\ISMS\Exceptions\ISMSException;
use Illuminate\Support\ServiceProvider;

class ISMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/isms.php',
            'isms'
        );

        $this->publishes([
            __DIR__ . '/config/isms.php' => config_path('isms.php')
        ]);

        $this->app->when(ISMSChannel::class)
            ->needs(ISMSClient::class)
            ->give(function () {
                $config = config('isms');
                if (is_null($config)) {
                    throw ISMSException::invalidConfiguration();
                }

                return new ISMSClient(
                    $config['username'],
                    $config['password'],
                    $config['url'],
                );
            });
    }
}

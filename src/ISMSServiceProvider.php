<?php
namespace Medkad\ISMS;

use Medkad\ISMS\Exceptions\ISMSException;
use Illuminate\Support\ServiceProvider;

class ISMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->when(ISMSChannel::class)
            ->needs(ISMSClient::class)
            ->give(function () {
                $config = config('services.isms');
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

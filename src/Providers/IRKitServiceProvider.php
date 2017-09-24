<?php
/**
 * Created by PhpStorm.
 * User: matsui
 * Date: 2017/09/23
 * Time: 11:36
 */

namespace Crhg\LaravelIRKit\Providers;

use Crhg\IRKit\Client;
use Crhg\IRKit\Host;
use Crhg\LaravelIRKit\Console\Commands\AccessoriesCommand;
use Crhg\LaravelIRKit\Console\Commands\HostsCommand;
use Crhg\LaravelIRKit\Console\Commands\MessagesCommand;
use Crhg\LaravelIRKit\Console\Commands\SendCommand;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class IRKitServiceProvider extends ServiceProvider
{
    const CONTAINER_NAME = 'irkit';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/irkit.php' => config_path('irkit.php'),
        ]);

        $this->commands([
            AccessoriesCommand::class,
            HostsCommand::class,
            MessagesCommand::class,
            SendCommand::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(self::CONTAINER_NAME, function (Container $app) {
            /** @var \Illuminate\Contracts\Config\Repository $config */
            $config = $app->make('config');
            $config_array = $config->get('irkit', []);
            $client = new Client($config_array);

            /** @var \Psr\Log\LoggerInterface $log */
            $log = $app->make('log');
            $client->setLogger($log);

            return $client;
        });
    }
}
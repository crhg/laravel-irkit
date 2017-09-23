<?php
/**
 * Created by PhpStorm.
 * User: matsui
 * Date: 2017/09/23
 * Time: 12:07
 */

namespace Crhg\LaravelIRKit\Facades;

use Crhg\LaravelIRKit\Providers\IRKitServiceProvider;
use Illuminate\Support\Facades\Facade;

/**
 * Class IRKit
 * @package Crhg\LaravelIRKit\Facades
 *
 * @method void send(string $accessory_name, string $command_name)
 */
class IRKit extends Facade
{
    protected static function getFacadeAccessor()
    {
        return IRKitServiceProvider::CONTAINER_NAME;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: matsui
 * Date: 2017/09/23
 * Time: 23:32
 */

namespace Crhg\LaravelIRKit\Console\Commands;


use Crhg\LaravelIRKit\Facades\IRKit;
use Illuminate\Console\Command;

class SendCommand extends Command
{
    protected $signature = 'irkit:send {accessory_name} {command_name}';

    protected $description = 'send a command to accessory';

    public function handle()
    {
        $accessory_name = $this->argument('accessory_name');
        $command_name = $this->argument('command_name');
        IRKit::send($accessory_name, $command_name);
    }
}

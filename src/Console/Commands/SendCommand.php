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
    protected $signature = 'irkit:send {accessory} {command}';

    protected $description = 'send a command to accessory';

    public function handle()
    {
        $accessory = $this->argument('accessory');
        $command = $this->argument('command');
        IRKit::send($accessory, $command);
    }
}

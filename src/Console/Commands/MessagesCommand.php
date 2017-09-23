<?php
/**
 * Created by PhpStorm.
 * User: matsui
 * Date: 2017/09/23
 * Time: 23:49
 */

namespace Crhg\LaravelIRKit\Console\Commands;

use Crhg\LaravelIRKit\Facades\IRKit;
use Illuminate\Console\Command;

class MessagesCommand extends Command
{
    protected $signature = 'irkit:messages {host}';

    protected $description = 'read IR signal from host';

    public function handle()
    {
        $host = $this->argument('host');
        $response = IRKit::messages($host);
        if (!$response->isOk()) {
            $this->error('fail', ['response' => $response]);
            return;
        }

        $response_array = json_decode($response->content(), true);
        $this->line(var_export($response_array, true));
    }
}
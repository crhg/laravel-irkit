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
        if (!$response->getStatusCode() == 200) {
            $this->error('fail', ['response' => $response]);
            return;
        }

        $response_array = json_decode($response->getBody(), true);

        $output = var_export($response_array, true);
        $output = preg_replace('/array \(/', '[', $output);
        $output = preg_replace('/\)/', ']', $output);
        $output = preg_replace('/,\s*\d+\s*=>\s*/', ', ', $output);
        $output = preg_replace('/\d+ =>/', '', $output);

        $this->line($output);
    }
}
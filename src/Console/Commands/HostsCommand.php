<?php
/**
 * Created by PhpStorm.
 * User: matsui
 * Date: 2017/09/24
 * Time: 11:23
 */

namespace Crhg\LaravelIRKit\Console\Commands;


use Illuminate\Console\Command;

class HostsCommand extends Command
{
    protected $signature = 'irkit:hosts';

    protected $description = 'lists hosts';

    public function handle()
    {
        $host = config('irkit.host');

        $headers = ['Name', 'URI'];

        $rows = collect($host)
            ->map(function ($e, $name) {
                return [$name, $e['uri']];
            })
            ->sortBy(0);

        $this->table($headers, $rows);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: matsui
 * Date: 2017/09/24
 * Time: 11:42
 */

namespace Crhg\LaravelIRKit\Console\Commands;


use Illuminate\Console\Command;

class AccessoriesCommand extends Command
{
    protected $signature = 'irkit:accessories';

    protected $description = 'lists accessories';

    public function handle()
    {
        $accessory = config('irkit.accessory');

        $headers = ['Name', 'Host', 'Commands'];

        $rows = collect($accessory)
            ->map(function ($e, $name) {
                return [
                    'name' => $name,
                    'host' => $e['host'],
                    'commands' => collect(array_keys($e['command']))->sort()->implode(' '),
                ];
            })
            ->sort(function ($x, $y) {
                return self::cmp($x['host'], $y['host']) || self::cmp($x['name'], $y['name']);
            })
            ->map(function ($e) {
                return [$e['name'], $e['host'], $e['commands']];
            });

        $this->table($headers, $rows);
    }

    private static function cmp($x, $y)
    {
        return ($x == $y)? 0: ($x < $y)? -1: +1;
    }
}

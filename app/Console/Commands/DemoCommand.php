<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\User;
use Illuminate\Console\Command;

class DemoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /*foreach(User::all() as $user) {
            echo $user->name.PHP_EOL;
        }
        $user = User::where('name', '=', 'Петя')->first();

        echo $user->email.PHP_EOL;*/

    }
}

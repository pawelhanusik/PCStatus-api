<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::cursor();

        foreach ($users as $user) {
            echo "- " . $user->username . "\n";
            
            foreach ($user->computers as $computer) {
                echo "\t- " . $computer->name . "\n";
            }
        }

        return 0;
    }
}

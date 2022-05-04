<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the specified user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::where('username', $this->argument('username'))->delete();
        return 0;
    }
}

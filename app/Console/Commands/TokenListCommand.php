<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class TokenListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:list {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List tokens of specified user (only names will be displayed, since tokens are stored as hashes)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::where('username', $this->argument('username'))->firstOrFail();

        foreach ($user->tokens()->get(['name'])->pluck('name') as $token) {
            echo "- " . $token . "\n";
        }

        return 0;
    }
}

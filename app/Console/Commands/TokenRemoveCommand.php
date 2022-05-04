<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class TokenRemoveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:remove {username} {tokenName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove specific user\'s token.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::where('username', $this->argument('username'))->firstOrFail();
        $user->tokens()->where('name', $this->argument('tokenName'))->delete();
        return 0;
    }
}

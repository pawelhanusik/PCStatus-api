<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class TokenCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:create {username} {tokenName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create token for specified user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tokenName = $this->argument('tokenName');
        
        $user = User::where('username', $this->argument('username'))->firstOrFail();
        
        $user->tokens()->where('name', $tokenName)->delete();
        $token = $user->createToken($tokenName);

        echo "Token: " . $token->plainTextToken . "\n";
        return 0;
    }
}

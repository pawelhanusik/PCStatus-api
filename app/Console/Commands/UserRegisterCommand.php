<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRegisterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:register {username} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register user with the given credentials';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = [
            'username' => $this->argument('username'),
            'password' => $this->argument('password'),
        ];

        $validator = Validator::make($data, [
            'username' => 'string|max:125|unique:users',
            'password' => 'string|max:125',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $fieldName => $fieldErrors) {
                foreach ($fieldErrors as $error) {
                    echo $error . "\n";
                }
            }

            return 1;
        }

        User::create($data);

        return 0;
    }
}

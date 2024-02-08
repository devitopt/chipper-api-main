<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ImportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-users {url} {number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = $this->arguments()['url'];
        $number = $this->arguments()['number'];
        
        $result = Http::get($url);  // https://jsonplaceholder.typicode.com/users
        $users = json_decode($result, true);
        $userCnt = count($users);
        $limit = $userCnt > $number ? $number : $userCnt;
        
        $i = 0;
        foreach ($users as $user) {
            $user = User::create([
                'name'              => $user['name'],
                'email'             => $user['email'],
                'password'          => Hash::make('password'),
                'email_verified_at' => config('app.must_verify_email') ? null : now(),
            ]);            
            if (++$i == $limit) break;
        }
    }
}

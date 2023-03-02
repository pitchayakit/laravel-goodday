<?php

namespace Lexicon\Goodday\Commands;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Lexicon\Goodday\Goodday;

class SyncUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'goodday:sync-users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = Goodday::get('users');

        foreach($users as $goodday_user) {
            $user = User::where('email', $goodday_user->primaryEmail)->first();

            if(!$user) {
                $user = new User();
                $user->name = $goodday_user->name;
                $user->email = $goodday_user->primaryEmail;
                $user->password = Hash::make('!6zj^08CikNZ');
                
                echo "Created new user : $user->email \n";
            }

            $user->goodday_id = $goodday_user->id;
            $user->company_role = $goodday_user->companyRole;
            $user->is_admin = $goodday_user->isAdmin;
            $user->save();

            echo "Updated user : $user->email \n";
        }
    }
}

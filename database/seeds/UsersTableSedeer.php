<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        User::truncate();
//        DB::table('role_user')->truncate();
        $adminRole=Role::where('name','admin')->first();
        $authorRole=Role::where('name','author')->first();
        $userRole=Role::where('name','user')->first();

        $admin=User::create([
            'names'=>'Admin User',
            'email'=>'admin.suggestionBox@rura.rw',
            'password'=>Hash::make('adminrura')
        ]);

        $author=User::create([
            'names'=>'Author User',
            'email'=>'author.suggestionBox@rura.rw',
            'password'=>Hash::make('authorrura')
        ]);
        $user=User::create([
            'names'=>'Generic User',
            'email'=>'user.suggestionBox@rura.rw',
            'password'=>Hash::make('userrura')
        ]);
        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);
    }
}

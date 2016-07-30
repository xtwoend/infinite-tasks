<?php

use App\Entities\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Exmaple User';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin123');
        $user->status = 1;
        $user->save();
    }
}

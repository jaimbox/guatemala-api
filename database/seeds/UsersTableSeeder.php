<?php
use App\User;
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
        User::truncate();

        $password = Hash::make('admin');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@guatemala.com',
            'password' => $password,
        ]);
    }
}

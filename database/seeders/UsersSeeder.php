<?php
use Illuminate\Database\Seeder;
use App\User; class UsersSeeder extends Seeder {
    /**
    * Run the database seeds.
    *
    * @return void */
   public function run() {
           User::truncate();
           $users = [
            [
              'name' => 'Admin',
              'email' => 'admin@gmail.com',
              'password' => '123456',
              'is_teacher' => '1',
            ],
            [
              'name' => 'User',
              'email' => 'user@gmail.com',
              'password' => '13456',
              'is_teacher' => null,
            ],
             [
              'name' => 'Client',
              'email' => 'client@gmail.com',
              'password' => '13456',
              'is_teacher' => null,
            ]
          ];
          foreach($users as $user)
          {
              User::create([
               'name' => $user['name'],
               'email' => $user['email'],
               'password' => Hash::make($user['password'])
             ]);
           }
    }
}

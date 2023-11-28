<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
   

     User::create([
        'full_name' => 'Luciana Morales',
        'email' => 'lucianam@example.com',
        'password' => Hash::make('12345678'),  
     ])->assignRole('Administrator');

     User::create([
        'full_name' => 'Matias Correa',
        'email' => 'Matias@example.com',
        'password' => Hash::make('12345678'),
     ])->assignRole('Author');
     
   //    $users = [
   //       [
   //           'full_name' => 'Luciana Morales',
   //           'email' => 'lucianam@example.com',
   //           'password' => Hash::make('12345678'),
   //       ],
   //       [
   //           'full_name' => 'Matias Correa',
   //           'email' => 'Matias@example.com',
   //           'password' => Hash::make('12345678'),
   //       ],
   //   ];

   //   foreach ($users as $userData) {
   //       $user = User::firstOrNew(['email' => $userData['email']]);
   //       $user->fill($userData)->save();

   //       if (!$user->profile) {
   //           $user->profile()->save(Profile::factory()->make());
   //       }
   //   }

   //   User::factory(10)->create()->each(function ($user) {
   //       if (!$user->profile) {
   //           $user->profile()->save(Profile::factory()->make());
   //       }
   //   });

     User::factory(10)->create(); 
       

 }
}
  
        
   //   User::factory(10)->create();
      
  
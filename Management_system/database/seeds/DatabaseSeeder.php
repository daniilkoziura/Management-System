<?php

use Illuminate\Database\Seeder;
use App\Role;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         $this->call([
             UsersTableSeeder::class,
             RolesTableSeeder::class,
             PermissionsTableSeeder::class,
             MeetingsTableSeeder::class,
             CommentsTableSeeder::class,
         ]);

            $managerRole = Role::where('name', '=', 'Manager')->get();

            $user = App\User::find(1);
            $user2 = App\User::find(2);
            $user3 = App\User::find(3);

            foreach ($managerRole as $value){
                $user->attachRole($value->id);
                $user2->attachRole($value->id);
                $user3->attachRole($value->id);
        }
    }
}

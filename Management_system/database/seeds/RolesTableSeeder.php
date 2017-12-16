<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*--Admin role creating--*/
        Role::create([
            'name'=>'Admin',
            'display_name'=>'Big Boss',
            'description'=>'Admin has all roles available',
            'created_at'=>date("Y-m-d H:i:s"),
        ]);

        /*--Resource Manager role creating--*/
        Role::create([
            'name'=>'Manager',
            'display_name'=>'Resource Manager',
            'description'=>'Resource Manager can watch user-list, search for them, creating meetings',
            'created_at'=>date("Y-m-d H:i:s"),
        ]);
        /*--Resource Manager role creating--*/
        Role::create([
            'name'=>'Employer',
            'display_name'=>'Employer',
            'description'=>'Employer`s just happy do be here',
            'created_at'=>date("Y-m-d H:i:s"),
        ]);
    }
}

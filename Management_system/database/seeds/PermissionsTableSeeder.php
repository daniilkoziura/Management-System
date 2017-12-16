<?php

use Illuminate\Database\Seeder;
use App\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions=[

            /*-For Admins-*/
            [
                'name'=>'role-read',
                'display_name'=>'Display Role Listing',
                'description'=>'See only Listing of Role',
            ],

            [
                'name'=>'role-create',
                'display_name'=>'Create Role',
                'description'=>'Create New Role',
            ],

            [
                'name'=>'role-edit',
                'display_name'=>'Edit Role',
                'description'=>'Edit Role',
            ],

            [
                'name'=>'role-delete',
                'display_name'=>'Delete Role',
                'description'=>'Delete Role',
            ],
            /*-for Manager-*/
            [
                'name'=>'user-list',
                'display_name'=>'display user listing',
                'description'=>'See only user listing',
            ],

            [
                'name'=>'latest-meetings',
                'display_name'=>'latest meetings',
                'description'=>'display user listing which already meeting',
            ],

            [
                'name'=>'recommended-meetings',
                'display_name'=>'list of last meetings',
                'description'=>'The widget displays those people which 
the system recommends create a meeting in the next 2 weeks',
            ],

        ];

        foreach ($permissions as $key => $value){

            Permission::create($value);

        }

    }
}

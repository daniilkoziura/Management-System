<?php

use Illuminate\Database\Seeder;

use App\Meeting;
class MeetingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meetings = [
            [
                'title'=>'Meeting title',
                'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit.
Amet consequatur culpa est harum laborum maiores modi nemo numquam perspiciatis placeat
qui quo reiciendis sapiente, similique sint tenetur veniam? Ex, facilis.',
                'manager_id' =>'1',
                'user_id' =>rand(4, 30),
                'date' => date("Y-m-d H:i:s"),

            ],

            [
                'title'=>'Meeting title2',
                'description'=>'Lorem 2 ipsum dolor sit amet, consectetur adipisicing elit.
Amet consequatur culpa est harum laborum maiores modi nemo numquam perspiciatis placeat',
                'manager_id' =>'1',
                'user_id' =>rand(4, 30),
                'date' => date("Y-m-d H:i:s"),
            ]

        ];


        foreach ($meetings as $meeting){
           Meeting::create($meeting);
        }
    }
}

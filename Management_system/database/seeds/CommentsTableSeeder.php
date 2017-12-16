<?php

use Illuminate\Database\Seeder;
use \App\Comment;
class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $comments  = [

            [
                'text'=>'it`s a great new comment',
                'creator_id' => rand(1, 8),
                'meeting_id' => rand(1,2),
            ],

            [
                'text'=>'2it`s a great new comment',
                'creator_id' => rand(1, 8),
                'meeting_id' => rand(1,2),
            ],

            [
                'text'=>'3it`s a great new comment',
                'creator_id' => rand(1, 8),
                'meeting_id' => rand(1,2),
            ],

            [
                'text'=>'4it`s a great new comment',
                'creator_id' => rand(1, 8),
                'meeting_id' => rand(1,2),
            ],
            [
                'text'=>'5it`s a great new comment',
                'creator_id' => rand(1, 8),
                'meeting_id' => rand(1,2),
            ],
            [
                'text'=>'6it`s a great new comment',
                'creator_id' => rand(1, 8),
                'meeting_id' => rand(1,2),
            ],
            [
                'text'=>'7it`s a great new comment',
                'creator_id' => rand(1, 8),
                'meeting_id' => rand(1,2),
            ],
            [
                'text'=>'8it`s a great new comment',
                'creator_id' => rand(1, 8),
                'meeting_id' => rand(1,2),
            ],
            [
                'text'=>'9it`s a great new comment',
                'creator_id' => rand(1, 8),
                'meeting_id' => rand(1,2),
            ],
        ];



        foreach ($comments as  $value){

            Comment::create($value);

        }
    }
}

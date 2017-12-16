<?php

namespace App\Http\Controllers;
use App\Comment;
use App\Meeting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Comment Controller
|--------------------------------------------------------------------------
|
| This controller handles the creation of new users.
|
*/

class CommentController extends Controller
{

    /**
     * @param User $user
     * @param Meeting $meeting
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(User $user, Meeting $meeting, Request $request)
    {
        $meeting->addComment($request);
        return back();
    }

}
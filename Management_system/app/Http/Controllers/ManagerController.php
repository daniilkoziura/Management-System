<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Meeting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Manager Controller
|--------------------------------------------------------------------------
|
| This controller has a show method which display all users,
|  recommended users and last meetings of new users, search method which search users by their names.
|
*/
class ManagerController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function show()
    {

        $recommended = User::RecommendedUsers();

        $users = User::orderBy('join_date', 'desc')->paginate(9);

        if (Auth::user()->hasRole('Manager') ){
            $id = Auth::user()->id;
            $meetings = Meeting::orderby('created_at', 'desc')->where('manager_id',
                '=', $id)->limit(10)->get();
        }


        return view('layouts.manager', compact('users', 'meetings', 'recommended'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function search(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:2'
        ]);
        $searchName = $request->name;
        $searchUser = User::where('name', '=', $searchName)->get();
            foreach ($searchUser as $item){
                $searchId = $item->id;

            }
        if (!isset($searchId)){
                return back()->withErrors(array('message' => "user  '$searchName'  is not found."));
        }else{

            return redirect("/meeting/$searchId");
        }

    }



}

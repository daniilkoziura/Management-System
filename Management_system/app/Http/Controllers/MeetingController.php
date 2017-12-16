<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Meeting Controller
|--------------------------------------------------------------------------
|
| This controller has a showMeetings method which display all meetings and
| sorting them by their created date,
| media method which returns comments with their creators in specify meetings,
| create method which create meetings
| choiceStatus which can update `risk_status` for special user
*/

class MeetingController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showMeetings(User $user)
    {
            $meetings = Meeting::orderby('created_at', 'desc')->get();

        return view('layouts.meetings', compact('meetings', 'user'));
    }


    /**
     * @param User $user
     * @param Meeting $meeting
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function media(User $user, Meeting  $meeting)
    {
       // dd($user, $meeting);
        $meetings = Meeting::orderby('created_at', 'desc')->get();
        $comments = Comment::where('meeting_id', '=', $meeting->id)->latest()->get();
        return view('layouts.full_meetings', compact('meeting', 'user', 'comments' , 'meetings'));

    }

    /**
     * @param User $user
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function create(User $user,  Request $request)
    {
        if ($request->user()->hasRole('Manager') ){
            if (empty($request->date)){
                $date =date("Y-m-d");
            }else{
                $date = $request->date;
            }

            $this->validate($request, [
                'title' =>'required',
                'description' =>'required|min:5',
            ]);

         Meeting::create([
            'title'=>$request->title,

            'description'=>$request->description,

            'manager_id'=>$request->user()->id,

            'user_id' =>$user->id,

             'date'=> $date
        ]);
        }else{
            return back()->withErrors(
                'message','Check your permissions and try again'
            );
        }
        $user->risk_status = 0;
        $user->save();
        return back();
    }

    /**
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function choiceStatus(User $user, Request $request)
    {
        $user->risk_status = $request->risk;
        $user->save();
        return back();
    }



}


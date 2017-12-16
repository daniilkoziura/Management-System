<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\DB;
class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name','name', 'email', 'password', 'join_date', 'risk_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @param $yourDate
     * @return float
     */
    protected function getAmountOfDays($yourDate)
    {
        $secondOfYourDate =  strtotime($yourDate);

        $secondOfNow = strtotime(date("Y-m-d H:i:s"));

        $days = ($secondOfNow - $secondOfYourDate - 10800)/60/60/24 ;

        return round($days,0, PHP_ROUND_HALF_UP);
    }

    /**
     * @param $risk
     * @param $days
     * @return int
     */
    protected function getDaysWhichDependRiskStatus($risk, $days)
    {
            if ($risk == 0)
            {
                return $days+90;
            }elseif ($risk == 1){
                return $days+60;
            }elseif ($risk ==2){
                return $days+30;
            }
    }


    /**
     * in array we have `id`, `risk_status` , `name` , `date`, `fullday` fields.
     * array sorted by fullday field
     * @return array
     */
    protected function RecommendedUsers()
    {   $j=0;
        $ViewMass=[];
        foreach ($this->all() as $users){
            $user = $this->find($users->id);
            $hasMeeting = $user->meetings;
            if (count($hasMeeting) != 0) {
                $j++;
                $dateOfLastMeeting =  $user->meetings()->orderby('created_at', 'desc')->first()->date;
                $days = $this->getAmountOfDays($dateOfLastMeeting);
                $id = $user->id;
                $name = $user->name;
                $risk =$user->risk_status;
                $fullDay =$this->getDaysWhichDependRiskStatus($risk, $days);
                $view=[
                    'id'=>$id,
                    'risk_status'=>$risk,
                    'name' => $name,
                    'date' => $dateOfLastMeeting,
                    'fullday' => $fullDay,
                ];
                 $ViewMass[$j]=$view;


            }else {
                $j++;
                $dateOfRegister = $user->join_date;
                $days = $this->getAmountOfDays($dateOfRegister);
                $name = $user->name;
                $risk = $user->risk_status;
                $id = $user->id;
                $fullDay = $this->getDaysWhichDependRiskStatus($risk, $days);
                $view=[
                    'id'=>$id,
                    'risk_status'=>$risk,
                    'name' => $name,
                    'date' => $dateOfRegister,
                    'fullday' => $fullDay,
                ];
                $ViewMass[$j]=$view;
            }
        }
        $newMass=array();
        foreach ($ViewMass as $key=>$items){
             $newMass[$key] = $items['fullday'];
        }
        array_multisort($newMass, SORT_DESC, $ViewMass);
        return $ViewMass;

    }

    /**
     * Just update risk status when manager has determined his choice
     * @param $id
     */
    protected function updateRiskStatus($id)
    {
        $user = $this->find($id);
        $user->risk_status = $this->checkUserRiskStatus($id);
        $user->save();
    }



}

<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 6/8/2019
 * Time: 7:37 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class UserFlow extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_flow';


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];


    
    /**
     * Get Onboard Users steps
     *
     * @return mixed
     */
    public function getOnboardUserSteps()
    {
        return $this->selectRaw("DATE_ADD(created_at, INTERVAL(2-DAYOFWEEK(created_at)) DAY) AS week_start,
                             CONCAT(YEAR(created_at), '/', WEEK(created_at)) AS week_name, 
                             SUM(CASE WHEN onboarding_perentage >= 0 AND onboarding_perentage < 20 THEN 1 ELSE 0 END) Step1,
                             SUM(CASE WHEN onboarding_perentage >= 20 AND onboarding_perentage < 40 THEN 1 ELSE 0 END) Step2,
                             SUM(CASE WHEN onboarding_perentage >= 40 AND onboarding_perentage < 50 THEN 1 ELSE 0 END) Step3,
                             SUM(CASE WHEN onboarding_perentage >= 50 AND onboarding_perentage < 70 THEN 1 ELSE 0 END) Step4,
                             SUM(CASE WHEN onboarding_perentage >= 70 AND onboarding_perentage < 90 THEN 1 ELSE 0 END) Step5,
                             SUM(CASE WHEN onboarding_perentage >= 90 AND onboarding_perentage < 99 THEN 1 ELSE 0 END) Step6,
                             SUM(CASE WHEN onboarding_perentage = 99 THEN 1 ELSE 0 END) Step7,
                             SUM(CASE WHEN onboarding_perentage <= 100 THEN 1 ELSE 0 END) Step8
                ")
                ->groupBy("week_name")
                ->orderByRaw("YEAR(created_at)","ASC")
                ->orderByRaw("WEEK(created_at)","ASC")
                ->get();
    }
}

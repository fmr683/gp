<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 6/8/2019
 * Time: 7:20 PM
 */

namespace App\Http\Controllers;


use App\UserFlow;

class UserController extends Controller
{
    /**
     * @var UserFlow
     */
    private $userFlow;


    /**
     * UserController constructor.
     *
     * @param UserFlow $userFlow
     */
    public function __construct(UserFlow $userFlow)
    {
        $this->userFlow = $userFlow;
    }


    /**
     * Get Flow Count Weekly
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function flowCountWeekly()
    {
        $weeklySteps = $this->userFlow->getOnboardUserSteps();

        foreach ($weeklySteps as $week)
        {
            $data = [];

            for ($i = 1; $i <= 8; $i++)
            {

                if ($i == 1)
                {
                    $data[] = 100;

                } else if ($week->Step1 > 0) {

                    $data[] = round(($week->{"Step" . $i} / $week->Step1) * 100);
                } else {
                    $data[] = 0;
                }
            }


            $chart ["series"] [] = [
                "name" => $week->week_start,
                "data" => $data
            ];
        }

        return response()->json($chart);
    }


}

<?php

namespace App\Http\Controllers;


use App\UserFlow;

class UserFlowController extends Controller
{
    /**
     * @var UserFlow
     */
    private $userFlow;


    /**
     * UserFlowController constructor.
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

        if (empty($weeklySteps)) { // No result
            return response()->json($users, 404);
        }

        foreach ($weeklySteps as $week)
        {
            $data = [];

            for ($i = 1; $i <= 8; $i++)
            {

                if ($i == 1)
                {
                    $data[] = 100;

                } else {
                    $data[] = round(($week->{"Step".$i}/$week->Step1) * 100);
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

<?php
   
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\CourseSession;
use App\Models\SessionExercise;

class UserController extends BaseController
{

    private $courseSession;
    private $sessionExercise;

    /**
     * Create a new controller instance.
     *
     * @param $courseSession \App\Models\CourseSession
     * @param $sessionExercise \App\Models\SessoinExercise
     *
     * @return void
     */
    public function __construct(CourseSession $courseSession, SessionExercise $sessionExercise)
    {
        $this->courseSession = $courseSession;
        $this->sessionExercise = $sessionExercise;
    }


    /**
     * User sessions API
     * @param $userId integr
     * @param $request \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */

    public function getUserSessionsByUserId($userId = 0, Request $request)
    {
        try {

            $courseSessions = $this->courseSession->getSessionsByUserId($userId);

            $success['history'] =  $courseSessions;
            $meta['row_count'] =  count($courseSessions);
            $meta['message'] = $meta['row_count'] ? 'Total '.$meta['row_count'].' record(s) found': 'No record found';

            return $this->sendResponse($success, $meta);
        } catch (\Exception $e) {

            return $this->sendError('SYSTEM ERROR.', ['error'=> $e->getMessage() ]);   
            return $this->sendError('SYSTEM ERROR.', ['error'=>'System is not responding. Please try again.']);   
        }
    }


    /**
     * User latest sessions' exercises (by default latest 12 sessions) API
     * @param $userId integr
     * @param $request \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserExercisesByUserId($userId = 0,Request $request)
    {
        try {
            $latestSessionExercis = $this->sessionExercise->getLatestExercisesByUserId($userId);
            $sessionExercises = $this->sessionExercise->getExercisesByUserId($userId);

            $success['exercises'] =  $sessionExercises;
            $success['lastest_exercise'] =  $latestSessionExercis;
            $meta['row_count'] =  count($sessionExercises);
            $meta['message'] = $meta['row_count'] ? 'Total '.$meta['row_count'].' record(s) found': 'No record found';

            return $this->sendResponse($success, $meta);
        } catch (\Exception $e) {
            return $this->sendError('SYSTEM ERROR.', ['error'=>'System is not responding. Please try again.']);   
        }
    }
}
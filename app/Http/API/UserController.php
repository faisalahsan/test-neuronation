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
     * @return void
     */
    public function __construct(CourseSession $courseSession, SessionExercise $sessionExercise)
    {
        $this->courseSession = $courseSession;
        $this->exercise = $sessionExercise;
    }


    /**
     * User sessions API
     * @return \Illuminate\Http\Response
     */

    public function getUserSessions($userId = null, Request $request)
    {
        try {

            $courseSessions = $this->courseSession->getSessionsByUserId($userId);

            $success['history'] =  $courseSessions;
            $meta['row_count'] =  count($courseSessions);
            $meta['message'] = $meta['row_count'] ? 'Total '.$meta['row_count'].' record(s) forund': 'No record found';
            $meta['timestamp'] = now();

            return $this->sendResponse($success, $meta);
        } catch (\Exception $e) {
            return $this->sendError('SYSTEM ERROR.', ['error'=>'System is not responding. Please try again.']);   
        }
    }
}
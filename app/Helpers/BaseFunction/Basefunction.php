<?php
namespace App\Helpers\BaseFunction;
use App\Models\ApiSession;

class BaseFunction
{
    public static function setSessionData($userId)
    {
        if (empty($userId)) {
            return "User id is empty.";
        } else {
            /*  FIND USER ID IN API SESSION AVAILABE OR NOT  */
            $getApiSessionData = ApiSession::where('user_id', $userId)->first();
            if ($getApiSessionData) {
                if ($getApiSessionData->delete()) {
                    $apiSession = new ApiSession();
                    /*  SET SESSION DATA  */
                    $sessionData = [];
                    $sessionData['session_id'] = md5(rand());
                    $sessionData['user_id'] = $userId; 
                    $apiSession->fill($sessionData);
                    if ($apiSession->save()) {
                        return $apiSession->session_id;
                    } else {
                        return FALSE;
                    }
                } else {
                    return FALSE;
                }
            } else {
                $apiSession = new ApiSession();
                /*  SET SESSION DATA  */
                $sessionData = [];
                $sessionData['session_id'] = md5(rand());
                $sessionData['user_id'] = $userId;               
                $apiSession->fill($sessionData);
                if ($apiSession->save()) {
                    return $apiSession->session_id;
                } else {
                    return FALSE;
                }
            }
        }
    }

    /**
     * Check token is valid or not
     * @param $sessionId
     * @return array
     */
    public static function checkApisSession($sessionId)
    {
        $checkSessionExist = ApiSession::where('session_id', $sessionId)->first();

        if ($checkSessionExist) {
            $sGetUserDataessionData = [];
            $sessionData['id'] = ($checkSessionExist->id) ? $checkSessionExist->id : '';
            $sessionData['session_id'] = ($checkSessionExist->session_id) ? $checkSessionExist->session_id : '';
            $sessionData['user_id'] = ($checkSessionExist->user_id) ? $checkSessionExist->user_id : '';           
            return $sessionData;
        } else {
            return array();
        }
    }
    public static function random_code($limit)
    {

        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}

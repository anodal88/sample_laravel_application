<?php
/**
 * Created by PhpStorm.
 * User: niru
 * Date: 7/9/2016
 * Time: 2:45 PM
 */

namespace App\Helpers;
use App\User;
use Illuminate\Support\Facades\Lang;
class Helper
{
    /**
     * @param string $status
     * var $status can have 3 values : success, failure, error
     * @param array $data
     * @param string $message
     */
    public static function processApiResult($status, $data = null, $message = null)
    {
        $result['status'] = $status;
        $result['data'] = $data;
        $result['message'] = $message;

        \Response::json($result);

        /*header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json;charset=utf-8');
        echo json_encode($result);*/
    }
    /**
     * @param string $username
     * var $status can have 2 values : true, false
     * @return boolean
     */
    public static function isExistNotActive($username)
    {
        $u = User::where('active',0)
            ->Where(function ($query) use ($username) {
                $query->Where('email', $username)
                    ->orWhere('username', $username)
                ;
            })->first();
        if($u instanceof User)
            return true;
        return false;

    }
    /**
     *
     *
     * @return string with global message for exceptions
     */
    public static function globalMessage()
    {
        return Lang::has('exceptions.global')
            ? Lang::get('exceptions.global')
            : 'Technical failure!!';

    }
}
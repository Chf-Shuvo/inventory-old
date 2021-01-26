<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
// use Mail;
// use App\Mail\SendEmail;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // function curl($url) {
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    //     $data = curl_exec($ch);
    //     curl_close($ch);

    //     return $data;
    // }
    public function index()
    {

        /**
         * assigning roles to users
         */
        $type= Auth::user()->type;
        $user_mail = Auth::user()->email;
        $roles = Role::all();
        // assigning role
        foreach($roles as $role){
            if($role->name == $type){
                auth()->user()->assignRole($role->name);
            }
        }
      
        // msg test
            
            // taking users
            // $users = User::latest()->take(2)->get();
            // $numbers=['01521211335','01575067411'];
            // foreach($users as $index=>$user1){
            //     $user = "baiustict";
            //     $pass = "20baiustictw";
            //     $sms_content = $user1->name;
            //     $msg=urlencode($sms_content);
            //     $number = $numbers[$index];
            //     //return $number;
            //     $feed = "http://developer.muthofun.com/sms.php?username=$user&password=$pass&mobiles=$number&sms=$msg&uniccode=1";
            //     $tweets = $this->curl($feed);
            // }

            /** sending email */
        // $subject="Requsition Placed";
        // $message = "A Requisition has been placed from ICT WING, waiting for your approval";
        // Mail::to($user_mail)->send(new SendEmail($subject,$message));
        return view('home');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Configurations;
use App\Group;
use Auth;
use Session;
use App\User;
use App\Page;
use App\UserLog;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/backend';

    public function authenticated($request, $user)
    {
        session(['uid' => $user->id]);
        session(['name' => $user->name]);
        session(['email' => $user->email]);
        session(['role' => $user->type]);

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function login(Request $request)
    {
        // check user exits in AD
        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "http://ws.lanna.co.th/Ads/checkuser",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_POSTFIELDS => "{\r\n    \"username\" : \"" . $request->username . "\",\r\n    \"password\" : \"" . $request->password . "\"\r\n}",
        //     CURLOPT_HTTPHEADER => array(
        //         "Content-Type: application/json"
        //     ),
        // ));

        // $response = json_decode(curl_exec($curl));
        // curl_close($curl);

        // if ($response->Result == true) {
        //     $data = $response->Data[0];
        //     $user = User::where('username', $data->Username)->first();
        //     if (is_null($user)) {

        //         $role = \App\Role::where('slug', 'super-admin')->first();
        //         // if (User::all()->isEmpty()) {
        //         //     $role = \App\Role::where('slug', 'super-admin')->first();
        //         // } else {
        //         //     $role = \App\Role::where('slug', 'user')->first();
        //         // }

        //         $new_user = new User();
        //         $new_user->name = $data->FullName;
        //         $new_user->username = $data->Username;
        //         $new_user->email = $data->Email;
        //         $new_user->save();
        //         $new_user->roles()->attach($role);

        //         $user = User::where('username', $data->Username)->first();
        //     }

        $user = User::where('username', $request->username)->first();

        $group = [];
        $group_hour = [];

        if (isset($data->Group)) {
            foreach ($data->Group as $key => $value) {
                $group[] = $value->ID;
                $hours = Group::where('group_id', $value->ID)->first();
                if ($hours) {
                    $group_hour[] = intval($hours->hour);
                }
            }
        }

        if (count($group_hour) > 0) {
            $max_booking_hour = max($group_hour);
        } else {
            $max_booking_hour = intval(\App\Configurations::select('value')->where('name', 'booking-hour-max')->first()->value);
        }

        session(['uid' => $user->id]);
        session(['username' => $user->username]);
        session(['name' => $user->name]);
        session(['email' => $user->email]);
        session(['group' => $group]);
        //session(['locale' => $user->lang]);

        $configs = \App\Configurations::all();

        foreach ($configs as $k => $c) {
            if ($c->name == 'booking-hour-max') {
                session([$c->name => $max_booking_hour]);
            } else if ($c->name == 'admin-password') {
            } else {
                session([$c->name => $c->value]);
            }
        }

        $notification = array(
            'message' => 'Welcome! ' . $user->name,
            'alert-type' => 'success'
        );

        $this->guard()->login($user, true);

        return redirect()->route('dashboard')->with($notification);
        // } else {

        //     $notification = array(
        //         'message' => 'The username or password is incorrect',
        //         'alert-type' => 'error'
        //     );

        //     return redirect()->route('login')->with($notification);
        // }
    }

    // public function login_via_ajax(Request $request)
    // {
    //     $curl = curl_init();
    //     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    //     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "http://ws.lanna.co.th/Ads/checkuser",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "POST",
    //         CURLOPT_POSTFIELDS => "{\r\n    \"username\" : \"" . $request->username . "\",\r\n    \"password\" : \"" . $request->password . "\"\r\n}",
    //         CURLOPT_HTTPHEADER => array(
    //             "Content-Type: application/json"
    //         ),
    //     ));

    //     $response = json_decode(curl_exec($curl));
    //     curl_close($curl);

    //     if ($response->Result == true) {
    //         $data = $response->Data[0];
    //         $user = User::where('username', $data->Username)->first();
    //         if (is_null($user)) {

    //             $role = \App\Role::where('slug', 'user')->first();

    //             $new_user = new User();
    //             $new_user->name = $data->FullName;
    //             $new_user->username = $data->Username;
    //             $new_user->email = $data->Email;
    //             $new_user->save();
    //             $new_user->roles()->attach($role);

    //             $user = User::where('username', $data->Username)->first();
    //         }

    //         $group_hour = [];

    //         foreach ($data->Group as $key => $value) {
    //             $group[] = $value->ID;
    //             $hours = Group::where('group_id', $value->ID)->first();
    //             if ($hours) {
    //                 $group_hour[] = intval($hours->hour);
    //             }
    //         }

    //         if (count($group_hour) > 0) {
    //             $max_booking_hour = max($group_hour);
    //         } else {
    //             $max_booking_hour = intval(\App\Configurations::select('value')->where('name', 'booking-hour-max')->first()->value);
    //         }

    //         session(['uid' => $user->id]);
    //         session(['username' => $user->username]);
    //         session(['name' => $user->name]);
    //         session(['email' => $user->email]);
    //         session(['group' => $group]);;
    //         session(['booking-hour-max' => $max_booking_hour]);

    //         $this->guard()->login($user, true);

    //         return response()->json(true);
    //     } else {
    //         return response()->json(false);
    //     }
    // }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('login');
    }
}

<?php

namespace App\Http\Controllers;

use App;
use App\User;

use App\Helpers\Helper;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Lang;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;



    public function index()
    {
        $User = User::all();

        return response()->json($User);
    }

    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function user_index()
    {
        return view('user.user');
    }


    public function get()
    {
        $user = User::query();
        return Datatables::of($user)
            ->addColumn('action', function ($id) {
                return '<button class="btn btn-info btn_edit_user" id="btn_edit_user" data-toggle="modal" data-target="#modal_edit_user" data-remote ="' . $id->id . '" >Edit</button>
            <button class="btn  btn-danger btn_delete_user" id="btn_delete_user"  data-remote ="' . $id->id . '" >Delete</button>
            <button class="btn  btn-bg bg-black btn_cp_user" data-toggle="modal" data-target="#modal_reset_password" id="btn_user_reset_password"  data-remote ="' . $id->id . '" >Change Password</button>';
            })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('Hola');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $data = $request->all();

            $validator = $this->validator($data);

            if ($validator->fails()) {
                $result['status'] = "failure";
                $result['message'] = $validator->errors()->getMessages();
                return response()->json($result);
            }

            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'active' => (isset($data['active'])) ? $data['active'] : 1,
                'password' => bcrypt($data['password']),
                'api_token' => str_random(60)
            ]);

            if (isset($data['role'])) {
                if ($data['role'] == '') {
                    $user->roles()->sync([]);
                } else {
                    $user->roles()->sync([]);
                    foreach ($data['role'] as $item) {
                        $user->attachRole($item);
                    }

                }
            } else {
                $role = App\Role::where('name', '=', 'user')->first();
                $user->attachRole($role->id);
            }




            $result['status'] = "success";
            $result['data'] = $user;
            $result['message'] = "User created successfully";
            $this->createFileStructureForUsers($data['email']);
            return response()->json($result);
        }catch(\Exception $e){
            return new Response(Helper::globalMessage(),500);
        }
    }

    public function createFileStructureForUsers($username){
        try{
            if(Storage::disk('s3')->exists('users')){
                Storage::makeDirectory('users/'.$username);
                Storage::makeDirectory('users/'.$username.'/projects');
            }else{
                Storage::makeDirectory('users');
                Storage::makeDirectory('users/'.$username);
                Storage::makeDirectory('users/'.$username.'/projects');
            }
        }catch(\Exception $e){
            throw new \Exception("Error creating user's file structure");
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Logout the current user of app
     */
    public function logout()
    {
        try {
            Auth::logout();
            if(Auth::user()){
                $result['status'] = "failure";
                $result['message'] = "Error login out the user.";
                return response()->json($result);
            }
            $result['status'] = "success";
            $result['message'] = "User logged out successfully.";
            return response()->json($result);
        }catch(\Exception $e){
                $result['status'] = "failure";
                $result['message'] = "Error login out the user.";
                return response()->json($result);
            }

    }

    /**
     * Reset paswd .
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function reset_passwd(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $request->all();

            $validator = Validator::make($data, [
                'password' => 'required|min:6|confirmed',
            ]);



            if ($validator->fails()) {
                $result['status'] = "failure";
                $result['message'] = $validator->errors()->getMessages();
                return response()->json($result);
            }

            $user = User::findOrFail($id);
            $user->password = bcrypt($data['password']);
            $user->save();


            $result['status'] = "success";
            $result['message'] = "Reset Password successfully";


            return response()->json($result);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {

            $data = $request->all();
            $user = User::findOrFail($id);
            $validator = $this->validator($data);

            $result = '';


            if ($validator->fails()) {
                $result['message'] = $validator->errors()->getMessages();

                if (!array_key_exists('name', $result['message'])) {

                    $user->name = $data['name'];
                }
                if (!array_key_exists('username', $result['message'])) {

                    $user->username = $data['username'];
                }
            } else {
                $user->name = $data['name'];
                $user->username = $data['username'];
            }

            $user->active = (isset($data['active'])) ? $data['active'] : 1;

            if ($data['rol'] == '') {
                $user->roles()->sync([]);
            } else {
                $user->roles()->sync([]);
//                $user->roles()->sync($data['rol']);
                foreach ($data['rol'] as $item) {

                    $user->attachRole($item);
                }

            }
            $user->save();


            $result['status'] = "success";
            $result['data'] = $user;
            $result['message'] = "The user was successfully changed";

            return response()->json($result);


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::findOrFail($id);
//        dd($user->profile()->get()->toArray());
        $user->delete();
        $user->roles()->sync([]);
        $result['status'] = "success";
        $result['message'] = "The user was deleted successfully";

        return response()->json($result);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        $credentials=$request->only($this->loginUsername(), 'password');
        return array_add($credentials,'active',1);
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {

        $result['status'] = "failure";
        $credentials = $this->getCredentials($request);
        if(Helper::isExistNotActive($credentials[$this->loginUsername()])){
            $result['message'] = Lang::has('auth.failed.active')
                ? Lang::get('auth.failed.active')
                : 'This account is not currently available, please contact our administrators.';
        }else{
            $result['message'] = $this->getFailedLoginMessage();
        }
        return response()->json($result);
    }

    public function getAll()
    {


        $user = User::all();

//        return View::make('user.new_rol')->with('permissions', $permission);
        return response()->json($user);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  bool $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        $user = Auth::user()->getAttributes();
        $api_token = $user['api_token'];

        unset($user['password']);
        //unset($user['api_token']);



        $result['status'] = "success";
        $result['data'] = $user;

        return response()->json($result)->header("Api-Token", $api_token);
    }

    /*public function verifyLogin(Request $request)
    {
        $this->login($request);
    }*/
}

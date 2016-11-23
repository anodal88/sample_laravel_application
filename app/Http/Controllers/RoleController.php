<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Validator;
use Auth;
use App;
use Yajra\Datatables\Datatables;

class RoleController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

//        if (Auth::user()->hasRole(['admin'])) {
//
            return view('user.rol');
//        } else {
//            return App::abort(403, 'Access denied');
//
//        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $role = Role::findOrFail($id); // Pull back a given role

// Regular Delete
        $role->delete(); // This will work no matter what
//
//// Force Delete
        $role->users()->sync([]); // Delete relationship data
        $role->perms()->sync([]); // Delete relationship data

//        $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete
        $result['status'] = "success";
        $result['message'] = "The role was deleted successfully";

        return response()->json($result);
    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        $role = Role::query();
        return Datatables::of($role)
            ->addColumn('action', function ($id) {
                return '<button class="btn btn-info btn_edit_rol" id="btn_edit_rol" data-toggle="modal" data-target="#modal_edit_rol" data-remote ="' . $id->id . '" >Edit</button>
            <button class="btn  btn-danger btn_delete_rol" id="btn_delete_rol"  data-remote ="' . $id->id . '" >Delete</button>';
            })->make(true);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            $validator = $this->validator($data);

            if ($validator->fails()) {
                $result['status'] = "failure";
                $result['message'] = $validator->errors()->getMessages();
                return response()->json($result);
            }

            $role = Role::create($request->all());
            $role->perms()->sync($data['permission']);


            $result['status'] = "success";
            $result['data'] = $role;
            $result['message'] = "Role created successfully";

            return response()->json($result);
        }
    }


    public function update(Request $request, $id)
    {
        if ($request->ajax()) {

            $data = $request->all();
            $role = Role::findOrFail($id);
            $validator = $this->validator($data);

            $result = '';


            if ($validator->fails()) {
                $result['message'] = $validator->errors()->getMessages();

                if (!array_key_exists('name', $result['message'])) {

                    $role->name = $data['name'];
                }
                if (!array_key_exists('display_name', $result['message'])) {

                    $role->display_name = $data['display_name'];
                }
            } else {
                $role->name = $data['name'];
                $role->display_name = $data['display_name'];
            }

            $role->description = $data['description'];
            if ($data['permission'] == '') {
                $role->perms()->sync([]);
            } else {
                $role->perms()->sync($data['permission']);
            }
            $role->save();


            $result['status'] = "success";
            $result['data'] = $role;
            $result['message'] = "The role was successfully changed";

            return response()->json($result);


        }
    }


    public function getAllUser($id_user)
    {

        $roleAll = Role::all()->toArray();
        $user = User::findOrFail($id_user);

        $roleUser = json_decode(json_encode($user->roles()->get()), true);

        $result = array();

        $pila = array();
        array_push($pila, ['user' => $user->toArray()]);
        foreach ($roleAll as $all) {
            $flag = False;
            foreach ($roleUser as $role) {
                if ($role['name'] == $all['name']) {
                    $flag = True;
                    break;
                }

            }
            if ($flag) {
                $data = ['data' => $all, 'intersect' => true];
                array_push($pila, $data);
            } else {
                $data = ['data' => $all, 'intersect' => false];
                array_push($pila, $data);
            }

        }
        return response()->json($pila);
    }

    public function getAll()
    {

        $role = Role::all();
        return response()->json($role);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:roles',
            'display_name' => 'required|max:255|unique:roles',

        ]);
    }
}




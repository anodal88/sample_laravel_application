<?php

namespace App\Http\Controllers;

use App\PermissionRole;
use App\Role;
use Illuminate\Http\Request;
use \GuzzleHttp\json_decode;
use App\Permission;
use Validator;
use Yajra\Datatables\Datatables;

class PermissionController extends Controller
{

    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        return view('user.permission');
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

            $permission = Permission::create($request->all());


            $result['status'] = "success";
            $result['data'] = $permission;
            $result['message'] = "Permission created successfully";


            return response()->json($result);
        }
    }

    public function destroy($id)
    {

        Permission::findOrFail($id)->delete(); // Pull back a given role

        $result['status'] = "success";
        $result['message'] = "The permission was deleted successfully";

        return response()->json($result);
    }

    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return response()->json($permission);
    }


    public function get()
    {
        $permission = Permission::query();
        return Datatables::of($permission)
            ->addColumn('action', function ($id) {
                return '<button class="btn btn-info btn_edit_permission" id="btn_edit_permission" data-toggle="modal" data-target="#modal_edit_permission" data-remote ="' . $id->id . '" >Edit</button>
            <button class="btn  btn-danger btn_delete_permission" id="btn_delete_permission"  data-remote ="' . $id->id . '" >Delete</button>';
            })->make(true);
    }


    public function getAll()
    {

        $permission = Permission::all();
//        return View::make('user.new_rol')->with('permissions', $permission);
        return response()->json($permission);
    }

    public function getAllRol($id_role)
    {

        $permissionAll = Permission::all()->toArray();
        $rol = Role::findOrFail($id_role);

        $permissionRole = json_decode(json_encode($rol->perms()->get()), true);


        $result = array();

        $pila = array();
        array_push($pila, ['rol' => $rol->toArray()]);
        foreach ($permissionAll as $all) {
            $flag = False;
            foreach ($permissionRole as $role) {
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


    public function update(Request $request, $id)
    {
        if ($request->ajax()) {

            $data = $request->all();
            $permission = Permission::findOrFail($id);
            $validator = $this->validator($data);

            $result = '';


            if ($validator->fails()) {
                $result['message'] = $validator->errors()->getMessages();

                if (!array_key_exists('name', $result['message'])) {

                    $permission->name = $data['name'];
                }
                if (!array_key_exists('display_name', $result['message'])) {

                    $permission->display_name = $data['display_name'];
                }
            } else {
                $permission->name = $data['name'];
                $permission->display_name = $data['display_name'];
            }

            $permission->description = $data['description'];
            $permission->save();


            $result['status'] = "success";
            $result['data'] = $permission;
            $result['message'] = "The permission was successfully changed";

            return response()->json($result);


        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:permissions',
            'display_name' => 'required|max:255|unique:permissions',

        ]);
    }
}

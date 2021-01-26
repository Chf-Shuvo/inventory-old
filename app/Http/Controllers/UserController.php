<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Department;
use Auth;
use DB;
// use Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $departments = Department::all();
        $object = new User;
        $modelname = class_basename($object);
        $roles = DB::table('roles')->get();
        //return $modelname;
        //toastr()->success('view loaded','success');
        return view('backend.content.user.index', compact('users','roles','modelname','departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       //return $request;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'type' => ['required','string'],
            'department' => 'required',
            'status' => ['required','string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $user = new User([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'department' => $request['department'],
            'status' => $request['status'],
            'password' => Hash::make($request['password']),
        ]);
        $user->password_raw = $request->get('password');
        $user->save();
        toastr()->success('user added successfully', 'Success');
        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::find($id);
        return view('backend.content.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'type' => ['required','string'],
            'department' => 'required',
            'status' => ['required','string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->department = $request->get('department');
        $user->type = $request->get('type');
        $user->status = $request->get('status');
        $user->password = Hash::make($request->get('password'));
        $user->save();
        toastr()->success('User updated successfully','Success');
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //$id = Crypt::decrypt($id); //receiving id and decrypting it
    //     return "hello";
    // }
    public function delete($id){
        $id = Crypt::decrypt($id);
        $user = User::find($id);
        $user->delete();
        toastr()->success('user deleted successfully', 'Success');
        return redirect(route('user.index'));
    }

                                /** ACL PART */
    // ACL INDEX
    public function acl_index(){
        $object = new Role;
        $object2 = new Permission;
        $modelname = class_basename($object);
        $modelname2 = class_basename($object2);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('backend.content.user.acl_index', compact('roles','permissions','modelname','modelname2'));
    }
    // acl store
    public function acl_store(Request $request){
        if($request->get('type') == 1){
            Role::create(['name' => $request->get('name')]);
        }else{
            Permission::create(['name' => $request->get('name')]);
        }
        toastr()->success('Role/Permission Created','Success');
        return redirect()->back();
    }
    // role 
    public function role_edit($id){
        $id = Crypt::decrypt($id);
        $role = Role::find($id);
        return view('backend.content.user.acl_edit', compact('role'));
    }
    // role update
    public function role_update(Request $request, $id){
        $id = Crypt::decrypt($id);
        $role = Role::find($id);

        $request->validate([
            'name' => 'required'
        ]);

        $role->name = $request->get('name');
        $role->save();
        toastr()->success('Role Updated','Success');
        return redirect()->route('acl.index');
    }
    // role delete
    public function role_delete($id){
        $id = Crypt::decrypt($id);
        $role = Role::find($id);
        $role->delete();
        toastr()->error('Role Removed', 'Success');
        return redirect()->back();
    }
    // permission
    public function permission_edit($id){
        $id = Crypt::decrypt($id);
        $permission = Permission::find($id);
        return view('backend.content.user.permission_edit', compact('permission'));
    }
    // permission update
    public function permission_update(Request $request, $id){
        $id = Crypt::decrypt($id);
        $permission = Permission::find($id);

        $request->validate([
            'name' => 'required'
        ]);

        $permission->name = $request->get('name');
        $permission->save();
        toastr()->success('permission Updated','Success');
        return redirect()->route('acl.index');
    }
    // permission delete
    public function permission_delete($id){
        $id = Crypt::decrypt($id);
        $permission = Permission::find($id);
        $permission->delete();
        toastr()->error('permission Removed', 'Success');
        return redirect()->back();
    }
    // acl manage
    public function acl_manage($id){
        $id = Crypt::decrypt($id);
        $user = User::find($id);
        $type = Auth::user()->type;
        $role = Role::where('name','=',$type)->get();
        $candoos = $user->getDirectPermissions();
        //return $candoos;
        return view('backend.content.user.acl_manage', compact('user','candoos'));
    }
    // assign/revoke permissions
    public function acl_add(Request $request, $id){
        $request->validate([
            'type'=>'required',
            'permission'=>'required'
        ]);
        $user = User::find($id);
        if($request->type == 'assign'){
            foreach($request->permission as $permission){
                $user->givePermissionTo($permission);
            }
        }else{
            foreach($request->permission as $permission){
                $user->revokePermissionTo($permission);
            }
        }
        toastr()->success('Permission Updated', 'Success');
        return redirect()->back();
    }

}

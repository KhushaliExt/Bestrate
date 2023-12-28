<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\roles;
use App\Models\rolepermission;
use App\Models\Permission;
use Illuminate\Support\Str;

class userrolecontroller extends Controller
{
    
    public function index()
    {
        $roles=roles::get();
        return view('admin.userrole.list',compact('roles'));
    }

    public function rolepermission($id)
    {
        $role=roles::where('id',$id)->first();
        $permission=Permission::get();
        $rolepermission=rolepermission::where('role_id',$role->id)->get();
        return view('admin.userrole.assignrole',compact('permission','role','rolepermission'));
    }

    public function updatepermission(Request $request)
    {
        $rolepermission=rolepermission::where('role_id',$request->roleid)->delete();
        
        $permission =$request->permission;
        if($permission !==null){
            foreach($permission as $permissionId)
            {   
                $existingRolePermission = rolepermission::where('role_id', $request->roleid)
                ->where('permission_id', $permissionId)
                ->first();
                if (!$existingRolePermission) {
                    $rolepermission = new rolepermission();
                    $rolepermission->role_id=$request->roleid;
                    $rolepermission->permission_id=$permissionId;
                    $rolepermission->save();
                }
            }
            return redirect()->route('userrole');
        }else{
            return redirect()->route('userrole');
        }
    }

    public function userpermission()
    {
        $Permission=Permission::get();
        return view('admin.userrole.permission',compact('Permission'));
    }

    public function addpermission(Request $request)
    {
        $Permission= new Permission();
        $Permission->name=$request->input('name');
        $Permission->url=Str::slug($request->name);
        $Permission->guard_name.=$request->input('name');
        $Permission->save();
        return redirect()->route('userpermission')->with('success','Data Add Successfully..');
    }
}

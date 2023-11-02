<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\DataTables\RolesDataTable;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Repository\RoleRepositoryInterface;
use App\Repository\PermissionRepositoryInterface;

class RoleController extends Controller
{

    private $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('admin.role.index');
    }

    public function create(PermissionRepositoryInterface $permissionRepository)
    {
        $permissions = $permissionRepository->all();
        return view('admin.role.create', compact("permissions"));
    }

    public function store(RoleRequest $request)
    {
        $this->roleRepository->store($request->all());
        return redirect()->route('role.indexrole')->with('success', 'Role name has been added');
    }

    public function edit(Request $request, PermissionRepositoryInterface $permissionRepository)
    {
        $permissions = $permissionRepository->all();

        $role = $this->roleRepository->getdata(filter(encrypt_decrypt($request->role_id,2)));

        $roleHavingPermissions = $this->roleRepository->getPermissionsVieRole($role->name);
    
        return view('admin.role.edit', compact("role","permissions","roleHavingPermissions"));
    }

    public function update(RoleRequest $request)
    {
        $this->roleRepository->update($request->all());
        return redirect()->route('role.indexrole')->with('success', 'Role name has been updated');
    }

    public function delete(Request $request)
    {
        return $this->roleRepository->delete(filter(encrypt_decrypt($request->role_id,2)));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PermissionsDataTable;
use App\Http\Requests\Admin\PermissionRequest;
use App\Repository\PermissionRepositoryInterface;

class PermissionController extends Controller
{

    private $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index(PermissionsDataTable $dataTable)
    {
        return $dataTable->render('admin.permission.index');
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(PermissionRequest $request)
    {
        $this->permissionRepository->store($request->all());
        return redirect()->route('permission.indexpermission')->with('success', 'Permission name has been added');
    }

    public function edit(Request $request)
    {
        $permission = $this->permissionRepository->getdata(filter(encrypt_decrypt($request->permission_id,2)));
        return view('admin.permission.edit', compact("permission"));
    }

    public function update(Request $request)
    {
        $this->permissionRepository->update($request->all());
        return redirect()->route('permission.indexpermission')->with('success', 'Permission name has been updated');
    }

    public function delete(Request $request)
    {
        return $this->permissionRepository->delete(filter(encrypt_decrypt($request->permission_id,2)));
    }
}

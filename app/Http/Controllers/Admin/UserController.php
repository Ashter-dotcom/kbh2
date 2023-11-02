<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\ProfileRequest;
use App\Repository\UserRepositoryInterface;
use App\Repository\RoleRepositoryInterface;


class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(UsersDataTable $dataTable)
    {

        return $dataTable->render('admin.user.index');
    }

    public function create(RoleRepositoryInterface $roleRepository)
    {
        $roles = $roleRepository->all();
        return view('admin.user.create', compact("roles"));
    }

    public function store(UserRequest $request)
    {
        if($this->userRepository->store($request->all())) {
            return redirect()->route('user.indexuser')->with('success', 'User has been added');
        }
    }

    public function view(Request $request)
    {
        $user = $this->userRepository->getdata(filter(encrypt_decrypt($request->user_id,2)));
        return view('admin.user.view', compact("user"));
    }

    public function edit(Request $request, RoleRepositoryInterface $roleRepository)
    {
        $roles = $roleRepository->all();
        $user = $this->userRepository->getdata(filter(encrypt_decrypt($request->user_id,2)));

        return view('admin.user.edit', compact("roles","user"));
    }

    public function update(UserRequest $request)
    {
        if($this->userRepository->update($request->all())) {
            return redirect()->route('user.indexuser')->with('success', 'User has been updated');
        }
        
    }

    public function delete(Request $request)
    {
        return $this->userRepository->delete(filter(encrypt_decrypt($request->user_id,2)));
    }

    public function profile(Request $request)
    {
        $user = $this->userRepository->getdata(encrypt_decrypt(filter($request->user_id), 2));
        return view('admin.user.profile', compact("user"));
    }

    public function update_profile(ProfileRequest $request)
    {
        $this->userRepository->update_profile($request->all());

        return redirect()->route('profile', ['user_id' => $request->user_id])->with('success', 'Your profile has been updated');
    }
}

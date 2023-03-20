<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }
    public function read(Request $request, $id)
    {
        $notification = Notification::find($id);
        $notification->markAsRead();
    }
    public function store(User $user, StoreUserRequest $request)
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $user->create(array_merge($request->validated(), [
            'password' => 'test'
        ]));

        return redirect('/')
            ->withSuccess(__('User created successfully.'));
    }
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }
    public function edit(User $user)
    {
        return view('users.create', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }
    public function update(User $user, UpdateUserRequest $request)
    {
        $user->update($request->validated());

        $user->syncRoles($request->get('role'));

        return redirect('/users')
            ->withSuccess(__('User updated successfully.'));
    }
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/users')
            ->withSuccess(__('User deleted successfully.'));
    }
}

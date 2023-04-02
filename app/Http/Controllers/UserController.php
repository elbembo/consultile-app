<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        return view('users.create', ['roles' => Role::latest()->get()]);
    }
    public function notifications()
    {
        # code...
        $notifications = auth()->user()->notifications;
        return view('notifications', compact('notifications'));
    }
    public function read($id)
    {
        $user = auth()->user();
        foreach ($user->unreadNotifications as $notification) {
            if ($notification->id == $id)
                $notification->markAsRead();
            return response()->json(true);
        }
        return response()->json(false);
    }
    public function store(User $user, Request $request)
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $new = $user->create(array_merge($request->all(), [
            'password' => Hash::make($request->password)
        ]));
        $new->syncRoles($request->get('role'));
        $user_id = $new->id;
        $emp = $new->emp()->create(['title' =>  $request->title, 'sallery' =>  $request->sallery]);

        return redirect('/users')
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
            'roles' => Role::latest()->get(),
            'emp' => $user->emp
        ]);
    }
    public function update(User $user, Request $request)
    {
        if($request->approved){
            $user->update($request->all());
            return back();
        }
        $request->validate([
            'email' => 'required|email',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->except(['_token', '_method']);
        if ($request->password == '')
            $request->request->remove('password');
        else
            $request->merge([
                'password' => Hash::make($request->password)
            ]);
        $user->update($request->all());

        $user->syncRoles($request->get('role'));
        $emp = $user->emp()->updateOrCreate(['user_id' => $user->id]);
        $emp->title =  $request->title;
        $emp->sallery =  $request->sallery;
        $emp->gender =  $request->gender;
        $emp->hiring_date =  $request->hiring_date;
        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/users/profile'), $imageName);
            $emp->image =  $imageName ;
        }
        $emp->save();

        return redirect('/users')
            ->withSuccess(__('User updated successfully.'));
    }
    public function destroy(User $user)
    {
        $name = $user->name;
        //$user->delete();

        return back()
            ->with('status', "User $name deleted successfully");
    }
}

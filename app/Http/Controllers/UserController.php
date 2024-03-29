<?php

namespace App\Http\Controllers;

use App\Models\DropList;
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
        if (!auth()->user()->hasAnyRole('admin', 'Super Admin')) {

            $users = $users->reject(function ($user, $key) {
                return $user->hasAnyRole('admin', 'Super Admin');
            });
        }

        return view('users.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::latest()->get();
        if (!auth()->user()->hasAnyRole('admin', 'Super Admin')) {

            $roles = Role::whereNotIn('name',['admin', 'Super Admin'])->latest()->get();
        }
        return view('users.create', ['roles' => $roles]);
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
        $roles = Role::latest()->get();
        if (!auth()->user()->hasAnyRole('admin', 'Super Admin')) {

            $roles = Role::whereNotIn('name',['admin', 'Super Admin'])->latest()->get();
        }
        return view('users.create', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => $roles,
            'emp' => $user->emp,
            'actionList' => DropList::where('section', 'communicate-action')->where('show', 1)->get()
        ]);
    }
    public function update(User $user, Request $request)
    {
        if ($request->hasFile('files')) {
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
            $files = $request->file('files');
            // dd($files);
            $docs = $user->emp->docs;
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = true; //in_array($extension, $allowedfileExtension);
                // dd($file)
                $path = $file->store('public/uploads/users/docs');
                // dd($path);
                if ($check) {
                    $docs[] = [
                        'path' => $path,
                        'name' => $filename,
                        'mime' => 'application/' . $extension,

                    ];
                }
            }
            $request->request->add(['docs' => $docs]);
        }
        if ($request->approved) {
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
        $emp->target =  $request->target;
        if (!empty($request->docs))
            $emp->docs =  $request->docs;
        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $path = $request->image->store('public/uploads/users/profile');
            $emp->image =  $path;
        }
        $emp->save();

        return redirect('/users')
            ->withSuccess(__('User updated successfully.'));
    }
    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();

        return back()
            ->with('status', "User $name deleted successfully");
    }
}

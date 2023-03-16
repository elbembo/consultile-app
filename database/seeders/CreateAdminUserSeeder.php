<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Row;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->truncate();
        $user = User::create([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@consultile.com',
            'password' => Hash::make('Hav$!)345k&@97!'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $role = Role::create(['name' => 'admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        $user = User::create([
            'id' => 5,
            'name' => 'user',
            'email' => 'user@consultile.com',
            'password' => Hash::make('Con849562sa'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $role = Role::create(['name' => 'supervisor']);

        // $permissions = Permission::pluck('id','id')->all();
        $permissions = [
            'home', 'dashboard', 'email.send_test',

            'campaigns.index', 'campaigns.show', 'campaigns.create', 'campaigns.store',
            'campaigns.edit', 'campaigns.update', 'campaigns.destroy', 'campaigns.removeAttachment',

            'contacts.index', 'contacts.show', 'contacts.create', 'contacts.store',
            'contacts.edit', 'contacts.update', 'contacts.destroy', 'contacts.import',
            'contacts.import.upload','contacts.export.example',

            'templates.index', 'templates.show', 'templates.create', 'templates.store',
            'templates.edit', 'templates.update', 'templates.destroy',

            'editor.index', 'editor.show', 'editor.create', 'editor.store',
            'editor.edit', 'editor.update', 'editor.destroy',

        ];

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        // $all_users_with_all_their_roles = Role::pluck('name','user');
        // $user = User::find(5);
        // $user->revokePermissionTo(['campaigns.create']);
        // $permissions = $user->getPermissionsViaRoles();
        // $roles = Role::all();
        // foreach ($roles  as $role) {
        //     // print($permission->name . "\n");
        //     $role->givePermissionTo(['campaigns.create']);
        // }
    }
}

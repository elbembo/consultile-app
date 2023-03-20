<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GlobalPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $permissions = ['check.duplicate', 'email.validation.dns','contacts.search','mail-preview'];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $roles = Role::all();
        foreach ($roles as $role) {
            $role->givePermissionTo($permissions);
        }

        return Command::SUCCESS;
    }
}

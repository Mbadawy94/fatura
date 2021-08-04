<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@fatura.app',
            'password' => bcrypt(12345678),
        ]);

        $role = Role::create([
            'name' => 'Admin'
        ]);

        $keys = [
            'users',
            'roles',
            'products'
        ];

        foreach ($keys as $key) {
            Permission::create(['name' => 'index_' . $key]);
            Permission::create(['name' => 'show_' . $key]);
            Permission::create(['name' => 'update_' . $key]);
            Permission::create(['name' => 'create_' . $key]);
            Permission::create(['name' => 'delete_' . $key]);
        }

        $role->syncPermissions(Permission::all());

        $user->assignRole('Admin');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'admin'
        ]);
        $user = Role::create([
            'name' => 'user'
        ]);
        Permission::create([
            'name' => 'products.create'
        ]);
        Permission::create([
            'name' => 'products.delete'
        ]);
        Permission::create([
            'name' => 'products.update'
        ]);
        $admin->givePermissionTo(Permission::all());
    }
}

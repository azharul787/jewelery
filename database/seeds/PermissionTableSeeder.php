<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-entry',
            'role-edit',
            'role-delete',
            'user-list',
            'user-entry',
            'user-edit',
            'user-delete',
         ];

         foreach ($permissions as $permission) 
            {
             Permission::create(['name' => $permission]);
             }
   }
}
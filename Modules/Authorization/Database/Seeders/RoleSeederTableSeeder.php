<?php

namespace Modules\Authorization\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Authorization\Entities\Permission;
use Modules\Authorization\Entities\Role;

class RoleSeederTableSeeder extends Seeder
{
    private $roles = [
        'super-admin' => [
            'title_en' => 'Super Admin',
            'title_ar' => 'مدير لوحة التحكم',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $name => $role_data){

            $role = Role::create([
                'name' => $name,
                'guard_name' => 'web',
                'display_name' => ['en' => $role_data['title_en'],'ar' => $role_data['title_ar']]
            ]);

            if($name == 'super-admin') {
                    $role->givePermissionTo(Permission::pluck('name')->toArray());
            }

            $role->save();
        }
    }
}

<?php

namespace Modules\App\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\App\Entities\Home;
use Modules\Authorization\Database\Seeders\PermissionsSeederTableSeeder;
use Modules\Authorization\Database\Seeders\RoleSeederTableSeeder;
use Modules\Category\Database\Seeders\CategoryDatabaseSeeder;
use Modules\Courses\Database\Seeders\CoursesDatabaseSeeder;
use Modules\Doctors\Database\Seeders\DoctorsDatabaseSeeder;
use Modules\Users\Entities\User;

class SetupAppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::beginTransaction();
        Model::unguard();
        (new PermissionsSeederTableSeeder())->run();
        (new RoleSeederTableSeeder())->run();
        $this->insertUserRole($this->insertUser());
//        $this->home();
//        (new CategoryDatabaseSeeder())->run();
//        (new DoctorsDatabaseSeeder())->run();
//        (new CoursesDatabaseSeeder())->run();
//        DB::commit();
    }

    private function insertUser()
    {
        return User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => \Illuminate\Support\Facades\Hash::make(123456),
        ]);
    }

    private function home()
    {
        $home = [
            ['ar'=>'most ordered 1','en'=>'most ordered 1'],
            ['ar'=>'most ordered 2','en'=>'most ordered 2'],
            ['ar'=>'most ordered 3','en'=>'most ordered 3'],
            ['ar'=>'most ordered 4','en'=>'most ordered 4'],
        ];
        foreach ($home as $index => $title){
            Home::create([
                'status' => 1,
                'order' => $index +1,
                'title' => $title
            ]);
        }
    }

    private function insertUserRole($user)
    {
        $user->assignRole(['super-admin']);
    }
}

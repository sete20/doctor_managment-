<?php

namespace Modules\Doctors\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Modules\Doctors\Entities\Doctor;

class DoctorsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $doc = Doctor::create([
                'name' => 'doctor - ' . $i,
                'email' => 'doc'. $i.'@doc.com',
                'password' => Hash::make(123456),
                'status' => 1,
            ]);
        }
    }
}

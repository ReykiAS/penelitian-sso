<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Faculties;
use App\Models\Unit;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("resources/csv/191112_users_igracias.csv"), "r");
        // username, fullname, email. active, status, unit, prodi, fakultas
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                $no= $data[0];
                $userStatus= UserStatus::firstOrCreate(['name' => $data[4]]);
                $unit= $data[5] && $data[5] != '-'  ? Unit::firstOrCreate(['name' => $data[5]]) : null;
                if($data[7]){
                    $faculties= Faculties::firstOrCreate(['name' => $data[7]]);
                    $department= Department::firstOrCreate(['name' => $data[6], 'faculty_id'=>$faculties->id]);
                } else {
                    $department= null;
                }
                // dd($data);
                
                User::create([
                    "name" => trim($data[1]),
                    "email" => $data[2] ? trim($data[2]) : null,
                    "no" => $no,
                    'md5password' => md5($no),
                    'password' => Hash::make($no),
                    'active' => trim($data[3]) == 'active' ? 1 : 0,
                    'status' => $userStatus->id,
                    'unit' => $unit ? $unit->id : null,
                    'department' => $department ? $department->id : null,
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}

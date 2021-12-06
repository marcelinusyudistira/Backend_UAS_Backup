<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Marcelinus Yoga',
            'email' => '10378@students.uajy.ac.id',
            'password' => '$2b$10$EqrIQKFE6EWSUSjBsfqTI.YquNKgTd5Ut9144B/5KbMpwK8hRoODK',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

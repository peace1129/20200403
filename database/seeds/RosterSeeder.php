<?php

use Illuminate\Database\Seeder;

class RosterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('rosters')->insert([
         'lastName' => 'お名前',
         'firstName' => '太郎',
         'pref' => '石川県',
         'address' => '金沢市',
         'gender' => '1',
         'grp_name' => 'グループA'
      ]);

      DB::table('rosters')->insert([
         'lastName' => 'お名前',
         'firstName' => '花子',
         'pref' => '富山県',
         'address' => '高岡市',
         'gender' => '2'
       ]);
    }
}

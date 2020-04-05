<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('groups')->insert([
         'grp_name' => 'グループA'
      ]);

      DB::table('groups')->insert([
         'grp_name' => 'グループB'
      ]);

      DB::table('groups')->insert([
         'grp_name' => 'グループC'
      ]);
    }
}

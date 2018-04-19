<?php

use Illuminate\Database\Seeder;

class BoardGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('boardsgroup')->insert([
            
            'bgr_key' => 'sharegroup',
            'bgr_name' => '판매 관련',
            'bgr_order' => 1,
        ]);
        DB::table('boardsgroup')->insert([
            
            'bgr_key' => 'communitygroup',
            'bgr_name' => '커뮤니티 관련',
            'bgr_order' => 2,
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('boards')->insert([
            
            'bgr_id' => 1,
            'brd_key' => 'share',
            'brd_name' => '오르골 악보 판매 게시판',
            'brd_order'=>1
        ]);
        DB::table('boards')->insert([
            
            'bgr_id' => 1,
            'brd_key' => 'share',
            'brd_name' => '실로폰 악보 판매 게시판',
            'brd_order'=>2
        ]);
        DB::table('boards')->insert([
            
            'bgr_id' => 2,
            'brd_key' => 'community',
            'brd_name' => '자유 게시판',
            'brd_order'=>1
        ]);
        DB::table('boards')->insert([
            
            'bgr_id' => 2,
            'brd_key' => 'community',
            'brd_name' => '동영상 게시판',
            'brd_order'=>2
        ]);
        
    }
}

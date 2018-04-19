<?php

use Illuminate\Database\Seeder;

class BoardCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('boardcategory')->insert([
            
            'brd_id' => 1,
            'bca_key' => '클래식',
            'bca_value' => '잔잔',
            'bca_order' =>1
        ]);
        
         DB::table('boardcategory')->insert([
            
            'brd_id' => 1,
            'bca_key' => '클래식',
            'bca_value' => '슬픔',
            'bca_order' =>2
        ]);
        
         DB::table('boardcategory')->insert([
            
            'brd_id' => 1,
            'bca_key' => '팝송',
            'bca_value' => '감동',
            'bca_order' =>3
        ]);
        
         DB::table('boardcategory')->insert([
            
            'brd_id' => 1,
            'bca_key' => '개인',
            'bca_value' => '편곡',
            'bca_order' =>4
        ]);
        
         DB::table('boardcategory')->insert([
            
            'brd_id' => 1,
            'bca_key' => '개인',
            'bca_value' => '자작',
            'bca_order' =>5
        ]);
        
         DB::table('boardcategory')->insert([
            
            'brd_id' => 1,
            'bca_key' => '취미',
            'bca_value' => '애니/게임',
            'bca_order' =>6
        ]);
    }
}

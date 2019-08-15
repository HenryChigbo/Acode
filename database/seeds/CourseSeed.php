<?php

use Illuminate\Database\Seeder;

class CourseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Learn Android Development With Java', 'image' => '/tmp/php3RBpku', 'key' => 'ANDROID_JAVA',],
            ['id' => 2, 'name' => 'Learn Android Development With Kotlin', 'image' => '/tmp/phpa7v02t', 'key' => 'ANDROID_KOTLIN',],

        ];

        foreach ($items as $item) {
            \App\Course::create($item);
        }
    }
}

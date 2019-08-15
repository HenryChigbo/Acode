<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$rp0NOLpSL1d3YGXS9W1DfeV/3CVY2PkV1Is8uxNS750O6FMxgxDeO', 'remember_token' => '', 'avatar' => null, 'country' => null,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}

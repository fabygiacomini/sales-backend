<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seller')->insert([
            'name' => 'Fabiana',
            'commission_fee' => 8.5,
            'email' => 'fabiana@email.com'
        ]);

        DB::table('seller')->insert([
            'name' => 'Darwin',
            'commission_fee' => 8.5,
            'email' => 'darwin@charles.com'
        ]);

        DB::table('seller')->insert([
            'name' => 'Zelda',
            'commission_fee' => 8.5,
            'email' => 'zelds@hyrule.com'
        ]);
    }
}

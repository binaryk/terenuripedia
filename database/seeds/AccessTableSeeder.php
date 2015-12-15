<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_DRIVER') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

//        $this->call(UserTableSeeder::class);
//        $this->call(RoleTableSeeder::class);
//        $this->call(UserRoleSeeder::class);
//        $this->call(PermissionGroupTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
//        $this->call(PermissionDependencyTableSeeder::class);
//        $this->call(CharacteristicSeeder::class);
//        $this->call(SubscriptionsTableSeeder::class);

        if (env('DB_DRIVER') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

    }
}

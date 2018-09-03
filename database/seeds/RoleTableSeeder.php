<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_operator = new Role();
        $role_operator->name = 'operator';
        $role_operator->full_name = 'Operator';
        $role_operator->save();

        $role_designer = new Role();
        $role_designer->name = 'designer';
        $role_designer->full_name = 'Designer';
        $role_designer->save();

        $role_customer = new Role();
        $role_customer->name = 'customer';
        $role_customer->full_name = 'Customer';
        $role_customer->save();
    }
}

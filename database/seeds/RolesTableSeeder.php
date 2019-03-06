<?php

use App\Model\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ["Administrator", "Owner", "User"];
        $this->save($data);
    }

    private function save($array) {
        foreach ($array as $role) {
            $model = new Role();
            $model->name = $role;
            $model->descriptive_name = $role;
            $model->save();
        }
    }
}

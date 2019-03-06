<?php

use App\Model\Role;
use App\User;
use Illuminate\Database\Seeder;
use Turfasap\ImageHelper\ImageRepository;

class UsersTableSeeder extends Seeder
{
    private $imageRepository;

    public function __construct()
    {
        $this->imageRepository = new ImageRepository();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => "Turf Asap",
                "email" => "admin@turfasap.io",
                "role" => "Administrator",
                "password" => "secret"
            ],
            [
                "name" => "Turf Owner",
                "email" => "owner@turfasap.io",
                "role" => "Owner",
                "password" => "secret"
            ],
            [
                "name" => "Turf User",
                "email" => "user@turfasap.io",
                "role" => "User",
                "password" => "secret"

            ]
        ];
        $this->save($data);
    }

    private function save($users) {
        foreach ($users as $user) {
            $name = $user["name"];
            $image_path = $this->imageRepository->getImageFromName($name);

            $model = new User();
            $model->name = $name;
            $model->email = $user["email"];

            $role = Role::where("name", $user["role"])->get()->first();
            $model->role_id = $role->id;
            $model->password = bcrypt($user["password"]);
            $model->phone = 9999999999;
            $model->verified = 0;
            $model->image_path = $image_path;

            $model->save();
        }
    }


}

<?php

namespace Turfasap\ModelRepository;


use App\User;
use Turfasap\Exception\ImageException;
use Turfasap\ImageHelper\ImageRepository;

class UserRepository
{
    private $imageRepo;
    public function __construct()
    {
        $this->imageRepo = new ImageRepository();
    }

    public function retrieveUserImage ($id) {
        $url = $this->getUserImageById($id);

        try {

            return response()->file($this->imageRepo->getImageFromPath($url));
        } catch (ImageException $exception) {
            switch ($exception->getState()) {
                case ImageException::$RETRIEVE_ERROR:
                    return redirect($url);
            }
        }

    }

    public function getUserImageById ($id) {
        return User::find($id)->image_path;
    }
}
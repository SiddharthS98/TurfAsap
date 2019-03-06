<?php

namespace Turfasap\ModelRepository;


use App\Model\Turf;
use App\Model\TurfImage;
use Turfasap\Exception\ImageException;
use Turfasap\ImageHelper\ImageRepository;

class TurfRepository
{
    private $imageRepo;
    public function __construct()
    {
        $this->imageRepo = new ImageRepository();
    }

    public function getAllTurfs () {
        return $this->getTurfQuery()->get();
    }

    public function getTurfById ($id) {
        return $this->getTurfQuery()->where('id', $id)->get()->first();
    }

    public function retrieveTurfImage ($id) {
        $url = $this->getTurfImageById($id);

        try {

            return response()->file($this->imageRepo->getImageFromPath($url));
        } catch (ImageException $exception) {
            switch ($exception->getState()) {
                case ImageException::$RETRIEVE_ERROR:
                    return redirect($url);
            }
        }

    }

    public function getTurfImageById ($id) {
        return TurfImage::find($id)->image_path;
    }

    private function getTurfQuery() {
        return Turf::with(['facilities', 'ratings', 'user']);
    }

}
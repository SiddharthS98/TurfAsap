<?php

namespace Turfasap\ImageHelper;

use Exception;
use Laravolt\Avatar\Facade as Avatar;
use Turfasap\Exception\ImageException;

class ImageRepository {

    public function storeAndGeneratePath($request) {
        try {
            $image = $request->file['image'];
            $image_path = "image";
            $image_path = "app/" . $image->store($image_path);

            return $image_path;
        } catch (Exception $exception) {
            throw ImageException::STORE_ERROR($exception->getMessage());
        }
    }

    public function getImageFromPath($path) {
        $path = storage_path($path);
        if (file_exists($path)) {

            return $path;
        }

        throw ImageException::RETRIEVE_ERROR("File not found");
    }


    public function getImageFromName($name) {
        $avatar = Avatar::create($name)->toBase64();
        $hashedName = $this->generateName($name);
        $this->base64ToStorage($avatar->encoded, storage_path($hashedName));

        return $hashedName;
    }

    private function generateName($name) {
        return 'app'.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR . sha1($name) . '.png';
    }

    private function generateNameWindows($name) {
        return 'app\\image\\' . sha1($name) . '.png';
    }

    private function base64ToStorage($base64_string, $output_file) {
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' );

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );

        // clean up the file resource
        fclose( $ifp );

        return $output_file;
    }

}
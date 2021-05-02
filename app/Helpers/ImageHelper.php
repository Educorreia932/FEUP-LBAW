<?php
namespace App\Helpers;


class ImageHelper {

    public static function get_image_representation($file_type, $tmp_file) {
        // Crete an image representation of the original image
        if ($file_type == 'png')
            return imagecreatefrompng($tmp_file);
        else if ($file_type == 'jpg' || $file_type == 'jpeg') {
            return imagecreatefromjpeg($tmp_file);
        } else {
            return NULL;
        }
    }

    // https://stackoverflow.com/questions/1201798/use-php-to-convert-png-to-jpg-with-compression
    public static function save_resized_image($original, $filename, $start_x, $start_y, $out_width, $out_height, $width, $height) {
        // Create and save a medium image
        $img = imagecreatetruecolor($out_width, $out_height);
        // Prepare alpha channel for transparent background
        $alpha_channel = imagecolorallocate($img, 255, 255, 255);
        // Fill image
        imagefill($img, 0, 0, $alpha_channel);
        imagealphablending($img, TRUE);
        imagecopyresized($img, $original, 0, 0, $start_x, $start_y, $out_width, $out_height, $width, $height);
        imagejpeg($img, $filename, 80);
        imagedestroy($img);
    }

    public static function save_upscaled_image($original, $filename, $target_width) {
        // Calculate width and height of image (max width)
        $width = imagesx($original);     // width of the original image
        $height = imagesy($original);    // height of the original image

        if ($width > $target_width)
            $target_height = $height * ( $target_width / $width );
        else
            $target_height = $height;

        ImageHelper::save_resized_image($original, $filename,
            0, 0,
            $target_width, $target_height,
            $width, $height
        );
    }

    public static function save_auction_image($file, $path, $id, $save_thumbs=true) {

        $original = ImageHelper::get_image_representation($file->extension(), $file);

        // Generate filenames for original, small and medium files
        $originalFileName = $path . "/$id" . "_original." . $file->extension();

        // Move the uploaded file to its final destination
        move_uploaded_file($file, $originalFileName);

        if ($save_thumbs) {

            $smallFileName = $path . "/$id" . "_small.jpg";
            $mediumFileName = $path . "/$id" . "_medium.jpg";
            $cardFileName = $path . "/$id" . "_card.jpg";

            $width = imagesx($original);     // width of the original image
            $height = imagesy($original);    // height of the original image
            $square = min($width, $height);  // size length of the maximum square

            ImageHelper::save_resized_image( $original, $cardFileName,
                ($width>$square)?($width-$square)/2:0,
                ($height>$square)?($height-$square)/2:0,
                200, 200, $square, $square
            );

            ImageHelper::save_upscaled_image($original, $mediumFileName, 600);
            ImageHelper::save_upscaled_image($original, $smallFileName, 300);
        }
    }
}

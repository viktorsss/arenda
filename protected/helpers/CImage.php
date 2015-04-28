<?php

include 'classSimpleImage.php';

class CImage {

    static function getCashImg($name, $size = 350, $dir = NULL) {
        $res_name = "noneImg.jpg";
        
        if((strpos($name, "/") != FALSE) || ($name[0] == "/")) {
            $arr = explode("/", $name);
            $name = $arr[count($arr)-1];
        }
        
        if (!is_null($name)) {
            $str_name = explode('.', $name);
            $res_name = $str_name[0] . "_" . $size . "." . $str_name[1];

            $file = __DIR__.'/../../images/upload/'.$dir.$name;
            $resize_file = __DIR__."/../../images/upload/".$dir."resize/" . $res_name;
            if (file_exists($file) && (!file_exists($resize_file))) {
                $image = new SimpleImage();
                $image->load($file);
                $image->resizeToWidth($size);
                $image->save($resize_file);
            }
        }
        return $res_name;
    }

    static function getImages($prod_id) {
        $model = Images::model()->findAllByAttributes(array('prod_id' => $prod_id));
        foreach ($model as $item) {
            $arr[] = $item->name;
        }
        return $arr;
    }

}

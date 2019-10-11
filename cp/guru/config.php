<?php

define("IMAGE_DIR", dirname(__FILE__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR);
define("BASE_URL", "http://sdi-aljannah.web.id/cp/guru/");
if (!is_dir(IMAGE_DIR))
    mkdir(IMAGE_DIR);

if (!function_exists('getImageUrl')) {
    function getImageUrl($name) {
        return rtrim(trim(BASE_URL), '/') . "/images/$name";
    }
}

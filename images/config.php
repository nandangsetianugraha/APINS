<?php

define("IMAGE_DIR", dirname(__FILE__) . DIRECTORY_SEPARATOR . 'siswa' . DIRECTORY_SEPARATOR);
define("BASE_URL", "http://localhost/1data/images/siswa/");
if (!is_dir(IMAGE_DIR))
    mkdir(IMAGE_DIR);

if (!function_exists('getImageUrl')) {
    function getImageUrl($name) {
        return rtrim(trim(BASE_URL), '/') . "/$name";
    }
}

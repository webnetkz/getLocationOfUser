<?php

require_once 'SxGeo.php';

function getIp() {
    $keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR'
    ];
    foreach($keys as $key) {
        if(!empty($_SERVER[$key])) {
            $ip = trim(end(explode(',', $_SERVER[$key])));
            if(filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
}



$ip = getIp();
echo '<pre>';
var_dump($ip);


$SxGeo = new SxGeo('SxGeoCity.dat', SXGEO_BATCH | SXGEO_MEMORY);
$city = $SxGeo->getCityFull($ip);

var_dump($city);

echo ('city: '. $city['city']['name_ru'].'<br>');
echo ('city: '.$city['city']['name_en'].'<br>');
echo ('city code: '.$city['city']['id'].'<br>');
echo ('city lat: '.$city['city']['lat'].'<br>');
echo ('city Ion: '.$city['city']['Ion'].'<br>');
echo ('country: '.$city['country']['name_ru'].'<br>');
echo ('country: '.$city['country']['name_en'].'<br>');
echo ('country iso: '.$city['country']['iso'].'<br>');
echo ('country code: '.$city['country']['id'].'<br>');

echo '<img
src="https://flagcdn.com/16x12/'.strlower($city['country']['iso']).'.png"
srcset="https://flagcdn.com/32x24/'.strlower($city['country']['iso']).'.png 2x,
  https://flagcdn.com/48x36/'.strlower($city['country']['iso']).'.png 3x"
width="16"
height="12"
alt="South Africa">';
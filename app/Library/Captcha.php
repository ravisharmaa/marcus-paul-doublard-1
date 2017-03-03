<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 2017-03-02
 * Time: 12:59 PM
 */

namespace App\Library;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class Captcha
{
   public  function make()
   {
       $string = str_random(4,'23456789abdefghjmnqtuy');
       Session::put('myCaptcha', $string);
       $width   = 90;
       $height = 30;
       $image               = imagecreatetruecolor($width,$height);
       $text_colour         = imagecolorallocate($image,255,255,255);
       $background_colour   = imagecolorallocate($image, 0,0,0);
       imagefilledrectangle($image, 0,0, $width, $height, $background_colour );
       $noise_color = imagecolorallocate($image, 120, 120, 120);
       /* generate random dots in background */
       for( $i=0; $i<($width*$height)/3; $i++ ) {
           imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
       }
       /* generate random lines in background */
       for( $i=0; $i<($width*$height)/150; $i++ ) {
           imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
       }



       $s='';
       for($i=0;$i<strlen($string);$i++){

           $s.=$string[$i].' ';
       }

       imagestring($image, 15,15,8, $s, $text_colour);
       ob_start();
       imagejpeg($image);
       $jpg = ob_get_clean();
       return "data:image/jpeg;base64,". base64_encode($jpg);
   }
}
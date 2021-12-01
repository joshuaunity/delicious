<?php

/**
 * Delicious Restraunt
 *
 * Delicious is the world best open restraunt
 *
 * @category Helpers
 * @author  Joshua, JDev
 * @copyright Copyright (c) 2021. All right reserved
 * @version 1.1.0
 */

namespace App\Helpers;

class ExtraFunc
{
    public $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    //tag token generator
    public static function gentoken($permitted_chars, $strength = 16)
    {
        $input_length = strlen($permitted_chars);
        $random_string = '';

        for ($i = 0; $i < $strength; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

}

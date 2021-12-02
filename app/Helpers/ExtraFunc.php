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
    public static $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    //tag token generator
    public static function gentoken( $strength = 16)
    {
        $input = self::$permitted_chars;
        $input_length = strlen($input);
        $random_string = '';

        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

}

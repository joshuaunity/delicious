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

    public static function format($config = null, $status = false)
    {
        $config = ($config) ? (object) $config : (object) [];
        $data = (object) [
            "status" => (isset($config->status)) ? $config->status : $status,
            "data" => (isset($config->data) && !empty($config->data)) ? $config->data : null,
            "response" => (isset($config->msg)) ? $config->msg : __('custom.default_response'),
            "code" => (isset($config->code)) ? $config->code : 200,
            "debug" => (isset($config->debug) && !empty($config->debug)) ? $config->debug : null,
        ];

        return (object) [
            "status" => $data->status,
            "meta_data" => (object) [
                "data" => $data->data,
                "response" => $data->response,
                "status_code" => $data->code,
            ],
            "debug" => $data->debug,
        ];
    }

    public static $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    //tag token generator
    public static function gentoken($strength = 16)
    {
        $input = self::$permitted_chars;
        $input_length = strlen($input);
        $random_string = '';

        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;

        // $token = openssl_random_pseudo_bytes(20);
        // $token = bin2hex($token);
        // return $token;

    }

    public static function return_response(array $data)
    {
        return [
            "status" => isset($data['status']) ? $data['status'] : false,
            "meta_data" => [
                "data" => isset($data['data']) ? $data['data'] : null,
                "response" => isset($data['response']) ? $data['response'] : null,
                "status_code" => isset($data['status_code']) ? $data['status_code'] : "204 No Content",
            ],
            "debug" => isset($data['debug']) ? $data['debug'] : null,
        ];
    }

    public static function formatted_response($config = null)
    {
        $formatted = self::format($config);
        return response()->json($formatted, $formatted->meta_data->status_code);
    }

}

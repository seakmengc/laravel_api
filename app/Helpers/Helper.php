<?php


namespace App\Helpers;


class Helper
{
    public static function getHttpHeader($bearerToken)
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $bearerToken,
        ];
    }
}

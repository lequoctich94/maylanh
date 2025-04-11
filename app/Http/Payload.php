<?php

namespace App\Http;

class Payload
{
    public static function toJson($data, $message, $status)
    {
        return [
            'data' => $data,
            'message' => $message,
            'status' => (string)$status,
        ];
    }
}
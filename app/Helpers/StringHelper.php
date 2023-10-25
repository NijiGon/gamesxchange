<?php

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 12) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            if ($i > 0 && $i % 4 == 0) {
                $randomString .= '-';
            }

            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}

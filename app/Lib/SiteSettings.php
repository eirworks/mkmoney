<?php


namespace App\Lib;


class SiteSettings
{

    public static function settings(): array
    {
        return [
            [
                'key' => 'contact_phone',
                'default' => '',
                'type' => 'string',
            ],
            [
                'key' => 'contact_wa',
                'default' => '',
                'type' => 'string',
            ],
//            [
//                'key' => 'enable_registration',
//                'default' => true,
//                'type' => 'bool',
//            ],
        ];
    }
}

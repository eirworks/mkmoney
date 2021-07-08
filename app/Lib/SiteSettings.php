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
            [
                'key' => 'site_name',
                'default' => 'App',
                'type' => 'string',
            ],
        ];
    }
}

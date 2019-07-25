<?php

namespace Display\Repositories;

class Themes
{
    public function get($key)
    {
        return $this->all()[$key];
    }

    public function all()
    {
        return [
            'earth' => [
                [
                    'photo' => 'https://nhmisc.s3.amazonaws.com/ts-random/earth-teal1.png',
                    'primary_text_color' => '#044d6f',
                    'secondary_text_color' => 'rgba(255, 255, 255, .6)',
                    'background_color' => '#00b8bc',
                ],
                [
                    'photo' => 'https://nhmisc.s3.amazonaws.com/ts-random/earth-orange2.png',
                    'primary_text_color' => '#ffffff',
                    'secondary_text_color' => 'rgba(255, 255, 255, .6)',
                    'background_color' => '#f15f46',
                ],
                [
                    'photo' => 'https://nhmisc.s3.amazonaws.com/ts-random/earth-navy3.png',
                    'primary_text_color' => '#ffffff',
                    'secondary_text_color' => 'rgba(255, 255, 255, .6)',
                    'background_color' => '#044d6f',
                ],
            ],
            'maps' => [
                [
                    'photo' => 'https://nhmisc.s3.amazonaws.com/ts-random/maps-lavendar1.png',
                    'primary_text_color' => '#f15f46',
                    'secondary_text_color' => '#f15f46',
                    'background_color' => '#d1d9ef',
                ],
                [
                    'photo' => 'https://nhmisc.s3.amazonaws.com/ts-random/maps-teal2.png',
                    'primary_text_color' => '#044d6f',
                    'secondary_text_color' => '#f15f46',
                    'background_color' => '',
                ],
                [
                    'photo' => 'https://nhmisc.s3.amazonaws.com/ts-random/maps-salmon3.png',
                    'primary_text_color' => '#044d6f',
                    'secondary_text_color' => '#044d6f',
                    'background_color' => '',
                ],
            ],
        ];
    }
}

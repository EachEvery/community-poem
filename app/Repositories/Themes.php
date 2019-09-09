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
            'hb' => [
                [
                    'photo' => 'https://nhmisc.s3.amazonaws.com/hb/hb-1.jpg',
                    'primary_text_color' => 'rgb(51, 89, 73)',
                    'secondary_text_color' => 'rgba(51, 89, 73, .8)',
                    'background_color' => 'rgb(254,246,218)',
                ],
                [
                    'photo' => 'https://nhmisc.s3.amazonaws.com/hb/hb-2.jpg',
                    'primary_text_color' => 'rgb(51, 89, 73)',
                    'secondary_text_color' => 'rgba(51, 89, 73, .8)',
                    'background_color' => 'rgb(230,240,237)',
                ],
                [
                    'photo' => 'https://nhmisc.s3.amazonaws.com/hb/hb-3.jpg',
                    'primary_text_color' => 'rgb(51, 89, 73)',
                    'secondary_text_color' => 'rgba(51, 89, 73, .8)',
                    'background_color' => 'rgb(246,227,218)',
                ],
                [
                    'photo' => 'https://nhmisc.s3.amazonaws.com/hb/hb-4.jpg',
                    'primary_text_color' => 'rgb(51, 89, 73)',
                    'secondary_text_color' => 'rgba(51, 89, 73, .8)',
                    'background_color' => 'rgb(247,229,208)',
                ],
            ],
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

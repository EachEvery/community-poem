<?php

namespace CommunityPoem\Repositories;

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

            'river' => [
                [
                    'photo' => 'https://eachevery.s3.us-east-1.amazonaws.com/ts-thread/TS-RSThreadResponseDisplay_BG-16x9.jpg',
                    'primary_text_color' => '#044d6f',
                    'secondary_text_color' => '#044d6f',
                    'background_color' => '',
                ],
                [
                    'photo' => 'https://eachevery.s3.us-east-1.amazonaws.com/ts-thread/TS-RSThreadResponseDisplay_BG-16x92.jpg',
                    'primary_text_color' => '#044d6f',
                    'secondary_text_color' => '#044d6f',
                    'background_color' => '',
                ],

                [
                    'photo' => 'https://eachevery.s3.us-east-1.amazonaws.com/ts-thread/TS-RSThreadResponseDisplay_BG-16x93.jpg',
                    'primary_text_color' => '#044d6f',
                    'secondary_text_color' => '#044d6f',
                    'background_color' => '',
                ],

                [
                    'photo' => 'https://eachevery.s3.us-east-1.amazonaws.com/ts-thread/TS-RSThreadResponseDisplay_BG-16x94.jpg',
                    'primary_text_color' => '#044d6f',
                    'secondary_text_color' => '#044d6f',
                    'background_color' => '',
                ],

                [
                    'photo' => 'https://eachevery.s3.us-east-1.amazonaws.com/ts-thread/TS-RSThreadResponseDisplay_BG-16x95.jpg',
                    'primary_text_color' => '#044d6f',
                    'secondary_text_color' => '#044d6f',
                    'background_color' => '',
                ],

                [
                    'photo' => 'https://eachevery.s3.us-east-1.amazonaws.com/ts-thread/TS-RSThreadResponseDisplay_BG-16x96.jpg',
                    'primary_text_color' => '#044d6f',
                    'secondary_text_color' => '#044d6f',
                    'background_color' => '',
                ],

                [
                    'photo' => 'https://eachevery.s3.us-east-1.amazonaws.com/ts-thread/TS-RSThreadResponseDisplay_BG-16x97.jpg',
                    'primary_text_color' => '#044d6f',
                    'secondary_text_color' => '#044d6f',
                    'background_color' => '',
                ],
            ],
            'nais' => [
                [
                    'photo' => 'http://eachevery.s3.amazonaws.com/ts-thread/NAIS-Thread-bg_A.jpg',
                    'primary_text_color' => '#722F6B',
                    'secondary_text_color' => '#722F6B',
                    'background_color' => '',
                ],
                [
                    'photo' => 'http://eachevery.s3.amazonaws.com/ts-thread/NAIS-Thread-bg_B.jpg',
                    'primary_text_color' => '#722F6B',
                    'secondary_text_color' => '#722F6B',
                    'background_color' => '',
                ],
                [
                    'photo' => 'http://eachevery.s3.amazonaws.com/ts-thread/NAIS-Thread-bg_C.jpg',
                    'primary_text_color' => '#722F6B',
                    'secondary_text_color' => '#722F6B',
                    'background_color' => '',
                ],
                [
                    'photo' => 'http://eachevery.s3.amazonaws.com/ts-thread/NAIS-Thread-bg_D.jpg',
                    'primary_text_color' => '#722F6B',
                    'secondary_text_color' => '#722F6B',
                    'background_color' => '',
                ],
            ],
            'dear-ukraine' => [
                [
                    'photo' => 'http://eachevery.s3.amazonaws.com/ts-thread/DU-BG-1.jpg',
                    'primary_text_color' => '#f5c36c',
                    'secondary_text_color' => '#f5c36c',
                    'background_color' => '#ebdac0'
                ],
                [
                    'photo' => 'http://eachevery.s3.amazonaws.com/ts-thread/DU-BG-2.jpg',
                    'primary_text_color' => '#f5c36c',
                    'secondary_text_color' => '#f5c36c',
                    'background_color' => '#ebdac0'
                ],
                [
                    'photo' => 'http://eachevery.s3.amazonaws.com/ts-thread/DU-BG-3.jpg',
                    'primary_text_color' => '#f5c36c',
                    'secondary_text_color' => '#f5c36c',
                    'background_color' => '#ebdac0'
                ]
            ]
        ];
    }
}

<?php

namespace CommunityPoem\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use GuzzleHttp\Client as Guzzle;

class Font extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'CommunityPoem\Font';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [ 'id', 'font' ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $guzzle = new Guzzle;
        $response = $guzzle->request('get', 'https://www.googleapis.com/webfonts/v1/webfonts?key=' . env('GOOGLE_FONTS_KEY'));
        $font_options = [];
        foreach(json_decode($response->getBody()->getContents())->items as $font) {
            $font_options[ $font->family ] = $font->family;
        }

        return [
            ID::make()->sortable(),
            Select::make('font')->options($font_options)->rules('required'),
            Text::make('size')->rules('required'),
            Select::make('weight')->options([
                '100' => 'Thin',
                '200' => 'Extra Light',
                '300' => 'Light',
                '400' => 'Normal (Regular)',
                '500' => 'Medium',
                '600' => 'Semi Bold',
                '700' => 'Bold',
                '800' => 'Extra Bold',
                '900' => 'Black'
            ])->rules('required')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}

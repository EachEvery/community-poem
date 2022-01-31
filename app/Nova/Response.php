<?php

namespace CommunityPoem\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Boolean;
use Illuminate\Support\Str;

class Response extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'CommunityPoem\Response';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'city', 'content', 'email', 'prompt'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make('Space')->sortable(),
            Text::make('Name'),
            Text::make('Email')->hideFromIndex(),
            Text::make('City')->hideFromIndex(),
            Text::make('Prompt')->sortable(),
            Textarea::make('Content')->alwaysShow()->showOnIndex()->displayUsing(function ($value) use ($request) {
                if ($request instanceof \Laravel\Nova\Http\Requests\ResourceIndexRequest) {
                    return Str::limit($value, 40, '...');
                }
                return $value;
            }),
            Text::make('Typeform Id')->hideFromIndex(),
            Text::make('Font Size')->hideFromIndex(),
            Boolean::make('Is Approved')->readonly()->onlyOnIndex(),
            DateTime::make('Approved At')->onlyOnForms(),
            Boolean::make('Display On Slideshow')
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

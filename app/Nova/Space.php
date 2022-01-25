<?php

namespace CommunityPoem\Nova;

use CommunityPoem\Nova\Actions\RetreiveMissingResponses;
use CommunityPoem\Repositories\Themes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Timothyasp\Color\Color;

class Space extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'CommunityPoem\Space';

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
        'name', 'typeform_id', 'slug',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(Request $request)
    {
        $keys = collect(resolve(Themes::class)->all())->keys();

        $keys = $keys->mapWithKeys(function ($item) {
            return [$item => $item];
        });

        return [
            Text::make('Name'),
            Text::make('Admin Emails')->hideFromIndex(),
            Text::make('Typeform Id')->hideFromIndex(),
            // Text::make('List Domain')->help('Domain to automatically launch the response list. Do not include propocol or forward slashes (e.g. https://).')->hideFromIndex(),
            Text::make('View Responses', function () {
                $url = route('thread', ['slug' => $this->resource->slug]);


                return sprintf('<a href="%s" target="_blank" class="no-underline dim text-primary font-bold">View Responses</a>', $url);
            })->asHtml(),
            Text::make('Moderate', function () {
                $url = URL::signedRoute(
                    'approveResponses',
                    [
                        'space' => $this->resource->slug,
                    ]
                );

                return sprintf('<a href="%s" target="_blank" class="no-underline dim text-primary font-bold">Moderate</a>', $url);
            })->asHtml(),
            Text::make('Slideshow', function () {
                $url = route('slideshow', ['space' => $this->resource->slug]);

                return sprintf('<a href="%s" target="_blank" class="no-underline dim text-primary font-bold">Slideshow</a>', $url);
            })->asHtml()->exceptOnForms(),
            Code::make('iFrame Code', function () {
                return view('spaceEmbed', ['space' => $this->resource])->render();
            })->exceptOnForms()->hideFromIndex()->language('html'),
            Text::make('Slug')->readonly(true)->hideFromIndex(),
            Color::make('Primary Color')->hideFromIndex(),
            Color::make('Secondary Color')->hideFromIndex(),
            Boolean::make('Show Header/Footer', 'show_header_footer')->hideFromIndex(),
            Code::make('Embed Code')->language('html'),
            Boolean::make('Auto Approve Responses')->help('If this box is checked, typeform responses will automatically show up in the web view and the slideshow view without the opportunity for moderation.'),
            Select::make('Theme')->options($keys)->hideFromIndex(),
            HasMany::make('Responses'),
            Text::make('Embedded Url')->help('If you are embedding the web responses page in an iframe, enter the URL of the iframe page here so that share links will have the proper URL.')->hideFromIndex(),
            Boolean::make('Allow Printing'),
            Textarea::make('Print Footer')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [resolve(RetreiveMissingResponses::class)];
    }
}

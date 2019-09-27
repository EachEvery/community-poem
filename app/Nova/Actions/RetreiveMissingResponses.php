<?php

namespace CommunityPoem\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use GuzzleHttp\Client as Guzzle;

class RetreiveMissingResponses extends Action
{
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(Guzzle $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection    $models
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $models->each(function ($space) {
            $url = sprintf('https://api.typeform.com/forms/%s/responses?page_size=1000', $space->typeform_id);

            $response = $this->guzzle->get($url, [
                'headers' => [
                    'Authorization' => sprintf('Bearer %s', config('services.typeform.key')),
                ],
            ]);

            collect(json_decode($response->getBody())->items)->map(function ($entry) use ($space) {
                $id = $entry->response_id;

                $data = array_merge(['typeform_id' => $id], (array) $this->getFields(['name', 'content', 'city', 'email'], $entry));

                return $space->responses()->firstOrCreate(
                    ['typeform_id' => $id],
                    $data
                );
            });
        });
    }

    public function getFields($fields, $entry)
    {
        return collect($entry->answers)
                ->mapWithKeys(function ($answer) {
                    $field = $answer->field;
                    $type = $answer->type;

                    return [
                        $field->ref => $answer->$type,
                    ];
                })
                ->only($fields)
                ->toArray();
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}

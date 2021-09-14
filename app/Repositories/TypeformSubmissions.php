<?php

namespace CommunityPoem\Repositories;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\Str;

class TypeformSubmissions
{
    public function __construct(Guzzle $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function formSubmissions($formId)
    {
        $url = sprintf('https://api.typeform.com/forms/%s/responses?page_size=1000', $formId);

        $response = $this->guzzle->get($url, [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', config('services.typeform.key')),
            ],
        ]);

        return json_decode($response->getBody())->items;
    }

    public function getFields($fields, $entry)
    {
        return collect($entry->answers)
                ->mapWithKeys(function ($answer) {
                    $answer = (object) $answer;
                    $field = (object) $answer->field;
                    $type = $answer->type;

                    if ('choice' === $type) {
                        $choice = (object) $answer->choice;

                        if (Str::contains($field->ref, 'prompt-')){
                            return [
                                'prompt' => $choice->label,
                            ];
                        }

                        return [
                            $field->ref => $choice->label,
                        ];
                    }

                    return [
                        $field->ref => $answer->$type,
                    ];
                })
                ->only($fields);
    }

    public function fieldsToCollect()
    {
        return ['name', 'city', 'email', 'content', 'prompt'];
    }
}

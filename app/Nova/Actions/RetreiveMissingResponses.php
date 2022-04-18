<?php

namespace CommunityPoem\Nova\Actions;

use CommunityPoem\Repositories\TypeformSubmissions;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class RetreiveMissingResponses extends Action
{
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(TypeformSubmissions $submissions)
    {
        $this->submissions = $submissions;
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $models->each(function ($space) {
            $typeform_ids = $space->typeformids;
            
            $items = [];
            foreach ($typeform_ids as $typeform_id) {
                $items = array_merge($items, $this->submissions->formSubmissions($typeform_id));
            }

            collect($items)->map(function ($entry) use ($space) {
                if (empty($entry->answers)) {
                    return;
                }

                $fields = $this->submissions->fieldsToCollect();
                $typeformIdFillable = ['typeform_id' => $entry->token];

                $data = array_merge(
                    $typeformIdFillable,
                    $this->submissions->getFields($fields, $entry)->toArray()
                );

                return $space->responses()->firstOrCreate(
                    $typeformIdFillable,
                    $data
                );
            });
        });
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

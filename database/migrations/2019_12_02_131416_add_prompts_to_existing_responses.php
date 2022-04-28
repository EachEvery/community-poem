<?php

use Carbon\Carbon;
use CommunityPoem\Repositories\TypeformSubmissions;
use CommunityPoem\Response;
use Illuminate\Database\Migrations\Migration;

class AddPromptsToExistingResponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $spaceRows = DB::table('spaces')->get();

        DB::table('responses')->get()->each(function ($rowResponse) use ($spaceRows) {
            $spaceData = $spaceRows->first(function ($r) use ($rowResponse) {
                return $r->id === $rowResponse->space_id;
            });

            if (filled($spaceData)) {

                $items = $spaceData->typeformids;
                $typeformResponses = collect([]);

                foreach($items as $typeform_id) {
                    $typeformResponses = $typeformResponses->merge($this->getTypeformResponses($typeform_id));
                }

                $match = $typeformResponses->first(function ($res) use ($rowResponse) {
                    $time = Carbon::parse($rowResponse->created_at);
                    $match_on = Response::matchBase64String($rowResponse->name, $rowResponse->city, $time);

                    return $res['match_on'] === $match_on;
                });

                if (filled($match)) {
                    DB::table('responses')
                        ->where('id', $rowResponse->id)
                        ->update([
                            'prompt' => $match['prompt'] ?? null,
                            'typeform_id' => $match['token'],
                        ]);
                }
            }
        });
    }

    public function tf()
    {
        return resolve(TypeformSubmissions::class);
    }

    public function getTypeformResponses($typeform_form_id)
    {
        return once(function () use ($typeform_form_id) {
            return collect($this->tf()->formSubmissions($typeform_form_id))
                ->map(function ($submission) {
                    $fields = $this->tf()->getFields(
                        $this->tf()->fieldsToCollect(), $submission
                    );

                    return array_merge($fields->toArray(), [
                        'token' => $submission->token,
                        'match_on' => Response::matchBase64String(
                            $fields['name'] ?? null,
                            $fields['city'] ?? null,
                            Carbon::parse($submission->landed_at)
                        ),
                    ]);
                });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('responses')->update([
            'prompt' => null,
        ]);
    }
}

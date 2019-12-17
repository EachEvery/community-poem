<?php

namespace CommunityPoem\Http\Requests;

use CommunityPoem\Repositories\Spaces;
use CommunityPoem\Repositories\TypeformSubmissions;
use Illuminate\Foundation\Http\FormRequest;

class TypeformWebhook extends FormRequest
{
    public function __construct(Spaces $spaces, TypeformSubmissions $submissions)
    {
        $this->spaces = $spaces;
        $this->submissions = $submissions;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function space()
    {
        $form_id = $this->input('form_response')['form_id'];

        return tap($this->spaces->matchingTypeformId($form_id), function ($space) use ($form_id) {
            if (empty($space)) {
                abort(404, 'No space configured to accept responses from from with id '.$form_id);
            }
        });
    }

    public function responseFillable()
    {
        $fieldsToCollect = $this->submissions->fieldsToCollect();

        $fields = $this->submissions->getFields($fieldsToCollect, (object) $this->input('form_response'));

        $fields->put('approved_at', now());

        $fields->put('typeform_id', $this->input('form_response.token'));

        return $fields->toArray();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'event_id' => 'required',
            'form_response.form_id' => 'required',
            'form_response.answers.*.field.ref' => 'required',
            'form_response.answers.*.field.ref' => 'required',
        ];
    }
}

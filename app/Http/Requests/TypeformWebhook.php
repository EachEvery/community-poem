<?php

namespace CommunityPoem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CommunityPoem\Repositories\Spaces;

class TypeformWebhook extends FormRequest
{
    public function __construct(Spaces $spaces)
    {
        $this->spaces = $spaces;
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
                abort(404, 'No space configured to accept responses from from with id ' . $form_id);
            }
        });
    }

    public function responseFillable()
    {
        $fields = collect($this->input('form_response')['answers'])
            ->mapWithKeys(function ($field) {
                return [
                    $field['field']['ref'] => $field[$field['type']],
                ];
            })
            ->only(['name', 'city', 'email', 'content']);

        return $fields->put('typeform_id', $this->input('event_id'))->toArray();
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

<?php

namespace Display\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return false;
    }

    public function space()
    {
        return $this->spaces->matchingTypeformId();
    }

    public function responseFillable() {
        return [
            'name' => '',
            'location' => '',
            'email' => '',
            'content' => ''
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }
}

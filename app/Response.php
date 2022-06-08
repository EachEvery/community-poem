<?php

namespace CommunityPoem;

use Illuminate\Database\Eloquent\Model;
use Google\Cloud\Translate\V2\TranslateClient;

class Response extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['status'];
    protected $dates = ['approved_at'];

    /**
     * Get translations for the response.
     */
    public function translations()
    {
        return $this->hasMany(Translation::class);
    }

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function getIsApprovedAttribute()
    {
        return filled($this->approved_at);
    }

    public function getStatusAttribute()
    {
        return filled($this->approved_at) ? 'approved' : 'unapproved';
    }

    public function getMatchOnAttribute()
    {
        return static::matchBase64String($this->name, $this->city, $this->created_at);
    }

    public static function matchBase64String($name, $city, $carbon)
    {
        return base64_encode(sprintf('%s.%s.%s', strtolower(trim($name ?? 'empty')), strtolower(trim($city ?? 'empty')), $carbon->format('Y-m-d-H')));
    }

    public function getUrl()
    {
        $space = $this->space;

        if (filled($space->embedded_url)) {
            return $space->embedded_url . '?highlight=' . $this->id;
        }

        return route('thread', ['slug' => $this->space->slug]) . '?highlight=' . $this->id;
    }

    public function translateText($response, $lang = 'original')
    {

        if ($lang != 'original') {

            $translate = new TranslateClient([
                'key' => env('GOOGLE_TRANSLATION_KEY')
            ]);

            if ( $translation = $response->translations()->where('lang', $lang)->first() ) {
                
                // Added for backwards compatability
                if ( ! filled($translation->prompt) ) {
                    $prompt = $translate->translate($response->prompt, ['target' => $lang]);
                    $translation->prompt = $prompt['text'];
                    $translation->save();
                }

                $response->content = $translation->content;
                $response->prompt = $translation->prompt;
            } else {

                // Translate text from english to new language.
                $content = $translate->translate($response->content, ['target' => $lang]);
                $prompt = $translate->translate($response->prompt, ['target' => $lang]);

                $translation = new Translation;
                $translation->response_id = $response->id;
                $translation->content = $content['text'];
                $translation->prompt = $prompt['text'];
                $translation->save();

                $response->content = $translation->content;
                $response->prompt = $translation->prompt;
                $response->name = 'no cache'; // $translation->name;

            }

        }

        return $response;
    }
}

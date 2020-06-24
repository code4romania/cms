<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasTranslation;
use Code4Romania\Cms\Models\BaseModel;
use Code4Romania\Cms\Presenters\PersonPresenter;
use Illuminate\Support\Facades\Storage;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;
use LasseRafn\Initials\Initials;

class Person extends BaseModel
{
    use HasTranslation, HasMedias;

    /** @var array<string> */
    protected $with = [
        'translations',
        'medias',
    ];

    /** @var Presenter */
    protected $presenterAdmin = PersonPresenter::class;

    /** @var Presenter */
    protected $presenter = PersonPresenter::class;

    /** @var array<string> */
    protected $fillable = [
        'published',
        'name',
        'linkedin',
        'github',
        'position',
    ];

    /** @var array<string> */
    public $translatedAttributes = [
        'title',
        'description',
        'active',
    ];

    /** @var array<string,int> */
    public $mediasParams = [
        'image' => [
            'default' => [
                [
                    'name' => 'default',
                    'ratio' => 1,
                ],
            ],
        ],
    ];

    public function setGithubAttribute(?string $value): void
    {
        $this->attributes['github'] = !is_null($value)
            ? str_replace(config('cms.social.networks.github.baseUrl'), '', $value)
            : null;
    }

    public function getGithubAttribute(?string $value): ?string
    {
        return !is_null($value)
            ? config('cms.social.networks.github.baseUrl') . $value
            : null;
    }

    public function setLinkedinAttribute(?string $value): void
    {
        $this->attributes['linkedin'] = !is_null($value)
            ? str_replace(config('cms.social.networks.linkedin.baseUrl'), '', $value)
            : null;
    }

    public function getLinkedinAttribute(?string $value): ?string
    {
        return !is_null($value)
            ? config('cms.social.networks.linkedin.baseUrl') . $value
            : null;
    }

    public function getPlaceholderAvatarAttribute(): string
    {
        $disk = Storage::disk('public');

        $initials = (new Initials)
            ->name($this->name)
            ->getUrlfriendlyInitials();


        if ($disk->missing("avatars/{$initials}.png")) {
            $disk->put(
                "avatars/{$initials}.png",
                (new InitialAvatar)
                    ->name($initials)
                    ->size(96)
                    ->generate()
                    ->encode()
            );
        }

        return $disk->url("avatars/{$initials}.png");
    }

    public function getTitleInBrowserAttribute(): string
    {
        return $this->name;
    }

    public function cityLab()
    {
        return $this->morphedByMany(CityLab::class, 'personable');
    }
}

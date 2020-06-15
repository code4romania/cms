<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use Code4Romania\Cms\Models\BaseModel;
use Code4Romania\Cms\Presenters\PartnerPresenter;

class Partner extends BaseModel implements Sortable
{
    use HasMedias, HasPosition;

    /** @var Presenter */
    protected $presenterAdmin = PartnerPresenter::class;

    /** @var Presenter */
    protected $presenter = PartnerPresenter::class;

    /** @var array<string> */
    protected $fillable = [
        'published',
        'name',
        'website',
        'position',
    ];

    /** @var array<string,int> */
    public $mediasParams = [
        'logo' => [
            'default' => [
                [
                    'name' => 'default',
                ],
            ],
        ],
    ];

    public function getTitleInBrowserAttribute(): string
    {
        return $this->name;
    }
}

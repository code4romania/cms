<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use NZTim\Mailchimp\MailchimpFacade as Mailchimp;
use Throwable;

class MailchimpHelper
{
    public static function getListsCached(): Collection
    {
        try {
            return Cache::rememberForever('settings.mailchimp.lists', function () {
                return collect(Mailchimp::getLists())
                    ->map(function ($list) {
                        return [
                            'id'   => $list['id'],
                            'name' => $list['name'],
                        ];
                    });
            });
        } catch (Throwable $th) {
            return collect();
        }
    }
}

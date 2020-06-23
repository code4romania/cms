<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Front;

use Code4Romania\Cms\Http\Requests\Front\NewsletterSubscriptionRequest;
use Illuminate\Http\RedirectResponse;
use NZTim\Mailchimp\MailchimpFacade as Mailchimp;

class NewsletterSubscriptionController extends Controller
{
    /**
     * Process form submission
     */
    public function subscribe(NewsletterSubscriptionRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        Mailchimp::subscribe($attributes['list'], $attributes['email']);

        return back()->with('success', __('form.confirmSubscription'));
    }
}

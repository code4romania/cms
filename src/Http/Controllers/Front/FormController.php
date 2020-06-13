<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Front;

use Code4Romania\Cms\Http\Requests\Front\FormRequest;
use Illuminate\Http\Response;

class FormController extends Controller
{
    /**
     * Process form submission
     *
     * @param FormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function submit(FormRequest $request)
    {
        return $request->validated();
    }
}

<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Front;

use Code4Romania\Cms\Http\Requests\Front\FormRequest;
use Code4Romania\Cms\Models\Form;
use Code4Romania\Cms\Repositories\ResponseRepository;
use Illuminate\Http\Response;

class FormController extends Controller
{
    /**
     * Process form submission
     */
    public function submit(FormRequest $request)
    {
        $form = Form::query()
            ->findOrFail($request->route('id'));

        $values = $request->validated()['fields'];

        $data = [];

        foreach ($form->getFieldsBySection() as $sectionIndex => $section) {
            $data[$sectionIndex] = [
                'title'  => $section['title'] ?? null,
                'fields' => [],
            ];
            foreach ($section['fields'] as $fieldIndex => $field) {
                $data[$sectionIndex]['fields'][$fieldIndex] = [
                    'label' => $field['label'] ?? null,
                    'value' => $values[$sectionIndex][$fieldIndex],
                ];
            }
        }

        if ($form->store) {
            app(ResponseRepository::class)->create([
                'form_id' => $form->id,
                'data'    => $data,
            ]);
        }

        return 'ok';
    }
}

@formField('select', [
    'name'         => 'form',
    'label'        => __('admin.form'),
    'required'     => true,
    'native'       => true,
    'max'          => 1,
    'options'      => app( config('twill.namespace') . '\Models\Form')
        ->with([
            'translation' => fn ($query) => $query->select('id', 'title'),
        ])
        ->get('id', 'translation')
        ->map(fn($item) => ['value' => $item->id, 'label' => $item->title])
        ->toArray(),
])

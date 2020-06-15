@formField('select', [
    'name'         => 'form',
    'label'        => __('admin.form'),
    'native'       => true,
    'max'          => 1,
    'options'      => app( config('twill.namespace') . '\Models\Form')
        ->with([
            'translation' => function ($query) {
                $query->select('id', 'title');
            }
        ])
        ->get('id', 'translation')
        ->map(function($item) {
            return [
                'value' => $item->id,
                'label' => $item->title,
            ];
        })
        ->toArray(),
])

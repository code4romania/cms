@formField('select', [
    'name'       => 'columns',
    'label'      => 'Columns',
    'default'    => 1,
    'unpack'     => true,
    'options'    => collect([1, 2, 3, 4])->map(function($i) {
        return [
            'value' => $i,
            'label' => $i,
        ];
    })->toArray(),
])

@formField('medias', [
    'name'         => 'image',
    'label'        => 'Images',
    'max'          => 8,
    'note'         => 'Add up to 8 images',
    'required'     => true,
    'withVideoUrl' => false,
])

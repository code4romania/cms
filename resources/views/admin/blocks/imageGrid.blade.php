@formField('select', [
    'name'       => 'columns',
    'label'      => __('admin.field.columns'),
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
    'label'        => __('admin.field.images'),
    'max'          => 12,
    'note'         => __('admin.fieldNote.imagesUpTo', ['count' => 12]),
    'required'     => true,
    'withVideoUrl' => false,
])

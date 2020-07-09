@twillBlockTitle('Form')
@twillBlockIcon('edit')
@twillBlockGroup('content')

@formField('select', [
    'name'         => 'form',
    'label'        => __('admin.form'),
    'required'     => true,
    'native'       => true,
    'max'          => 1,
    'options'      => Code4Romania\Cms\Models\Form::query()
        ->with('translation:id,form_id,title')
        ->get('id')
        ->mapWithKeys(fn($form) => [ $form->id => $form->title ]),
])

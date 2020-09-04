@twillRepeaterTitle('Counter item')
@twillRepeaterTrigger('Add counter item')
@twillRepeaterGroup('app')

@formField('input', [
    'name'           => 'number',
    'label'          => __('admin.field.number'),
    'translated'     => false,
])

@formField('input', [
    'name'           => 'label',
    'label'          => __('admin.field.label'),
    'translated'     => true,
])

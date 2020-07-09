@twillBlockTitle('Menu item')
@twillBlockIcon('info')
@twillBlockGroup('menu')

@include('admin.repeaters.subMenuItem')

@formField('repeater', [
    'type' => 'subMenuItem',
])

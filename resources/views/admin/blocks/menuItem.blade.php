@twillBlockTitle('Menu item')
@twillBlockIcon('info')
@twillBlockGroup('menu')

@include('admin.utils.menu-item-template')

@formField('repeater', [
    'type' => 'subMenuItem',
])

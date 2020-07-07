@twillBlockTitle('Newsletter form')
@twillBlockIcon('info')
@twillBlockGroup('content')

@inject('mailchimp', 'Code4Romania\Cms\Helpers\MailchimpHelper')

@include('admin.utils.ckeditor', [
    'name'       => 'text',
    'label'      => __('admin.field.text'),
    'translated' => true,
])

@formField('select', [
    'name'       => 'list',
    'label'      => __('admin.field.list'),
    'unpack'     => false,
    'options'    => $mailchimp->getListsCached()
        ->map(function($list) {
            return [
                'value' => $list['id'],
                'label' => $list['name'] . " ({$list['id']})",
            ];
        })
        ->toArray(),
])

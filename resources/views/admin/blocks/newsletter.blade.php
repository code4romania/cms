@inject('mailchimp', 'Code4Romania\Cms\Helpers\MailchimpHelper')

@formField('wysiwyg', [
    'name'           => 'text',
    'label'          => __('admin.field.text'),
    'type'           => config('cms.editor.type'),
    'toolbarOptions' => config('cms.editor.toolbar'),
    'translated'     => true,
    'editSource'     => true,
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

<?php

return [

    'analytics' => [
        'enabled'                          => boolval(env('ANALYTICS_VIEW_ID')),
        'service_account_credentials_json' => storage_path('app/analytics/service-account-credentials.json'),
    ],

    'modules' => [
        /**
         * @param array $module Array containing the module config params.
         *
         * 'moduleName' = [
         *     'name'           => (string)  [required] Module name
         *     'label'          => (string)  [optional] If the name of your module above does not work as a label
         *     'label_singular' => (string)  [optional] If the automated singular version does not work as a label
         *     'routePrefix'    => (string)  [optional] If the module is living under a specific routes group
         *     'count'          => (boolean) [required] Show total count with link to index of this module
         *     'create'         => (boolean) [required] Show link in create new dropdown
         *     'activity'       => (boolean) [required] Show activities on this module in actities list
         *     'draft           => (boolean) [required] Show drafts of this module for current user
         *     'search'         => (boolean) [required] Show results for this module in global search
         * ]
         */

        'page' => [
            'name'           => 'pages',
            'label'          => 'Pages',
            'label_singular' => 'Page',
            'routePrefix'    => '',
            'count'          => true,
            'create'         => true,
            'activity'       => true,
            'draft'          => true,
            'search'         => true,
        ],

    ],
];

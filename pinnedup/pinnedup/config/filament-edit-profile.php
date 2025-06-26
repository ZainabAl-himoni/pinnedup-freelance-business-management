<?php

return [
    'avatar_column' => 'avatar_url',
    'disk' => env('FILESYSTEM_DISK', 'public'),
    'visibility' => 'public', // or replace by filesystem disk visibility with fallback value
    'show_custom_fields' => true,
    'custom_fields' => [
        'behance' => [
            'type' => 'text', // Valid Filament field type
            'label' => 'Behance URL',
            'placeholder' => 'https://www.behance.net/your-profile',
            'required' => false, // Explicitly set required to true or false
            'rules' => 'nullable|url|max:255', // Validation rules
        ],
        'dribbble' => [
            'type' => 'text',
            'label' => 'Dribbble URL',
            'placeholder' => 'https://www.dribbble.com/your-profile',
            'required' => false,
            'rules' => 'nullable|url|max:255',
        ],
        'linkedin' => [
            'type' => 'text',
            'label' => 'LinkedIn URL',
            'placeholder' => 'https://www.linkedin.com/in/your-profile',
            'required' => false,
            'rules' => 'nullable|url|max:255',
        ],
        'github' => [
            'type' => 'text',
            'label' => 'GitHub URL',
            'placeholder' => 'https://www.github.com/your-profile',
            'required' => false,
            'rules' => 'nullable|url|max:255',
        ],
    ],
];


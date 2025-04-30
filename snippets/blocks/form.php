<?php snippet('dreamform/form', [
    'form' => $block->form()->toPage(),
    'attr' => [
        'form' => ['class' => 'uk-form'],
        'row' => ['class' => 'uk-grid'],
        'column' => ['class' => ''],
        'field' => ['class' => 'uk-margin'],
        'label' => ['class' => 'uk-form-label'],
        'error' => ['class' => 'uk-form-danger'],
        'input' => ['class' => ''],
        'button' => ['class' => 'uk-button uk-button-primary'],

        
        // Field-specific attributes
        'textarea' => [
            'field' => [],
            'label' => [],
            'error' => [],
            'input' => ['class' => 'uk-textarea'],
        ],
        'text' => [
            'field' => [],
            'label' => [],
            'error' => [],
            'input' => ['class' => 'uk-input'],
        ],
        'select' => [
            'field' => [],
            'label' => [],
            'error' => [],
            'input' => ['class' => 'uk-select uk-input'],
        ],
        'number' => [
            'field' => [],
            'label' => [],
            'error' => [],
            'input' => ['class' => 'uk-input'],
        ],
        'file' => [
            'field' => ['class' => 'uk-form-custom'],
            'label' => [],
            'error' => [],
            'input' => [],
        ],
        'email' => [
            'field' => [],
            'label' => [],
            'error' => [],
            'input' => ['class' => 'uk-input'],
        ],
        'radio' => [
            'field' => [],
            'label' => [],
            'error' => [],
            'input' => ['class' => 'uk-radio'],
            'row' => []
        ],
        'checkbox' => [
            'field' => [],
            'label' => [],
            'error' => [],
            'input' => ['class' => 'uk-checkbox'],
            'row' => []
        ],

        'success' => [], // Success message
        'inactive' => [], // Inactive message
    ]
    ]); ?>
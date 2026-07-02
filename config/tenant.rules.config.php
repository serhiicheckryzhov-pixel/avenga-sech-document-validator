<?php
return [
    'tenant_a'         => [
        'max_size'          => 250,
        'prohibited_words'  => ['test', 'something', 'valid'],
        'required_metadata' => ['author']
    ],

    'tenant_b'         => [
        'max_size'          => 5,
        'prohibited_words'  => ['hello', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur'],
        'required_metadata' => ['some_metadata']
    ],

    'tenant_c'         => [
        'max_size'          => 500,
        'prohibited_words'  => ['Lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur'],
        'required_metadata' => ['created_at']
    ],
];
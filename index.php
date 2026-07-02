<?php

require_once __DIR__ . '/vendor/autoload.php';

use src\Document;
use src\Validator;
use src\TenantRules;
use src\Factories\ValidationRuleFactory;


// Success case:
echo "=== Success ===\n\n";

// Set current tenant
$tenantId = 'tenant_a';

// Create a document
$document = new Document(
    id: 1,
    tenantId: $tenantId,
    content: 'Hello world! Content for validation',
    metadata: [
        'author' => 'John Doe',
        'created_at' => '2026-06-30',
    ]
);

// Get config rules for a tenant
$rules = new TenantRules();
$tenantRules = $rules->getTenantRules($tenantId);

// Validate the document
$rulesFactory = new ValidationRuleFactory($tenantRules);
$validator = new Validator($rulesFactory);
$result = $validator->validate($document, $tenantRules);
echo json_encode($result, JSON_PRETTY_PRINT);

echo PHP_EOL;


// Unsuccess case:
echo "=== Unsuccess ===\n\n";

// Set current tenant
$tenantId = 'tenant_b';

// Create a document
$document = new Document(
    id: 1,
    tenantId: $tenantId,
    content: 'Hello world! Content for validation',
    metadata: [
        'author' => 'John Doe',
        'created_at' => '2026-06-30',
    ]
);

// Get config rules for a tenant
$rules = new TenantRules();
$tenantRules = $rules->getTenantRules($tenantId);

// Validate the document
$rulesFactory = new ValidationRuleFactory($tenantRules);
$validator = new Validator($rulesFactory);
$result = $validator->validate($document, $tenantRules);
echo json_encode($result, JSON_PRETTY_PRINT);

echo PHP_EOL;


<?php

declare(strict_types=1);

use CodeIgniter\CodingStandard\CodeIgniter4;
use Nexus\CsConfig\Factory;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in(__DIR__)
    ->exclude([
        'application/ThirdParty',
        'application/Views',
        'vendor',
    ]);

$overrides = [];

$options = [
    'finder'     => $finder,
    'usingCache' => false,
];

return Factory::create(new CodeIgniter4(), $overrides, $options)->forProjects();
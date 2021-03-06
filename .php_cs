<?php

$header = <<<'EOF'
This file is part of Sulu.

(c) MASSIVE ART WebServices GmbH

This source file is subject to the MIT license that is bundled
with this source code in the file LICENSE.
EOF;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        'ordered_imports' => true,
        'concat_space' => ['spacing' => 'one'],
        'array_syntax' => ['syntax' => 'short'],
        'php_unit_construct' => true,
        'phpdoc_align' => false,
        'header_comment' => ['header' => $header],
        'class_definition' => [
            'multiLineExtendsEachSingleLine' => true,
        ]
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->exclude('vendor')
            ->exclude('cache')
            ->in(__DIR__)
    );

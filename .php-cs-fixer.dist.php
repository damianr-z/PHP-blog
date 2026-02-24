<?php

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        'indentation_type' => true,
        'braces' => ['position_after_functions_and_oop_constructs' => 'next'],
    ])
    ->setIndent("    ") // 4 spaces
    ->setLineEnding("\n");

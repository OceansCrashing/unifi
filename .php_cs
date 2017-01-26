<?php

$header = <<<EOF
This file is part of invokatis/unifi package.

(c) Invokatis Technologies <admin@invokatis.tech>

This source file is subject to the MIT license that is bundled
with this source code in the file LICENSE.md.
EOF;

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

return Config::create()
    ->setFinder(
        Finder::create()
            ->in(__DIR__ . '/src')
    )
    ->setRules(array(
        '@PSR2' => true,
        'header_comment' => array('header' => $header),
        'array_syntax' => true,
    ))
    ->setUsingCache(true);

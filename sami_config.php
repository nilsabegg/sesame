<?php

use Sami\Sami;

return new Sami('./src', [
    'title' => 'Sesame Documentation',
    'build_dir' => __DIR__ . '/build/apidoc/'
]);
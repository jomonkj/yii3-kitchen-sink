<?php

return [
    'i18n.locale' => 'en-US',
    'debug.enabled' => true,
    'debug.allowedIPs' => ['[::1]'],
    'packages' => require 'packages.php',
    'request.cookieValidationKey' => 'kZcZPIa22dtb5k00JfBhtOm9svGfihig',
    'db.name' => dirname(__DIR__) . '/db.sqlite',
];

<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '/site' => 'site/index',
        '/sandbox' => 'sandbox/index',
        '/sign-in' => 'session/login',
        '/sign-up' => 'session/signup',
    ],
];
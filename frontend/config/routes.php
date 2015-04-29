<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '/site' => 'site/index',
        '/sandbox' => 'sandbox/index',
        '/sign-in' => 'session/log-in',
        '/sign-up' => 'session/sign-up',
    ],
];
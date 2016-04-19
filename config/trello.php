<?php

return [

    'api_key' => env('TRELLO_KEY', ''),
    'api_token' => env('TRELLO_TOKEN', ''),
    'organization' => env('TRELLO_ORGANIZATION', ''),
    'board' => env('TRELLO_BOARD', 'Main'),
    'list' => env('TRELLO_LIST', 'Today'),
];

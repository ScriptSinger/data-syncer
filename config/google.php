<?php

return [
    'credentials_path' => env('GOOGLE_CREDENTIALS_PATH', storage_path('app/google/credentials.json')),
    'spreadsheet_id' => env('GOOGLE_SPREADSHEET_ID'),
];

<?php

return [
    'MediaTypeServices' => [
        'image' => [
            'extensions' => [
                'png', 'jpg', 'jpeg',
            ],
            'handler' => \Cyaxaress\Media\Services\ImageFileService::class,
        ],
        'video' => [
            'extensions' => [
                'avi', 'mp4', 'mkv',
            ],
            'handler' => \Cyaxaress\Media\Services\VideoFileService::class,
        ],
        'zip' => [
            'extensions' => [
                'zip', 'rar', 'tar',
            ],
            'handler' => \Cyaxaress\Media\Services\ZipFileService::class,
        ],
    ],
];

<?php

use Illuminate\Support\Facades\Facade;

return [
  'homepage' => env('CMS_HOMEPAGE', 'home'),
  'media_sizes' => [
    'thumbnail' => [
      'width' => 300,
      'height' => 300,
      'crop' => true,
    ],
    'small' => [
      'width' => 500,
    ],
    'medium' => [
      'width' => 1024,
    ]
    ],
    'media_extensions' => [
      'image' => ['jpeg','jpg','png','gif','webp'],
      'document' => ['docx','doc','xls','xlsx','zip','epub','xml','ppt','pptx','txt','pdf'],
      'video' => ['mp4','webm'],
      'audio' => ['mp3','wav','ogg'],
    ]
];

?>
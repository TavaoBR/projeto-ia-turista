<?php

namespace Src\Services;

use GeminiAPI\Client;
use GeminiAPI\Enums\HarmCategory;
use GeminiAPI\Enums\HarmBlockThreshold;
use GeminiAPI\GenerationConfig;
use GeminiAPI\Resources\Parts\TextPart;
use GeminiAPI\SafetySetting;

class IA 
{

    private string $text;

    public function __construct($text)
    {
      $this->text = $text;
    }

    public function gerar()
    {
        
        $client = new Client('AIzaSyA8E0IfBW4qdPXin-Tu5VmZD5-OPJPAVWI');
        $response = $client->geminiPro()->generateContent(
            new TextPart("{$this->text}"),
        );
        return $response->text();
    }

}
<?php

namespace App\Services\Messenger\SlackMessenger;

use App\Services\Messenger\MessengerInterface;
use GuzzleHttp\Client;

class SlackMessengerService implements MessengerInterface
{
    public function __construct(
        protected Client $client
    ) {
    }

    public function send(string $message): bool
    {
        $this->client->post(config('message.slack.url'), [
            'json' => [
                'text' => $message,
//                "blocks" => [
//                    [
//                        "type" => "section",
//                        "text" => [
//                            "type" => "mrkdwn",
//                            "text" => "Danny Torrence left the following review for your property:"
//                        ]
//                    ],
//                    [
//                        "type" => "section",
//                        "block_id" => "section567",
//                        "text" => [
//                            "type" => "mrkdwn",
//                            "text" => "<https://example.com|Overlook Hotel> \n :star: \n Doors had too many axe holes, guest in room 237 was far too rowdy, whole place felt stuck in the 1920s."
//                        ],
//                        "accessory" => [
//                            "type" => "image",
//                            "image_url" => "https://is5-ssl.mzstatic.com/image/thumb/Purple3/v4/d3/72/5c/d3725c8f-c642-5d69-1904-aa36e4297885/source/256x256bb.jpg",
//                            "alt_text" => "Haunted hotel image"
//                        ],
//                    ]
//                ]
            ]
        ]);

        return true;
    }
}

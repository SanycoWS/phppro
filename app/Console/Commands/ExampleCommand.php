<?php

namespace App\Console\Commands;

use App\Enums\Messenger;
use App\Services\Messenger\MessengerFactory;
use Illuminate\Console\Command;

class ExampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:example-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(MessengerFactory $service)
    {
        foreach (Messenger::cases() as $messenger) {
            $service->handle($messenger)->send('text from ' . $messenger->name);
        }

        return;

//        $message = new BookCreateMessageDTO(
//            (object)[
//                'name' => 'cat name',
//                'lang' => Lang::UA->value,
//                'createdAt' => time(),
//                //   'updatedAt' => time(),
//            ]
//        );
//        $encoded = json_encode($message);
//        $this->info($encoded);
//
//        // in other place
//        $object = json_decode($encoded);
//        $newMessage = new BookCreateMessageDTO($object);
//
//        var_dump($newMessage);
    }
}

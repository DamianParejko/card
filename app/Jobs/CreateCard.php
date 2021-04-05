<?php

namespace App\Jobs;

use App\Models\Card;
use Illuminate\Bus\Queueable;
use App\Http\Requests\CardRequest;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateCard implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $receiver;

    public function __construct(array $receiver)
    {
        $this->receiver = $receiver;
    }

    public function handle()
    {
        $card = new Card([
            'number' => $this->receiver['number'],
            'pin' => $this->receiver['pin'],
            'activation' => $this->receiver['activation'],
            'validity' => $this->receiver['validity'],
            'balance' => $this->receiver['balance']
        ]);

        $card->save();

        return $card;
    }
}

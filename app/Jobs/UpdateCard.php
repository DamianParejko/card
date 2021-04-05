<?php

namespace App\Jobs;

use App\Models\Card;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateCard implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $card;
    private $receiver;

    public function __construct(Card $card, array $receiver)
    {
        $this->card = $card;
        $this->receiver = $receiver;
    }

    public function handle()
    {
        $this->card->update([
            'number' => $this->receiver['number'],
            'pin' => $this->receiver['pin'],
            'activation' => $this->receiver['activation'],
            'validity' => $this->receiver['validity'],
            'balance' => $this->receiver['balance']
        ]);
    }
}

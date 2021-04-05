<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Card;
use App\Jobs\CreateCard;
use App\Jobs\UpdateCard;
use Illuminate\Http\Request;
use App\Http\Requests\CardRequest;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::paginate(3);

        return response()->json($cards, 200);
    }

    public function store(CardRequest $request)
    {
        $this->dispatchNow(new CreateCard($request->only(
            ['number', 'pin', 'activation', 'validity', 'balance']
        )));

        return response()->json(201);
    }

    public function edit(Card $card)
    {
        return response()->json($card, 200);
    }

    public function update(CardRequest $request, Card $card)
    {
        $this->dispatchNow(new UpdateCard($card, $request->only([
            'number', 'pin', 'activation', 'validity', 'balance'
        ])));

        return response()->json($card, 201);
    }

    
    public function destroy(Card $card)
    {
        $card->delete();

        return response()->json(204);
    }
}

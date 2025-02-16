<?php

namespace App\Http\Controllers;

use App\Conversations\CompraInmuebleConversation;
use App\Conversations\ConversationServices;
use App\Conversations\InformacionUsuarioConversation;
use App\Conversations\VentaPropiedadConversation;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\ExampleConversation;
use Illuminate\Support\Facades\Log;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        Log::info('test');
        $botman = app('botman');

        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new InformacionUsuarioConversation());
    }


}

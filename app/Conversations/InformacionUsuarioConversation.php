<?php

namespace App\Conversations;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Support\Facades\Log;

class InformacionUsuarioConversation extends Conversation
{
    protected $datos = [];

    public function run()
    {
        $botones =  Question::create('¡Hola! Soy el asistente virtual de '.config('app.name').'. Me gustaría obtener más información para ayudarte mejor. ¿Podrías proporcionarme algunos datos?')
            ->addButtons([
                Button::create('Claro que si.')->value('si'),
                Button::create('En otra ocación-')->value('no'),
            ])
        ;
        $this->ask($botones, function (Answer $answer){
            if ($answer->getValue() === 'si') {
                $this->askNombreCompleto();
            } else {
                $this->say('¡Gracias por tu tiempo! Si necesitas ayuda, puedes escribirnos a través de nuestro sitio web o llamarnos al 55 5555 5555.');
            }
        });
    }

    public function askNombreCompleto()
    {
        $this->ask('Por favor, proporciona tu nombre completo:', function (Answer $answer) {
            $this->datos['nombre_completo'] = $answer->getText();
            $this->askTelefono();
        });
    }

    public function askTelefono()
    {
        $this->ask('Ahora, ¿cuál es tu número de teléfono?', function (Answer $answer) {
            $this->datos['telefono'] = $answer->getText();
            $this->askCorreo();
        });
    }

    public function askCorreo()
    {
        $this->ask('Por último, ¿puedes proporcionar tu dirección de correo electrónico?', function (Answer $answer) {
            $this->datos['correo'] = $answer->getText();
            $this->askTipoServicio();
        });
    }

    public function askTipoServicio()
    {

        $botones =  Question::create('¿Qué tipo de servicio deseas realizar?')
            ->addButtons([
                Button::create('Compra Inmueble')->value('compra_inmueble'),
                Button::create('Venta Propiedad')->value('venta_propiedad'),
                Button::create('Rentar Propiedad')->value('rentar_propiedad'),
                Button::create('Rentar Inmueble ')->value('rentar_inmueble'),
            ]);
        $this->ask($botones, function (Answer $answer) {
            if ($answer->getValue() === 'compra_inmueble') {
                $this->datos['tipo_servicio'] = $answer->getText();
                $this->bot->startConversation(new CompraInmuebleConversation($this->datos));
            } else if ($answer->getValue() === 'venta_propiedad') {
                $this->datos['tipo_servicio'] = $answer->getText();
                $this->bot->startConversation(new VentaPropiedadConversation($this->datos));
            } else if ($answer->getValue() === 'rentar_propiedad') {
                $this->datos['tipo_servicio'] = $answer->getText();
                $this->bot->startConversation(new RentaPropiedadConversation($this->datos));
            } else if ($answer->getValue() === 'rentar_inmueble') {
                $this->datos['tipo_servicio'] = $answer->getText();
                $this->bot->startConversation(new RentaInmuebleConversation($this->datos));
            }

        });
    }
}
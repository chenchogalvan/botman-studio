<?php

namespace App\Conversations;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\CompraInmueble;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Support\Facades\Log;

class CompraInmuebleConversation extends Conversation
{

    protected $datos = [];

    public function __construct($datosUsuario)
    {
        $this->datos = $datosUsuario;
    }

    public function run()
    {
        $this->askTipoInmueble();
    }

    public function askTipoInmueble()
    {
        $this->ask('¿Casa o terreno?', function (Answer $answer) {
            $this->datos['tipo_inmueble'] = $answer->getText();
            $this->askPresupuesto();
        });
    }

    public function askPresupuesto()
    {
        $this->ask('Presupuesto:', function (Answer $answer) {
            $this->datos['presupuesto'] = $answer->getText();
            $this->askUbicacion();
        });
    }

    public function askUbicacion()
    {
        $this->ask('¿Ubicación?', function (Answer $answer) {
            $this->datos['ubicacion'] = $answer->getText();
            $this->askRecursosPropios();
        });
    }

    public function askRecursosPropios()
    {
        $recursos = Question::create('¿Con recursos propios o crédito?')
            ->addButtons([
                Button::create('Con recursos propios')->value('recursos propios'),
                Button::create('Con un credito')->value('creditos'),
            ]);
        $this->ask($recursos, function (Answer $answer) {
            $this->datos['recursos_propios'] = $answer->getText();
            if ($answer->getText() === 'crédito') {
                $this->datos['tipo_credito'] = $answer->getText();
                $this->askTipoCredito();
            } else {
                $this->datos['tipo_credito'] = $answer->getText();
                $this->askDescripcionInmueble();
            }
        });
    }

    public function askTipoCredito()
    {
        $this->ask('¿Crédito Infonavit o bancario?', function (Answer $answer) {
            $this->datos['tipo_credito'] = $answer->getText();
            $this->askTipoCreditoEspecifico();
        });
    }

    public function askTipoCreditoEspecifico()
    {
        $this->ask('¿Primer crédito o segundo?', function (Answer $answer) {
            $this->datos['tipo_credito_especifico'] = $answer->getText();
            $this->askDescripcionInmueble();
        });
    }

    public function askDescripcionInmueble()
    {
        $this->ask('Breve descripción del inmueble a adquirir:', function (Answer $answer) {
            $this->datos['descripcion'] = $answer->getText();

            // Guardar los datos en la base de datos
//            CompraInmueble::create($this->datos);
            Log::info($this->datos);

            $this->say('¡Gracias por proporcionar la información! Hemos registrado tus datos en la base de datos.');
        });
    }
}
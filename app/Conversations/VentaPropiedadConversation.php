<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\BotMan;
use App\VentaPropiedad as Propiedad;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Support\Facades\Log;

class VentaPropiedadConversation extends Conversation
{
    protected $datos = [];

    public function __construct($datosUsuario)
    {
        $this->datos = $datosUsuario;
    }

    public function run()
    {
        $this->askUbicacion();
    }

    public function askUbicacion()
    {
        $this->ask('¿Cuál es la ubicación de la propiedad?', function (Answer $answer) {
            $this->datos['ubicacion'] = $answer->getText();
            $this->askPretendesRecibir();
        });
    }

    public function askPretendesRecibir()
    {
        $this->ask('¿Cuánto pretendes recibir?', function (Answer $answer) {
            $this->datos['precio'] = $answer->getText();
            $this->askAdeudo();
        });
    }

    public function askAdeudo()
    {
        $this->ask(
            Question::create('¿Cuenta con algún adeudo?')
                ->addButtons([
                    Button::create('Sí, tengo adeudo')->value('si'),
                    Button::create('No, no tengo adeudo')->value('no'),
                ]),
            function (Answer $answer) {
                if ($answer->getValue() === 'si') {
                    $this->datos['adeudo'] = $answer->getText();
                    $this->askNumeroCredito();
                } else {
                    $this->datos['adeudo'] = $answer->getText();
                    $this->askTerrenoMetros();
                }
            }
        );
    }

    public function askNumeroCredito()
    {
        $this->ask('Número de crédito:', function (Answer $answer) {
            $this->datos['numero_credito'] = $answer->getText();
            $this->askAdeudoMonto();
        });
    }

    public function askAdeudoMonto()
    {
        $this->ask('¿Cuánto es el adeudo?', function (Answer $answer) {
            $this->datos['adeudo_monto'] = $answer->getText();
            $this->askInstitucionFinanciera();
        });
    }

    public function askInstitucionFinanciera()
    {
        $this->ask('¿Con qué institución financiera tiene el crédito?', function (Answer $answer) {
            $this->datos['institucion_financiera'] = $answer->getText();
            $this->askTerrenoMetros();
        });
    }

    public function askTerrenoMetros()
    {
        $this->ask('¿De cuántos metros es el terreno?', function (Answer $answer) {
            $this->datos['terreno_metros'] = $answer->getText();
            $this->askConstruidosMetros();
        });
    }

    public function askConstruidosMetros()
    {
        $this->ask('¿Cuántos metros tiene construidos?', function (Answer $answer) {
            $this->datos['construidos_metros'] = $answer->getText();
            $this->askEscrituras();
        });
    }

    public function askEscrituras()
    {
        $this->ask('¿Cuenta con escrituras?', function (Answer $answer) {
            $this->datos['escrituras'] = $answer->getText();
            $this->askDescripcionInmueble();
        });
    }

    public function askDescripcionInmueble()
    {
        $this->ask('Breve descripción del inmueble:', function (Answer $answer) {
            $this->datos['descripcion'] = $answer->getText();

            // Guardar los datos en la base de datos
           Propiedad::create($this->datos);
            Log::info($this->datos);

            $this->say('¡Gracias por proporcionar la información! Hemos registrado tus datos en la base de datos.');
        });
    }
}

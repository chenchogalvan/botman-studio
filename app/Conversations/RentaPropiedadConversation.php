<?php

namespace App\Conversations;

use App\RentaPropiedad;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Log;

class RentaPropiedadConversation extends Conversation
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
        $this->ask('Presupuesto esperado:', function (Answer $answer) {
            $this->datos['presupuesto'] = $answer->getText();
            $this->askUbicacion();
        });
    }

    public function askUbicacion()
    {
        $this->ask('Ubicación:', function (Answer $answer) {
            $this->datos['ubicacion'] = $answer->getText();
            $this->askDuracionContrato();
        });
    }

    public function askDuracionContrato()
    {
        $this->ask('Duración del contrato:', function (Answer $answer) {
            $this->datos['duracion_contrato'] = $answer->getText();
            $this->askAceptaMascotas();
        });
    }

    public function askAceptaMascotas()
    {
        $this->ask('¿Se admiten mascotas? (sí o no)', function (Answer $answer) {
            $this->datos['acepta_mascotas'] = $answer->getText();
            $this->askAceptaNinos();
        });
    }

    public function askAceptaNinos()
    {
        $this->ask('¿Se admiten niños? (sí o no)', function (Answer $answer) {
            $this->datos['acepta_ninos'] = $answer->getText();
            $this->askDescripcionInquilinos();
        });
    }

    public function askDescripcionInquilinos()
    {
        $this->ask('Breve descripción de los inquilinos y situación ideal:', function (Answer $answer) {
            $this->datos['descripcion'] = $answer->getText();

            // Guardar los datos en la base de datos
//            RentaPropiedad::create($this->datos);
            Log::info($this->datos);

            $this->say('¡Gracias por proporcionar la información! Hemos registrado tus datos en la base de datos.');
        });
    }
}
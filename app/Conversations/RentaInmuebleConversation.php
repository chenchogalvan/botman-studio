<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\RentaInmueble;
use Illuminate\Support\Facades\Log;

class RentaInmuebleConversation extends Conversation
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
        $this->ask('¿Quieres rentar casa o departamento?', function (Answer $answer) {
            $this->datos['tipo_inmueble'] = $answer->getText();
            $this->askPresupuesto();
        });
    }

    public function askPresupuesto()
    {
        $this->ask('Presupuesto:', function (Answer $answer) {
            $this->datos['presupuesto'] = $answer->getText();
            $this->askPersonas();
        });
    }

    public function askPersonas()
    {
        $this->ask('Para cuántas personas?', function (Answer $answer) {
            $this->datos['personas'] = $answer->getText();
            $this->askDuracionRenta();
        });
    }

    public function askDuracionRenta()
    {
        $this->ask('Durante cuánto tiempo?', function (Answer $answer) {
            $this->datos['duracion'] = $answer->getText();
            $this->askMascotas();
        });
    }

    public function askMascotas()
    {
        $this->ask('¿Cuenta con mascotas?', function (Answer $answer) {
            $this->datos['mascotas'] = $answer->getText();
            $this->askNinos();
        });
    }

    public function askNinos()
    {
        $this->ask('¿Cuenta con niños?', function (Answer $answer) {
            $this->datos['ninos'] = $answer->getText();
            $this->askLugarTrabajo();
        });
    }

    public function askLugarTrabajo()
    {
        $this->ask('Lugar de trabajo:', function (Answer $answer) {
            $this->datos['lugar_trabajo'] = $answer->getText();
            $this->askDescripcionBusqueda();
        });
    }

    public function askDescripcionBusqueda()
    {
        $this->ask('Breve descripción de lo que buscas:', function (Answer $answer) {
            $this->datos['descripcion'] = $answer->getText();

            // Guardar los datos en la base de datos
//            RentaInmueble::create($this->datos);
            Log::info($this->datos);

            $this->say('¡Gracias por proporcionar la información! Hemos registrado tus datos en la base de datos.');
        });
    }
}
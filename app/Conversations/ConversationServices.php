<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class ConversationServices extends Conversation
{

    protected $firstname;
    protected $email;
    protected $phone;

    /**
     * @var string
     */
    private $buyBudget;
    /**
     * @var string
     */
    private $buyLocation;

    public function askFirstname()
    {
        $this->ask('¡Hola! antes de comenazar a ayudarte, pudeiras decirme ¿Cual es tu nombre?', function(Answer $answer) {
            // Save result
            $this->firstname = $answer->getText();

            $this->say('¡Mucho gusto!  '.$this->firstname);
            $this->askObjetive();
        });
    }

    public function askEmail()
    {
        $this->ask('One more thing - what is your email?', function(Answer $answer) {
            // Save result
            $this->email = $answer->getText();

            $this->say('Great - that is all we need, '.$this->firstname);
        });
    }

    public function askObjetive()
    {
        $question =Question::create('¿Que te gustaría hacer?')
            ->addButtons([
                Button::create('Quiero Vender')->value('vender'),
                Button::create('Quiero Comprar')->value('comprar'),
                Button::create('Quiero Rentar (departamento o terreno)')->value('rentar_depa_terreno'),
                Button::create('Quiero Rentar (casa)')->value('rentar_casa'),
            ]);

        return  $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'vender') {
                    $this->say('¡Genial! ¿Que tipo de propiedad quieres vender?');
                } elseif ($answer->getValue() === 'comprar') {
                    $this->say('¡Genial! ¿Que tipo de propiedad quieres comprar?');
                    $this->askBuyType();
                } elseif ($answer->getValue() === 'rentar_depa_terreno') {
                    $this->say('¡Genial! ¿Que tipo de propiedad quieres rentar?');
                } elseif ($answer->getValue() === 'rentar_casa') {
                    $this->say('¡Genial! ¿Que tipo de propiedad quieres rentar?');
                } else {
                    $this->say('¡Genial! ¿Que tipo de propiedad quieres rentar?');
                }
            }
        });

    }



    /*
    * Comprar terreno
    */
    public function askBuyType()
    {
        $question =Question::create('¿Que te gustaría hacer?')
            ->addButtons([
                Button::create('Casa')->value('casa'),
                Button::create('Terreno')->value('terreno'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'casa') {
                    $this->say('¡Genial! ¿Que tipo de casa quieres comprar?');
                    $this->askBuyBudget();
                } elseif ($answer->getValue() === 'terreno') {
                    $this->say('¡Genial! ¿Que tipo de terreno quieres comprar?');
                    $this->askBuyBudget();
                } else {
                    $this->say('¡Genial! ¿Que tipo de terreno quieres comprar?');
                    $this->askBuyBudget();
                }
            }
        });
    }

    public function askBuyBudget()
    {
        $this->ask('¿Cual es tu presupuesto?', function(Answer $answer) {
            // Save result
            $this->buyBudget = $answer->getText();
            $this->askBuyLocation();
        });
    }

    public function askBuyLocation()
    {
        $this->ask('¿Cual es la locación de la propiedad?', function(Answer $answer) {
            // Save result
            $this->buyLocation = $answer->getText();
            $this->askBuyResources();
        });
    }

    public function askBuyResources()
    {
        $question =Question::create('¿Con recursos propios o credito?')
            ->addButtons([
                Button::create('Recursos propios')->value('propios'),
                Button::create('Credito')->value('credito'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'propios') {
                    $this->askBuyBudget();
                } elseif ($answer->getValue() === 'credito') {
                    $this->askBuyBudget();
                } else {
                    $this->askBuyBudget();
                }

            }
        });
    }

    public function run()
    {
        // This will be called immediately
        $this->askFirstname();
    }
}
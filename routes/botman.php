<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});

$botman->hears('It just works', function($bot) {
    $bot->reply('Yep 🤘');
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');


$palabrasClave = [
    'Hola',
    'hola',
    'Buenos días',
    'buenos días',
    'Buenas tardes',
    'buenas tardes',
    'Buenas noches',
    'buenas noches',
    '¿En qué puedo ayudarte?',
    '¿en qué puedo ayudarte?',
    'Quiero comprar una casa',
    'quiero comprar una casa',
    'Estoy buscando una propiedad',
    'estoy buscando una propiedad',
    'Necesito vender mi casa',
    'necesito vender mi casa',
    '¿Tienen propiedades disponibles?',
    '¿tienen propiedades disponibles?',
    'Información sobre alquiler',
    'información sobre alquiler',
    'Quiero rentar un apartamento',
    'quiero rentar un apartamento',
    '¿Cuáles son los precios?',
    '¿cuáles son los precios?',
    '¿Hay propiedades en venta?',
    '¿hay propiedades en venta?',
    '¿Puedes ayudarme a encontrar un hogar?',
    '¿puedes ayudarme a encontrar un hogar?',
    '¿Cuáles son las opciones de financiamiento?',
    '¿cuáles son las opciones de financiamiento?',
    'Asesoría en bienes raíces',
    'asesoría en bienes raíces',
    '¿Dónde están ubicados?',
    '¿dónde están ubicados?',
    '¿Cuál es su número de contacto?',
    '¿cuál es su número de contacto?',
    '¿Horario de atención?',
    '¿horario de atención?',
    '¿Tienen propiedades en [ciudad o área]?',
    '¿tienen propiedades en [ciudad o área]?',
    '¿Tienen propiedades rurales?',
    '¿tienen propiedades rurales?',
    '¿Cuáles son los servicios que ofrecen?',
    '¿cuáles son los servicios que ofrecen?',
    '¿Pueden ayudarme a invertir en bienes raíces?',
    '¿pueden ayudarme a invertir en bienes raíces?',
    '¿Cuál es el proceso de compra?',
    '¿cuál es el proceso de compra?',
    '¿Pueden tasar mi propiedad?',
    '¿pueden tasar mi propiedad',
];

$botman->hears('(' . implode('|', $palabrasClave) . ')',BotManController::class.'@startConversation');

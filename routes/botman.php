<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

//$botman->hears('Hi', function ($bot) {
//    $bot->reply('Hello!');
//});

//$botman->hears('It just works', function($bot) {
//    $bot->reply('Yep 🤘');
//});

$botman->hears('Start conversation', BotManController::class.'@startConversation');


$palabrasClave = 'Can you tell me more about your business?|can you tell me more about your business?|Hello|Info|Help|hello|info|help|Hi|hi|Hey|hey|Hola|hola|Buenos días|buenos días|Buenos dias|buenos dias|Buenas tardes|buenas tardes|Buenas noches|buenas noches|¿En qué puedo ayudarte?|En que puedo ayudarte?|en que puedo ayudarte?|Quiero comprar una casa|quiero comprar una casa|Estoy buscando una propiedad|estoy buscando una propiedad|Necesito vender mi casa|necesito vender mi casa|¿Tienen propiedades disponibles?|Tienen propiedades disponibles?|tienen propiedades disponibles?|Información sobre alquiler|información sobre alquiler|Quiero rentar un apartamento|quiero rentar un apartamento|¿Cuáles son los precios?|Cuales son los precios?|cuales son los precios?|¿Hay propiedades en venta?|Hay propiedades en venta?|hay propiedades en venta?|¿Puedes ayudarme a encontrar un hogar?|Puedes ayudarme a encontrar un hogar?|puedes ayudarme a encontrar un hogar?|¿Cuáles son las opciones de financiamiento?|Cuales son las opciones de financiamiento?|cuales son las opciones de financiamiento?|Asesoría en bienes raíces|Asesoria en bienes raices|asesoria en bienes raices|¿Dónde están ubicados?|Donde estan ubicados?|donde estan ubicados?|¿Cuál es su número de contacto?|Cual es su numero de contacto?|cual es su numero de contacto?|¿Horario de atención?|Horario de atencion?|horario de atencion?|¿Tienen propiedades en [ciudad o área]?|Tienen propiedades en [ciudad o área]?|tienen propiedades en [ciudad o área]?|¿Tienen propiedades rurales?|Tienen propiedades rurales?|tienen propiedades rurales?|¿Cuáles son los servicios que ofrecen?|Cuales son los servicios que ofrecen?|cuales son los servicios que ofrecen?|¿Pueden ayudarme a invertir en bienes raíces?|Pueden ayudarme a invertir en bienes raices?|pueden ayudarme a invertir en bienes raices?|¿Cuál es el proceso de compra?|Cual es el proceso de compra?|cual es el proceso de compra?|¿Pueden tasar mi propiedad?|Pueden tasar mi propiedad?|pueden tasar mi propiedad?';

$botman->hears('(' . $palabrasClave . ')',BotManController::class.'@startConversation');

$botman->fallback(function($bot) {
    $bot->reply('Lo sentimos, no podemos entender tu mensaje, intenta escribiendo "hola" para iniciar una conversación nueva. :)');
});

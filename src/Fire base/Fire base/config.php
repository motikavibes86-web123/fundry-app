
<?php
include 'config.php';
require_once 'vendor/autoload.php';

use Twilio\Rest\Client;

$client = new Client(TWILIO_SID, TWILIO_TOKEN);

// Tuma SMS
$client->messages->create('+2557xxxxxxx', [
    'from' => TWILIO_FROM,
    'body' => 'Hello, hii ni SMS ya Motika Vibes!'
]);

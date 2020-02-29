<?php

// configure
$from = 'Nouveau message Portfolio ! <>';
$sendTo = 'Nouveau message Portfolio ! <pr.priscilla.roy@gmail.com>'; // Add Your Email
$subject = 'Nouveau message du formulaire de contact';
$fields = array('name' => 'Nom', 'subject' => 'Sujet', 'email' => 'Mail', 'message' => 'Message'); // array variable name => Text to appear in the email
$okMessage = 'Formulaire de contact soumis avec succès. Merci, je vous répondrai très prochainement !';
$errorMessage = 'Une erreur s\'est produite lors de la soumission du formulaire. Veuillez réessayer plus tard.';

// let's do the sending

try
{
    $emailText = "Vous avez un nouveau message du formulaire de contact de :\n=============================\n";

    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );
    
    mail($sendTo, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
    echo $responseArray['message'];
}

<?php

    /** Honey Pot. Si alguno de estos formatos está lleno, un bot los ha utilizado.
     */
    if( !empty($_POST['email']) || 
    !empty($_POST['name']) ||
    !empty($_POST['company']) || 
    !empty($_POST['phone']) ||
    !empty($_POST['correo']) || 
    !empty($_POST['nombre']) ||
    !empty($_POST['empresa']) || 
    !empty($_POST['telefono']) ) {
        die();
    }

    /** Time check. Si el tiempo de llenado de la forma fue de menos de 5 segundos, se considera bot. */
    $clientDate = strtotime( $_POST['timestamp'] );
    $serverDate = strtotime("now");
    $differenceInSeconds = $serverDate - $clientDate;

    if( $differenceInSeconds < 5 ) {
        die();
    }

    if(isset($_POST['submit'])){
        $to ="info@requilibrium.com";
        $from = $_POST['3mai_l'];
        $nombre = $_POST['n_4me'];
        $empresa = $_POST['c_0mpany'];
        $telefono = $_POST['p_h0ne'];

        $subject ="Nuevo Contacto de Re-Equilibrium";
        $subject2 ="Copia del Mensaje enviado a Re-Equilibrium";

        $inputMessage = $_POST['M3_ssage']; 
        /** URL in message. Si el mensaje del usuario incluye una URL, posiblemente un bot lo ha llenado. */
        if( preg_match( '/http|www/i', $inputMessage )) {
            die();
        }

        $message = $nombre .", de empresa:" . $empresa .", escribió:" ."\n\n" . $inputMessage ."\n\n" ."Telefono:" . $telefono;
        $message2 ="Esta es la copia del mensaje enviado," . $name ."\n\n" . $inputMessage;
    
        $headers ="From:" . $from;
        $headers2 ="From:" . $to;
        mail($to,$subject,$message,$headers);
        mail($from,$subject2,$message2,$headers2); // envia una copia al contacto

        $lang = $_POST['lang'];

        if($lang == "es") {
            header('Location: ../gracias.html');
        } else if($lang == "en") {
            header('Location: ../en/thank-you.html');
        }
    }
?>
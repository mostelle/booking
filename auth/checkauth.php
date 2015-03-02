<?php
if (isset($_POST['submitconnex'])){
	if ( empty($_SESSION['login']) ) {
		
		$pwd = $_POST['passwordinput'];
		$mail = $_POST['mailinput'];

	    $clientData = $booking->getPwd($mail,$pwd);

	    if ( $clientData == true ){ 	
		    session_regenerate_id();
		    $_SESSION['login'] = session_id();
		    $userData = $booking->getClient($mail);
		    $valuesCookie = serialize($userData);
		    setcookie("user", $valuesCookie, time()+2629743, null, null, false, true);
		    header("Location: ./reservation.php");
		}else{
			$error = $booking->getError();
		}

	}
}

if (isset($_POST['submitnew'])){
	
	$pwd = $_POST['passwordinputnew'];
	$mail = $_POST['mailinputnew'];
	$name = $_POST['nameinputnew'];

	$createClient = $booking->createClient($name,$mail,$pwd);

	if ( $createClient == true ){
	    session_regenerate_id();
	    $_SESSION['login'] = session_id();
	    $userData = array('mail' => $mail,'name' => $name );
	    $valuesCookie = serialize($userData);
	    setcookie("user", $valuesCookie, time()+2629743);
	    header("Location: ./reservation.php");
	}else{
		$error = $booking->getError();
	}

}

?>
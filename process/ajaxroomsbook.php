<?php
header("Content-Type: text/plain ; charset=utf-8");
//anti Cache pour HTTP/1.1
header("Cache-Control: no-cache , private");
//anti Cache pour HTTP/1.0
header("Pragma: no-cache");
require('../class/bookit.class.php');

  
if (
    isset($_COOKIE['user']) && !empty($_COOKIE['user'])
  ){

  if (isset($_POST['clientid'])){ $clientId = intval($_POST['clientid']); }else{ $clientId=false; }
  if (isset($_POST['selectroom'])){ $roomId = intval($_POST['selectroom']); }else{ $roomId=false; }
  if (isset($_POST['startdate'])){ $startDate = intval($_POST['startdate']); }else{ $startDate=false; }
  if (isset($_POST['enddate'])){ $endDate = intval($_POST['enddate']); }else{ $endDate=false; }

  $booking = new bookit();

  try{
    
    if ($clientId!=false && $roomId!=false && $startDate!=false && $endDate!=false){

      $insertBooking = $booking->insertBooking($clientId,$roomId,$startDate,$endDate);

      if ($insertBooking == true){
        echo "ok";
      }else{
        echo '<p class="alert alert-warning ">Aïe ! Un problème est survenue avec votre réservation ! <strong>Veuillez réessayer svp.</strong></p>';
      }

    }else{
      echo '<p class="alert alert-warning ">Problème de récupération des données !</p>';
    }

  }catch (Exception $e){
    echo '<p class="alert alert-warning ">Un problème est survenue avec votre réservation : ' . $e . '. <br/><strong>Veuillez recommencer svp.</strong></p>';
  }

}else{
  echo '<p class="alert alert-warning ">Veuillez vous identifiez avant de réserver. Merci.</p>';
}

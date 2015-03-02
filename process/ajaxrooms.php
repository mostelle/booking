<?php
header("Content-Type: text/plain ; charset=utf-8");
//anti Cache pour HTTP/1.1
header("Cache-Control: no-cache , private");
//anti Cache pour HTTP/1.0
header("Pragma: no-cache");
require('../class/bookit.class.php');

if (isset($_GET['hotelid'])){ $hotelid = $_GET['hotelid'];}else{ $hotelid=false; }
if (isset($_GET['startdate'])){ $startDate = $_GET['startdate'];}else{ $startDate=false; }
if (isset($_GET['enddate'])){ $endDate = $_GET['enddate'];}else{ $endDate=false; }

$booking = new bookit();
try{
	if ($hotelid!=false && $startDate!=false && $endDate!=false){
		//var_dump($hotelid . ' | ' . $startDate . ' | ' . $endDate);
		$roomsBusy = $booking->isEmpty(intval($hotelid),intval($startDate),intval($endDate));
		$roomsEmpty = $booking->getRoom(intval($hotelid));
		//var_dump($roomsBusy);
		//var_dump($roomsEmpty);
		$html = "<option value=\"0\">-- Sélectionnez une chambre --</option>";
		foreach ($roomsEmpty as $room) {
			if (!in_array($room, $roomsBusy)){
				$html.= '<option value="'.$room["id"].'">' . $room["number"] . '</option>';
			}else{
				$html.= '<option value="'.$room["id"].'" disabled="disabled">' . $room["number"] . '-- non dispo </option>';
			}
		}
		echo $html;
	}else{
		echo "Problème de récupération des données";
	}
}catch(Exception $e){
	echo $e->getMessage();
}
?>
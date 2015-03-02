<?php
session_start();
if ( empty($_SESSION['login']) ){ setcookie('user',''); }
require(  __DIR__  .'/define.php');
require(  __DIR__  .'/../class/bookit.class.php');
require(  __DIR__  .'/../process/processbooking.php');
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Booking Hostel</title>

    <!-- Bootstrap core CSS -->
    <link href="//<? echo _DOCUMENT_URL_ ; ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="//<? echo _DOCUMENT_URL_ ; ?>css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="//<? echo _DOCUMENT_URL_ ; ?>css/theme.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

 
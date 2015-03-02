<?php
session_start();
if (!empty($_SESSION['login'])){ header("Location: ./index.php"); exit();}//pour les petits coquins
require( __DIR__  .'/require/define.php');
require( __DIR__  .'/class/bookit.class.php');
require( __DIR__  .'/process/processbooking.php');
require( __DIR__  .'/assets/lib/password.php');//lib pour hashage du mot de passe
require( __DIR__  .'/auth/checkauth.php');//auth user
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
  </head>
  <body role="document">
 
<?php
require( __DIR__  .'/require/nav.php');
?>

    <div class="container" >
      <div class="row">

<?php if ( isset($error) ){ ?>
        <p class="col-md-12 alert alert-warning"><?php echo $error; ?></p>
<?php } ?>

        <form class="form-horizontal col-md-6" method="post">
          <fieldset>
          <legend class="well well-lg text-center">Vous possédez déjà un compte ?</legend>

          <div class="form-group">
            <label class="col-md-4 control-label" for="mailinput">Adresse Mail</label>  
            <div class="col-md-5">
            <input id="mailinput" name="mailinput" type="email" class="form-control input-md" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="passwordinput">Mot de Passe</label>
            <div class="col-md-5">
              <input id="passwordinput" name="passwordinput" type="password" class="form-control input-md" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="submitconnex"></label>
            <div class="col-md-4">
              <button id="submitconnex" name="submitconnex" class="btn btn-primary">Se Connecter</button>
            </div>
          </div>

          </fieldset>
        </form>

        <form class="form-horizontal col-md-6" method="post">
          <fieldset>
          <legend class="well well-lg text-center">Sinon, créez votre compte :</legend>

          <div class="form-group">
            <label class="col-md-4 control-label" for="nameinputnew">Votre Nom</label>  
            <div class="col-md-5">
            <input id="nameinputnew" name="nameinputnew" type="text" class="form-control input-md" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="mailinputnew">Adresse Mail</label>  
            <div class="col-md-5">
            <input id="mailinputnew" name="mailinputnew" type="email" class="form-control input-md" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="passwordinputnew">Mot de Passe</label>
            <div class="col-md-5">
              <input id="passwordinputnew" name="passwordinputnew" type="password" class="form-control input-md" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="submitnew"></label>
            <div class="col-md-4">
              <button id="submitnew" name="submitnew" class="btn btn-primary">Inscription</button>
            </div>
          </div>

          </fieldset>
        </form>

      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./assets/js/ie10-viewport-bug-workaround.js"></script>

  </body>
</html>

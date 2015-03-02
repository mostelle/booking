<?php
require( __DIR__  .'/require/head.php');
?>
  <body role="document">
<?php
require( __DIR__  .'/require/nav.php');
?>
    <div class="jumbotron" >
      <div class="container" >
        <h1><img src="./css/images/hotel.jpg" class="col-md-4 img-responsive" /><small>Bienvenue sur le site de</small><br/>Will's Hôtel Booking !</h1>
      </div>
      <div class="container" >
        <p>Le meilleur site de booking au monde. Avec un peu d'ajax dedans, histoire de compliquer un peu la donne...</p>
      </div>
    </div>

    <div class="container" >
      <div class="row">
        <div class="col-md-4">
          <h2>Hôtels</h2>
          <p>Chez Will's Hôtel Booking (WHB) on est pas des rigolos. Chez WHB les hôtels sentent le propre et ont des grandes salles de bains.</p>
          <p><a class="btn btn-default" href="./hotels.php" role="button">Liste des Hôtels »</a></p>
        </div>
        <div class="col-md-4">
          <h2>Réservation</h2>
          <p>Réservez en 2 clics grâce à notre super interface révolutionnaire mieux que la concurrence !</p>
          <p><a class="btn btn-default" href="./reservation.php" role="button">Réserver »</a></p>
       </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./assets/js/ie10-viewport-bug-workaround.js"></script>

  </body>
</html>

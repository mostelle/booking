<?php
require( __DIR__  .'/require/head.php');
?>
  </head>
  <body role="document">
<?php
require( __DIR__  .'/require/nav.php');
?>
    <div class="container" role="main">
      
      <div id="content" class="row" >

      <?php 
          if (isset($hostels)){
            ?>
            <div class="col-md-12">
              <h1>Liste des Hôtels :</h1>
            <?php
              $html = '';
              foreach ($hostels as $key => $hostel) {
                $html .= '<div id="hotel_'.$hostel["id"].'" class="col-md-6"><h2>' . $hostel["name"] . '</h2>';
                $html .= '<p>' . $hostel["adresse"] . '</p>';
                $html .= '<p><a class="btn btn-default" href="./reservation.php?hotelnum='.$hostel["id"].'" role="button">Réservez »</a></p></div>';
              }
              echo $html;?>
            </div>
            <?php
          }
      ?>

      </div>

    </div> <!-- /container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./assets/js/ie10-viewport-bug-workaround.js"></script>
    
  </body>
</html>

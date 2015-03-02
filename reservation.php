<?php
require( __DIR__  .'/require/head.php');
?>
    <link rel="stylesheet" href="./css/jquery-ui-bootstrap.css">
  </head>

  <body role="document">

    <?php
    require( __DIR__  .'/require/nav.php');
    ?>

    <div class="container">

    <?php 
      include( __DIR__  .'/require/form.php');
    ?>

    </div> <!-- /container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="./js/datepicker-fr.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./assets/js/ie10-viewport-bug-workaround.js"></script>

    <script src="./js/ajaxcall.js"></script>

    <script>
    jQuery(function($) { /* $(document).ready(...) = conflict */
        $( ".datepicker" ).datepicker();
    });
    </script>
    
  </body>
</html>

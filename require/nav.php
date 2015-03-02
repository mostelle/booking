 <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="//<? echo _DOCUMENT_URL_ ; ?>index.php">Accueil</a></li>
            <li><a href="//<? echo _DOCUMENT_URL_ ; ?>reservation.php">Réservation</a></li>
            <li><a href="//<? echo _DOCUMENT_URL_ ; ?>hotels.php">Hôtels</a></li>
         
          <?php
          if (empty($_SESSION['login'])){ ?>
            <li><a href="//<? echo _DOCUMENT_URL_ ; ?>connex.php">Connexion</a></li>
          <?php }else{ ?>
            <li><a href="//<? echo _DOCUMENT_URL_ ; ?>auth/deconnex.php">Déconnexion</a></li>
          <?php
          }
          ?>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
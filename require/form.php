<?php
if ( isset($_COOKIE['user']) && !empty($_COOKIE['user']) ){
  $dataCookieUser = unserialize($_COOKIE['user']);
}

?>
<form class="form-horizontal" method="post" action="#" id="submitbooking">
  <fieldset>

    <legend class="well well-lg">Réservez votre chambre</legend>

    <div class="form-group">
      <label class="col-md-4 control-label" for="clientmail">eMail</label>  
      <div class="col-md-4">
        <?php
        if (isset($dataCookieUser['mail'])){ ?>
          <input value="<?php echo $dataCookieUser['mail']; ?>" id="clientmail" name="clientmail" type="email" class="form-control input-md" required>
  <?php }else{ ?>
          <input id="clientmail" name="clientmail" type="email" placeholder="adresse mail svp" class="form-control input-md" required>
  <?php
        }
    ?>
      </div>
    </div>

  <?php
    if (isset($dataCookieUser)){
      $clientId = intval($dataCookieUser['id']);
      echo '<input id="clientid" name="clientid" type="hidden" value="'.$clientId.'" required>';
    }
  ?>

    <div class="form-group">
      <label class="col-md-4 control-label" for="clientname">Nom</label>  
      <div class="col-md-4">
        <?php
        if (isset($dataCookieUser['name'])){ ?>
          <input value="<?php echo $dataCookieUser['name']; ?>" id="clientname" name="clientname" type="text" class="form-control input-md" required>
  <?php }else{ ?>
          <input id="clientname" name="clientname" type="text" placeholder="votre nom svp" class="form-control input-md" required>
        <?php } ?>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="selectbasic">Choisissez votre Hôtel</label>
      <div class="controls col-md-4">
        <select id="selecthotel" name="selecthotel" class="form-control">
          <option value="0">-- Sélectionnez un hôtel --</option>
          <?php

              if (isset($_GET['hotelnum'])) {
                $hotelnum = intval($_GET['hotelnum']);
              } 
           
              if (isset($hostels)){
                $html ='';
                foreach ($hostels as $key => $hostel) {
                  $html .= '<option value="'.$hostel["id"].'" ';
                  if (isset($hotelnum) && $hotelnum==$hostel["id"]){ $html .= 'selected="selected" ';}
                  $html .= '>' . $hostel["name"] . '</option>';
                }
                echo $html;
              }
          ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" >Dates du Séjour</label>  
      <div class="col-md-2">
        <input value="<?php if (isset($today)){ echo $booking->dateConvert($today);} ?>" id="startdate" name="startdate" type="text" placeholder="jour d'arrivée" class="datepicker form-control input-md" required>
      </div>
       <div class="col-md-2">
        <input id="enddate" name="enddate" type="text" placeholder="jour du départ" class="datepicker form-control input-md" required>
      </div>
    </div>

    <div class="form-group showroom" style="display:none;">
      <label class="col-md-4 control-label" for="selectroom">Chambre</label>
      <div class="controls col-md-3">
        <?php
        if (isset($msg)){
          echo '<p>' . $msg .'</p>';
        }
        ?>
        <select id="selectroom" name="selectroom" class="form-control"></select>
      </div>
       <div class="col-md-1 submitdiv">
        <button id="submitform" name="submitform" class="btn btn-primary pull-right">OK</button>
      </div>
    </div>  

  </fieldset>
</form>
<div id="okbookit" style="display:none"></div>

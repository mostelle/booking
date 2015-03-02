$( document ).ready(function() {

	function convertTime(date){
		var myDate = date.split("/");
		var newDate = myDate[1]+"/"+myDate[0]+"/"+myDate[2];
		var unixtime = new Date(newDate).getTime()/1000;
		unixtime = unixtime+3600;// GMT+1 /!\ le petit truc qui fausse la requête…
		return unixtime;
	}

	function ajaxRoom(){
 
  		var okbook = $( "#okbookit" );
  		var hostelid =  $( "#selecthotel" ).val();
  		var startdate =  $( "#startdate" ).val();
  		var enddate =  $( "#enddate" ).val();
  		var unixStart = convertTime(startdate);
  		var unixEnd = convertTime(enddate);
  		var divsubmit = $( "div.submitdiv" );
  		var selectroom = $( "#selectroom" );
  		var showroom = $( ".showroom" );

  		okbook.hide();

		if (enddate!=0) {
			if (unixStart<unixEnd) {
		  		
		  		selectroom.empty();

		      	if(hostelid==0){
		      		divsubmit.hide();
		      		selectroom.empty();
					showroom.hide("fast");
				}else{
					divsubmit.hide();
					var request = $.ajax({
					  type: "GET",
					  url: "./process/ajaxrooms.php",
					  data: {	
					  	hotelid: hostelid,
					  	startdate: unixStart,
					  	enddate: unixEnd
					  }
					});
					request.done( function( msg ) {
						showroom.show("fast");
						selectroom.append(msg);
					});
					request.fail( function( jqXHR, textStatus ) {
						alert( "Problème rencontré : " + textStatus );
					});
				}   
			}else{
				divsubmit.hide();
				showroom.hide("fast");
				alert( "La date de départ ne peut être inférieur à la date d'arrivée' !");
			}   
		}else{
			divsubmit.hide();
	      	selectroom.empty();
			showroom.hide("fast");
		} 
	}

	
	/* ----------- */

	$("#submitbooking").submit( function() {
		var okbook = $( "#okbookit" );
		var selectroom = $( "#selectroom" ).val();
  		var clientid =  $( "#clientid" ).val();
  		var startdate =  $( "#startdate" ).val();
  		var enddate =  $( "#enddate" ).val();
  		var unixStart = convertTime(startdate);
  		var unixEnd = convertTime(enddate);

		$.post(
			"./process/ajaxroomsbook.php",
		  	{	
			  	clientid: clientid,
			  	selectroom: selectroom,
			  	startdate: unixStart,
			  	enddate: unixEnd
		  	},
		  	function(data){
		  		if (data!="ok"){
		  			okbook.empty().hide("fast");
					alert( "Problème rencontré !" );
					okbook.show("slow").append(data);
		  		}else{
		  			okbook.empty().hide("fast");
		  			okbook.show("slow").append('<p class="alert alert-success ">Réservation effectuée avec succès !</p>');
		  		}
		  	}
		);
		ajaxRoom();
		return false; // éviter soumission formulaire
	});

	/* ----------- */

	
	var hostelid =  $( "#selecthotel" ).val();
	if (hostelid!=0){ ajaxRoom(); }

	$( "#selecthotel" ).change( function() { ajaxRoom(); } );
	$( "#startdate" ).change( function() { ajaxRoom(); } );
	$( "#enddate" ).change( function() { ajaxRoom(); } );	

    $( "#selectroom" ).change(function() {
    	var okbook = $( "#okbookit" );
    	var roomval =  $( "#selectroom" ).val();
    	var divsubmit = $( "div.submitdiv" );

    	okbook.empty().hide("fast");

    	if (roomval!=0){
    		divsubmit.show("fast");
    	}else{
    		divsubmit.hide("fast");
    	}
    });

});
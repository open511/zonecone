var markerArray = new Array();
var activeMarkers =  new Array();
var map;
var bb;
var directionsService;
var directionsDisplay;

function showContent(div){
	
	var arr = new Array("new-route","my-routes","my-notif", "default");
	var len=arr.length;
	for(var i=0; i<len; i++) {
		if (div == arr[i]){
			$("#" + arr[i]).show();
		} else{
			$("#" + arr[i]).hide();
		}
	}
	
	if (div == "my-routes"){
		ajaxToElement ("/routes", "my-routes", "GET", "insert");
	}
	if (div == "my-notif"){
		ajaxToElement ("/notification", "my-notif", "GET", "insert");
	}	
	if (div == "new-route"){
		$('#save-button').hide();

		//Can't use ajaxToElement here because we want an "on Success" function to be call
	  $.ajax({
	    url: '/routes/new',
	    type: 'GET',
	    error:function(msg){alert( "Error on call /routes/new: " + msg);},
	    success: function(html){
	      myelement = document.getElementById(div);
	      myelement.innerHTML = html;
//TODO ne pas appeler init mais faire une sous fonction pour faire les display utile... sinon ça recharge toute la page...
		  //init(45.52, -73.71, 45.75, -73.09);
		  formSetUp(bb);
		  $('#save-button').show();
	    }
	  });

	
	}	
}

function infoCallback(map, marker, id) { 
	return function() { 
		closeActiveMarkers();
		activeMarkers[id] = 1;
		marker.infowindow.open(map, marker); 
		}; 
}

function closeActiveMarkers () {
	for (i in activeMarkers){
		markerArray[i].infowindow.close();
	}	
	
	activeMarkers = [];
}

function ajaxToElement (url, targetElement, httpType, insertMode){

  $.ajax({
    url: url,
    type: httpType,
    error:function(msg){alert( "Error on call "+ url +": " + msg);},
    success: function(html){
      myelement = document.getElementById(targetElement);
      myelement.innerHTML = html;
//TODO ne pas appeler init mais faire une sous fonction pour faire les display utile... sinon ça recharge toute la page...
			//init(45.52, -73.71, 45.75, -73.09);
					  formSetUp(bb);
    }
  });
}


function displayRwOnMap(map){

   $.getJSON(jsonUrl,"",
  function(data) {

	for (i in data){
		var pointArray = [];

		for (j in data[i]["coordinates"]){
			var splited = data[i]["coordinates"][j].split(" ");
			var points = new google.maps.LatLng(splited[1], splited[0]);
			pointArray.push(points);
		}
		
		var severity = 2;
		if (data[i]["is_active"] == true){
			if (data[i]["severity"] < 4 || data[i]["severity"] > 0){
				severity = data[i]["severity"];
			}
		}else{
			
			severity = 9;
		}
		
		
		//Display a marker for the first point available
	   markerArray[data[i]["id"]] = new google.maps.Marker({
   	     position: pointArray[0], 
         map: map,
         icon: "/images/cone-small-"+ severity +".png" });

       infoWindowContent = "<div class='infowindow'>"
       infoWindowContent = "<div class='infoicon'><img src='/images/cone-med-"+ severity +".png' alt='cone'/></div>";
       infoWindowContent += "<p><b>";
       if (data[i]["is_active"] == false){
	     infoWindowContent +=  "[Inactif] ";
        }
       infoWindowContent +=  data[i]["name"] + "</b></p>";
       infoWindowContent += "<p>("+ data[i]["startDate"] +" - "+ data[i]["endDate"] +")";
       infoWindowContent += " - <a href='/rw/"+ data[i]["id"] +"'>[plus]</a></p>";
       infoWindowContent += "</div>";

//Not clean not to use "url_for" to go to the rw URL

	   markerArray[data[i]["id"]].infowindow = new google.maps.InfoWindow({
         content: infoWindowContent,
		     maxWidth: "300"
       });

       google.maps.event.addListener(
	     markerArray[data[i]["id"]], 
	     'click', 
	     infoCallback(map, markerArray[data[i]["id"]], [data[i]["id"]]));

         //If variable rwToDisplay is set, it means that the infoWindow for that rw has to be opened
         if (data[i]["id"] == rwToDisplay){
           showMarker(rwToDisplay);	
         }

  		
  		//If many points, then draw a line
		if (pointArray.length > 1){		
  			var rwLine = new google.maps.Polyline({
    			path: pointArray,
    			strokeColor: "#FF0000",
    			strokeOpacity: 0.5,
    			strokeWeight: 6
  			});

  			rwLine.setMap(map);
		}
    }
  
  });

}

	
function computeRouteFromGoogle (result) {

		//Retrieve and format the path. Target format is "long1 lat1, long2 lat2, ..."
		var fullString = "";
	  	var myRoute = result.routes[0].overview_path;

	  	for (var i = 0; i < myRoute.length; i++) {
			var exploded = (myRoute[i] + ",").split(",");
			fullString +=  exploded[1].replace(")", "").substring(1, 11) + " " + exploded[0].replace("(", "").substring(0, 10) + ",";
     }

	  fullString = fullString.replace(")", "");
	  fullString = fullString.replace("(", "");
	  
	  //Set the value of an hidden form field to be sent to the server.
	  var postValue = document.getElementById('rw_user_route_geom');
	  postValue.value = "LINESTRING(" + fullString.substring(0, fullString.length - 2) + ")";

	  getRwNearRoute(postValue.value);

}  

function getRwNearRoute (geom) {
	
  $.ajax({
    type: "POST",
    url: "/near",
    data: ({geom : geom}),
    error:function(msg){alert( "Error !: " + msg);},
    success: function(html){
      //$("#panels").append(html);
      //$("#variable").replaceWith(html);
      document.getElementById('near').innerHTML = html;
    }
  });	
	
} 

function showMarker (markerId) {

	if (map.getZoom() <= 13) {
	  map.setZoom(13);
	}
	
	google.maps.event.trigger(markerArray[markerId], 'click');
}


function formSetUp(bb){

    var geocoder = new google.maps.Geocoder();
    var autocomplete = {
 
      //This bit uses the geocoder to fetch address values
      source: function(request, response) {
          geocoder.geocode( {'address': request.term, 'bounds': bb }, function(results, status) {
          response($.map(results, function(item) {
            return {
              label: item.formatted_address,
              value: item.formatted_address
            }
          }));
	  })},
    }
	
	    $("#rw_user_route_start_point_name").autocomplete(autocomplete);
	    $("#rw_user_route_end_point_name").autocomplete(autocomplete);    

	    $("#plan-button").button();
	    $("#save-button").button();
	    $("#save-button").attr('disabled', 'disabled');

	    $("#plan-button").click(function() {
		  $('#error-widget').hide();
		  $('#rw_user_route_start_point_name').blur();
		  $('#rw_user_route_end_point_name').blur();


		  var oldPlanButtonVal = $("#plan-button").val();

		  $("#plan-button").attr('disabled', 'disabled');
		  $("#plan-button").val("Working...");

		  var request = {
	            origin: $("#rw_user_route_start_point_name").val(),
	            destination: $("#rw_user_route_end_point_name").val(),
	            travelMode: google.maps.DirectionsTravelMode.DRIVING
		  };

		  directionsService.route(request, function(response, status) {
		    $("#plan-button").removeAttr('disabled');
		    $("#plan-button").val(oldPlanButtonVal);

		    if (status == google.maps.DirectionsStatus.OK) {
			  directionsDisplay.setDirections(response);
		    } else {
			  $('#error-widget').show();
			  console.log("Error processing directions!");
		    }
		  });

		  $("#save-button").removeAttr('disabled');

		return false;
	    });

	/*    $("#reverse-button").button({
		text: false, 
		icons: {
		    primary: 'ui-icon-shuffle'
		}
	    }).click(function() {
		var fromval = $("#rw_user_route_start_point_name").val();
		$("#rw_user_route_start_point_name").val($("#rw_user_route_end_point_name").val());
		$("#rw_user_route_end_point_name").val(fromval);
	    });*/
}

function init(minLat, minLon, maxLat, maxLon) {
  //alert("Dans le init");  
  //ajaxToElement ("showform", "#signup", "GET", "APPEND");


  var rendererOptions = {
    draggable: true
  };

    bb = new google.maps.LatLngBounds(new google.maps.LatLng(minLat, minLon),
					  new google.maps.LatLng(maxLat, maxLon));

    map = new google.maps.Map(document.getElementById("map_canvas"), 
    { 
      zoom: 6, 
      mapTypeId: google.maps.MapTypeId.TERRAIN,
      center: bb.getCenter() });

    directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
    directionsDisplay.setMap(map);
    directionsService = new google.maps.DirectionsService();
    



    google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
      computeRouteFromGoogle(directionsDisplay.directions);
    });
   
    $('body').layout({ defaults: { spacing_open: 0 },
                       applyDefaultStyles: true,
                       west: { size: 400 },
                       north: { innerHeight: 30 },
                       center: { onresize_end: function () { google.maps.event.trigger(map, "resize"); } } });
    map.fitBounds(bb);
    formSetUp(bb);
    var placeService = new google.maps.places.PlacesService(map);




    
    displayRwOnMap(map);
    //if (isAuthenticated){ajaxToElement ("routes", "#variable", "GET", "APPEND");}

//TODO : Mettre la prepa du formulaire dans une autre fonction qui pourrait être appel quand on fait un showContent('new-route')


}

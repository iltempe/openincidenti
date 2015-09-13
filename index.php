<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>OpenIncidenti Map</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="La mappa degli incidenti fatta da chi li vede" />
    <meta name="keywords" content="leaflet, users, map, javascript, cloudmade" />
    <meta name="author" content="Pratosmart - http://www.pratosmart.org" />

    <!-- Le styles -->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Norican">
    <link type="text/css" rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="assets/leaflet/leaflet.css" />
    <!--[if lte IE 8]><link type="text/css" rel="stylesheet" href="assets/leaflet/leaflet.ie.css" /><![endif]-->
    <link type="text/css" rel="stylesheet" href="assets/leaflet/plugins/leaflet.markercluster/MarkerCluster.css" />
    <link type="text/css" rel="stylesheet" href="assets/leaflet/plugins/leaflet.markercluster/MarkerCluster.Default.css" />
    <style type="text/css">
      html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
        position: absolute;
        overflow:hidden;
      }
      #map {
        margin-top:40px;
        width:100%;
        height:100%;
      }
      #loading {
        position: absolute;
        width: 220px;
        height: 19px;
        top: 50%;
        left: 50%;
        margin: -10px 0 0 -110px;
        z-index: 20001;
      }
      #loading .loading-indicator {
        height: auto;
        margin: 0;
      }
      .navbar .brand {
        font-size: 25px;
        font-family: 'Norican', serif;
        font-weight: bold;
        color: white;
      }
      .navbar .nav > li > a {
        padding: 13px 10px 11px;
      }
      .navbar .btn, .navbar .btn-group {
        margin-top: 8px;
      }
      .leaflet-popup-content-wrapper, .leaflet-popup-tip {
        background: #f7f7f7;
      }
      .leaflet-control-geoloc {
        background-image: url(img/location.png);
        -webkit-border-radius: 5px 5px 5px 5px;
        border-radius: 5px 5px 5px 5px;
      }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script type="text/javascript">
      WebFontConfig = {
        google: {
            families: ['Norican::latin']
        }
      };
      (function () {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      })();
      </script>
    <![endif]-->
	  	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-47062888-1', 'teo-soft.com');
  ga('send', 'pageview');

	</script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#" onclick="return false;">OpenIncidenti</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="#" onclick="$('#aboutModal').modal('show'); return false;"><i class="icon-question-sign icon-white"></i>Aiuto</a></li>
              <li><a href="#" onclick="$('#contactModal').modal('show'); return false;"><i class="icon-envelope icon-white"></i>Contatti</a></li>
            </ul>
            <form class="navbar-form pull-right">
               <span><a class='btn btn-primary btn-small' data-toggle="modal" href="#addmeModal"><i class="icon-plus-sign icon-white"></i> Aggiungi incidente</a></span>
               <span><a class='btn btn-danger btn-small' data-toggle="modal" href="#removemeModal"><i class="icon-minus-sign icon-white"></i> Rimuovi incidente</a></span>
               <span><a class='btn btn-success btn-small' data-toggle="modal" href="#csvModal"><i class="icon-download icon-white"></i> Scarica archivio incidenti</a></span>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal hide fade" id="aboutModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Benvenuto sulla mappa OpenIncidenti</h3>
      </div>
      <div class="modal-body">
        <h3>OpenIncindenti Map</h3>
          <p>
            La mappa si pone l'obiettivo di raccogliere dati su incidenti stradali in Italia e si basa su dati aperti. La mappa non ha lo scopo di segnalare gli incidenti, quanto piuttosto di raccogliere indicazioni su essi perchè i dati possano essere di tutti.
          </p>
          <p>Se avvisti un incidente mappalo.</p> 
		  <p>Diffondi l'iniziativa con #openincidenti.</p>
		  <p>Tutti i dati aggiornati sono disponibili in formato <a href="http://www.sqlite.org/" target="_blank">Sqlite</a> tramite <a href="http://teo-soft.com/openincidenti/leaflet.sqlite" target="_blank">questo link</a></p>
        <h3>Chi siamo</h3>
        <p>L'applicazione è creata da <a href="http://www.pratosmart.org/" target="_blank">Pratosmart</a> nel Settembre 2014 su idea di <a href= "http://twitter.com/flavia_marzano" target="_blank">Flavia Marzano </a> </p>
          <p>Il progetto è ispirato a <a href="http://users.leafletjs.com/" target="_blank">Leaflet Users Map</a>.</p>
      </div>
    </div>

    <div class="modal hide fade" id="contactModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Contatti</h3>
      </div>
      <div class="modal-body">
        <p><strong>Email:</strong> <a href="mailto:pratosmart@gmail.com">pratosmart@gmail.com</a></p>
        <p><strong>Twitter:</strong> <a href="https://twitter.com/#!/pratosmart">@pratosmart</a></p>
		 <p><strong>Twitter:</strong> <a href="https://twitter.com/flavia_marzano">@flavia_marzano</a></p>
        <p><strong>Website</strong> <a href="http://www.pratosmart.org">pratosmart.org</a></p>
		  <p><strong>Website</strong> <a href="http://about.me/flaviamarzano">about.me/flaviamarzano</a></p>	  
      </div>
    </div>

    <div class="modal hide fade" id="addmeModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Aggiungi un incidente</h3>
      </div>
      <div class="modal-body">
        <p>Fai click su OK per iniziare</p>
        <p>Naviga sulla locazione desiderata e clicca sulla mappa per porre un indicatore e registrare un incidente. Inserendo i dati accetti</p>
      </div>
      <div class="modal-footer">
        <a href="#" onclick="$('#addmeModal').modal('hide'); initRegistration(); return false;"class="btn btn-primary">OK</a>
      </div>
    </div>

    <div class="modal hide fade" id="insertSuccessModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Fatto!</h3>
      </div>
      <div class="modal-body">
        <p>Grazie per aver contribuito alla mappa OpenIncidenti!</p>
        <p>Dovresti ricevere a breve email contenente un codice da usare per poter rimuovere l'incidente inserito nel caso ti accorgessi di aver sbagliato</p>
      </div>
    </div>

    <div class="modal hide fade" id="removemeModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Rimuovi</h3>
      </div>
      <div class="modal-body">
        <form class="well">
          <label>Email</label>
          <input type="text" class="span3" name="email_remove" id="email_remove">
          <label>Codice</label>
          <input type="password" class="span3" name="token_remove" id="token_remove"><br>
          <button type="button" class="btn btn-primary" onclick="removeUser();">OK</button>
        </form>
      </div>
    </div>

    <div class="modal hide fade" id="removeSuccessModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Sei stato rimosso</h3>
      </div>
      <div class="modal-body">
        <p>Hai rimosso un incidente da OpenIncidenti</p>
        <p>Grazie per il tuo interesse e torna non appena hai nuovi incidenti da segnalare.</p>
      </div>
    </div>
    <div id="map"></div>
    <div id="loading-mask" class="modal-backdrop" style="display:none;"></div>
    <div id="loading" style="display:none;">
        <div class="loading-indicator">
            <img src="img/ajax-loader.gif">
        </div>
    </div>
	
	
	  <div class="modal hide fade" id="csvModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Scarica Archivio Incidenti</h3>
      </div>
      <div class="modal-body">
        <p>Fai click su OK per effettuare il download del database degli incidenti.</p>
        <p>Tutti i dati aggiornati sono disponibili in formato <a href="http://www.sqlite.org/" target="_blank">Sqlite</a> E' in progress l'esportazione in formato CSV.</p>
      </div>
      <div class="modal-footer">
		<a href="leaflet.sqlite" target="_blank">OK</a>
      </div>
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/leaflet/leaflet.js"></script>
    <script type="text/javascript" src="assets/leaflet/plugins/leaflet.markercluster/leaflet.markercluster.js"></script>

    <script type="text/javascript">
      var map, newUser, users, mapquest, firstLoad;

      firstLoad = true;

      //users = new L.FeatureGroup();
      users = new L.MarkerClusterGroup({spiderfyOnMaxZoom: true, showCoverageOnHover: false, zoomToBoundsOnClick: true});
      newUser = new L.LayerGroup();

      mapquest = new L.TileLayer("http://{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png", {
        maxZoom: 18,
        subdomains: ["otile1", "otile2", "otile3", "otile4"],
        attribution: 'Basemap tiles courtesy of <a href="http://www.mapquest.com/" target="_blank">MapQuest</a> <img src="http://developer.mapquest.com/content/osm/mq_logo.png">. Map data (c) <a href="http://www.openstreetmap.org/" target="_blank">OpenStreetMap</a> contributors, CC-BY-SA.'
      });

      map = new L.Map('map', {
        center: new L.LatLng(42.212, 11.646),
        zoom: 6,
        layers: [mapquest, users, newUser]
      });

      // GeoLocation Control
      function geoLocate() {
        map.locate({setView: true, maxZoom: 17});
      }
      var geolocControl = new L.control({
        position: 'topright'
      });
      geolocControl.onAdd = function (map) {
        var div = L.DomUtil.create('div', 'leaflet-control-zoom leaflet-control');
        div.innerHTML = '<a class="leaflet-control-geoloc" href="#" onclick="geoLocate(); return false;" title="My location"></a>';
        return div;
      };
      
      map.addControl(geolocControl);
      map.addControl(new L.Control.Scale());

      //map.locate({setView: true, maxZoom: 3});

      $(document).ready(function() {
        $.ajaxSetup({cache:false});
        $('#map').css('height', ($(window).height() - 40));
        getUsers();
      });

      $(window).resize(function () {
        $('#map').css('height', ($(window).height() - 40));
      }).resize();

      function geoLocate() {
        map.locate({setView: true, maxZoom: 17});
      }

      function initRegistration() {
        map.addEventListener('click', onMapClick);
        $('#map').css('cursor', 'crosshair');
        return false;
      }

      function cancelRegistration() {
        newUser.clearLayers();
        $('#map').css('cursor', '');
        map.removeEventListener('click', onMapClick);
      }

      function getUsers() {
        $.getJSON("get_users.php", function (data) {
          for (var i = 0; i < data.length; i++) {
            var location = new L.LatLng(data[i].lat, data[i].lng);
            var date = data[i].date;
            var note = data[i].note;
            var n_pedoni = data[i].n_pedoni;
            var n_bici = data[i].n_bici;
            var n_moto = data[i].n_moto;
            var n_auto = data[i].n_auto;
            var n_altri = data[i].n_altri;

            var title = "<div style='font-size: 18px; color: #0078A8;'>"+ data[i].date +"</div>";
            
            if (data[i].note.length > 0) {
              var note = "<div style='font-size: 14px;'>"+ data[i].note +"</div>";
            }
            else {
              var note = "";
            }
            if (data[i].n_pedoni > 0) {
              var n_pedoni = "<div style='font-size: 14px;'>"+ "Pedoni: " + data[i].n_pedoni +"</div>";
            }
            else {
              var n_pedoni = "";
            }
            if (data[i].n_bici > 0) {
              var n_bici = "<div style='font-size: 14px;'>"+ "Biciclette: " + data[i].n_bici +"</div>";
            }
            else {
              var n_bici = "";
            }
            if (data[i].n_moto > 0) {
              var n_moto = "<div style='font-size: 14px;'>"+ "Motocicli: " + data[i].n_moto +"</div>";
            }
            else {
              var n_moto = "";
            }
            if (data[i].n_auto > 0) {
              var n_auto = "<div style='font-size: 14px;'>"+ "Automezzi: " + data[i].n_auto +"</div>";
            }
            else {
              var n_auto = "";
            }
            if (data[i].n_altri > 0) {
              var n_altri = "<div style='font-size: 14px;'>"+ "Altri mezzi: " + data[i].n_altri +"</div>";
            }
            else {
              var n_altri = "";
            }
            
            var marker = new L.Marker(location, {
              title: date
            });
            marker.bindPopup("<div style='text-align: center; margin-left: auto; margin-right: auto;'>"+ "Incidente del " + title + n_pedoni + n_bici + n_moto + n_auto + n_altri + note +"</div>", {maxWidth: '400'});
            users.addLayer(marker);
          }
        }).complete(function() {
          if (firstLoad == true) {
            map.fitBounds(users.getBounds());
            firstLoad = false;
          };
        });
      }

      function insertUser() {
        $("#loading-mask").show();
        $("#loading").show();
        var date = $("#date").val();
        var email = $("#email").val();
		var n_pedoni = $("#n_pedoni").val();
		var n_bici = $("#n_bici").val();
		var n_moto = $("#n_moto").val();
		var n_auto = $("#n_auto").val();
		var n_altri = $("#n_altri").val();
        var note = $("#note").val();
        var lat = $("#lat").val();
        var lng = $("#lng").val();
        
        if (date.length == 0) {
          alert("Inserire data!");
        	$("#loading-mask").hide();
            $("#loading").hide();
          return false;
        }
        
        if (email.length == 0) {
          alert("Inserire Email!");
            $("#loading-mask").hide();
            $("#loading").hide();
          return false;
        }
		
		if(validate_email(email)==false)
		{
			alert("Inserire Email Corretta");
			$("#loading-mask").hide();
            $("#loading").hide();
			return false;
		}
		
		// other validation field
		if(validatedate(date)==false)
		{
		  alert("Formato data errato!");
			$("#loading-mask").hide();
            $("#loading").hide();
          return false;
		}
		
		if(validate_num(n_pedoni)==false || validate_num(n_bici)==false || validate_num(n_moto)==false || validate_num(n_auto)==false || validate_num(n_altri)==false)
		{
		  alert("Inserire solo numeri nei campi dei mezzi coinvolti");
		    $("#loading-mask").hide();
            $("#loading").hide();
          return false;
		}
		
        var dataString = 'date='+ date + '&email=' + email + '&n_pedoni=' + n_pedoni + '&n_bici=' + n_bici + '&n_moto=' + n_moto + '&n_auto=' + n_auto + '&n_altri=' + n_altri + '&note=' + note+ '&lat=' + lat + '&lng=' + lng;
        $.ajax({
          type: "POST",
          url: "insert_user.php",
          data: dataString,
          success: function() {
            cancelRegistration();
            users.clearLayers();
            getUsers();
            $("#loading-mask").hide();
            $("#loading").hide();
            $('#insertSuccessModal').modal('show');
          }
        });
        return false;
      }

      function removeUser() {
        var email = $("#email_remove").val();
        var token = $("#token_remove").val();
        if (email.length == 0) {
          alert("Inserire Email");
          return false;
        }
        if (token.length == 0) {
          alert("Inserire Token!");
          return false;
        }
        var dataString = 'email='+ email + '&token=' + token;
        $.ajax({
          type: "POST",
          url: "remove_user.php",
          data: dataString,
          success: function(data) {
            //console.log(data);
            if (data > 0) {
              $('#removemeModal').modal('hide');
              users.clearLayers();
              getUsers();
              $('#removeSuccessModal').modal('show');
            }
            else {
              alert("Email o token non corretti. Perfavore riprova.");
            }
          }
        });
        return false;
      }

      function onMapClick(e) {
        var markerLocation = new L.LatLng(e.latlng.lat, e.latlng.lng);
        var marker = new L.Marker(markerLocation);
        newUser.clearLayers();
        newUser.addLayer(marker);
        var form =  '<form id="inputform" enctype="multipart/form-data" class="well">'+
              '<label><strong>Data:</strong> <i>(gg/mm/aaaa)</i></label>'+
              '<input type="text" class="span3" placeholder="Richiesta" id="date" name="date" />'+
              '<label><strong>Email:</strong></label>'+
              '<input type="text" class="span3" placeholder="Richiesta" id="email" name="email" />'+
              '<label><strong>N° Pedoni coinvolti:</strong></label>'+
              '<input type="text" class="span3" placeholder="Se nessuno inserire 0" id="n_pedoni" name="n_pedoni" value="0" />'+
			  '<label><strong>N° Biciclette coinvolte:</strong></label>'+
              '<input type="text" class="span3" placeholder="Se nessuno inserire 0" id="n_bici" name="n_bici" value="0" />'+
			  '<label><strong>N° Motocicli coinvolti:</strong></label>'+
              '<input type="text" class="span3" placeholder="Se nessuno inserire 0" id="n_moto" name="n_moto" value="0" />'+
			  '<label><strong>N° Automezzi coinvolti:</strong></label>'+
              '<input type="text" class="span3" placeholder="Se nessuno inserire 0" id="n_auto" name="n_auto" value="0" />'+
			  '<label><strong>N° Altri mezzi coinvolti:</strong></label>'+
              '<input type="text" class="span3" placeholder="Se nessuno inserire 0" id="n_altri" name="n_altri" value="0" />'+
			  '<label><strong>Note:</strong></label>'+
              '<input type="text" class="span3" placeholder="Opzionale" id="note" name="note" />'+
              '<input style="display: none;" type="text" id="lat" name="lat" value="'+e.latlng.lat.toFixed(6)+'" />'+
              '<input style="display: none;" type="text" id="lng" name="lng" value="'+e.latlng.lng.toFixed(6)+'" /><br><br>'+
              '<div class="row-fluid">'+
                '<div class="span6" style="text-align:center;"><button type="button" class="btn" onclick="cancelRegistration()">Cancel</button></div>'+
                '<div class="span6" style="text-align:center;"><button type="button" class="btn btn-primary" onclick="insertUser()">Submit</button></div>'+
              '</div>'+
              '</form>';
        marker.bindPopup(form).openPopup();	
      }
	   
	   //controlla se la data è gg/mm/aaaa oppure gg-mm-aaaa
		function validatedate(inputText)  
		  {  

			var allowBlank = true;
    var minYear = 1902;
    var maxYear = (new Date()).getFullYear();

    var errorMsg = "";

    // regular expression to match required date format
    re = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;

    if(inputText.value != '') {
      if(regs = inputText.match(re)) {
        if(regs[1] < 1 || regs[1] > 31) {
          errorMsg = "Invalid value for day: " + regs[1];
        } else if(regs[2] < 1 || regs[2] > 12) {
          errorMsg = "Invalid value for month: " + regs[2];
        } else if(regs[3] < minYear || regs[3] > maxYear) {
          errorMsg = "Invalid value for year: " + regs[3] + " - must be between " + minYear + " and " + maxYear;
        }
      } else {
        errorMsg = "Invalid date format: " + inputText.value;
      }
    } else if(!allowBlank) {
      errorMsg = "Empty date not allowed!";
    }

    if(errorMsg != "") {
      //alert(errorMsg);
      //field.focus();
      return false;
    }

    return true;
}  
		
	//testa se una stringa contiene solo numeri	
	function validate_num(inputtxt)  
   {  
      var numbers = /^[0-9]+$/;
      if  (inputtxt.length>0)
      {
      	if(inputtxt.match(numbers))  
      	{  
      		//alert('Your Registration number has accepted....');  
      		//document.form1.text1.focus();  
      		return true;  
      	}  
      	else  
      	{  
      		//alert('Please input numeric characters only');  
      		//document.form1.text1.focus();  
      		return false;  
      	}
      }  
   }
	//testa se una stringa è una mail
	function validate_email(email) { 
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}    

	   
    </script>

  </body>
</html>

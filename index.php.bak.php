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
              <li><a href="#" onclick="$('#contactModal').modal('show'); return false;"><i class="icon-envelope icon-white"></i> Contattami</a></li>
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
            La mappa si pone l'obiettivo di raccogliere dati aperti su incidenti stradali in Italia e si basa su dati aperti. La mappa non ha lo scopo di segnalare gli incidenti, quanto piuttosto di raccogliere indicazioni su essi perchè i dati possano essere di tutti.
          </p>
          <p>Se avvisti un incidente mappalo. Diffondi l'iniziativa con #openincidenti</p>
        <h3>Chi sono</h3>
          <p>L'applicazione è creata da Pratosmart <a href="http://www.pratosmart.org/" target="_blank"></a> nel Settembre 2014. </p>
        <h3>Ispirazione</h3>
          <p>Il progetto è ispirato a <a href="http://users.leafletjs.com/" target="_blank">Leaflet Users Map</a>.</p>
      </div>
    </div>

    <div class="modal hide fade" id="contactModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Contattami</h3>
      </div>
      <div class="modal-body">
        <p><strong>Email:</strong> <a href="mailto:pratosmart@gmail.com">pratosmart@gmail.com</a></p>
        <p><strong>Twitter:</strong> <a href="https://twitter.com/#!/pratosmart">@pratosmart</a></p>
        <p><strong>Website</strong> <a href="http://www.pratosmart.org">pratosmart.org</a></p>
      </div>
    </div>

    <div class="modal hide fade" id="addmeModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Aggiungi un incidente</h3>
      </div>
      <div class="modal-body">
        <p>Fai click su OK per iniziare</p>
        <p>Naviga sulla tua locazione desiderata e clicca sulla mappa per porre un indicatore e segnalare i tuoi dati.</p>
      </div>
      <div class="modal-footer">
        <a href="#" onclick="$('#addmeModal').modal('hide'); initRegistration(); return false;"class="btn btn-primary">Go!</a>
      </div>
    </div>

    <div class="modal hide fade" id="insertSuccessModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Fatto!</h3>
      </div>
      <div class="modal-body">
        <p>Grazie per aver contribuito alla mappa OpenIncidenti!</p>
        <p>Tu dovresti ricevere a breve un email con un'indicazione su come poter rimuovere i dati inseriti.</p>
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
          <label>Token</label>
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
        <p>Tu sei stato rimosso da OpenIncidenti</p>
        <p>Grazie per il tuo interesse e torna a trovarci appena hai nuovi dati da segnalare.</p>
      </div>
    </div>
    <div id="map"></div>
    <div id="loading-mask" class="modal-backdrop" style="display:none;"></div>
    <div id="loading" style="display:none;">
        <div class="loading-indicator">
            <img src="img/ajax-loader.gif">
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
            var name = data[i].name;
            var website = data[i].website;
            if (data[i].website.length > 7) {
              var title = "<div style='font-size: 18px; color: #0078A8;'><a href='"+ data[i].website +"' target='_blank'>"+ data[i].name + "</a></div>";
            }
            else {
              var title = "<div style='font-size: 18px; color: #0078A8;'>"+ data[i].name +"</div>";
            }
            if (data[i].city.length > 0) {
              var city = "<div style='font-size: 14px;'>"+ data[i].city +"</div>";
            }
            else {
              var city = "";
            }
            var marker = new L.Marker(location, {
              title: name
            });
            marker.bindPopup("<div style='text-align: center; margin-left: auto; margin-right: auto;'>"+ title + city +"</div>", {maxWidth: '400'});
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
        var name = $("#name").val();
        var email = $("#email").val();
        var website = $("#website").val();
        var city = $("#city").val();
        var lat = $("#lat").val();
        var lng = $("#lng").val();
        if (name.length == 0) {
          alert("Name is required!");
          return false;
        }
        if (email.length == 0) {
          alert("Email is required!");
          return false;
        }
        var dataString = 'name='+ name + '&email=' + email + '&website=' + website + '&city=' + city + '&lat=' + lat + '&lng=' + lng;
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
          alert("Email is required!");
          return false;
        }
        if (token.length == 0) {
          alert("Token is required!");
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
              alert("Incorrect email or token. Please try again.");
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
              '<label><strong>Name:</strong> <i>marker title</i></label>'+
              '<input type="text" class="span3" placeholder="Required" id="name" name="name" />'+
              '<label><strong>Email:</strong> <i>never shared</i></label>'+
              '<input type="text" class="span3" placeholder="Required" id="email" name="email" />'+
              '<label><strong>City:</strong></label>'+
              '<input type="text" class="span3" placeholder="Optional" id="city" name="city" />'+
              '<label><strong>Website:</strong></label>'+
              '<input type="text" class="span3" placeholder="Optional" id="website" name="website" value="http://" />'+
              '<input style="display: none;" type="text" id="lat" name="lat" value="'+e.latlng.lat.toFixed(6)+'" />'+
              '<input style="display: none;" type="text" id="lng" name="lng" value="'+e.latlng.lng.toFixed(6)+'" /><br><br>'+
              '<div class="row-fluid">'+
                '<div class="span6" style="text-align:center;"><button type="button" class="btn" onclick="cancelRegistration()">Cancel</button></div>'+
                '<div class="span6" style="text-align:center;"><button type="button" class="btn btn-primary" onclick="insertUser()">Submit</button></div>'+
              '</div>'+
              '</form>';
        marker.bindPopup(form).openPopup();
      }
    </script>

  </body>
</html>

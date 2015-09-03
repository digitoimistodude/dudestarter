$ = jQuery;

var dude = dude || {};

dude.Global = {

    $window: $(window),

    $header : $('section.interior-content header.fade, section.banner'),
    $headerContent : null,
    headerImg : null,
    WindowHeight: null,
    IsMobile: false,
    IsTouch : false,
    IsIE: false,

  Init: function () {

        dude.Global.WindowHeight = window.innerHeight ? window.innerHeight : dude.Global.$window.height();
        dude.Global.WindowWidth = window.innerWidth ? window.innerWidth : dude.Global.$window.width();
        dude.Global.$window.on( "scroll" , dude.Global.Scroll );
        dude.Global.$window.on( "resize", _.debounce(dude.Global.Resize, 100));

        dude.Global.CheckIsTouch();
        dude.Global.CheckIsMobile();
        dude.Global.CheckIsIE();

    },

    Resize: function() {

        dude.Global.WindowHeight =  window.innerHeight ? window.innerHeight : dude.Global.$window.height();
        dude.Global.WindowWidth = window.innerWidth ? window.innerWidth : dude.Global.$window.width();
        dude.Global.SizeHeader();
        dude.Global.CheckIsMobile();

    },

    CheckIsMobile: function() {

        var navLIDisplay = $("nav .nav-bar li").css("display");

        if (navLIDisplay == "block") {

            dude.Global.IsMobile = true;

        }
        else {

            dude.Global.IsMobile = false;

        }

    },

    CheckIsTouch : function(){

            //
            // Check for touch supported device
            dude.Global.IsTouch = 'ontouchstart' in document.documentElement;

            //
            // Apply global class for touch styling
            if(dude.Global.IsTouch){
                $('body').addClass('touchdevice');
            }

    },

    CheckIsIE: function() {


      if ($.browser.msie && $.browser.version < 10.0) {

          dude.Global.IsIE = true;

      }

    }
    
};


$(function() {

dude.Map = {

    $Holder: $('#map'),

    isLoaded: false,

    isInitiated: false,

    Marker: false,

    GoogleMap: null,


    MapOptions: {
        zoom: 15,
        disableDefaultUI: true,
        panControl: false,
        scrollwheel: false,
        zoomControl: true,
        streetViewControl: false,
        navigationControl: false,
        scaleControl: false,
        draggable: true, 
        mapTypeControl: false,
        navigationControl: true,

        styles: [{
            elementType: "geometry.fill",
            stylers: [{
                color: "#666666"
            }]
        }, {
            featureType: "landscape",
            elementType: "geometry.fill",
            stylers: [{
                visibility: "on"
            }, {
                color: "#f0f0f0"
            }]
        }, {
            featureType: "poi",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "administrative.country",
            elementType: "labels.text.fill",
            stylers: [{
                color: "#ffffff"
            }, {
                weight: 2
            }, {
                visibility: "off"
            }]
        }, {
            featureType: "administrative.province",
            elementType: "labels.text.fill",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "administrative.locality",
            elementType: "labels.icon",
            stylers: [{
                color: "#ffffff"
            }, {
                lightness: 100
            }, {
                visibility: "simplified"
            }]
        }, {
            featureType: "administrative.locality",
            elementType: "labels.text.fill",
            stylers: [{
                visibility: "on"
            }, {
                color: "#00ACEC"
            }]
        }, {
            featureType: "administrative.locality",
            elementType: "labels.text.stroke",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "road.arterial",
            elementType: "geometry.fill",
            stylers: [{
                visibility: "on"
            }, {
                color: "#cccccc"
            }]
        }, {
            featureType: "road.highway",
            elementType: "geometry.stroke",
            stylers: [{
                visibility: "on"
            }, {
                color: "#999999"
            }]
        }, {
            featureType: "road.highway",
            elementType: "geometry.fill",
            stylers: [{
                visibility: "on"
            }, {
                color: "#bbbbbb"
            }]
        }, {
            featureType: "road.highway",
            elementType: "geometry.stroke",
            stylers: [{
                color: "#999999"
            }]
        }, {
            featureType: "road.arterial",
            stylers: [{
                visibility: "on"
            }]
        }, {
            featureType: "road.arterial",
            elementType: "geometry.fill",
            stylers: [{
                color: "#00ACEC"
            }]
        }, {
            featureType: "road.arterial",
            elementType: "geometry.stroke",
            stylers: [{
                color: "#00ACEC"
            }]
        }, {
            featureType: "road.local",
            elementType: "geometry.fill",
            stylers: [{
                color: "#999999"
            }]
        }, {
            featureType: "transit",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "administrative.locality",
            elementType: "labels.text.fill",
            stylers: [{
                color: "#00ACEC"
            }]
        }, {
            featureType: "administrative.neighborhood",
            elementType: "labels.text.fill",
            stylers: [{
                visibility: "on"
            }, {
                color: "#00ACEC"
            }]
        }, {
            featureType: "administrative.neighborhood",
            elementType: "labels.text.stroke",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "road",
            elementType: "labels.text",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "road.local",
            elementType: "labels.icon",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "road.local",
            elementType: "geometry.stroke",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "water",
            elementType: "labels.text.fill",
            stylers: [{
                color: "#00ACEC"
            }]
        }, {
            featureType: "water",
            elementType: "labels.text.stroke",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "administrative.land_parcel",
            elementType: "geometry.stroke",
            stylers: [{
                color: "#888888"
            }]
        }, {
            featureType: "landscape.man_made",
            elementType: "geometry.stroke",
            stylers: [{
                color: "#888888"
            }]
        }, {
            featureType: "road",
            elementType: "labels.text.fill",
            stylers: [{
                visibility: "on"
            }, {
                color: "#ffffff"
            }]
        }, {
            featureType: "road",
            elementType: "labels.text.stroke",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "road",
            elementType: "labels.icon",
            stylers: [{
                visibility: "off"
            }]
        }, {}, {
            featureType: "administrative.province",
            elementType: "geometry.stroke",
            stylers: [{
                color: "#999999"
            }, {
                visibility: "on"
            }]
        }, {
            featureType: "administrative.country",
            elementType: "geometry.stroke",
            stylers: [{
                color: "#999999"
            }, {
                weight: 1
            }]
        }, {
            featureType: "administrative.country",
            elementType: "labels.text.fill",
            stylers: [{
                color: "#ffffff"
            }, {
                visibility: "on"
            }]
        }, {
            featureType: "administrative.country",
            elementType: "labels.text.stroke",
            stylers: [{
                visibility: "off"
            }]
        }, {}]
    },

    Load: function(){
        dude.Map.MapOptions.draggable = ! dude.Global.IsTouch;

        if(dude.Map.$Holder.length && ! dude.Map.isLoaded){
            script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=dude.Map.Init";
            document.body.appendChild(script);
            dude.Map.isLoaded = true;
        }

    },

    Init: function(){

        if(!dude.Map.isLoaded){
            dude.Map.Load();
        } else if(!dude.Map.isInitiated) {
            dude.Map.LatLng = new google.maps.LatLng(62.2433363, 25.7490045);
            dude.Map.MapOptions.mapTypeId = google.maps.MapTypeId.ROADMAP;
            dude.Map.MapOptions.zoomControlOptions = {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.LEFT_CENTER
            };
            dude.Map.GoogleMap = new google.maps.Map(dude.Map.$Holder[0], dude.Map.MapOptions);
            dude.Map.isInitiated = true;
            dude.Map.Center();

            dude.Map.CreateMarker(dude.Map.LatLng, "marker");

            google.maps.event.addListener(dude.Map.Marker, 'click', function(event) {
               window.open('https://www.google.com/maps/dir//Address,+Helsinki,+Suomi', 'dudeDirections');
            });

            //dude.Global.$window.on( "resize", _.debounce(dude.Map.Center, 100));
        }
    },

    CompanyLoad: function() {
        dude.Map.MapOptions.draggable = ! dude.Global.IsTouch;

        if (dude.Map.$Holder.length && ! dude.Map.isLoaded) {
            script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=dude.Map.CompanyInit";
            document.body.appendChild(script);
            dude.Map.isLoaded = true;
        }

    },

    CustomLoad : function(funcName){
        dude.Map.MapOptions.draggable = ! dude.Global.IsTouch;
        if (dude.Map.$Holder.length && ! dude.Map.isLoaded) {
            script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=" + funcName;
            document.body.appendChild(script);
            dude.Map.isLoaded = true;
        }
    },

    CompanyInit: function() {

        if (!dude.Map.isLoaded) {

            dude.Map.CompanyLoad();

        }

        else if (!dude.Map.isInitiated) {

            dude.Map.LatLng = new google.maps.LatLng(62.2433363, 25.7490045);
            dude.Map.Center = new google.maps.LatLng(62.2433363, 25.7490045);
            dude.Map.MapOptions.mapTypeId = google.maps.MapTypeId.ROADMAP;
            dude.Map.MapOptions.zoomControlOptions = {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.LEFT_CENTER
            };
            dude.Map.MapOptions.zoom = 5;
            dude.Map.GoogleMap = new google.maps.Map(dude.Map.$Holder[0], dude.Map.MapOptions);
            dude.Map.isInitiated = true;

            dude.Map.Headquarters = dude.Map.LatLng;

            dude.Map.CreateMarker(dude.Map.Headquarters, "marker");


            if (dude.Global.IsMobile) {

                dude.Map.GoogleMap.panTo(dude.Map.Headquarters);

            }
            else {

                dude.Map.GoogleMap.panTo(dude.Map.Center);

            }


            google.maps.event.addListener(dude.Map.Marker, 'click', function(event) {
                window.open('https://www.google.fi/maps/place/Kauppakatu+28,+40100+Jyv%C3%A4skyl%C3%A4/@62.2433363,25.7490045,17z/data=!3m1!4b1!4m2!3m1!1s0x4685741691e4eb33:0x917cb50e5d0fdaa2', 'dudeDirections');
            });

            dude.Global.$window.on( "resize", _.debounce(dude.Map.CompanyCenter, 100));

        }

    },

    CreateMarker: function (latLng, type, iconAnchor, pinAnimation) {
        var animation = null,
            pinIcon = { url  : "/content/themes/dude/images/" + type + ".png" };

        if(iconAnchor){
            pinIcon.anchor = iconAnchor;
        } else {
            if(type == 'marker'){
                pinIcon.anchor = new google.maps.Point(44,51);
            } else {
                pinIcon.anchor = new google.maps.Point(18,23);
            }
        }

        if(pinAnimation){
            animation = google.maps.Animation[pinAnimation.toUpperCase()];
        }
        dude.Map.Marker = new google.maps.Marker({
            position: latLng,
            map: dude.Map.GoogleMap,
            icon: pinIcon,
            animation : animation
        });

        if(type == 'marker'){
            dude.Map.Marker.setZIndex(999);
        }

    },

    Center: function(){

        if(!dude.Map.isInitiated){
            dude.Map.Init();
        } else {
            dude.Map.GoogleMap.panTo(dude.Map.LatLng);
        }

    },

    CompanyCenter: function() {

      if (!dude.Map.isInitiated) {
            dude.Map.CompanyInit();
        } else {
            dude.Map.GoogleMap.panTo(dude.Map.Headquarters);
        }

    }

};

});
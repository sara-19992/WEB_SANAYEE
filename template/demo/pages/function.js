$(document).ready(function() {

    var map;
    var marker;
    var lat = 28.7407056;
    var lng = 77.0577493;
    var ico = new google.maps.MarkerImage("https://webdevtrick.com/wp-content/uploads/location.png");

    var overlay = new google.maps.OverlayView();
    overlay.draw = function() {};

    function initialize () {
        var mapCanvas = document.getElementById('map');
        var mapOptions = {
            zoom: 13,
            center: {
                lat: lat,
                lng: lng
            },
            mapTypeControl: false,
            zoomControl: false,
            panControl: false,
            scaleControl: false,
            streetViewControl: false,
            scrollwheel: false
        }

        map = new google.maps.Map( mapCanvas, mapOptions );

        overlay.setMap(map);
        ZoomControl(map);
        addMarker(map);

    }

    // Marker
    function addMarker ( map ) {
        marker = new google.maps.Marker({
            map: map,
            draggable: false,
            icon: ico,
            position: new google.maps.LatLng( lat, lng )
        });

        mouseOverHandler = function () {
            showMarker(marker);
        }
        mouseClickHandler = function () {
            clickMarker(lat, lng);
        }

        google.maps.event.addListener( marker, 'click', mouseClickHandler );
        google.maps.event.addListener( marker, 'mouseover', mouseOverHandler );
    }

    // Marker Click
    function clickMarker ( lat, lng ) {
        var url = 'https://maps.google.com/maps?q='+lat+','+lng+'&z=18';
        window.open(url, '_blank');
    }

    // Zoom
    function ZoomControl ( map ) {
        var zoomIn = document.getElementById('zoomIn');
        var zoomOut = document.getElementById('zoomOut');

        google.maps.event.addDomListener(zoomOut, 'click', function() {
            var currentZoomLevel = map.getZoom();
            if(currentZoomLevel != 0){
                map.setZoom(currentZoomLevel - 1);}
        });

        google.maps.event.addDomListener(zoomIn, 'click', function() {
            var currentZoomLevel = map.getZoom();
            if(currentZoomLevel != 21){
                map.setZoom(currentZoomLevel + 1);}
        });
    }

    // MapTypeId
    function TypeIdChange ( option ) {
        switch (option) {
            case "1":
                map.setMapTypeId( google.maps.MapTypeId.ROADMAP );
                break;
            case "2":
                map.setMapTypeId( google.maps.MapTypeId.SATELLITE );
                break;
            default:
                map.setMapTypeId( google.maps.MapTypeId.ROADMAP );
        }
    }
    // center
    $( '#center' ).on( 'click', function () {
        map.setZoom( 13 );
        map.setCenter(new google.maps.LatLng( lat, lng ) );
        map.setMapTypeId( google.maps.MapTypeId.ROADMAP );
        $( '#mapTypeId' ).val( "1" ).trigger('click');
    });

    // center
    $( '#center' ).on( 'click', function () {
        map.setZoom( 13 );
        map.setCenter(new google.maps.LatLng( lat, lng ) );
        map.setMapTypeId( google.maps.MapTypeId.ROADMAP );
        $( '#mapTypeId' ).val( "1" ).trigger('click');
    });

    $( '#mapTypeId' ).change( function () {
        var self = $(this);
        TypeIdChange( self.val() );
    });

    google.maps.event.addDomListener( window, 'load', initialize );
});
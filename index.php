<!DOCTYPE html>
<html> 
    <head>
        <title>Mapa Distritos</title> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8" http-equiv="X-UA-Compatible"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <link rel="apple-touch-icon" href="images/"/>
        <link rel="shortcut icon" href="images/">
        <link rel="icon" href="images/" />
        <link href="css/bootstrap.css" rel="stylesheet">
        <script src="js/jquery.js" type="text/javascript"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=drawing,geometry"></script>
    <body>
        <style>

        </style>

        <form class="form" action="controlCapas.php" method="post" id="formMapa" name="formMapa" enctype="multipart/form-data">

            <div class="container-fluid">

                <div class="row" align="">

                    <div class="col-md-12">

                        <div class="">

                            <div id="div_data" class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Mapa</h4>
                                </div>
                                <div class="panel-body no-padding" id="">

                                    <div class="" id="map_canvas"  style="height: 700px;" >

                                    </div>
                                </div>
                                <div class="panel-footer" id="footerMap">
                                    <div class="checkbox">
                                        <label>
                                            <!--<input type="checkbox" value="1" id="Dibujar" name="Dibujar" onclick="activarDrawingMode()">Activar selección por área-->
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>


            </div>

        </div>

    </form> 

    <script>

        var map;

        var marker;


        //Se establece el listener del evento para cuando se cierre la forma a dibujar



        function showPosition(position) {

            marker.setPosition(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
            marker.setMap(map);
        }


        function initialize() {


            var myOptions = {
                zoom: 13,
                center: new google.maps.LatLng(18.93080713014078, -99.22439575195312),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };


            //Inicialización del mapa
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);

            } else {
                map.setCenter(new google.maps.LatLng(19.028447938103028, -99.18035387992859));
            }



            google.maps.event.addListener(map, 'click', function(event) {
                //            alert(event.latLng);
                $("#footerMap").html("" + event.latLng);
            });


            //Creación de un marcador, pero no se posiciona en el mapa
            marker = new google.maps.Marker({
                //                                                        position: new google.maps.LatLng(18.596644603973186, -99.24847092479467),
                //                                                        map: map
            });
            google.maps.event.addListener(marker, 'click', function() {
                $("#footerMap").html("" + marker.getPosition());
            });
            var imageBounds = new google.maps.LatLngBounds(
                    new google.maps.LatLng(18.860879329595857, -99.34311836957932),
                    new google.maps.LatLng(19.028447938103028, -99.18035387992859));

            var oldmap = new google.maps.GroundOverlay(
                    "images/mapa2.png",
                    imageBounds);
            oldmap.setMap(map);
        }


        //Opciones de inicialización de la herramienta de dibujo




        $(document).ready(function() {
            $("#map_canvas").css("height", $(window).height() - 200);


            initialize();

        });

        $(window).resize(function() {
            $("#map_canvas").css("height", $(window).height() - 200);
        });



    </script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
</body>
</html>


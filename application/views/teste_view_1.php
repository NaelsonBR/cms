<html>
  <head>
    <title>title</title>
  </head>
  <body>
    <!-- jQuery 2.2.3 -->
    <script src="<?= base_url('assets/admin/') ?>plugins/jQuery/jquery.js"></script>
    <script src="<?= base_url('assets/admin/') ?>plugins/jQueryUI/jquery-ui.custom.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBnat1IMH6cMczvcaKdtZtcjoPmSqBLJJ8&amp;sensor=false"></script>
    <form method="post">
      <fieldset>
        <legend>Google Maps</legend>
        <div>
          <label for="txtEndereco">Endereço:</label>
          <br>
          <input type="text" id="txtEndereco" name="txtEndereco" class="form-control input-md"/>
        </div>
        <div>
          <input type="button" id="btnEndereco" name="btnEndereco" value="Mostrar no mapa" />
        </div>
        <div id="mapa" style="height: 500px; width: 800px"></div>
        <div>
          <input type="submit" value="Enviar" name="btnEnviar" />
        </div>
        <input type="hidden" id="txtLatitude" name="txtLatitude" />
        <input type="hidden" id="txtLongitude" name="txtLongitude" />
      </fieldset>
    </form>
    <script>
      var geocoder;
      var map;
      var marker;
      $(document).ready(function () {
        /*inicializando*/
        initialize();
        /*fazer a chamada da função carregarNoMapa no evento click do botão 
         * “Mostrar no mapa” e no evento blur do campo endereço:*/
        $("#btnEndereco").click(function () {
          if ($(this).val() !== "")
            carregarNoMapa($("#txtEndereco").val());
        });

        $("#txtEndereco").blur(function () {
          if ($(this).val() !== "")
            carregarNoMapa($(this).val());
        });

        /*Caso a pessoa queira fazer o processo contrário, ou seja, mexer no 
         * marcador e atualizar o endereço, vamos utilizar novamente o geocoder.geocode,
         *  só que dessa vez, ao invés de passarmos o endereço para ele, 
         *  vamos passar a posição atual do marcador e a partir dela, o geocoder.geocode
         *   irá nos retornar o endereço, a latitude e a longitude do ponto:*/
        google.maps.event.addListener(marker, 'drag', function () {
          geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              if (results[0]) {
                $('#txtEndereco').val(results[0].formatted_address);
                $('#txtLatitude').val(marker.getPosition().lat());
                $('#txtLongitude').val(marker.getPosition().lng());
              }
            }
          });
        });

        /* vamos colocar o código que irá habilitar o autocomplete. O código 
         * contém o evento source, que definiremos nossa fonte de dados, e o 
         * evento select que será acionado quando a pessoa clicar em alguma 
         * sugestão do autocomplete.*/
        $("#txtEndereco").autocomplete({
          source: function (request, response) {
            geocoder.geocode({'address': request.term + ', Brasil', 'region': 'BR'}, function (results, status) {
              response($.map(results, function (item) {
                return {
                  label: item.formatted_address,
                  value: item.formatted_address,
                  latitude: item.geometry.location.lat(),
                  longitude: item.geometry.location.lng()
                }
              }));
            })
          },
          select: function (event, ui) {
            $("#txtLatitude").val(ui.item.latitude);
            $("#txtLongitude").val(ui.item.longitude);
            var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
            marker.setPosition(location);
            map.setCenter(location);
            map.setZoom(16);
          }
        });

        /*funções
         ######################################################################*/

        /*função de inicializaçao*/
        function initialize() {
          var latlng = new google.maps.LatLng(-23.50833652786387, -46.57539156249999);
          var options = {
            zoom: 5,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };

          map = new google.maps.Map(document.getElementById("mapa"), options);

          geocoder = new google.maps.Geocoder();

          marker = new google.maps.Marker({
            map: map,
            draggable: true,
          });

          marker.setPosition(latlng);
        }

        /*Para que ao digitar o endereço o mesmo apareça no mapa, vamos utilizar 
         * o botão “Mostrar no mapa” e aproveitaremos também o evento blur do 
         * campo endereço.*/
        function carregarNoMapa(endereco) {
          geocoder.geocode({'address': endereco + ', Brasil', 'region': 'BR'}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              if (results[0]) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();

                $('#txtEndereco').val(results[0].formatted_address);
                $('#txtLatitude').val(latitude);
                $('#txtLongitude').val(longitude);

                var location = new google.maps.LatLng(latitude, longitude);
                marker.setPosition(location);
                map.setCenter(location);
                map.setZoom(16);
              }
            }
          });
        }

      });
    </script>
    <style>
      /* =============== Estilos do autocomplete =============== */
      .ui-autocomplete { 
        background: #fff; 
        border-top: 1px solid #ccc;
        cursor: pointer; 
        font: 15px 'Open Sans',Arial;
        margin-left: 3px;
        width: 100% !important;
        position: fixed;
      }

      .ui-autocomplete .ui-menu-item { 
        list-style: none outside none;
        padding: 7px 0 9px 10px;
      }

      .ui-autocomplete .ui-menu-item:hover { background: #eee }

      .ui-autocomplete .ui-corner-all { 
        color: #666 !important;
        display: block;
      }
    </style>
  </body>
</html>

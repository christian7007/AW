<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Reproductor-Nombre Cancion</title>

      <link rel="icon" type="image/png" href="../img/Logo.png"/>

      <!-- Bootstrap -->
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/webmusic.css" rel="stylesheet">
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/general.js"></script>
      <script src="../js/reproductor.js"></script>
   </head>
   <body>
      <?php if(isset($_GET["titulo"])) : ?>
      <div id="container-principal">
         <!-- En caso de que no haya JavaScript avisamos al usuario de que la pagina podria ir mal pero no redirigimos a error ya que no podrian introducir datos maliciosos por falta de validaciones -->
         <noscript>
            <div class="alert alert-danger text-center">
               <h4>Esta página requiere JavaScript para su correcto funcionamiento. Compruebe si JavaScript está deshabilitado en el navegador.</h4>
            </div>
         </noscript>
         <!-- Barra de navegacion -->
         <nav class="navbar navbar-inverse">
            <a class="navbar-brand" href="../index.html">Webmusic</a>
            <div class="navbar-header">
               <img src="../img/Logo.png" width="50" height="50" alt="logo">
               <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
               </button>
            </div>
            <div id="navbarCollapse" class="collapse navbar-collapse">
               <ul class="nav navbar-nav navbar-right">
                  <li><a href="registro.html"><span class="glyphicon glyphicon-plus"></span> Registrarse</a></li>
                  <li><a href="login.html"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesión</a></li>
               </ul>
            </div>
         </nav>
         <!-- Fin barra de navegacion -->

         <div class="container-fluid">
            <!-- Barra de búsqueda -->
            <div class="container">
               <div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                     <div id="imaginary_container"> 
                        <div class="input-group stylish-input-group">
                           <input type="text" class="form-control"  placeholder="Buscar" >
                           <span class="input-group-addon">
                              <a href="buscar_registrado.html" class="link-home-carousel-and-search"><span class="glyphicon glyphicon-search"></span></a>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div><!-- Fin barra de búsqueda -->

            <!-- Cabecera del reproductor-->
            <div id="player-header" class="col-md-10 col-md-push-2">
               <div>
                  <img src="../img/DiscoPortada.jpg" width="150" height="150" alt="Imagen usuario">
               </div>
               <div id="player-header-info">
                  <?php 
                  require_once("../php/controlador.php");
                  $info = info_cancion($_GET["titulo"]);
                  echo "<audio src=".$info["archivo"]." id='song'></audio>";
                  echo "<p>".$_GET["titulo"]."</p>\n";
                  echo "<p>".$info["autor"]."</p>";
                  echo "<p>Nº reproducciones: ".$info["nreproducciones"]."</p>"
                  ?>
                  <div class="dropdown">
                     <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Añadir a lista <span class="caret"></span></button>
                     <ul class="dropdown-menu">
                        <li><a href="#">Lista 1</a></li>
                        <li><a href="#">Lista 2</a></li>
                        <li><a href="#">Lista 3</a></li>
                     </ul>
                  </div>
               </div>
            </div>

            <!-- Barra de control del reproductor -->
            <div id="bar-player" class="col-md-10 col-md-push-2">
               <!-- Botones para el control del reproducotor -->
               <div id="player-buttons">
                  <!-- Boton para volver a la cancion anterior -->
                  <button type="button" class="btn btn-default" aria-label="Left Align">
                     <span class="glyphicon glyphicon-step-backward" aria-hidden="true"></span>
                  </button>

                  <!-- Boton de play/pause -->
                  <button type="button" class="btn btn-default" aria-label="Left Align" onclick="onPlay()">
                     <span class="glyphicon glyphicon-play" aria-hidden="true"></span>
                  </button>

                  <!-- Boton para pasar a la siguiente cancion -->
                  <button type="button" class="btn btn-default" aria-label="Left Align">
                     <span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span>
                  </button>
               </div>

               <!-- Barra de estado de la cancion -->
               <div id="info-player">
                  <p class="info-player-time">0:59</p>
                  <div id="player-progres" class="progress">
                     <div id="myBar" class="progress-bar" role="progressbar" aria-valuenow="70"
                          aria-valuemin="0" aria-valuemax="100">
                     </div>
                  </div>
                  <p class="info-player-time" id="duracion"><?php echo  floor($info["duracion"] / 60), ":", $info["duracion"] % 60; ?></p>
               </div>
            </div>

            <h3 id="comment-title" class="col-md-10 col-md-push-2">Comentarios</h3>

            <div class="comment-content col-xs-12 col-md-8 col-md-push-2">
               <div class="row">
                  <div class="panel panel-primary">
                     <div class="panel-heading comment-heading">
                        <img src="../img/FotoPerfil.jpg" class="img-circle img-responsive comment-img" alt="user profile image">
                        <div>
                           <h4>Nombre usuario</h4>
                        </div>
                     </div>
                     <div class="panel-body">
                        <form action="#" id="comment-form">
                           <textarea class="col-md-12 form-control" form="comment-form"></textarea>
                           <input type="submit" id="comment-btn" value="Comentar" class="btn btn-primary pull-right">
                        </form>
                     </div>
                  </div>
               </div>
            </div>

            <div class="comment-content col-md-8 col-md-push-2 col-xs-12">
               <div class="row">
                  <div class="panel panel-primary">
                     <div class="panel-heading comment-heading">
                        <img src="../img/FotoPerfil.jpg" class="img-circle img-responsive comment-img" alt="user profile image">
                        <div>
                           <h4>Nombre usuario</h4>
                           <h6>hace 1 minuto</h6>
                        </div>
                     </div>
                     <div class="panel-body">
                        <p>Esta página es la mejor!</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Container que contiene el footer de la página -->
      <div class="footer-container">
         <footer class="footer-bs" id="footer">
            <div class="row">
               <div class="margin-logo-footer col-md-2 footer-brand animated fadeInLeft">
                  <a href="index.html"><img alt="WebMusic" src="../img/Logo.png" width="180" height="180"></a>
               </div>
               <div class="col-md-10 footer-nav animated fadeInUp">
                  <div class="col-md-3">
                     <h4>Acerca de</h4>
                     <p>Webmusic es una página creada para el proyecto de la asignatura Aplicaciones Web, optativa del intinerario tecnologías de la información de la carrera Ingeniería Informática de la UCM.</p>
                  </div>
                  <div class="col-md-4 col-md-push-2">
                     <h4>Miembros</h4>
                     <ul class="list">
                        <li>José Ángel Garrido Montoya</li>
                        <li>Christian Gónzalez García-Muñoz</li>
                        <li>Alejandro Huertas Herrero</li>
                        <li>Héctor Valverde Bourgon</li>
                     </ul>
                  </div>
                  <div class="col-md-4 col-md-push-2">
                     <h4>Enlaces</h4>
                     <ul class="list">
                        <li><a href="#">Mapa del sitio</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Explicación diseño</a></li>
                        <li><a href="#">Guía de usuario</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </footer>
      </div><!-- Fin container footer -->
      <?php else : ?>
      <div class="alert alert-danger text-center">
         <h4>Has accedido a la pagina de forma incorrecta.</h4>
      </div>
      <?php endif; ?>
   </body>
</html>
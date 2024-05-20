<?php

$conn = include 'conexion/conexion.php';
$kinesNav = $conn->query("SELECT nombre FROM tiempo_maya.kin order by nombre;");
$uinalesNav = $conn->query("SELECT nombre FROM tiempo_maya.uinal order by nombre;");
$nahualesNav = $conn->query("SELECT nombre FROM tiempo_maya.nahual order by nombre;");
$energiasNav = $conn->query("SELECT nombre FROM tiempo_maya.energia order by id;");
$periodosNav = $conn->query("SELECT nombre FROM tiempo_maya.periodo order by orden ;");

?>
<?php include "mensaje.php"; ?>


<header id="header" style="padding-left: 600px;">
  <div class="container">
    <nav class="navbar navbar-expand-lg" id="nav-menu-container">
      <div class="container-fluid">
        <a id="title" class="navbar-brand" href="index.php" style="color: white;font-size: 24px;"><strong>TIEMPO</strong> MAYA</a>
        <button class="navbar-toggler" type="button" onclick="rellenar()" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span><i style="color: white;" class="fas fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <ul class="navbar-nav nav-menu">
            <li>
              <a class="nav-link" href="models/paginaModelo.php?pagina=Calendario Haab">Calendario Haab &nbsp;&nbsp;&nbsp;&nbsp; </a>
              <button type="button" style="opacity: 0; height: 0;" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Calendario Haab
              </button>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li>
                  <button type="button" style="opacity: 0; height: 0;" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kin
                  </button>
                  <a class="nav-link" href="#" style="font-size: 13px;">Kines </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div div style="width: 200px; height: 400px; overflow-y: scroll;">
                      <?php

                      if (is_array($kinesNav) || is_object($kinesNav)) {
                        foreach ($kinesNav as $kin) {
                          echo "<li class='nav-item'><a class='nav-link' href='models/paginaModeloElemento.php?elemento=kin#" . $kin['nombre'] . "'>" . $kin['nombre'] . "</a></li>";
                        }
                      } ?>
                  </ul>
                </li>
                <li>
                  <button type="button" style="opacity: 0; height: 0;" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Uinal
                  </button>
                  <a class="nav-link" href="#" style="font-size: 13px;">Uniales </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div div style="width: 200px; height: 400px; overflow-y: scroll;">
                      <?php if (is_array($uinalesNav) || is_object($uinalesNav)) {
                        foreach ($uinalesNav as $uinal) {
                          echo "<li class='nav-item'><a class='nav-link' href='models/paginaModeloElemento.php?elemento=uinal#" . $uinal['nombre'] . "'>" . $uinal['nombre'] . "</a></li>";
                        }
                      } ?>
                  </ul>
                </li>
              </ul>
            </li>

            <li>
              <a class="nav-link" href="models/paginaModelo.php?pagina=Calendario Cholquij">Calendario Cholq'ij &nbsp;&nbsp;&nbsp;&nbsp; </a>
              <button type="button" style="opacity: 0; height: 0;" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Calendario Cholquij
              </button>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li>
                  <button type="button" style="opacity: 0; height: 0;" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Nahual
                  </button>
                  <a class="nav-link" href="#" style="font-size: 13px;">Nahuales </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div div style="width: 200px; height: 400px; overflow-y: scroll;">
                      <?php if (is_array($nahualesNav) || is_object($nahualesNav)) {
                        foreach ($nahualesNav as $nahual) {
                          echo "<li class='nav-item'><a class='nav-link' href='models/paginaModeloElemento.php?elemento=nahual#" . $nahual['nombre'] . "'>" . $nahual['nombre'] . "</a></li>";
                        }
                      } ?>
                    </div>
                  </ul>
                </li>
                <li>
                  <button type="button" style="opacity: 0; height: 0;" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Energia
                  </button>
                  <a class="nav-link" href="#" style="font-size: 13px;">Energias </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div div style="width: 200px; height:400px; overflow-y: scroll;">
                      <?php if (is_array($energiasNav) || is_object($energiasNav)) {
                        foreach ($energiasNav as $energia) {
                          echo "<li class='nav-item'><a class='nav-link' href='models/paginaModeloElemento.php?elemento=energia#" . $energia['nombre'] . "'>" . $energia['nombre'] . "</a></li>";
                        }
                      } ?>
                    </div>
                  </ul>
                </li>
              </ul>
            </li>
            <li>
              <a class="nav-link" href="models/paginaModelo.php?pagina=Rueda Calendarica">Rueda Calendarica &nbsp;&nbsp;&nbsp;&nbsp; </a>
              <button type="button" style="opacity: 0; height: 0;" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Rueda Calendarica
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li>
                  <a class="nav-link" href="models/paginaModelo.php?pagina=Rueda Calendarica" style="font-size: 13px;">Informacion </a>
                </li>
                <li>
                  <a class="nav-link" href="calculadora_rueda_calendarica.php" style="font-size: 13px;">Calculadora </a>
                </li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="calculadora_cuenta_larga.php">Calculadora</a></li>
            <li>
              <a class="nav-link" href="models/paginaModelo.php?pagina=Calendario">Calendario &nbsp;&nbsp;&nbsp;&nbsp; </a>
              <button type="button" style="opacity: 0; height: 0;" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Calendario
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li>
                  <a class="nav-link" href="models/paginaModelo.php?pagina=Calendario" style="font-size: 13px;">Informacion </a>
                </li>
                <li>
                  <a class="nav-link" href="calculadora_calendario.php" style="font-size: 13px;">Calculadora </a>
                </li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="acerca_de.php">Acerca De</a></li>                      
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>


<script type="text/javascript">
  var relleno = false;

  function rellenar() {
    if (!relleno) {
      $('#header').addClass('header-fixed1');
      $('#inicioContainer').addClass('iniciofixed');
      relleno = true
    } else {
      relleno = false
      $('#header').removeClass('header-fixed1');
      $('#inicioContainer').removeClass('iniciofixed');
    }
  }
</script>
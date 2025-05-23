<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="index.php?vista=home">
        <img src="./img/logo.png" alt="" width="80" height="0">
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">


      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">Clientes</a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="index.php?vista=cliente_nuevo">Nuevo</a>
          <a class="navbar-item" href="index.php?vista=clientes_lista">Lista</a>
        </div>
      </div>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">Proyectos</a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="index.php?vista=proyecto_nuevo">Nueva</a>
          <a class="navbar-item" href="index.php?vista=proyectos_lista">Lista</a>
        </div>
      </div>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">Productos</a>

        <div class="navbar-dropdown">
          <a class="navbar-item">Nuevo</a>
          <a class="navbar-item">Lista</a>
          <a class="navbar-item">Por categorias</a>
          <a class="navbar-item">Buscar</a>
        </div>
      </div>


    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a href="index.php?vista=user_update&user_id_up=<?php echo $_SESSION['id'];?>" class="button is-primary is-rounded">
            Mi cuenta
          </a>
          <a href="index.php?vista=logout" class="button is-link is-rounded">
            salir
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
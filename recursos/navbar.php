<!-- Navbar -->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <!-- Container wrapper -->
  <div class="container">
    <!-- Navbar brand -->
    <a class="navbar-brand" href="#">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="40"
        height="40"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        class="h-12 w-12 text-primary">
        <path d="m8 3 4 8 5-5 5 15H2L8 3z"></path>
      </svg>
    </a>

    <!-- Toggle button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Search form -->
    <form class="d-flex align-items-center w-100" method="GET" action="index.php">
      <input class="form-control mb-1=== w-100" id="searchInput" name="search" type="text" placeholder="Buscar tareas..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
    </form>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item mx-2">
          <a class="nav-link d-flex align-items-center me-3" href="#!">
            <i class="fas fa-bookmark pe-2"></i> Hola, <?php echo $_SESSION['usuario']; ?>
          </a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link d-flex align-items-center" href="logout.php">Cerrar Sesión</a>
        </li>
      </ul>
    </div>
    <!-- Collapsible wrapper -->


  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->

<script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
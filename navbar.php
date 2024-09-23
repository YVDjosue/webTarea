<nav class="navbar navbar-expand-lg bg-primary">

    <a class="navbar-brand text-dark" href="index.php">
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
            class="h-12 w-12 text-light">
            <path d="m8 3 4 8 5-5 5 15H2L8 3z"></path>
        </svg>
    </a>
    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">hola</span>
    </button> -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link text-light" href="#">Hola, <?php echo $_SESSION['usuario']; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="logout.php">Cerrar Sesión</a>
            </li>
        </ul>
    </div>

</nav>
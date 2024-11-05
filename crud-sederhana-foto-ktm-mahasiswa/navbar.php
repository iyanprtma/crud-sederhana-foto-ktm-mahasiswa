<!-- navbar.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">DATA KTM MAHASISWA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <!-- Menu Tambah Data -->
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" 
             aria-current="page" href="index.php">Tambah Data</a>
        </li>
        <!-- Dropdown Menu Data -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php echo (basename($_SERVER['PHP_SELF']) == 'data-mhs.php') ? 'active' : ''; ?>" 
             href="#" id="dataDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Data
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dataDropdown">
            <li><a class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == 'data-mhs.php') ? 'active' : ''; ?>" 
                   href="data-mhs.php">Data Mahasiswa</a></li>
            <!-- <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"></a></li> -->
          </ul>
        </li>
        <!-- Dropdown Menu Pengaturan -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown" 
             aria-expanded="false">
            Pengaturan
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="settingsDropdown">
            <li><a class="dropdown-item" href="admin/profil.php">Profil</a></li>
            <!-- <li><a class="dropdown-item" href="#">Pengguna</a></li> -->
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

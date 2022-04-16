<?php
// Koneksi ke database
require 'config.php';
$petugas = query("SELECT * FROM data_petugas");

// ketika tombol cari di klik maka akan menampilkan hasil data yang dicari
if (isset($_POST["cari"])) {
  $petugas = cari($_POST["keyword"]);
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/bda58e72f8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="utama.js"></script>
    <title>Data Petugas</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
          <!-- offcanvas trigger -->
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
          </button>
          <!--akhir ofcanvas trigger  -->
        <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">Anyeong Admin</a>
      </div>
    </nav>
    <!-- Akhir Navbar -->
    <!-- offcanvas -->
    <div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar">
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">Interface</div>
            </li>
            <li>
              <a class="nav-link px-3 sidebar-link text-aria-expanded" data-bs-toggle="collapse" href="#layouts">
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                <span>Barang</span>
                <span class="ms-auto">
                  <span class="right-icon">
                  <i class="fa-solid fa-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="index1.php" class="nav-link px-3 text-aria-expanded">
                      <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                      <span><i class="fa-solid fa-rectangle-list"></i>Daftar Barang</i></span>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="tambahbarang.php" class="nav-link px-3 text-aria-expanded">
                      <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                      <span><i class="fa-solid fa-file-circle-plus"></i>Tambah Barang</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
            <a class="nav-link px-3 sidebar-link text-aria-expanded" data-bs-toggle="collapse" href="#layouts">
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                <span>Petugas</span>
                <span class="ms-auto">
                  <span class="right-icon">
                  <i class="fa-solid fa-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="daftarpetugas.php" class="nav-link px-3 text-aria-expanded">
                      <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                      <span><i class="fa-solid fa-user"></i>Daftar Petugas</i></span>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="tambahpetugas.php" class="nav-link px-3 text-aria-expanded">
                      <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                      <span><i class="fa-solid fa-person-circle-plus"></i>Tambah Petugas</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">Addons</div>
            </li>
            <li>
              <a href="logout.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-graph-up"></i></span>
                <span><i class="fa-solid fa-right-from-bracket"></i>LogOut</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas akhir -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 fw-bold fs-3">Daftar Petugas</div>
          <br><br><br>
          <div class="row">
            <div class="col-md-12 mb-5">
              <div class="card">
                <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Table</div>
                  <div class="card-body">
                  <div class="table-responsive"> 
                  <form action="" method="POST" class="d-flex">
        <input class="form-control me-2" type="text" name="keyword" autofocus placeholder="Cari data" autocomplete="off" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" name="cari"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>Photo</th>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Emali</th>
                      </tr>
                    </thead>
                    <?php $i = 1; ?>
                   <?php foreach ($petugas as $row) : ?>
                    <tr>
                  <td> <?= $i; ?> </td>
                  <td><img src="img/<?php echo $row["gambar"] ?>" width="50"></td>
                <td><?php echo $row["nama"] ?></td>
                <td><?php echo $row["nohp"] ?></td>
                <td><?php echo $row["email"] ?></td>
                </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
                  </table>
                </div>
              </div>
            </div>
          </div>              
        </div>
      </div>
    </main>
    <!-- tabel -->
       
    <!-- akhir tabel -->
  </body>
</html>
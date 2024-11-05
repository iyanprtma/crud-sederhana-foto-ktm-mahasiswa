<?php
// index.php
session_start();

// Cek apakah user sudah login
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require 'connections.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
    $npm = htmlspecialchars($_POST['npm']);
    $kode_foto = htmlspecialchars($_POST['kode_foto']);
    $prodi = $_POST['prodi'];
    $cetak = $_POST['cetak'];
    $nomor_wa = htmlspecialchars($_POST['nomor_wa']);

    // Cek duplikasi npm atau nomor_wa
    $check = $conn->prepare("SELECT * FROM mahasiswa WHERE npm = ? OR nomor_wa = ?");
    $check->bind_param("ss", $npm, $nomor_wa);
    $check->execute();
    $result = $check->get_result();

    if($result->num_rows > 0){
        // Data duplikat
        $message = "NPM atau Nomor WhatsApp sudah ada!";
        $alertType = "error";
        $alertTitle = "Gagal Menambahkan Data";
    } else {
        // Insert data
        $stmt = $conn->prepare("INSERT INTO mahasiswa (nama_lengkap, npm, kode_foto, prodi, cetak, nomor_wa) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nama_lengkap, $npm, $kode_foto, $prodi, $cetak, $nomor_wa);
        if($stmt->execute()){
            $message = "Data berhasil ditambahkan!";
            $alertType = "success";
            $alertTitle = "Sukses";
        } else {
            $message = "Terjadi kesalahan saat menambahkan data.";
            $alertType = "error";
            $alertTitle = "Gagal";
        }
        $stmt->close();
    }
    $check->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DATA KTM MAHASISWA</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Form Input -->
    <div class="cards1">
        <h2 class="mb-4">Tambah Data Mahasiswa</h2>
        <form method="POST" action="" id="mhsForm">
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
            </div>
            <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" class="form-control" id="npm" name="npm" required>
            </div>
            <div class="mb-3">
                <label for="kode_foto" class="form-label">Kode Foto</label>
                <input type="text" class="form-control" id="kode_foto" name="kode_foto">
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label">Prodi</label>
                <select class="form-select" id="prodi" name="prodi" required>
                    <option value="">Pilih Prodi</option>
                    <option value="Bisnis Digital">Bisnis Digital</option>
                    <option value="D3 Keperawatan">D3 Keperawatan</option>
                    <option value="S1 Administrasi Bisnis">S1 Administrasi Bisnis</option>
                    <option value="S1 Administrasi Negara">S1 Administrasi Negara</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="cetak" class="form-label">Cetak</label>
                <select class="form-select" id="cetak" name="cetak" required>
                    <option value="">Pilih Opsi</option>
                    <option value="Iya">Iya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nomor_wa" class="form-label">Nomor WhatsApp</label>
                <input type="text" class="form-control" id="nomor_wa" name="nomor_wa" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom JS -->
    <script src="scripts.js"></script>

    <!-- PHP Notifikasi -->
    <?php if(isset($message)): ?>
        <script>
            Swal.fire({
                icon: '<?php echo $alertType; ?>',
                title: '<?php echo $alertTitle; ?>',
                text: '<?php echo $message; ?>',
                confirmButtonColor: '#4e73df'
            });
        </script>
    <?php endif; ?>
</body>
</html>

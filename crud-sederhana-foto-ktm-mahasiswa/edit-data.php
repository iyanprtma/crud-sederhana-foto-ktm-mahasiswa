<?php
// edit-data.php
session_start();

// Cek apakah user sudah login
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require 'connections.php';

// Inisialisasi variabel
$id = '';
$nama_lengkap = '';
$npm = '';
$kode_foto = '';
$prodi = '';
$cetak = '';
$nomor_wa = '';
$message = '';
$alertType = '';
$alertTitle = '';

// Cek apakah id ada di URL
if(isset($_GET['id'])){
    $id = intval($_GET['id']);

    // Fetch data berdasarkan id
    $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $nama_lengkap = htmlspecialchars($row['nama_lengkap']);
        $npm = htmlspecialchars($row['npm']);
        $kode_foto = htmlspecialchars($row['kode_foto']);
        $prodi = htmlspecialchars($row['prodi']);
        $cetak = htmlspecialchars($row['cetak']);
        $nomor_wa = htmlspecialchars($row['nomor_wa']);
    } else {
        // Jika data tidak ditemukan, redirect ke data-mhs.php
        header("Location: data-mhs.php");
        exit();
    }

    $stmt->close();
} else {
    // Jika id tidak ada, redirect ke data-mhs.php
    header("Location: data-mhs.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
    $npm = htmlspecialchars($_POST['npm']);
    $kode_foto = htmlspecialchars($_POST['kode_foto']);
    $prodi = $_POST['prodi'];
    $cetak = $_POST['cetak'];
    $nomor_wa = htmlspecialchars($_POST['nomor_wa']);

    // Cek duplikasi npm atau nomor_wa, kecuali record saat ini
    $check = $conn->prepare("SELECT * FROM mahasiswa WHERE (npm = ? OR nomor_wa = ?) AND id != ?");
    $check->bind_param("ssi", $npm, $nomor_wa, $id);
    $check->execute();
    $result_check = $check->get_result();

    if($result_check->num_rows > 0){
        // Data duplikat
        $message = "NPM atau Nomor WhatsApp sudah ada!";
        $alertType = "error";
        $alertTitle = "Gagal Memperbarui Data";
    } else {
        // Update data
        $update = $conn->prepare("UPDATE mahasiswa SET nama_lengkap = ?, npm = ?, kode_foto = ?, prodi = ?, cetak = ?, nomor_wa = ? WHERE id = ?");
        $update->bind_param("ssssssi", $nama_lengkap, $npm, $kode_foto, $prodi, $cetak, $nomor_wa, $id);
        if($update->execute()){
            $message = "Data berhasil diperbarui!";
            $alertType = "success";
            $alertTitle = "Sukses";
        } else {
            $message = "Terjadi kesalahan saat memperbarui data.";
            $alertType = "error";
            $alertTitle = "Gagal";
        }
        $update->close();
    }
    $check->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Mahasiswa</title>
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
    <!-- Form Edit -->
    <div class="cards1">
        <h2 class="mb-4">Edit Data Mahasiswa</h2>
        <form method="POST" action="" id="editForm">
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $nama_lengkap; ?>" required>
            </div>
            <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" class="form-control" id="npm" name="npm" value="<?php echo $npm; ?>" required>
            </div>
            <div class="mb-3">
                <label for="kode_foto" class="form-label">Kode Foto</label>
                <input type="text" class="form-control" id="kode_foto" name="kode_foto" value="<?php echo $kode_foto; ?>">
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label">Prodi</label>
                <select class="form-select" id="prodi" name="prodi" required>
                    <option value="">Pilih Prodi</option>
                    <option value="Bisnis Digital" <?php if($prodi == 'Bisnis Digital') echo 'selected'; ?>>Bisnis Digital</option>
                    <option value="D3 Keperawatan" <?php if($prodi == 'D3 Keperawatan') echo 'selected'; ?>>D3 Keperawatan</option>
                    <option value="S1 Administrasi Bisnis" <?php if($prodi == 'S1 Administrasi Bisnis') echo 'selected'; ?>>S1 Administrasi Bisnis</option>
                    <option value="S1 Administrasi Negara" <?php if($prodi == 'S1 Administrasi Negara') echo 'selected'; ?>>S1 Administrasi Negara</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="cetak" class="form-label">Cetak</label>
                <select class="form-select" id="cetak" name="cetak" required>
                    <option value="">Pilih Opsi</option>
                    <option value="Iya" <?php if($cetak == 'Iya') echo 'selected'; ?>>Iya</option>
                    <option value="Tidak" <?php if($cetak == 'Tidak') echo 'selected'; ?>>Tidak</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nomor_wa" class="form-label">Nomor WhatsApp</label>
                <input type="text" class="form-control" id="nomor_wa" name="nomor_wa" value="<?php echo $nomor_wa; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Perbarui</button>
            <a href="data-mhs.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom JS -->
    <script src="scripts.js"></script>

    <!-- PHP Notifikasi -->
    <?php if($message != ""): ?>
        <script>
            Swal.fire({
                icon: '<?php echo $alertType; ?>',
                title: '<?php echo $alertTitle; ?>',
                text: '<?php echo $message; ?>',
                confirmButtonColor: '#4e73df'
            }).then((result) => {
                if(result.isConfirmed && '<?php echo $alertType; ?>' === 'success'){
                    window.location.href = 'data-mhs.php';
                }
            });
        </script>
    <?php endif; ?>
</body>
</html>

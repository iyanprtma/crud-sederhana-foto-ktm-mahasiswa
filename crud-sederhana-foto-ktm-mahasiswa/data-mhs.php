<?php
// data-mhs.php
session_start();

// Cek apakah user sudah login
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require 'connections.php';

// Fetch data
$sql = "SELECT * FROM mahasiswa";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Tabel Data Mahasiswa -->
    <div class="container mt-5">
        <h2 class="mb-4">Data Mahasiswa</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>NPM</th>
                    <th>Kode Foto</th>
                    <th>Prodi</th>
                    <th>Cetak</th>
                    <th>Nomor WhatsApp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                            <td><?php echo htmlspecialchars($row['npm']); ?></td>
                            <td><?php echo htmlspecialchars($row['kode_foto']); ?></td>
                            <td><?php echo htmlspecialchars($row['prodi']); ?></td>
                            <td><?php echo htmlspecialchars($row['cetak']); ?></td>
                            <td><?php echo htmlspecialchars($row['nomor_wa']); ?></td>
                            <td>
                                <a href="edit-data.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="del-data.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="scripts.js"></script>
</body>
</html>


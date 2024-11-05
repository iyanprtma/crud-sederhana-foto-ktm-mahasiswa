<?php
// del-data.php
session_start();

// Cek apakah user sudah login
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require 'connections.php';

if(isset($_GET['id'])){
    $id = intval($_GET['id']);

    // Menghapus data
    $stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        $message = "Data berhasil dihapus!";
        $alertType = "success";
        $alertTitle = "Sukses";
    } else {
        $message = "Terjadi kesalahan saat menghapus data.";
        $alertType = "error";
        $alertTitle = "Gagal";
    }

    $stmt->close();
} else {
    $message = "ID tidak ditemukan.";
    $alertType = "error";
    $alertTitle = "Gagal";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Data</title>
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: '<?php echo $alertType; ?>',
            title: '<?php echo $alertTitle; ?>',
            text: '<?php echo $message; ?>',
            confirmButtonColor: '#4e73df'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data-mhs.php';
            }
        });
    </script>
</body>
</html>

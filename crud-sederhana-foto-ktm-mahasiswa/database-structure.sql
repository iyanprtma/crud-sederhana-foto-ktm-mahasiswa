CREATE DATABASE IF NOT EXISTS dsadmin;
USE dsadmin;

CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    npm VARCHAR(20) UNIQUE NOT NULL,
    kode_foto VARCHAR(50) NOT NULL,
    prodi ENUM('Bisnis Digital', 'D3 Keperawatan', 'S1 Administrasi Bisnis', 'S1 Administrasi Negara') NOT NULL,
    cetak ENUM('iya', 'tidak') NOT NULL,
    nomor_whatsapp VARCHAR(20) UNIQUE NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES ('admin', 'admin');

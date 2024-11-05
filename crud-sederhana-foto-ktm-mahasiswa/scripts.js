// scripts.js

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('mhsForm') || document.getElementById('editForm');

    if(form){
        form.addEventListener('submit', function(e) {
            const npm = document.getElementById('npm').value.trim();
            const nomorWa = document.getElementById('nomor_wa').value.trim();

            // Contoh validasi sederhana
            if(npm === '' || nomorWa === ''){
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Validasi Gagal',
                    text: 'NPM dan Nomor WhatsApp tidak boleh kosong!',
                    confirmButtonColor: '#4e73df'
                });
                return;
            }

            // Validasi nomor WhatsApp (misalnya harus angka dan minimal 10 digit)
            const waPattern = /^[0-9]{10,15}$/;
            if(!waPattern.test(nomorWa)){
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Validasi Gagal',
                    text: 'Nomor WhatsApp harus terdiri dari 10 hingga 15 angka.',
                    confirmButtonColor: '#4e73df'
                });
                return;
            }

            // Jika semua validasi lolos, form akan dikirim
        });
    }
});

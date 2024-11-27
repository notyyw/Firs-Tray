<?php 
require_once 'app/koneksi.php';
$id = $_GET["id"];
$hasil = query("SELECT * FROM data WHERE id = $id")[0];


// Mengencode gambar ke base64
$imageData = base64_encode($hasil['pict']);
$imageSrc = 'data:image/jpeg;base64,' . $imageData; 
?>

<div class="satudua">
    <img src="assets/images/hiasan.gif" alt="Hiasan GIF" class="tiga">
</div>
<div class="container my-5">
    <h2 class="text-center mb-4">Update Data Anda</h2>
    <form id="registrationForm" enctype="multipart/form-data" method="POST" action="app/proses.php">
        
        <!-- Pilih Sumber Gambar -->
        <div id="alertOverlay" class="overlay">
            <div class="alert alert-light text-center p-4 shadow" role="alert" style="width: 300px; position: relative;">
                <button type="button" class="btn-close position-absolute top-0 end-0" aria-label="Close" id="closeAlertBtn"></button>
                <h5 class="mb-3">Pilih Sumber Gambar</h5>
                <input type="file" id="fileInput" accept="image/*" name="foto" style="display:none">
                <button type="button" class="btn btn-primary mb-2" id="deviceBtn">Ambil dari Perangkat</button>
                <button type="button" class="btn btn-secondary" id="cameraBtn">Ambil dari Kamera</button>
            </div>
        </div>

        <!-- Form Fields -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required value="<?=$hasil["nama"]; ?>">
            </div>
            <div class="col-md-3">
                <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenisKelamin" name="jenisKelamin" required>
                    <option selected disabled>Pilih jenis kelamin</option>
                    <option value="Laki-laki" <?= $hasil["jk"] == "Laki-laki" ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $hasil["jk"] == "Perempuan" ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat" required value="<?=$hasil["alamat"]; ?>">
            </div>
        </div>

        <!-- Baris Kedua -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                <div class="d-flex">
                    <input type="number" class="form-control me-2" name="tanggal" placeholder="Tanggal" required max="31" value="<?=$hasil["tgl"]; ?>">
                    <select class="form-select me-2" name="bulan" required>
                        <option selected disabled>Bulan</option>
                        <option value="Januari" <?= $hasil["bulan"] == "Januari" ? 'selected' : ''; ?>>Januari</option>
                        <option value="Februari" <?= $hasil["bulan"] == "Februari" ? 'selected' : ''; ?>>Februari</option>
                        <option value="Maret" <?= $hasil["bulan"] == "Maret" ? 'selected' : ''; ?>>Maret</option>
                        <option value="April" <?= $hasil["bulan"] == "April" ? 'selected' : ''; ?>>April</option>
                        <option value="Mei" <?= $hasil["bulan"] == "Mei" ? 'selected' : ''; ?>>Mei</option>
                        <option value="Juni" <?= $hasil["bulan"] == "Juni" ? 'selected' : ''; ?>>Juni</option>
                        <option value="Juli" <?= $hasil["bulan"] == "Juli" ? 'selected' : ''; ?>>Juli</option>
                        <option value="Agustus" <?= $hasil["bulan"] == "Agustus" ? 'selected' : ''; ?>>Agustus</option>
                        <option value="September" <?= $hasil["bulan"] == "September" ? 'selected' : ''; ?>>September</option>
                        <option value="Oktober" <?= $hasil["bulan"] == "Oktober" ? 'selected' : ''; ?>>Oktober</option>
                        <option value="November" <?= $hasil["bulan"] == "November" ? 'selected' : ''; ?>>November</option>
                        <option value="Desember" <?= $hasil["bulan"] == "Desember" ? 'selected' : ''; ?>>Desember</option>
                    </select>
                    <input type="number" class="form-control" name="tahun" placeholder="Tahun" required min="1700" max="2024" value="<?=$hasil["tahun"]; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempatLahir" name="tempatLahir" placeholder="Masukkan tempat lahir" required value="<?=$hasil["tempat_lahir"]; ?>">
            </div>
        </div>

        <!-- Baris Ketiga -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="pendidikanTerakhir" class="form-label">Pendidikan Terakhir</label>
                <select class="form-select" id="pendidikanTerakhir" name="pendidikanTerakhir" required>
                    <option selected disabled>Pilih pendidikan terakhir</option>
                    <option value="SD" <?= $hasil["pendidikan"] == "SD" ? 'selected' : ''; ?>>SD</option>
                    <option value="SMP" <?= $hasil["pendidikan"] == "SMP" ? 'selected' : ''; ?>>SMP</option>
                    <option value="SMA" <?= $hasil["pendidikan"] == "SMA" ? 'selected' : ''; ?>>SMA</option>
                    <option value="D3" <?= $hasil["pendidikan"] == "D3" ? 'selected' : ''; ?>>D3</option>
                    <option value="S1" <?= $hasil["pendidikan"] == "S1" ? 'selected' : ''; ?>>S1</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="foto" class="form-label">Foto</label>
                <button type="button" id="openAlertBtn" class="btn btn-primary form-control">Unggah Foto</button>  
                <input type="file" name="foto" id="foto" style="display:none" required>
                <input type="hidden" name="id" value="<?= $hasil['id']; ?>">
            </div>
            <div class="col-md-2">
                <img id="previewImage" class="mt-2" src="#" alt="Preview" style="display: none; width: 100px; height: 100px; object-fit: cover;">
            </div>
        </div>

        <!-- Baris Terakhir -->
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-check">
                    
                </div>
            </div>
            <div class="col-md-6 text-end">
                <button type="button" class="btn btn-secondary me-2"  onclick="window.location.href='../bd'">Cancel</button>
                <button type="submit" name="update" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<!-- JavaScript untuk Preview Gambar -->
<script>
// Dapatkan elemen yang dibutuhkan
const openAlertBtn = document.getElementById('openAlertBtn');
const closeAlertBtn = document.getElementById('closeAlertBtn');
const alertOverlay = document.getElementById('alertOverlay');
const deviceBtn = document.getElementById('deviceBtn');
const cameraBtn = document.getElementById('cameraBtn');
const fileInput = document.getElementById('foto');
const previewImage = document.getElementById('previewImage');

// Fungsi untuk mengubah base64 menjadi Blob
function base64ToBlob(base64, mime) {
    const byteCharacters = atob(base64.split(',')[1]);
    const byteNumbers = new Array(byteCharacters.length);
    for (let i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
    }
    const byteArray = new Uint8Array(byteNumbers);
    return new Blob([byteArray], { type: mime });
}

// Fungsi untuk menampilkan preview gambar
function showPreview(imageSrc) {
    previewImage.src = imageSrc;
    previewImage.style.display = 'block';
    alertOverlay.classList.remove('show');
}

// Ketika tombol 'Unggah Foto' ditekan, tampilkan overlay
openAlertBtn.addEventListener('click', () => {
    alertOverlay.classList.add('show');
});

// Fungsi untuk menutup overlay
closeAlertBtn.addEventListener('click', () => {
    alertOverlay.classList.remove('show');
});

// Ketika tombol 'Ambil dari Perangkat' ditekan
deviceBtn.addEventListener('click', () => {
    fileInput.click();
});

// Ketika file dipilih
fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            showPreview(e.target.result);
        };
        reader.readAsDataURL(file);
    }
});

// Ketika tombol 'Ambil dari Kamera' ditekan
cameraBtn.addEventListener('click', () => {
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then((stream) => {
                const video = document.createElement('video');
                video.srcObject = stream;
                video.play();

                // Capture image after loading video
                video.addEventListener('loadeddata', () => {
                    setTimeout(() => {
                        const canvas = document.createElement('canvas');
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        const context = canvas.getContext('2d');
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);
                        const imageDataURL = canvas.toDataURL('image/png');
                        showPreview(imageDataURL);

                        // Convert the Data URL to a Blob
                        const blob = dataURLToBlob(imageDataURL);
                        const file = new File([blob], 'camera_image.png', { type: 'image/png' });

                        // Create a new DataTransfer object and set the file
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);

                        // Assign the file to the input element
                        fileInput.files = dataTransfer.files;

                        // Stop the video stream
                        stream.getTracks().forEach(track => track.stop());
                    }, 500); // Capture after half a second
                });
            })
            .catch((err) => {
                console.error("Camera access denied or unavailable", err);
            });
    } else {
        alert("Camera not available on this device.");
    }
});

function dataURLToBlob(dataURL) {
    const arr = dataURL.split(',');
    const mime = arr[0].match(/:(.*?);/)[1];
    const bstr = atob(arr[1]);
    let n = bstr.length;
    const u8arr = new Uint8Array(n);
    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new Blob([u8arr], { type: mime });
}

// Fungsi untuk menampilkan gambar preview
function showPreview(imageSrc) {
    previewImage.src = imageSrc;
    previewImage.style.display = 'block';
    alertOverlay.classList.remove('show');
}

// Menambahkan data ke input file
const imageSrc = '<?= $imageSrc; ?>'; // Ganti dengan PHP
const blob = base64ToBlob(imageSrc, 'image/jpeg');
const file = new File([blob], 'existing_image.jpg', { type: 'image/jpeg' });

// Buat DataTransfer dan tambahkan file
const dataTransfer = new DataTransfer();
dataTransfer.items.add(file);

// Assign file ke input
fileInput.files = dataTransfer.files;

// Tampilkan gambar preview
showPreview(imageSrc);




















</script>

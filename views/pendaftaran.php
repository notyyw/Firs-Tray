<div class="satudua">
    <img src="assets/images/hiasan.gif" alt="Hiasan GIF" class="tiga">
</div>
<div class="container my-5">
    <h2 class="text-center mb-4">Form Pendaftaran</h2>
    <form id="registrationForm" enctype="multipart/form-data" method="POST" action="app/proses.php">
        
        <!-- Pilih Sumber Gambar -->
        <div id="alertOverlay" class="overlay">
            <div class="alert alert-light text-center p-4 shadow" role="alert" style="width: 300px; position: relative;">
                <button type="button" class="btn-close position-absolute top-0 end-0" aria-label="Close" id="closeAlertBtn"></button>
                <h5 class="mb-3">Pilih Sumber Gambar</h5>
                <input type="file" id="fileInput" accept="image/*"  name="foto" style="display:none">
                <button type="button" class="btn btn-primary mb-2" id="deviceBtn">Ambil dari Perangkat</button>
                <button type="button" class="btn btn-secondary" id="cameraBtn">Ambil dari Kamera</button>
            </div>
        </div>

        <!-- Form Fields -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="col-md-3">
                <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenisKelamin" name="jenisKelamin" required>
                    <option selected disabled>Pilih jenis kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat" required>
            </div>
        </div>

        <!-- Baris Kedua -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                <div class="d-flex">
                    <input type="number" class="form-control me-2" name="tanggal" placeholder="Tanggal" required max="31" >
                    <select class="form-select me-2" name="bulan" required>
                        <option selected disabled>Bulan</option>
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                    </select>
                    <input type="number" class="form-control" name="tahun" placeholder="Tahun" required min="1700" max="2024">
                </div>
            </div>
            <div class="col-md-6">
                <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempatLahir" name="tempatLahir" placeholder="Masukkan tempat lahir" required>
            </div>
        </div>

        <!-- Baris Ketiga -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="pendidikanTerakhir" class="form-label">Pendidikan Terakhir</label>
                <select class="form-select" id="pendidikanTerakhir" name="pendidikanTerakhir" required>
                    <option selected disabled>Pilih pendidikan terakhir</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="D3">D3</option>
                    <option value="S1">S1</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="foto" class="form-label">Foto</label>
                <button type="button" id="openAlertBtn" class="btn btn-primary form-control">Unggah Foto</button>    
                <input type="file" name="foto" id="foto" style="display:none" required>
            </div>
            <div class="col-md-2">
                <img id="previewImage" class="mt-2" src="#" alt="Preview" style="display: none; width: 100px; height: 100px; object-fit: cover;">
            </div>
        </div>

        <!-- Baris Terakhir -->
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="syaratKetentuan" required>
                    <label class="form-check-label" for="syaratKetentuan">
                    Saya bersedia mengikuti syarat dan ketentuan
                    </label>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <button type="reset" class="btn btn-secondary me-2">Cancel</button>
                <button type="submit" name="submit"class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<!-- JavaScript untuk Preview Gambar -->
<script>
  // Dapatkan elemen yang dibutuhkan
// Dapatkan elemen yang dibutuhkan
const openAlertBtn = document.getElementById('openAlertBtn');
const closeAlertBtn = document.getElementById('closeAlertBtn');
const alertOverlay = document.getElementById('alertOverlay');
const deviceBtn = document.getElementById('deviceBtn');
const cameraBtn = document.getElementById('cameraBtn');
const fileInput = document.getElementById('foto');
const previewImage = document.getElementById('previewImage');

const cameraPreview = document.createElement('video');
cameraPreview.autoplay = true;
cameraPreview.style.width = '100%';
cameraPreview.style.height = 'auto';


// Fungsi untuk menampilkan gambar preview
function showPreview(imageSrc) {
    previewImage.src = imageSrc;
    previewImage.style.display = 'block';
    alertOverlay.classList.remove('show');
}

// Fungsi untuk membuka overlay
openAlertBtn.addEventListener('click', () => {
    alertOverlay.classList.add('show');
});

// Fungsi untuk menutup overlay
closeAlertBtn.addEventListener('click', () => {
    alertOverlay.classList.remove('show');
});

// Event handler untuk tombol "Ambil dari Perangkat"
deviceBtn.addEventListener('click', () => {
    fileInput.click();
});

// Event handler untuk input file dari perangkat
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

// Event handler untuk tombol "Ambil dari Kamera"
// Event handler untuk tombol "Ambil dari Kamera"
cameraBtn.addEventListener('click', () => {
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then((stream) => {
                cameraPreview.srcObject = stream;
                alertOverlay.querySelector('.alert').appendChild(cameraPreview); // Menambahkan video ke dalam alert
                alertOverlay.classList.add('show'); // Menampilkan overlay dengan preview live kamera

                // Tambahkan event listener untuk menangkap gambar ketika video diklik
                cameraPreview.addEventListener('click', () => {
                    const canvas = document.createElement('canvas');
                    canvas.width = cameraPreview.videoWidth;
                    canvas.height = cameraPreview.videoHeight;
                    const context = canvas.getContext('2d');
                    context.drawImage(cameraPreview, 0, 0, canvas.width, canvas.height);
                    const imageDataURL = canvas.toDataURL('image/png');
                    showPreview(imageDataURL); // Menampilkan gambar preview

                    // Mengubah Data URL menjadi Blob dan file
                    const blob = dataURLToBlob(imageDataURL);
                    const file = new File([blob], 'camera_image.png', { type: 'image/png' });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;

                    // Hentikan streaming kamera
                    stream.getTracks().forEach(track => track.stop());
                    alertOverlay.classList.remove('show'); // Menutup overlay setelah gambar diambil
                });
            })
            .catch((err) => {
                console.error("Camera access denied or unavailable", err);
            });
    } else {
        alert("Camera not available on this device.");
    }
});

// Fungsi untuk menghapus preview video ketika modal ditutup
closeAlertBtn.addEventListener('click', () => {
    alertOverlay.classList.remove('show');
    cameraPreview.srcObject.getTracks().forEach(track => track.stop()); // Menghentikan kamera ketika ditutup
    cameraPreview.remove(); // Menghapus elemen video dari overlay
});

// Function to convert data URL to Blob
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

// Fungsi untuk menghapus semua input dan menghilangkan preview gambar
document.querySelector('button[type="reset"]').addEventListener('click', () => {
    // Reset form
    document.getElementById('registrationForm').reset();

    // Hapus gambar preview
    previewImage.src = '';
    previewImage.style.display = 'none';

    // Hapus file input
    fileInput.files = new DataTransfer().files;

    // Menutup overlay jika terbuka
    alertOverlay.classList.remove('show');
});


</script>



    // Event listener untuk tombol delete
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const form = document.getElementById('isiuser-' + userId);

            // Konfirmasi penghapusan dengan SweetAlert
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tambahkan input hidden untuk mengirimkan aksi delete
                    const deleteInput = document.createElement('input');
                    deleteInput.type = 'hidden';
                    deleteInput.name = 'delete';
                    form.appendChild(deleteInput);

                    // Kirim form jika dikonfirmasi
                    form.submit();
                }
            });
        });
    });





    const openAlertBtn = document.getElementById('openAlertBtn');
    const closeAlertBtn = document.getElementById('closeAlertBtn');
    const alertOverlay = document.getElementById('alertOverlay');
    const deviceBtn = document.getElementById('deviceBtn');
    const cameraBtn = document.getElementById('cameraBtn');
    const fileInput = document.getElementById('foto');
    const previewImage = document.getElementById('previewImage');
    
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
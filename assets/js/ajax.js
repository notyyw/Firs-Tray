var searchbar = document.getElementById('searchbar');
var card = document.getElementById('card');

searchbar.addEventListener('keyup', function() {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if(xhr.readyState == 4 && xhr.status == 200){
            card.innerHTML = xhr.responseText;
            initDeleteButtons(); // Inisialisasi ulang tombol delete setelah hasil pencarian dimuat
        }
    }

    xhr.open('GET', 'views/ajax.php?searchbar=' + encodeURIComponent(searchbar.value), true);
    xhr.send();
});

// Fungsi untuk menginisialisasi ulang tombol delete
function initDeleteButtons() {
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const form = document.getElementById('isiuser-' + userId);

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
                    const deleteInput = document.createElement('input');
                    deleteInput.type = 'hidden';
                    deleteInput.name = 'delete';
                    form.appendChild(deleteInput);
                    form.submit();
                }
            });
        });
    });
}

// Inisialisasi tombol delete pertama kali saat halaman dimuat
initDeleteButtons();

<?php 
require '../app/koneksi.php';

$key = $_GET["searchbar"];
$key = $conn->real_escape_string($key);

$query = "SELECT * FROM data WHERE nama LIKE '%$key%'";

$result = $conn->query($query);
?>

<div class="row">
    <?php while ($row = $result->fetch_assoc()) { 
        $imageData = base64_encode($row['pict']);
        $imageSrc = 'data:image/jpeg;base64,' . $imageData; ?>
        <div class="col-md-6 mb-3" >
            <div class="card" >
                <div class="card-body p-2">
                    <form id="isiuser-<?= $row['id']; ?>" enctype="multipart/form-data" method="POST" action="app/proses.php">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img src="<?= $imageSrc; ?>" class="img-fluid rounded-circle" alt="Profile Picture" style="width: 80px; height: 80px; background-size:cover;">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            </div>   
                            <div class="col">
                                <h5 class="mb-0"><?= htmlspecialchars($row['nama']); ?></h5>
                            </div>   
                            <div class="col-auto text-end">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#details<?= $row['id']; ?>">Detail</button>
                                <button type="button" class="btn btn-warning btn-sm update-btn" onclick="window.location.href='update?id=<?= $row['id']; ?>'">Update</button>
                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="<?= $row['id']; ?>">Delete</button>
                            </div>   
                        </div>
                    </form>
                </div>
            </div>
            <div class="collapse" id="details<?= $row['id']; ?>">
                <div class="card card-body mt-2">
                    <p><strong>Alamat:</strong> <?= htmlspecialchars($row['alamat']); ?></p>
                    <p><strong>Pendidikan Terakhir:</strong> <?= htmlspecialchars($row['pendidikan']); ?></p>
                    <p><strong>Tempat, Tanggal Lahir:</strong> <?= htmlspecialchars($row['tempat_lahir']) . ", " . $row['tgl'] . " " . $row['bulan'] . " " . $row['tahun']; ?></p>
                    <p><strong>Jenis Kelamin:</strong> <?= htmlspecialchars($row['jk']); ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>                



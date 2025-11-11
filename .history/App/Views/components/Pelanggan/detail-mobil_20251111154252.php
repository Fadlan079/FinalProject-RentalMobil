<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mobil - Cylc Rent Car</title>
    <link rel="icon" href="assets/logo-cylc.jpg" type="image/jpg">
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        .scrollbar-hide::-webkit-scrollbar { display: none; }

        ::-webkit-scrollbar {
            width: 5px;
            transition: width 0.3s ease;
        }

        ::-webkit-scrollbar-track {
            background: #171717;
        }

        ::-webkit-scrollbar-thumb {
            background: #f97316;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #ea580c;
            box-shadow: 0 0 0 2px #ea580c;
        }
    </style>
</head>
<body>
    <header>
        <?php include __DIR__ . "/header.php"?>
        <?php include __DIR__ . "/profile.php"?>
    </header>

    <main class="bg-neutral-100 min-h-screen">
        <div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-xl mt-10">
    <!-- Success/Error Messages -->
    <div id="message" class="hidden mb-4 p-4 rounded-lg text-center font-semibold"></div>
    <!-- Bagian 1: Foto dan Identitas -->
    <div class="flex flex-col md:flex-row gap-6">
        <div class="flex-shrink-0">
            <img src="uploads/<?= htmlspecialchars($detail['img']) ?>" 
                 alt="Foto Mobil" 
                 class="w-80 h-56 object-cover rounded-lg border">
        </div>

        <div class="flex-1">
            <h2 class="text-3xl font-semibold mb-3"><?= htmlspecialchars($detail['merk']) ?> <?= htmlspecialchars($detail['tipe']) ?></h2>
            <p><strong>Model:</strong> <?= htmlspecialchars($detail['model']) ?></p>
            <p><strong>Tahun:</strong> <?= htmlspecialchars($detail['tahun']) ?></p>
            <p><strong>Warna:</strong> <?= htmlspecialchars($detail['warna']) ?></p>
            <p><strong>Status:</strong>
                <span class="px-2 py-1 rounded text-white
                    <?= $detail['status'] == 'ready' ? 'bg-green-500' : ($detail['status'] == 'rent' ? 'bg-red-500' : 'bg-gray-400') ?>">
                    <?= htmlspecialchars($detail['status']) ?>
                </span>
            </p>
            <p class="text-xl mt-3 font-bold text-orange-600">Rp<?= number_format($detail['harga'], 0, ',', '.') ?> / hari</p>
        </div>
    </div>

    <!-- Garis pemisah -->
    <hr class="my-6 border-gray-300">

    <!-- Bagian 2: Spesifikasi Teknis -->
    <div>
        <h3 class="text-xl font-semibold mb-4">Spesifikasi Teknis</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
            <p><strong>No. Plat:</strong> <?= htmlspecialchars($detail['noplat']) ?></p>
            <p><strong>No. Mesin:</strong> <?= htmlspecialchars($detail['nomesin']) ?></p>
            <p><strong>No. Rangka:</strong> <?= htmlspecialchars($detail['norangka']) ?></p>
            <p><strong>Silinder:</strong> <?= htmlspecialchars($detail['silinder']) ?> cc</p>
            <p><strong>Bahan Bakar:</strong> <?= htmlspecialchars($detail['bhn_bkr']) ?></p>
            <p><strong>Transmisi:</strong> <?= htmlspecialchars($detail['transmisi']) ?></p>
            <p><strong>Pintu:</strong> <?= htmlspecialchars($detail['pintu']) ?></p>
            <p><strong>Kursi:</strong> <?= htmlspecialchars($detail['kursi']) ?></p>
        </div>
    </div>

    <!-- Garis pemisah -->
    <hr class="my-6 border-gray-300">

    <!-- Bagian 3: Form Sewa -->
    <div id="sewa-form">
        <h3 class="text-xl font-semibold mb-4">Form Sewa</h3>
        <?php if ($detail['status'] == 'ready'): ?>
            <form id="sewaForm" class="space-y-4">
                <input type="hidden" name="id_mobil" value="<?= $detail['id_mobil'] ?>">
                <input type="hidden" name="id_pelanggan" value="<?= $_SESSION['user']['id_user'] ?? '' ?>">

                <label class="block">
                    <span class="text-gray-700">Tanggal Sewa</span>
                    <input type="date" name="tgl_sewa" id="tgl_sewa" class="border rounded px-3 py-2 w-full" required>
                </label>

                <label class="block">
                    <span class="text-gray-700">Tanggal Kembali</span>
                    <input type="date" name="tgl_kembali" id="tgl_kembali" class="border rounded px-3 py-2 w-full" required>
                </label>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-gray-700 font-medium">Durasi Sewa:</span>
                        <p id="durasi_display" class="text-lg font-bold text-orange-600">0 hari</p>
                    </div>
                    <div>
                        <span class="text-gray-700 font-medium">Total Bayar:</span>
                        <p id="total_display" class="text-lg font-bold text-green-600">Rp 0</p>
                    </div>
                </div>

                <input type="hidden" name="durasi_sewa" id="durasi_sewa" value="0">
                <input type="hidden" name="total_bayar" id="total_bayar" value="0">

                <button type="submit"
                        class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition w-full">
                        Sewa Sekarang
                </button>
            </form>
        <?php else: ?>
            <div class="text-red-500 font-semibold">Mobil ini tidak tersedia untuk disewa saat ini.</div>
        <?php endif; ?>
    </div>

    <div class="mt-6">
        <a href="index.php?action=index" 
           class="inline-block bg-gray-300 text-black px-4 py-2 rounded-lg hover:bg-gray-400">
           Kembali ke Daftar Mobil
        </a>
    </div>
    </div>

    <script>
    $(document).ready(function() {
        const hargaPerHari = <?= $detail['harga'] ?>;

        // Function to calculate duration and total
        function calculateTotal() {
            const tglSewa = $('#tgl_sewa').val();
            const tglKembali = $('#tgl_kembali').val();

            if (tglSewa && tglKembali) {
                const startDate = new Date(tglSewa);
                const endDate = new Date(tglKembali);
                const timeDiff = endDate.getTime() - startDate.getTime();
                const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                if (daysDiff > 0) {
                    const total = daysDiff * hargaPerHari;
                    $('#durasi_display').text(daysDiff + ' hari');
                    $('#total_display').text('Rp ' + total.toLocaleString('id-ID'));
                    $('#durasi_sewa').val(daysDiff);
                    $('#total_bayar').val(total);
                } else {
                    $('#durasi_display').text('0 hari');
                    $('#total_display').text('Rp 0');
                    $('#durasi_sewa').val(0);
                    $('#total_bayar').val(0);
                }
            }
        }

        // Calculate on date change
        $('#tgl_sewa, #tgl_kembali').change(calculateTotal);

        // Form submission
        $('#sewaForm').submit(function(e) {
            e.preventDefault();

            const formData = $(this).serialize();

            $.ajax({
                url: 'index.php?action=buat-transaksi',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    const messageDiv = $('#message');
                    if (response.success) {
                        messageDiv.removeClass('hidden bg-red-100 text-red-800').addClass('bg-green-100 text-green-800');
                        messageDiv.html('<i class="fas fa-check-circle mr-2"></i>' + response.message);

                        // Reset form and hide it
                        $('#sewaForm')[0].reset();
                        $('#durasi_display').text('0 hari');
                        $('#total_display').text('Rp 0');
                        $('#durasi_sewa').val(0);
                        $('#total_bayar').val(0);

                        // Redirect to riwayat transaksi after 2 seconds
                        setTimeout(function() {
                            window.location.href = 'index.php?action=riwayat-transaksi';
                        }, 2000);
                    } else {
                        messageDiv.removeClass('hidden bg-green-100 text-green-800').addClass('bg-red-100 text-red-800');
                        messageDiv.html('<i class="fas fa-exclamation-circle mr-2"></i>' + response.message);
                    }
                    messageDiv.show();
                },
                error: function(xhr, status, error) {
                    const messageDiv = $('#message');
                    messageDiv.removeClass('hidden bg-green-100 text-green-800').addClass('bg-red-100 text-red-800');
                    messageDiv.html('<i class="fas fa-exclamation-circle mr-2"></i>Terjadi kesalahan saat memproses permintaan');
                    messageDiv.show();
                }
            });
        });
    });
    </script>

</body>
</html>

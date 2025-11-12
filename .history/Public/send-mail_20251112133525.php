<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $pesan = htmlspecialchars($_POST['pesan']);

    $mail = new PHPMailer(true);

    try {
        // Konfigurasi server
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // server Gmail
        $mail->SMTPAuth   = true;
        $mail->Username   = 'cylc.rentcarservice@gmail.com'; // ganti dengan email kamu
        $mail->Password   = 'udgm gvtg szbm wmvq';    // ganti dengan App Password (bukan password biasa)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Pengirim & penerima
        $mail->setFrom('cylc.rentcarservice@gmail.com', 'Cylc Rent Car');
        $mail->addAddress('cylc.rentcarservice@gmail.com', 'Admin Cylc');
        $mail->addReplyTo($email, $nama);


        // Isi email
        $mail->isHTML(true);
        $mail->Subject = "Pesan dari $nama melalui form Cylc Rent Car";
        $mail->Body    = "
            <h3>Pesan Baru dari Pelanggan</h3>
            <p><strong>Nama:</strong> $nama</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Pesan:</strong><br>$pesan</p>
        ";

        // Kirim email
        $mail->send();

                // --- Kirim balasan otomatis ke pelanggan ---
        $mail->clearAddresses(); // hapus penerima sebelumnya
        $mail->addAddress($email, $nama);
        $mail->Subject = "Terima kasih telah menghubungi Cylc Rent Car";
        $mail->Body = "
            <p>Halo <strong>$nama</strong>,</p>
            <p>Pesan kamu sudah kami terima. Kami akan segera membalas secepatnya.</p>
            <p>Salam,<br><strong>Cylc Rent Car</strong></p>
        ";
        $mail->send();
        echo "<script>alert('Pesan berhasil dikirim!'); window.location.href='index.php';</script>";

    } catch (Exception $e) {
        echo "<script>alert('Gagal mengirim pesan: {$mail->ErrorInfo}'); window.history.back();</script>";
    }
}

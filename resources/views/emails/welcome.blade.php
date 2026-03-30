<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Masjid Syatho Sedan</title>
</head>
<body style="margin: 0; padding: 0; background-color: #fef9f0; font-family: 'Segoe UI', Arial, sans-serif; color: #78350f;">

    <!-- Wrapper -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #fef9f0; padding: 32px 16px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #fde68a;">

                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #b45309 0%, #d97706 50%, #92400e 100%); padding: 40px 32px; text-align: center;">
                            <!-- Crescent & Star Icon -->
                            <div style="margin-bottom: 16px;">
                                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline-block;">
                                    <circle cx="30" cy="30" r="28" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.4)" stroke-width="2"/>
                                    <path d="M30 10 C18 10 10 18 10 30 C10 42 18 50 30 50 C24 44 22 37 24 30 C26 23 30 18 36 16 C34 13 32 11 30 10Z" fill="white" opacity="0.9"/>
                                    <polygon points="42,12 44,18 50,18 45,22 47,28 42,24 37,28 39,22 34,18 40,18" fill="white" opacity="0.9"/>
                                </svg>
                            </div>
                            <h1 style="margin: 0 0 8px 0; font-size: 26px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px;">
                                Masjid Syatho
                            </h1>
                            <p style="margin: 0; font-size: 14px; color: #fde68a; font-weight: 600; letter-spacing: 2px; text-transform: uppercase;">
                                Sedan &bull; Rembang
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px 32px;">

                            <!-- Greeting -->
                            <h2 style="margin: 0 0 8px 0; font-size: 22px; font-weight: 700; color: #78350f;">
                                Assalamu'alaikum, {{ $user->name }}!
                            </h2>
                            <p style="margin: 0 0 24px 0; font-size: 15px; color: #92400e; line-height: 1.6;">
                                Jazakumullah khairan atas kehadiran Anda. Kami dengan sepenuh hati menyambut Anda sebagai anggota baru di portal digital <strong>Masjid Syatho Sedan</strong>.
                            </p>

                            <!-- Divider -->
                            <div style="border-top: 2px solid #fde68a; margin-bottom: 24px;"></div>

                            <!-- Stats Row -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 28px;">
                                <tr>
                                    <td width="33%" style="text-align: center; padding: 16px 8px; background: linear-gradient(135deg, #fffbeb, #fef3c7); border-radius: 12px; border: 1px solid #fde68a;">
                                        <div style="font-size: 22px; font-weight: 800; color: #b45309;">2500+</div>
                                        <div style="font-size: 11px; color: #92400e; font-weight: 600; margin-top: 4px;">Kapasitas Jamaah</div>
                                    </td>
                                    <td width="4%"></td>
                                    <td width="33%" style="text-align: center; padding: 16px 8px; background: linear-gradient(135deg, #fffbeb, #fef3c7); border-radius: 12px; border: 1px solid #fde68a;">
                                        <div style="font-size: 22px; font-weight: 800; color: #b45309;">24/7</div>
                                        <div style="font-size: 11px; color: #92400e; font-weight: 600; margin-top: 4px;">Keamanan</div>
                                    </td>
                                    <td width="4%"></td>
                                    <td width="33%" style="text-align: center; padding: 16px 8px; background: linear-gradient(135deg, #fffbeb, #fef3c7); border-radius: 12px; border: 1px solid #fde68a;">
                                        <div style="font-size: 22px; font-weight: 800; color: #b45309;">12+</div>
                                        <div style="font-size: 11px; color: #92400e; font-weight: 600; margin-top: 4px;">Fasilitas Lengkap</div>
                                    </td>
                                </tr>
                            </table>

                            <!-- What you can do -->
                            <h3 style="margin: 0 0 16px 0; font-size: 16px; font-weight: 700; color: #78350f;">
                                Apa yang bisa Anda lakukan sekarang?
                            </h3>

                            <!-- Feature list -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 28px;">
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #fef3c7;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="width: 32px; vertical-align: top; padding-top: 2px;">
                                                    <div style="width: 24px; height: 24px; background-color: #d97706; border-radius: 50%; text-align: center; line-height: 24px;">
                                                        <span style="color: white; font-size: 12px; font-weight: 700;">&#10003;</span>
                                                    </div>
                                                </td>
                                                <td style="padding-left: 12px;">
                                                    <strong style="color: #78350f; font-size: 14px;">Akses Portal Masjid</strong>
                                                    <p style="margin: 2px 0 0 0; font-size: 13px; color: #92400e;">Kelola konten dan informasi masjid melalui dashboard</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #fef3c7;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="width: 32px; vertical-align: top; padding-top: 2px;">
                                                    <div style="width: 24px; height: 24px; background-color: #d97706; border-radius: 50%; text-align: center; line-height: 24px;">
                                                        <span style="color: white; font-size: 12px; font-weight: 700;">&#10003;</span>
                                                    </div>
                                                </td>
                                                <td style="padding-left: 12px;">
                                                    <strong style="color: #78350f; font-size: 14px;">Tulis & Bagikan Artikel</strong>
                                                    <p style="margin: 2px 0 0 0; font-size: 13px; color: #92400e;">Bagikan ilmu dan berita Islami kepada jamaah</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="width: 32px; vertical-align: top; padding-top: 2px;">
                                                    <div style="width: 24px; height: 24px; background-color: #d97706; border-radius: 50%; text-align: center; line-height: 24px;">
                                                        <span style="color: white; font-size: 12px; font-weight: 700;">&#10003;</span>
                                                    </div>
                                                </td>
                                                <td style="padding-left: 12px;">
                                                    <strong style="color: #78350f; font-size: 14px;">Kelola Informasi Kegiatan</strong>
                                                    <p style="margin: 2px 0 0 0; font-size: 13px; color: #92400e;">Informasikan kegiatan dan acara masjid kepada publik</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA Button -->
                            <div style="text-align: center; margin-bottom: 32px;">
                                <a href="{{ url('/portal') }}"
                                   style="display: inline-block; padding: 14px 36px; background: linear-gradient(135deg, #b45309, #d97706); color: #ffffff; font-size: 15px; font-weight: 700; text-decoration: none; border-radius: 8px; letter-spacing: 0.3px;">
                                    Masuk ke Portal Masjid &rarr;
                                </a>
                            </div>

                            <!-- Divider -->
                            <div style="border-top: 2px solid #fde68a; margin-bottom: 24px;"></div>

                            <!-- Closing -->
                            <p style="margin: 0 0 8px 0; font-size: 14px; color: #92400e; line-height: 1.6;">
                                Semoga Allah SWT senantiasa meridhoi langkah kita semua. Jangan ragu untuk menghubungi kami jika ada pertanyaan atau butuh bantuan.
                            </p>
                            <p style="margin: 0; font-size: 14px; color: #78350f; font-weight: 600;">
                                Wassalamu'alaikum warahmatullahi wabarakatuh,<br>
                                <span style="color: #b45309;">Pengurus Masjid Syatho Sedan</span>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #fffbeb, #fef3c7); padding: 24px 32px; text-align: center; border-top: 2px solid #fde68a;">
                            <p style="margin: 0 0 4px 0; font-size: 13px; font-weight: 700; color: #b45309;">
                                Masjid Syatho Sedan
                            </p>
                            <p style="margin: 0 0 12px 0; font-size: 12px; color: #92400e; line-height: 1.6;">
                                SEDAN RT 01 RW 04, Karanganyar, Sedan<br>
                                Kec. Sedan, Kabupaten Rembang, Jawa Tengah 59264
                            </p>
                            <p style="margin: 0; font-size: 11px; color: #a16207;">
                                Email ini dikirim otomatis. Mohon tidak membalas email ini.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>

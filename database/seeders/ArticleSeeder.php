<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'test@example.com')->first();

        $categories = Category::all()->keyBy('name');
        $tags = Tag::all()->keyBy('name');

        $articleData = [
            // ── FEATURED ─────────────────────────────────────────────────────
            [
                'title' => 'Keutamaan Shalat Berjamaah di Masjid',
                'excerpt' => 'Shalat berjamaah di masjid memiliki keutamaan yang jauh lebih besar dibandingkan shalat sendirian. Rasulullah ﷺ sangat menganjurkan kaum muslimin untuk memakmurkan masjid dengan shalat berjamaah.',
                'content' => '<p>Shalat berjamaah merupakan salah satu amalan yang sangat dianjurkan dalam Islam. Rasulullah ﷺ bersabda, <em>"Shalat berjamaah lebih utama dua puluh tujuh derajat daripada shalat sendirian."</em> (HR. Bukhari &amp; Muslim)</p>

<h2>Keutamaan Shalat Berjamaah</h2>

<p>Para ulama sepakat bahwa shalat berjamaah memiliki banyak keutamaan, di antaranya:</p>

<ul>
<li><strong>Pahala yang berlipat ganda.</strong> Setiap langkah menuju masjid dicatat sebagai kebaikan, bahkan langkah pulang pun bernilai pahala.</li>
<li><strong>Terjaga dari gangguan setan.</strong> Kebersamaan dalam ibadah memperkuat ikatan spiritual dan membentengi diri dari bisikan jahat.</li>
<li><strong>Mempererat ukhuwah Islamiyah.</strong> Bertemu sesama muslim setiap hari membangun rasa persaudaraan yang tulus.</li>
<li><strong>Mendapatkan jaminan keamanan dari Allah.</strong> Orang yang senantiasa shalat berjamaah dijanjikan kecintaan Allah dan perlindungan-Nya.</li>
</ul>

<h2>Hukum Shalat Berjamaah</h2>

<p>Jumhur ulama (mayoritas ulama) berpendapat bahwa shalat berjamaah bagi laki-laki yang mukallaf dan mampu menuju masjid hukumnya adalah <strong>fardhu kifayah</strong>, bahkan sebagian ulama seperti Imam Ahmad bin Hanbal berpendapat <strong>fardhu \'ain</strong>.</p>

<p>Imam Ibnu Qudamah dalam kitab <em>Al-Mughni</em> menyebutkan bahwa tidak ada satu pun ulama salaf yang meninggalkan shalat berjamaah kecuali karena uzur yang dibenarkan syariat.</p>

<h2>Tips Agar Istiqamah Shalat Berjamaah</h2>

<ol>
<li>Biasakan tidur lebih awal agar tidak terlambat bangun untuk shalat Subuh berjamaah.</li>
<li>Atur jadwal pekerjaan agar tidak berbenturan dengan waktu shalat.</li>
<li>Ajak anggota keluarga dan tetangga untuk shalat berjamaah bersama.</li>
<li>Tanamkan kecintaan terhadap masjid sejak dini kepada anak-anak.</li>
</ol>

<p>Masjid Syatho Sedan membuka pintu selebar-lebarnya bagi seluruh jamaah untuk memakmurkan setiap waktu shalat. Mari bersama-sama kita hidupkan masjid dengan shalat berjamaah.</p>',
                'status' => 'published',
                'featured' => true,
                'views' => 312,
                'published_at' => now()->subDays(10),
                'category' => 'Ibadah',
                'tags' => ['shalat', 'kajian'],
            ],

            [
                'title' => 'Keutamaan Bulan Ramadan dan Amalan yang Dianjurkan',
                'excerpt' => 'Bulan Ramadan adalah bulan penuh berkah yang dinantikan setiap muslim. Di dalamnya terdapat malam Lailatul Qadar yang lebih baik dari seribu bulan. Manfaatkan sebaik-baiknya dengan amal ibadah yang sungguh-sungguh.',
                'content' => '<p>Bulan Ramadan adalah bulan yang paling mulia dalam kalender Islam. Allah ﷻ berfirman, <em>"Bulan Ramadan adalah bulan yang di dalamnya diturunkan Al-Qur\'an sebagai petunjuk bagi manusia dan penjelasan-penjelasan mengenai petunjuk itu dan pembeda (antara yang hak dan yang batil)."</em> (QS. Al-Baqarah: 185)</p>

<h2>Keistimewaan Bulan Ramadan</h2>

<p>Bulan Ramadan memiliki sejumlah keistimewaan yang tidak dimiliki bulan-bulan lainnya:</p>

<ul>
<li><strong>Pintu surga dibuka, pintu neraka ditutup.</strong> Rasulullah ﷺ bersabda bahwa setan-setan dibelenggu pada bulan ini.</li>
<li><strong>Turunnya Al-Qur\'an.</strong> Wahyu pertama diturunkan di bulan Ramadan, menjadikannya bulan Al-Qur\'an.</li>
<li><strong>Lailatul Qadar.</strong> Satu malam di sepuluh hari terakhir Ramadan yang nilainya lebih baik dari seribu bulan.</li>
<li><strong>Ampunan dosa.</strong> Siapa yang berpuasa dengan iman dan penuh harap, dosa-dosanya yang telah lalu diampuni.</li>
</ul>

<h2>Amalan Utama di Bulan Ramadan</h2>

<h3>1. Puasa Wajib</h3>
<p>Menahan diri dari makan, minum, dan hal-hal yang membatalkan puasa dari terbit fajar hingga terbenam matahari adalah rukun utama Ramadan.</p>

<h3>2. Shalat Tarawih</h3>
<p>Shalat sunah malam yang dilaksanakan secara berjamaah di masjid. Masjid Syatho Sedan menyelenggarakan shalat Tarawih 8 rakaat dan 3 rakaat witir setiap malam Ramadan.</p>

<h3>3. Tadarus Al-Qur\'an</h3>
<p>Memperbanyak bacaan Al-Qur\'an adalah amalan yang sangat dianjurkan. Targetkan khatam minimal sekali selama Ramadan.</p>

<h3>4. Sedekah dan Berbagi</h3>
<p>Ramadan adalah waktu terbaik untuk memperbanyak sedekah. Bahkan Rasulullah ﷺ adalah orang yang paling dermawan, dan beliau semakin dermawan di bulan Ramadan.</p>

<h3>5. I\'tikaf</h3>
<p>Berdiam diri di masjid dengan niat ibadah, terutama pada sepuluh hari terakhir Ramadan untuk mencari Lailatul Qadar.</p>

<p>Semoga Allah ﷻ mempertemukan kita dengan bulan Ramadan dan memberikan kekuatan untuk mengisinya dengan amal terbaik. Aamiin.</p>',
                'status' => 'published',
                'featured' => true,
                'views' => 508,
                'published_at' => now()->subDays(5),
                'category' => 'Ramadan',
                'tags' => ['ramadan', 'puasa', 'quran'],
            ],

            [
                'title' => 'Memakmurkan Masjid: Tanggung Jawab Setiap Muslim',
                'excerpt' => 'Masjid bukan sekadar tempat shalat, melainkan pusat peradaban Islam. Memakmurkannya adalah kewajiban setiap muslim yang beriman kepada Allah dan Hari Akhir.',
                'content' => '<p>Allah ﷻ berfirman, <em>"Sesungguhnya yang memakmurkan masjid-masjid Allah hanyalah orang-orang yang beriman kepada Allah dan Hari Akhir, mendirikan shalat, menunaikan zakat, dan tidak takut kecuali kepada Allah."</em> (QS. At-Taubah: 18)</p>

<h2>Apa Artinya Memakmurkan Masjid?</h2>

<p>Memakmurkan masjid (ta\'mirul masajid) bukan hanya berarti membangun fisik masjid, tetapi mencakup:</p>

<ul>
<li>Mengisi masjid dengan ibadah shalat berjamaah lima waktu</li>
<li>Menyelenggarakan kajian ilmu dan pengajian rutin</li>
<li>Menjaga kebersihan dan kerapian masjid</li>
<li>Menggunakan masjid sebagai pusat kegiatan sosial dan kemasyarakatan</li>
<li>Mendidik generasi muda untuk mencintai masjid</li>
</ul>

<h2>Masjid sebagai Pusat Peradaban</h2>

<p>Pada zaman Rasulullah ﷺ, masjid berfungsi jauh lebih luas dari sekadar tempat shalat. Masjid adalah:</p>

<ul>
<li><strong>Pusat pendidikan</strong> — tempat para sahabat belajar Al-Qur\'an dan ilmu agama</li>
<li><strong>Pusat konsultasi</strong> — tempat masyarakat mendatangi Rasulullah untuk meminta fatwa dan nasihat</li>
<li><strong>Pusat sosial</strong> — tempat menampung kaum dhuafa, membagikan sedekah, dan merawat yang sakit</li>
<li><strong>Pusat diplomasi</strong> — tempat menerima delegasi dan membahas urusan umat</li>
</ul>

<h2>Peran Masjid Syatho Sedan</h2>

<p>Masjid Syatho Sedan berkomitmen untuk menjalankan fungsi tersebut dengan menyelenggarakan:</p>

<ol>
<li>Shalat berjamaah lima waktu dan Jumat</li>
<li>Kajian rutin mingguan bersama ustaz setempat</li>
<li>Taman Pendidikan Al-Qur\'an (TPQ) untuk anak-anak</li>
<li>Santunan anak yatim dan dhuafa</li>
<li>Pengumpulan dan penyaluran zakat, infaq, dan sedekah</li>
</ol>

<p>Kami mengundang seluruh warga untuk aktif berkontribusi dalam memakmurkan Masjid Syatho Sedan. Setiap amal kebaikan, sekecil apapun, akan dicatat oleh Allah ﷻ.</p>',
                'status' => 'published',
                'featured' => true,
                'views' => 247,
                'published_at' => now()->subDays(15),
                'category' => 'Berita Masjid',
                'tags' => ['dakwah', 'kajian'],
            ],

            // ── REGULAR ARTICLES ─────────────────────────────────────────────
            [
                'title' => 'Adab dan Keutamaan Membaca Al-Qur\'an',
                'excerpt' => 'Al-Qur\'an adalah kalamullah yang mulia. Membacanya dengan adab yang benar akan mendatangkan ketenangan hati dan pahala yang berlipat ganda.',
                'content' => '<p>Al-Qur\'an adalah firman Allah ﷻ yang diturunkan kepada Nabi Muhammad ﷺ melalui perantara Malaikat Jibril. Membaca Al-Qur\'an adalah ibadah yang paling agung dan mendatangkan ketenangan jiwa yang luar biasa.</p>

<p>Rasulullah ﷺ bersabda, <em>"Bacalah Al-Qur\'an, karena sesungguhnya ia akan menjadi syafaat bagi para pembacanya di hari kiamat."</em> (HR. Muslim)</p>

<h2>Adab Sebelum Membaca Al-Qur\'an</h2>

<ol>
<li><strong>Bersuci.</strong> Berwudhu terlebih dahulu adalah adab mulia, meski membaca tanpa wudhu hukumnya boleh bagi yang tidak memegang mushaf.</li>
<li><strong>Memilih tempat yang bersih dan tenang.</strong> Hindarkan membaca Al-Qur\'an di tempat yang kotor atau ramai.</li>
<li><strong>Menghadap kiblat.</strong> Dianjurkan menghadap kiblat saat membaca sebagai bentuk penghormatan.</li>
<li><strong>Membaca ta\'awudz dan basmalah.</strong> Mulailah dengan "A\'udzu billahi minasy-syaithanir-rajim" kemudian "Bismillahirrahmanirrahim".</li>
</ol>

<h2>Adab Ketika Membaca Al-Qur\'an</h2>

<ul>
<li>Membaca dengan tartil (perlahan dan jelas) sesuai kaidah tajwid</li>
<li>Menghayati makna setiap ayat yang dibaca</li>
<li>Menangis atau berusaha menangis saat melewati ayat tentang siksa Allah</li>
<li>Tidak terburu-buru hanya mengejar khatam tanpa memahami isi</li>
</ul>

<h2>Keutamaan Membaca Al-Qur\'an</h2>

<p>Setiap huruf yang dibaca dari Al-Qur\'an bernilai sepuluh kebaikan. Rasulullah ﷺ bersabda, <em>"Aku tidak mengatakan \'Alif Lam Mim\' itu satu huruf, tetapi Alif satu huruf, Lam satu huruf, dan Mim satu huruf."</em> (HR. Tirmidzi)</p>

<p>Bayangkan betapa besar pahala yang terkumpul saat kita membaca satu halaman, satu juz, bahkan khatam Al-Qur\'an. Semoga Allah ﷻ menjadikan kita termasuk golongan Ahlul Qur\'an yang senantiasa dekat dengan Al-Qur\'an.</p>',
                'status' => 'published',
                'featured' => false,
                'views' => 189,
                'published_at' => now()->subDays(20),
                'category' => 'Kajian Islam',
                'tags' => ['quran', 'kajian'],
            ],

            [
                'title' => 'Panduan Lengkap Zakat Fitrah: Ketentuan dan Cara Membayar',
                'excerpt' => 'Zakat fitrah wajib ditunaikan setiap muslim menjelang Idul Fitri. Ketahui ketentuan, besaran, dan waktu yang tepat untuk membayarnya agar zakat Anda diterima Allah.',
                'content' => '<p>Zakat fitrah adalah zakat yang wajib ditunaikan oleh setiap muslim yang mampu pada bulan Ramadan hingga sebelum shalat Idul Fitri. Hukumnya <strong>fardhu \'ain</strong> bagi setiap muslim, termasuk bayi yang baru lahir dan orang tua yang sudah sepuh.</p>

<h2>Dasar Hukum Zakat Fitrah</h2>

<p>Ibnu Umar radhiyallahu \'anhuma berkata, <em>"Rasulullah ﷺ mewajibkan zakat fitrah satu sha\' kurma atau satu sha\' gandum bagi setiap hamba sahaya, orang merdeka, laki-laki, perempuan, anak kecil, maupun orang dewasa dari kalangan kaum muslimin."</em> (HR. Bukhari &amp; Muslim)</p>

<h2>Besaran Zakat Fitrah</h2>

<p>Besaran zakat fitrah adalah <strong>1 sha\'</strong> dari makanan pokok yang dikonsumsi, setara dengan kurang lebih <strong>2,5 kg</strong> atau <strong>3,5 liter</strong> beras.</p>

<p>Boleh juga membayar dengan uang senilai harga beras tersebut sesuai pendapat mayoritas ulama kontemporer, terutama untuk kemudahan distribusi.</p>

<h2>Waktu Pembayaran Zakat Fitrah</h2>

<table>
<thead><tr><th>Waktu</th><th>Status</th></tr></thead>
<tbody>
<tr><td>Awal Ramadan hingga malam Idul Fitri</td><td>Boleh (ta\'jil)</td></tr>
<tr><td>Malam Idul Fitri hingga sebelum shalat Id</td><td>Waktu utama (wajib)</td></tr>
<tr><td>Setelah shalat Id hingga matahari terbenam</td><td>Makruh</td></tr>
<tr><td>Setelah hari Idul Fitri</td><td>Haram, wajib diqadha</td></tr>
</tbody>
</table>

<h2>Cara Membayar Zakat Fitrah di Masjid Syatho Sedan</h2>

<p>Panitia Zakat Masjid Syatho Sedan membuka penerimaan zakat fitrah mulai <strong>1 Ramadan</strong>. Pembayaran dapat dilakukan:</p>

<ul>
<li>Langsung ke panitia di masjid</li>
<li>Melalui transfer ke rekening masjid (hubungi pengurus untuk informasi rekening)</li>
</ul>

<p>Zakat yang terkumpul akan disalurkan kepada delapan golongan yang berhak menerima zakat (<em>asnaf</em>), dengan prioritas fakir miskin di sekitar wilayah Sedan.</p>',
                'status' => 'published',
                'featured' => false,
                'views' => 275,
                'published_at' => now()->subDays(25),
                'category' => 'Zakat & Infaq',
                'tags' => ['zakat', 'ramadan'],
            ],

            [
                'title' => 'Hikmah di Balik Ibadah Puasa Ramadan',
                'excerpt' => 'Puasa bukan sekadar menahan lapar dan dahaga. Di balik ibadah ini tersimpan hikmah yang luar biasa bagi kesehatan jiwa, raga, dan kehidupan sosial umat Islam.',
                'content' => '<p>Puasa Ramadan adalah salah satu rukun Islam yang wajib dilaksanakan oleh setiap muslim yang baligh, berakal, sehat, dan mukim. Namun puasa bukan sekadar ritual tahunan — ia adalah madrasah (sekolah) jiwa yang mendidik kita menjadi insan yang lebih baik.</p>

<h2>Hikmah Spiritual Puasa</h2>

<p>Allah ﷻ menyebutkan tujuan puasa dengan jelas: <em>"Wahai orang-orang yang beriman, diwajibkan atas kamu berpuasa sebagaimana diwajibkan atas orang-orang sebelum kamu agar kamu bertakwa."</em> (QS. Al-Baqarah: 183)</p>

<p><strong>Taqwa</strong> adalah buah tertinggi dari puasa. Dengan menahan nafsu makan dan minum, kita melatih diri untuk menundukkan keinginan demi ridha Allah.</p>

<h2>Hikmah Sosial Puasa</h2>

<p>Puasa mengajarkan empati terhadap saudara-saudara kita yang kurang beruntung. Dengan merasakan lapar dan dahaga, hati kita tergerak untuk berbagi kepada mereka yang senantiasa merasakan kondisi tersebut setiap harinya.</p>

<p>Ramadan juga mempererat silaturahmi melalui:</p>
<ul>
<li>Buka puasa bersama (iftar jama\'i)</li>
<li>Sahur bersama keluarga</li>
<li>Shalat Tarawih berjamaah di masjid</li>
</ul>

<h2>Hikmah Kesehatan Puasa</h2>

<p>Penelitian ilmiah modern telah membuktikan berbagai manfaat kesehatan dari puasa, di antaranya:</p>

<ol>
<li><strong>Detoksifikasi.</strong> Sistem pencernaan beristirahat dan membersihkan diri dari racun.</li>
<li><strong>Pengendalian berat badan.</strong> Puasa membantu mengatur pola makan dan metabolisme tubuh.</li>
<li><strong>Peremajaan sel.</strong> Proses <em>autophagy</em> (pembersihan sel rusak) meningkat selama puasa.</li>
<li><strong>Kesehatan mental.</strong> Pengendalian nafsu melatih kedisiplinan dan fokus mental.</li>
</ol>

<h2>Menjaga Kualitas Puasa</h2>

<p>Rasulullah ﷺ memperingatkan, <em>"Betapa banyak orang yang berpuasa namun tidak mendapat apa-apa dari puasanya kecuali lapar dan dahaga."</em> (HR. Ibnu Majah)</p>

<p>Jagalah puasa dari hal-hal yang merusak kualitasnya: berbohong, menggosip, marah-marah, dan membuang waktu untuk hal yang tidak bermanfaat.</p>',
                'status' => 'published',
                'featured' => false,
                'views' => 163,
                'published_at' => now()->subDays(30),
                'category' => 'Ibadah',
                'tags' => ['puasa', 'ramadan', 'kajian'],
            ],

            [
                'title' => 'Pentingnya Pendidikan Agama Islam Sejak Dini',
                'excerpt' => 'Investasi terbaik bagi anak adalah pendidikan agama yang kuat. Generasi yang bertakwa adalah warisan paling berharga yang bisa kita tinggalkan untuk masa depan.',
                'content' => '<p>Rasulullah ﷺ bersabda, <em>"Setiap anak dilahirkan dalam keadaan fitrah. Maka kedua orang tuanyalah yang menjadikannya Yahudi, Nasrani, atau Majusi."</em> (HR. Bukhari &amp; Muslim)</p>

<p>Hadits ini menegaskan betapa besar pengaruh lingkungan dan pendidikan terhadap perkembangan agama seorang anak. Orang tua adalah madrasah pertama dan utama bagi buah hati mereka.</p>

<h2>Mengapa Pendidikan Agama Harus Dimulai Sejak Dini?</h2>

<ul>
<li><strong>Masa emas perkembangan otak.</strong> Usia 0–7 tahun adalah masa di mana otak anak menyerap informasi dengan sangat cepat seperti spons.</li>
<li><strong>Membentuk karakter dasar.</strong> Nilai-nilai yang ditanamkan sejak kecil akan menjadi fondasi kepribadian yang sulit tergoyahkan.</li>
<li><strong>Membangun kecintaan terhadap Islam.</strong> Anak yang tumbuh dengan Al-Qur\'an dan sunnah akan memiliki rasa cinta yang tulus terhadap agamanya.</li>
</ul>

<h2>Program TPQ Masjid Syatho Sedan</h2>

<p>Masjid Syatho Sedan menyelenggarakan <strong>Taman Pendidikan Al-Qur\'an (TPQ)</strong> setiap hari Senin hingga Sabtu ba\'da Ashar. Program ini mencakup:</p>

<ol>
<li>Pembelajaran Iqra\' dan Al-Qur\'an dengan metode tartil</li>
<li>Hafalan surah-surah pendek (Juz \'Amma)</li>
<li>Pembelajaran doa-doa harian</li>
<li>Pengenalan akidah dan akhlak dasar</li>
<li>Kisah-kisah para nabi dan sahabat</li>
</ol>

<h2>Peran Orang Tua dalam Pendidikan Agama</h2>

<p>TPQ adalah pelengkap, bukan pengganti peran orang tua. Di rumah, orang tua perlu:</p>

<ul>
<li>Menjadi teladan dalam beribadah</li>
<li>Membiasakan membaca Al-Qur\'an bersama setiap hari</li>
<li>Mengajarkan doa-doa harian dalam setiap aktivitas</li>
<li>Bercerita tentang kisah-kisah teladan dari Al-Qur\'an dan Sunnah</li>
</ul>

<p>Daftarkan putra-putri Anda di TPQ Masjid Syatho Sedan. Hubungi pengurus masjid untuk informasi lebih lanjut. Investasi terbaik untuk anak adalah pendidikan agama yang kokoh.</p>',
                'status' => 'published',
                'featured' => false,
                'views' => 134,
                'published_at' => now()->subDays(40),
                'category' => 'Pendidikan',
                'tags' => ['dakwah', 'kajian'],
            ],

            [
                'title' => 'Kegiatan Bakti Sosial Masjid Syatho Sedan',
                'excerpt' => 'Masjid Syatho Sedan baru-baru ini menggelar kegiatan bakti sosial berupa santunan anak yatim dan pembagian sembako kepada warga kurang mampu di sekitar kelurahan Sedan.',
                'content' => '<p>Alhamdulillah, pada bulan ini Masjid Syatho Sedan kembali menyelenggarakan kegiatan bakti sosial yang melibatkan partisipasi aktif jamaah dan warga sekitar. Kegiatan ini merupakan wujud nyata dari semangat gotong royong dan kepedulian sosial yang senantiasa kami jaga.</p>

<h2>Rangkaian Kegiatan</h2>

<h3>Santunan Anak Yatim</h3>
<p>Sebanyak <strong>45 anak yatim</strong> dari wilayah Sedan mendapatkan santunan berupa uang tunai dan perlengkapan sekolah. Kegiatan ini merupakan agenda rutin masjid yang dilaksanakan setiap tiga bulan sekali.</p>

<h3>Pembagian Sembako</h3>
<p>Lebih dari <strong>80 paket sembako</strong> berhasil terkumpul dari donasi jamaah dan didistribusikan kepada keluarga kurang mampu di lingkungan sekitar masjid. Paket sembako berisi beras, minyak goreng, gula, dan kebutuhan pokok lainnya.</p>

<h3>Pemeriksaan Kesehatan Gratis</h3>
<p>Bekerja sama dengan Puskesmas setempat, masjid juga menyelenggarakan pemeriksaan kesehatan gratis meliputi cek tekanan darah, gula darah, dan konsultasi kesehatan umum.</p>

<h2>Ucapan Terima Kasih</h2>

<p>Pengurus Masjid Syatho Sedan mengucapkan terima kasih yang sebesar-besarnya kepada:</p>
<ul>
<li>Seluruh jamaah yang telah berdonasi</li>
<li>Para relawan yang membantu persiapan dan distribusi</li>
<li>Pihak Puskesmas Sedan yang telah bersedia bekerja sama</li>
<li>Perangkat desa yang membantu dalam pendataan warga</li>
</ul>

<p>Semoga amal kebaikan kita semua diterima oleh Allah ﷻ dan menjadi investasi pahala yang terus mengalir. Kegiatan serupa akan terus kami adakan secara rutin. Bagi yang ingin berpartisipasi sebagai donatur atau relawan, silakan hubungi pengurus masjid.</p>',
                'status' => 'published',
                'featured' => false,
                'views' => 221,
                'published_at' => now()->subDays(8),
                'category' => 'Sosial',
                'tags' => ['sedekah', 'dakwah'],
            ],

            [
                'title' => 'Tata Cara Shalat Jumat yang Benar Sesuai Sunnah',
                'excerpt' => 'Shalat Jumat adalah kewajiban setiap muslim laki-laki yang merdeka, baligh, berakal, dan mukim. Ketahui tata cara pelaksanaannya yang benar sesuai tuntunan Rasulullah.',
                'content' => '<p>Shalat Jumat adalah ibadah mingguan yang memiliki kedudukan sangat istimewa dalam Islam. Allah ﷻ bahkan mengabadikan satu surah dalam Al-Qur\'an dengan nama "Al-Jumu\'ah" dan secara khusus memerintahkan kaum beriman untuk segera menuju masjid ketika azan Jumat dikumandangkan.</p>

<h2>Hukum Shalat Jumat</h2>

<p>Shalat Jumat hukumnya <strong>fardhu \'ain</strong> bagi setiap laki-laki muslim yang: mukallaf, merdeka, sehat, dan mukim (tidak dalam perjalanan jauh). Rasulullah ﷺ memperingatkan dengan keras mereka yang meninggalkan Jumat tanpa uzur.</p>

<h2>Syarat Sah Shalat Jumat</h2>

<ul>
<li>Dilaksanakan pada waktu Zuhur</li>
<li>Dilaksanakan di wilayah yang ada penduduknya</li>
<li>Didahului oleh dua khutbah</li>
<li>Dihadiri minimal 40 orang (menurut pendapat Syafi\'i) atau cukup minimal 3 orang (menurut pendapat lain)</li>
</ul>

<h2>Adab dan Sunnah Hari Jumat</h2>

<ol>
<li><strong>Mandi Jumat.</strong> Sangat dianjurkan mandi sebelum berangkat shalat Jumat.</li>
<li><strong>Memakai pakaian terbaik.</strong> Utamakan pakaian berwarna putih.</li>
<li><strong>Memakai wangi-wangian.</strong> Gunakan parfum atau wewangian yang halal.</li>
<li><strong>Berangkat lebih awal.</strong> Semakin awal tiba, semakin besar pahala yang didapat.</li>
<li><strong>Memperbanyak shalawat.</strong> Rasulullah ﷺ menganjurkan memperbanyak shalawat pada hari Jumat.</li>
<li><strong>Membaca Surah Al-Kahfi.</strong> Membaca Al-Kahfi pada hari Jumat mendatangkan cahaya dari Jumat ke Jumat berikutnya.</li>
</ol>

<h2>Hal yang Dilarang Saat Khutbah</h2>

<p>Ketika khatib sedang berkhutbah, jamaah wajib:</p>
<ul>
<li>Diam dan mendengarkan khutbah</li>
<li>Tidak berbicara sepatah kata pun, termasuk menegur orang yang berbicara</li>
<li>Menghadap ke arah khatib</li>
</ul>

<p>Masjid Syatho Sedan menyelenggarakan shalat Jumat dengan khutbah dua bahasa (Arab dan Indonesia) agar seluruh jamaah dapat memahami dan mengambil manfaat dari nasihat yang disampaikan.</p>',
                'status' => 'published',
                'featured' => false,
                'views' => 198,
                'published_at' => now()->subDays(35),
                'category' => 'Ibadah',
                'tags' => ['shalat', 'fiqih'],
            ],

            [
                'title' => 'Keutamaan dan Tata Cara Bersedekah dalam Islam',
                'excerpt' => 'Sedekah adalah salah satu amalan terbaik dalam Islam yang tidak hanya mendatangkan pahala akhirat, tetapi juga keberkahan di dunia. Tidak ada sedekah yang mengurangi harta.',
                'content' => '<p>Sedekah adalah pemberian sukarela kepada orang lain semata-mata karena mengharap ridha Allah ﷻ. Berbeda dengan zakat yang memiliki ketentuan nisab dan haul, sedekah dapat diberikan kapan saja, berapa saja, dan dalam bentuk apa saja.</p>

<h2>Keutamaan Sedekah dalam Al-Qur\'an dan Hadits</h2>

<p>Allah ﷻ berfirman, <em>"Perumpamaan orang-orang yang menginfakkan hartanya di jalan Allah seperti sebutir biji yang menumbuhkan tujuh tangkai, pada setiap tangkai ada seratus biji. Allah melipatgandakan bagi siapa yang Dia kehendaki."</em> (QS. Al-Baqarah: 261)</p>

<p>Rasulullah ﷺ bersabda, <em>"Sedekah tidak mengurangi harta."</em> (HR. Muslim). Sebaliknya, sedekah mendatangkan keberkahan dan pertambahan rezeki yang tidak terduga.</p>

<h2>Jenis-Jenis Sedekah</h2>

<ul>
<li><strong>Sedekah harta</strong> — memberikan uang, makanan, pakaian, atau barang lainnya</li>
<li><strong>Sedekah tenaga</strong> — membantu orang lain dengan tenaga dan kemampuan</li>
<li><strong>Sedekah ilmu</strong> — mengajarkan ilmu yang bermanfaat</li>
<li><strong>Sedekah senyum</strong> — Rasulullah ﷺ bersabda bahwa senyum kepada saudara adalah sedekah</li>
<li><strong>Sedekah jariyah</strong> — sedekah yang pahalanya terus mengalir seperti membangun masjid atau sumur</li>
</ul>

<h2>Cara Bersedekah yang Benar</h2>

<ol>
<li>Niatkan ikhlas semata-mata karena Allah, bukan untuk pujian atau pamer</li>
<li>Berikan yang terbaik, bukan yang sudah tidak terpakai</li>
<li>Utamakan orang-orang terdekat: keluarga, tetangga, lingkungan sekitar</li>
<li>Jangan mengungkit sedekah yang telah diberikan</li>
<li>Bersedekah dalam keadaan lapang maupun sempit</li>
</ol>

<p>Masjid Syatho Sedan membuka kotak amal dan program sedekah jariyah untuk pembangunan dan operasional masjid. Mari bersama-sama kita investasikan harta kita untuk kebaikan yang abadi.</p>',
                'status' => 'published',
                'featured' => false,
                'views' => 156,
                'published_at' => now()->subDays(45),
                'category' => 'Kajian Islam',
                'tags' => ['sedekah', 'kajian'],
            ],

            // ── DRAFTS ─────────────────────────────────────────────────────────
            [
                'title' => 'Tips Mencapai Kekhusyukan dalam Shalat',
                'excerpt' => 'Kekhusyukan adalah ruh dari shalat. Tanpa kekhusyukan, shalat hanyalah gerakan fisik tanpa makna. Berikut tips praktis agar kita bisa lebih khusyuk dalam shalat.',
                'content' => '<p>Khusyuk dalam shalat adalah impian setiap muslim. Allah ﷻ memuji orang-orang yang khusyuk dalam shalatnya: <em>"Sesungguhnya beruntunglah orang-orang yang beriman, yaitu orang-orang yang khusyuk dalam shalatnya."</em> (QS. Al-Mu\'minun: 1-2)</p>

<h2>Mengapa Kekhusyukan Sulit Dicapai?</h2>

<p>Salah satu sebab utama sulitnya khusyuk adalah <em>was-was</em> (bisikan setan) dan pikiran yang melanglang buana. Ibnu Al-Qayyim menyebutkan bahwa setan sangat bersemangat mengganggu manusia justru di saat shalat, karena shalat adalah sarana komunikasi langsung antara hamba dan Allah.</p>

<h2>Tips Meraih Kekhusyukan</h2>

<ol>
<li><strong>Persiapan sebelum shalat.</strong> Wudhu dengan sempurna, pakai pakaian yang baik, dan tinggalkan urusan dunia sejenak.</li>
<li><strong>Sadari bahwa kita sedang menghadap Allah.</strong> Bayangkan bahwa Allah ﷻ melihat dan mendengar setiap bacaan dan gerakan kita.</li>
<li><strong>Pahami makna bacaan shalat.</strong> Pelajari arti dari setiap doa dan dzikir dalam shalat agar hati turut merasakan apa yang diucapkan lisan.</li>
<li><strong>Perlambat gerakan shalat.</strong> Tuma\'ninah (tenang) adalah rukun shalat yang sering diabaikan.</li>
<li><strong>Hindari shalat dalam keadaan menahan buang air.</strong> Persiapkan diri agar fokus tidak terpecah.</li>
</ol>

<p>[Artikel ini masih dalam proses penyelesaian]</p>',
                'status' => 'draft',
                'featured' => false,
                'views' => 0,
                'published_at' => null,
                'category' => 'Ibadah',
                'tags' => ['shalat', 'kajian'],
            ],

            [
                'title' => 'Mengenal Lebih Dekat Aqidah Islam: Rukun Iman',
                'excerpt' => 'Aqidah adalah fondasi keislaman seorang muslim. Rukun iman yang enam merupakan hal-hal yang wajib diyakini sepenuh hati oleh setiap muslim.',
                'content' => '<p>Aqidah secara bahasa berarti ikatan atau keyakinan yang kuat. Secara istilah, aqidah Islam adalah perkara-perkara yang wajib diyakini oleh setiap muslim dengan yakin tanpa keraguan sedikitpun.</p>

<h2>Enam Rukun Iman</h2>

<p>Rukun iman yang enam adalah:</p>

<ol>
<li><strong>Iman kepada Allah</strong> — meyakini keesaan Allah dalam dzat, sifat, dan perbuatan-Nya</li>
<li><strong>Iman kepada Malaikat</strong> — meyakini keberadaan malaikat sebagai makhluk dari cahaya yang senantiasa taat</li>
<li><strong>Iman kepada Kitab-kitab</strong> — meyakini semua kitab suci yang diturunkan Allah, dengan Al-Qur\'an sebagai yang terakhir dan paling sempurna</li>
<li><strong>Iman kepada Para Rasul</strong> — meyakini semua nabi dan rasul, dengan Nabi Muhammad ﷺ sebagai yang terakhir</li>
<li><strong>Iman kepada Hari Akhir</strong> — meyakini datangnya hari kiamat, hari perhitungan, surga, dan neraka</li>
<li><strong>Iman kepada Qadha dan Qadar</strong> — meyakini bahwa segala sesuatu terjadi atas kehendak dan ketetapan Allah</li>
</ol>

<p>[Artikel ini masih dalam proses penulisan. Akan dilengkapi segera.]</p>',
                'status' => 'draft',
                'featured' => false,
                'views' => 0,
                'published_at' => null,
                'category' => 'Kajian Islam',
                'tags' => ['akidah', 'kajian'],
            ],
        ];

        foreach ($articleData as $data) {
            $categoryName = $data['category'];
            $tagNames = $data['tags'];

            unset($data['category'], $data['tags']);

            $categoryModel = $categories->get($categoryName);
            $data['category_id'] = $categoryModel?->id;
            $data['user_id'] = $admin->id;
            $data['slug'] = Str::slug($data['title']);

            $article = Article::create($data);

            $tagIds = $tags->only($tagNames)->pluck('id');
            $article->tags()->attach($tagIds);
        }
    }
}

# INCLUDES
# login
Kode di atas adalah bagian dari halaman login untuk aplikasi Twitter. Berikut adalah penjelasan singkatnya:

1. **Validasi Metode Permintaan:**
   - Jika metode permintaan adalah GET dan alamat file sama dengan alamat skrip, pengguna akan diarahkan kembali ke halaman indeks (`index.php`).

2. **Proses Login:**
   - Jika tombol login (`login`) dikirimkan melalui formulir dan tidak kosong, maka proses login akan dimulai.
   - Nilai dari formulir (alamat email dan kata sandi) akan dibersihkan menggunakan fungsi `checkInput` dari objek `$getFromU`.
   - Alamat email akan diverifikasi menggunakan fungsi `filter_var` dengan opsi `FILTER_VALIDATE_EMAIL`.
   - Jika alamat email valid, fungsi `login` dari objek `$getFromU` akan dipanggil untuk melakukan proses login. Jika tidak berhasil, pesan kesalahan disimpan.
   - Jika alamat email tidak valid, pesan kesalahan juga disimpan.

3. **Formulir HTML:**
   - Sebuah formulir login dengan dua bidang input (alamat email dan kata sandi) dan tombol login.
   - Input diapit dalam div dengan kelas "form-group" dan "form-row".
   - Pesan kesalahan ditampilkan di bawah formulir jika terjadi kesalahan saat login.

4. **Pesan Kesalahan:**
   - Jika terdapat pesan kesalahan (seperti format email yang tidak valid atau kegagalan login), pesan kesalahan akan ditampilkan di dalam sebuah div dengan kelas "alert alert-danger".

5. **HTML Styling:**
   - Pengaturan tata letak dan gaya menggunakan Bootstrap CSS classes.

6. **Catatan:**
   - Sebagian dari kode yang terkomentari (`<!-- ... -->`) adalah bagian yang dinonaktifkan (tidak aktif) dan mungkin merupakan bagian formulir alternatif atau perubahan pada tata letak.
# log out
Kode di atas merupakan bagian dari proses logout pada aplikasi Twitter. Berikut adalah penjelasan singkatnya:

1. **Include File Init:**
   - Mengimpor file `init.php` yang berisi inisialisasi dan konfigurasi dasar untuk aplikasi.

2. **Panggil Fungsi Logout:**
   - Memanggil fungsi `logout()` dari objek `$getFromU`.
   - Fungsi ini bertanggung jawab untuk melakukan proses logout, seperti menghapus sesi atau mengatur variabel yang diperlukan.

3. **Periksa Status Login Setelah Logout:**
   - Memeriksa status login setelah proses logout menggunakan `loggedIn()` dari objek `$getFromU`.
   - Jika pengguna tidak lagi terautentikasi (logged in), pengguna akan diarahkan kembali ke halaman indeks (`index.php`) menggunakan fungsi `header()`.

**Catatan:**
   - Fungsi `logout()` seharusnya sudah menangani proses logout dengan membersihkan sesi dan variabel sesuai kebutuhan.
   - Penggunaan `header('Location: ...')` digunakan untuk mengarahkan pengguna ke halaman lain setelah proses logout.
# sign up-form
Kode di atas merupakan bagian dari proses pendaftaran (signup) pada aplikasi Twitter. Berikut adalah penjelasan singkatnya:

1. **Validasi Metode Permintaan (Request Method):**
   - Memeriksa apakah metode permintaan adalah POST dan apakah file ini sama dengan file yang diminta oleh server. Jika tidak, maka pengguna akan diarahkan kembali ke halaman indeks.

2. **Pengecekan Tombol Signup:**
   - Memeriksa apakah tombol signup (`$_POST['signup']`) telah ditekan.
   - Mengambil data dari formulir, seperti nama pengguna (`screenName`), email, dan kata sandi.
   - Melakukan validasi pada kolom-kolom tersebut, seperti memastikan tidak ada yang kosong, format email benar, panjang nama pengguna sesuai, dan panjang kata sandi memenuhi syarat.

3. **Proses Pendaftaran:**
   - Jika tidak ada kesalahan validasi, data pengguna baru disiapkan dan disimpan ke database menggunakan fungsi `$getFromU->create('users', ...)`.
   - Sesuai dengan langkah-langkah pendaftaran, sesi pengguna (`$_SESSION['user_id']`) diatur dan pengguna diarahkan ke langkah selanjutnya (`header('Location: includes/signup.php?step=1')`).
  
4. **Formulir Pendaftaran:**
   - Terdapat komentar HTML yang menunjukkan sebuah formulir pendaftaran. Namun, form tersebut dijelaskan sebagai komentar dan tidak aktif.

5. **Pesan Kesalahan:**
   - Jika ada kesalahan selama proses pendaftaran, pesan kesalahan ditampilkan dalam elemen `div` dengan kelas `alert alert-danger`.

6. **Script Pengaturan Waktu (Timeout):**
   - Mengandung script JavaScript untuk menutup pesan kesalahan setelah 3.5 detik dengan menggunakan `setTimeout` dan `$('#alert').alert('close')`. Namun, elemen dengan id `alert` tidak terlihat dalam potongan kode yang diberikan.

**Catatan:**
   - Proses pendaftaran seharusnya melibatkan langkah-langkah keamanan seperti enkripsi kata sandi dengan algoritma yang lebih kuat dan perlindungan terhadap SQL injection.

# signup
Kode di atas merupakan bagian dari proses pendaftaran lanjutan pada aplikasi Twitter. Berikut penjelasan singkatnya:

1. **Validasi Parameter `$_GET['step']`:**
   - Memeriksa apakah parameter `step` pada URL telah diatur dan tidak kosong. Jika tidak, maka seharusnya tidak menampilkan konten pada file ini dan mengarahkan pengguna kembali ke halaman indeks.

2. **Pengecekan Sesi dan Data Pengguna:**
   - Memeriksa apakah pengguna sudah masuk (sesi pengguna `$_SESSION['user_id']` telah diatur).
   - Mengambil data pengguna menggunakan `$getFromU->userData($user_id)`.

3. **Pengaturan Langkah Pendaftaran (`$step`):**
   - Menggunakan nilai parameter `step` untuk menentukan langkah pendaftaran selanjutnya.
   - Jika `step` sama dengan '1', menampilkan formulir untuk memilih nama pengguna (`username`).
   - Jika `step` sama dengan '2', menampilkan informasi selamat datang setelah memilih nama pengguna.

4. **Pemrosesan Formulir (`$_POST['next']`):**
   - Memeriksa apakah formulir telah dikirim dengan mengecek ketersediaan `$_POST['next']`.
   - Memvalidasi input nama pengguna (`username`), memastikan tidak kosong, sesuai panjang, dan tidak mengandung karakter khusus.
   - Jika valid, memperbarui data pengguna di database dan mengarahkan pengguna ke langkah pendaftaran selanjutnya (`signup.php?step=2`).
   - Jika tidak valid, menampilkan pesan kesalahan.

5. **HTML dan CSS:**
   - Menampilkan struktur HTML dan beberapa elemen CSS untuk tata letak dan tampilan halaman.
   - Menggunakan ikon Twitter dan beberapa elemen tata letak dari Twitter.

6. **Navigasi dan Tautan:**
   - Menampilkan tombol kembali (`Let's go!`) untuk melanjutkan ke halaman utama setelah menyelesaikan langkah pendaftaran.

7. **Pesan Kesalahan:**
   - Menampilkan pesan kesalahan jika terjadi kesalahan dalam proses pendaftaran.


# MAINNN
# Followers
Kode di atas adalah bagian dari halaman profil pengguna Twitter yang menampilkan daftar pengguna yang mengikuti pengguna tertentu. Berikut adalah penjelasan singkatnya:

1. **Validasi Parameter `$_GET['username']`:**
   - Memeriksa apakah parameter `username` pada URL telah diatur dan tidak kosong.
   - Mengambil dan memproses data pengguna berdasarkan nama pengguna (`username`) dari URL.
   - Memeriksa apakah pengguna yang dimaksud ada. Jika tidak, mengarahkan pengguna kembali ke halaman beranda.

2. **Pengecekan Sesi dan Data Pengguna:**
   - Memeriksa apakah pengguna telah masuk (sesi pengguna `$_SESSION['user_id']` telah diatur).
   - Mengambil data pengguna yang sedang dilihat (`$profileData`) dan data pengguna yang masuk (`$user`).

3. **HTML dan CSS:**
   - Menampilkan struktur HTML untuk halaman profil dan menggunakan beberapa elemen CSS untuk tata letak dan tampilan halaman.

4. **Informasi Profil Pengguna:**
   - Menampilkan informasi profil pengguna yang sedang dilihat, termasuk gambar sampul, gambar profil, nama pengguna, nama lengkap, bio, tautan situs web, dan lokasi.
   - Menampilkan jumlah pengikut, jumlah yang diikuti, dan jumlah tweet pengguna.

5. **Daftar Pengikut:**
   - Menampilkan daftar pengguna yang mengikuti pengguna yang sedang dilihat (`$profileData`).
   - Menggunakan metode `$getFromF->followersList()` untuk menampilkan daftar pengikut dengan tautan ke profil masing-masing.

6. **Script JavaScript:**
   - Memuat berbagai skrip JavaScript untuk meng-handle interaksi pengguna seperti menyukai, me-retweet, menghapus tweet, dan menampilkan popup.

7. **Tautan ke Skrip JavaScript Eksternal:**
   - Memuat beberapa skrip JavaScript eksternal untuk fitur-fitur seperti pencarian, hashtag, pengikut, dll.

8. **Pembaruan Otomatis:**
   - Memuat skrip JavaScript untuk memperbarui notifikasi secara otomatis.

# following
Kode di atas adalah bagian dari halaman yang menampilkan daftar pengguna yang diikuti oleh seorang pengguna Twitter tertentu. Berikut adalah penjelasan singkatnya:

1. **Validasi Parameter `$_GET['username']`:**
   - Memeriksa apakah parameter `username` pada URL telah diatur dan tidak kosong.
   - Mengambil dan memproses data pengguna berdasarkan nama pengguna (`username`) dari URL.
   - Memeriksa apakah pengguna yang dimaksud ada. Jika tidak, mengarahkan pengguna kembali ke halaman beranda.

2. **Pengecekan Sesi dan Data Pengguna:**
   - Memeriksa apakah pengguna telah masuk (sesi pengguna `$_SESSION['user_id']` telah diatur).
   - Mengambil data pengguna yang sedang dilihat (`$profileData`) dan data pengguna yang masuk (`$user`).

3. **HTML dan CSS:**
   - Menampilkan struktur HTML untuk halaman profil dan menggunakan beberapa elemen CSS untuk tata letak dan tampilan halaman.

4. **Informasi Profil Pengguna:**
   - Menampilkan informasi profil pengguna yang sedang dilihat, termasuk gambar sampul, gambar profil, nama pengguna, nama lengkap, bio, tautan situs web, dan lokasi.
   - Menampilkan jumlah pengikut, jumlah yang diikuti, dan jumlah tweet pengguna.

5. **Daftar Pengguna yang Diikuti:**
   - Menampilkan daftar pengguna yang diikuti oleh pengguna yang sedang dilihat (`$profileData`).
   - Menggunakan metode `$getFromF->followingList()` untuk menampilkan daftar pengguna yang diikuti dengan tautan ke profil masing-masing.

6. **Script JavaScript:**
   - Memuat berbagai skrip JavaScript untuk meng-handle interaksi pengguna seperti menyukai, me-retweet, menghapus tweet, dan menampilkan popup.

7. **Tautan ke Skrip JavaScript Eksternal:**
   - Memuat beberapa skrip JavaScript eksternal untuk fitur-fitur seperti pencarian, hashtag, pengikut, dll.

8. **Pembaruan Otomatis:**
   - Memuat skrip JavaScript untuk memperbarui notifikasi secara otomatis.

# hashtag
Kode di atas merupakan halaman yang menampilkan tweet yang terkait dengan sebuah hashtag pada platform mirip Twitter. Berikut adalah penjelasan singkatnya:

1. **Validasi Parameter `$_GET['hashtag']`:**
   - Memeriksa apakah parameter `hashtag` pada URL telah diatur dan tidak kosong.
   - Mengambil dan memproses data hashtag dari URL.
   - Mengambil data pengguna dan notifikasi.

2. **HTML dan CSS:**
   - Menampilkan struktur HTML untuk halaman hashtag dan menggunakan beberapa elemen CSS untuk tata letak dan tampilan halaman.

3. **Navigasi dan Pencarian:**
   - Menampilkan tombol navigasi dan pencarian di bagian atas halaman.
   - Menampilkan jumlah notifikasi.

4. **Daftar Tweet:**
   - Menampilkan daftar tweet yang terkait dengan hashtag.
   - Memisahkan tweet berdasarkan kategori seperti "Latest," "Accounts," dan "Photos."

5. **Pengguna yang Diikuti:**
   - Jika kategori adalah "Accounts," menampilkan daftar pengguna yang terkait dengan hashtag.

6. **Pop-up untuk Tweet:**
   - Menampilkan pop-up untuk melihat detail tweet saat tombol tweet di-klik.

7. **Skrip JavaScript:**
   - Menghubungkan berbagai skrip JavaScript untuk meng-handle interaksi pengguna seperti retweet, like, popup tweet, delete tweet, dan fungsi pencarian.

8. **Pembaruan Otomatis dan Notifikasi:**
   - Memuat skrip JavaScript untuk memperbarui notifikasi secara otomatis.
   - Menangani pembaruan otomatis untuk tweet dan notifikasi.

9. **Hashtag Menu:**
   - Menampilkan menu untuk memfilter tweet berdasarkan kategori seperti "Latest," "Accounts," dan "Photos."

10. **Pemrosesan Tweet:**
   - Menampilkan tweet beserta informasi seperti pengguna yang membuat tweet, waktu, dan interaksi pengguna seperti retweet dan like.

11. **Pemrosesan Akun Pengguna:**
   - Jika kategori adalah "Accounts," menampilkan daftar pengguna dengan informasi profil dan tombol follow.

12. **Pencarian dan Pembaruan Otomatis:**
   - Memuat skrip JavaScript untuk pencarian dan pembaruan otomatis.

13. **Pemanggilan Skrip Eksternal:**
   - Memuat berbagai skrip JavaScript eksternal untuk fitur-fitur seperti pop-up tweet, delete tweet, retweet, like, pencarian, dan notifikasi.

Kode ini menciptakan antarmuka pengguna yang mirip dengan Twitter untuk menavigasi dan berinteraksi dengan tweet yang berhubungan dengan hashtag tertentu.

# home
Kode di atas merupakan halaman utama (home) pada aplikasi mirip Twitter. Berikut adalah penjelasan singkatnya:

1. **Pengecekan Login:**
   - Mengecek apakah pengguna sudah login. Jika tidak, pengguna akan diarahkan ke halaman login.

2. **Pengolahan Tweet Baru:**
   - Meng-handle pengiriman tweet baru yang diketikkan oleh pengguna.
   - Memvalidasi panjang tweet dan mengupload gambar jika ada.
   - Menambahkan hashtag dan mention ke dalam database.
   - Mengarahkan pengguna kembali ke halaman home setelah tweet terkirim.

3. **Struktur HTML:**
   - Membuat struktur HTML untuk halaman home.
   - Menggunakan Bootstrap untuk tata letak dan desain responsif.
   - Memuat berbagai skrip JavaScript untuk menangani interaksi pengguna.

4. **Tweet Box:**
   - Menampilkan kotak untuk membuat tweet baru.
   - Memungkinkan pengguna untuk menambahkan teks tweet dan memilih gambar.
   - Menampilkan pesan kesalahan jika ada.

5. **Daftar Tweet:**
   - Menampilkan daftar tweet yang sudah ada oleh pengguna dan pengguna yang diikuti.
   - Memuat skrip JavaScript untuk menangani like, retweet, tampilkan detail tweet, dan lainnya.

6. **Pemuatan Lebih Banyak Tweet:**
   - Menampilkan ikon loader saat pemuatan tweet lebih banyak sedang berlangsung.
   - Memuat skrip JavaScript untuk pemuatan tweet secara dinamis saat pengguna mencapai bagian bawah halaman.

7. **Popup Tweet dan Interaksi:**
   - Menampilkan popup untuk melihat detail tweet saat tombol tweet di-klik.
   - Memuat skrip JavaScript untuk menangani like, retweet, komentar, dan tampilkan notifikasi.

8. **Pemanggilan Skrip Eksternal:**
   - Memuat berbagai skrip JavaScript eksternal untuk fitur-fitur seperti like, retweet, popup tweet, delete tweet, comment, follow, dan notifikasi.

9. **Right Sidebar dan Fitur Tambahan:**
   - Menampilkan kolom sidebar sebelah kanan dengan fitur-fitur tambahan seperti trending hashtags, pengguna yang diikuti, dan fitur pencarian.

10. **Pembaruan Otomatis dan Notifikasi:**
   - Memuat skrip JavaScript untuk pembaruan otomatis dan notifikasi.

11. **Pemanggilan Skrip Bootstrap dan jQuery:**
   - Memuat skrip Bootstrap dan jQuery untuk mendukung tampilan dan fungsionalitas halaman.

12. **Pemuatan Lebih Banyak Tweet Saat Scroll:**
   - Mengaktifkan pemuatan tweet lebih banyak secara otomatis saat pengguna melakukan scroll ke bagian bawah halaman.

# index.php
Kode di atas adalah halaman utama untuk pengguna yang belum login ke aplikasi mirip Twitter. Berikut adalah penjelasan singkatnya:

1. **Pengecekan Login:**
   - Memeriksa apakah pengguna sudah login. Jika sudah, maka akan diarahkan langsung ke halaman home (`home.php`).

2. **Struktur HTML:**
   - Membuat struktur HTML untuk halaman utama.
   - Menggunakan Bootstrap untuk tata letak dan desain responsif.

3. **Pemuatan CSS dan JavaScript Eksternal:**
   - Memuat beberapa file CSS dan JavaScript eksternal, termasuk Font Awesome dan jQuery.

4. **Preloader:**
   - Menampilkan preloader sebelum halaman sepenuhnya dimuat. Preloader ini akan hilang setelah 3 detik.

5. **Container Utama:**
   - Membuat container utama dengan dua bagian: bagian kiri dan bagian kanan.

6. **Bagian Kiri (Left):**
   - Menampilkan beberapa elemen yang menjelaskan keuntungan menggunakan Twitter.
   - Terdapat ikon dan teks untuk "Follow your interests," "Hear what your people are talking about," dan "Join the conversation."

7. **Bagian Kanan (Right):**
   - Memuat file `login.php` untuk menampilkan formulir login.
   - Menampilkan elemen dengan ikon Twitter dan slogan untuk mengajak pengguna bergabung.
   - Memuat file `signup-form.php` untuk menampilkan formulir pendaftaran.

8. **Script untuk Preloader:**
   - Menambahkan skrip JavaScript untuk menyembunyikan preloader setelah 3 detik.

Halaman ini dirancang untuk memberikan gambaran umum tentang keuntungan menggunakan Twitter dan menawarkan formulir login dan pendaftaran bagi pengguna yang belum login.
# left-sidebar
Kode di atas adalah bagian dari tampilan sidebar pada halaman utama (home.php) atau profil pengguna (profile.php). Berikut adalah penjelasan singkatnya:

1. **Pengecekan Parameter URL:**
   - Memeriksa apakah parameter URL `username` ada dan tidak kosong.
   - Mengambil dan membersihkan nilai parameter `username`.
   - Jika data profil tidak ditemukan, pengguna akan diarahkan kembali ke halaman utama.

2. **Inisialisasi Data Pengguna:**
   - Mendapatkan data pengguna yang sedang aktif (jika ada).
   - Mendapatkan notifikasi terbaru untuk pengguna aktif.

3. **Sidebar:**
   - Menampilkan daftar menu sidebar dalam bentuk daftar tanpa gaya (list-style:none).
   - Menu meliputi: Home, Explore, Notifications, Messages, Profile, Settings, Logout, dan Tombol Tweet.
   - Tombol Login ditampilkan jika pengguna belum login.

4. **Profil Pengguna di Sidebar:**
   - Jika pengguna sudah login, menampilkan gambar profil, nama pengguna, dan username.
   - Memberikan tautan ke profil pengguna.

Kode ini bertanggung jawab untuk menampilkan elemen-elemen sidebar dengan mempertimbangkan status login pengguna dan memberikan tautan ke halaman-halaman terkait.
# profile
Kode di atas adalah bagian dari halaman profil pengguna (profile.php) pada aplikasi Twitter. Berikut adalah penjelasan singkatnya:

1. **Pengecekan Parameter URL:**
   - Memeriksa apakah parameter URL `username` ada dan tidak kosong.
   - Mengambil dan membersihkan nilai parameter `username`.
   - Mendapatkan data profil pengguna berdasarkan `username` dari URL.
   - Jika data profil tidak ditemukan, pengguna akan diarahkan kembali ke halaman utama.

2. **HTML dan CSS:**
   - Mendefinisikan struktur HTML dari halaman profil.
   - Menggunakan CSS dan beberapa ikon Font Awesome untuk tata letak dan gaya.

3. **Profil Pengguna:**
   - Menampilkan cover profil, gambar profil, dan informasi profil pengguna seperti nama, username, bio, website, lokasi, dan statistik pengikut.
   - Menampilkan tombol untuk mengikuti atau berhenti mengikuti pengguna tergantung pada status hubungan.

4. **Tweets:**
   - Menampilkan tweet-tweet pengguna dalam wrapper khusus.
   - Menggunakan JavaScript untuk menangani interaksi seperti menyukai, me-retweet, mengomentari, dan menampilkan popup tweet.

5. **Script dan Fungsi Lainnya:**
   - Memuat beberapa script JavaScript yang diperlukan untuk berbagai fungsi, seperti mencari dan menangani hashtag, serta berinteraksi dengan notifikasi dan pesan.

Kode ini bertanggung jawab untuk menampilkan halaman profil pengguna dengan informasi lengkap dan tweet terkait.
# profile edit
Kode di atas adalah halaman untuk mengedit profil pengguna (profileEdit.php) pada aplikasi Twitter. Berikut adalah penjelasan singkatnya:

1. **Pengecekan Status Login:**
   - Memastikan pengguna telah login sebelumnya. Jika tidak, pengguna akan diarahkan kembali ke halaman utama.

2. **Pemrosesan Form Edit:**
   - Menghandle form edit yang mencakup pembaruan nama, bio, lokasi, dan situs web pengguna.
   - Menggunakan fungsi `checkInput` untuk membersihkan input dan `update` untuk mengupdate data pengguna di database.
   - Jika ada kesalahan validasi, seperti nama terlalu panjang, deskripsi terlalu panjang, atau lokasi terlalu panjang, pesan kesalahan akan ditampilkan.

3. **Pembaruan Gambar Profil dan Sampul:**
   - Memproses unggahan gambar profil dan sampul.
   - Menggunakan fungsi `uploadImage` untuk mengunggah gambar dan mengupdate path gambar di database.

4. **HTML dan CSS:**
   - Mendefinisikan struktur HTML dari halaman edit profil.
   - Menggunakan CSS dan beberapa ikon Font Awesome untuk tata letak dan gaya.

5. **Form Edit Profil:**
   - Menampilkan formulir untuk mengedit profil pengguna, termasuk gambar profil, gambar sampul, nama, lokasi, situs web, dan bio.
   - Memberikan opsi untuk mengunggah gambar profil dan sampul baru.

6. **Script dan Fungsi Lainnya:**
   - Menggunakan beberapa script JavaScript yang diperlukan untuk berbagai fungsi, seperti memproses unggahan gambar dan menangani interaksi seperti menyimpan perubahan.

Kode ini memungkinkan pengguna untuk mengedit informasi profil mereka, termasuk gambar profil dan sampul, serta data lainnya seperti nama, lokasi, dan bio.
# right sidebar
Kode tersebut adalah bagian dari sidebar kanan (right sidebar) pada halaman Twitter. Berikut adalah penjelasan singkatnya:

1. **Kotak Pencarian:**
   - Terdapat kotak pencarian dengan ikon kaca pembesar dan input untuk mengetikkan kata kunci pencarian.
   - Menggunakan ikon Font Awesome untuk ikon pencarian.

2. **Daftar Hasil Pencarian:**
   - Menampilkan daftar hasil pencarian dalam elemen dengan class `search-result`.

3. **Tren Pencarian:**
   - Memanggil fungsi `$getFromT->trends()` untuk menampilkan tren pencarian saat ini.
   - Tren pencarian umumnya berupa tagar (hashtag) yang sedang populer.

4. **Rekomendasi Pengguna untuk Diikuti:**
   - Memanggil fungsi `$getFromF->whoToFollow($user_id, $user_id)` untuk menampilkan rekomendasi pengguna yang dapat diikuti.
   - Umumnya, ini akan menampilkan daftar pengguna berdasarkan algoritma rekomendasi.

Kode ini membentuk elemen-elemen dalam sidebar kanan yang melibatkan fungsi pencarian, menampilkan hasil pencarian, tren pencarian, dan rekomendasi pengguna untuk diikuti pada platform Twitter.
# 
# 
# 
# 



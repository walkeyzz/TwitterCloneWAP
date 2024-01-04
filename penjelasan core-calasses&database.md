# CLASSES
# follow
Kode ini adalah bagian dari sebuah class PHP yang disebut `Follow`, yang memanfaatkan konsep pewarisan (`extends User`). Class ini berfungsi untuk mengelola fitur-fitur terkait pengikutan (following) antar pengguna dalam aplikasi web. Berikut adalah penjelasan singkat untuk beberapa metode yang terdapat dalam class ini:

1. **Metode `checkFollow`:**
   - Mengambil data dari tabel `follow` untuk memeriksa apakah pengguna tertentu mengikuti pengguna lain.
   - Parameter: `$followerID` dan `$user_id`.
   - Menggunakan parameter untuk mengikuti dan memeriksa keterhubungan antara pengguna yang diikuti (`$followerID`) dan pengguna yang melakukan tindakan (`$user_id`).

2. **Metode `followBtn`:**
   - Menampilkan tombol untuk mengikuti atau berhenti mengikuti berdasarkan status hubungan pengguna.
   - Jika pengguna telah diikuti, tombol akan menampilkan "Following", jika belum, tombol akan menampilkan "Follow".
   - Menyertakan tombol "Edit Profile" jika pengguna melihat profilnya sendiri.
   - Parameter: `$profileID`, `$user_id`, dan `$followID`.

3. **Metode `follow`:**
   - Memulai pengikutan antara pengguna yang melakukan tindakan (`$user_id`) dengan pengguna yang diikuti (`$followID`).
   - Menambah jumlah pengikut (`followers`) dan jumlah yang diikuti (`following`).
   - Mengirim notifikasi ke pengguna yang diikuti.
   - Parameter: `$followID`, `$user_id`, dan `$profileID`.

4. **Metode `unfollow`:**
   - Membatalkan pengikutan antara pengguna yang melakukan tindakan (`$user_id`) dengan pengguna yang diikuti (`$followID`).
   - Mengurangkan jumlah pengikut (`followers`) dan jumlah yang diikuti (`following`).
   - Parameter: `$followID`, `$user_id`, dan `$profileID`.

5. **Metode `addFollowCount` dan `removeFollowCount`:**
   - Menambah atau mengurangkan jumlah pengikut (`followers`) dan jumlah yang diikuti (`following`).
   - Parameter: `$followID` dan `$user_id`.

6. **Metode `followingList` dan `followersList`:**
   - Menampilkan daftar pengguna yang diikuti atau pengikut dalam tampilan profil.
   - Parameter: `$profileID`, `$user_id`, dan `$followID`.

7. **Metode `whoToFollow`:**
   - Menampilkan rekomendasi pengguna yang bisa diikuti oleh pengguna tertentu.
   - Parameter: `$user_id` dan `$profileID`.

# message
Kode di atas merupakan implementasi class PHP yang disebut `Message` yang mengelola fitur-fitur terkait pesan dan notifikasi dalam aplikasi web. Berikut adalah penjelasan singkat untuk beberapa metode yang terdapat dalam class ini:

1. **Metode `recentMessages`:**
   - Mengambil pesan terbaru untuk setiap pengguna yang berkomunikasi dengan pengguna tertentu.
   - Menggunakan JOIN antara tabel `messages` dan `users` untuk mendapatkan informasi pengguna.
   - Menggunakan GROUP BY untuk mendapatkan pesan terbaru dari setiap pengguna yang berkomunikasi.
   - Parameter: `$user_id`.

2. **Metode `getMessages`:**
   - Mengambil semua pesan antara dua pengguna.
   - Menampilkan pesan-pesan tersebut dengan membedakan antara pesan yang dikirim dan diterima.
   - Parameter: `$messageFrom` (pengirim pesan) dan `$user_id` (penerima pesan).

3. **Metode `deleteMsg`:**
   - Menghapus pesan berdasarkan ID pesan dan user ID pengguna yang terlibat.
   - Parameter: `$messageID` (ID pesan) dan `$user_id` (ID pengguna).

4. **Metode `getNotificationCount`:**
   - Mengambil jumlah total pesan dan notifikasi yang belum dibaca oleh pengguna.
   - Parameter: `$user_id`.
   - Menggunakan subquery untuk menghitung jumlah notifikasi yang belum dibaca.

5. **Metode `messagesViewed` dan `notificationViewed`:**
   - Menandai pesan atau notifikasi sebagai sudah dibaca.
   - Parameter: `$user_id`.

6. **Metode `notification`:**
   - Mengambil notifikasi yang diterima oleh pengguna.
   - Melibatkan JOIN dengan tabel `users`, `tweets`, `likes`, dan `follow` untuk mendapatkan informasi terkait notifikasi.
   - Parameter: `$user_id`.

7. **Metode `sendNotification`:**
   - Mengirim notifikasi kepada pengguna.
   - Menyimpan notifikasi ke dalam tabel `notification`.
   - Parameter: `$get_id` (penerima notifikasi), `$user_id` (pengirim notifikasi), `$target` (ID target notifikasi, misalnya ID tweet atau ID pengguna yang diikuti), dan `$type` (jenis notifikasi).

Class ini digunakan untuk mengelola aspek komunikasi antar pengguna, termasuk mengambil pesan, mengirim notifikasi, dan menangani tampilan pesan dan notifikasi.
# tweet
Kode di atas adalah implementasi class PHP yang disebut `Tweet` yang berfungsi untuk mengelola operasi terkait tweet dalam aplikasi web. Berikut adalah penjelasan singkat untuk beberapa metode yang terdapat dalam class ini:

1. **Konstruktor:**
   - Menerima objek PDO sebagai parameter dan menginisialisasi properti.
   - Membuat instance dari class `Message` untuk mengelola pesan terkait tweet.

2. **Metode `tweets`:**
   - Mengambil tweet dari pengguna tertentu beserta informasi terkait (seperti retweet dan like).
   - Menampilkan tweet dengan membedakan antara tweet asli dan retweet.
   - Parameter: `$user_id` (ID pengguna), `$num` (jumlah tweet yang diambil).

3. **Metode `getUserTweets`:**
   - Mengambil semua tweet yang diposting oleh pengguna tertentu.
   - Parameter: `$user_id` (ID pengguna).

4. **Metode `addLike` dan `unLike`:**
   - Menambah dan mengurangi jumlah "like" pada suatu tweet.
   - Mengirim notifikasi kepada pengguna yang diposting tweet.
   - Parameter: `$user_id` (ID pengguna), `$tweet_id` (ID tweet), `$get_id` (ID pengguna yang diposting tweet).

5. **Metode `likes`:**
   - Memeriksa apakah pengguna tertentu sudah "like" suatu tweet.
   - Parameter: `$user_id` (ID pengguna), `$tweet_id` (ID tweet).

6. **Metode `getTrendByHash`:**
   - Mengambil tren berdasarkan hashtag.
   - Parameter: `$hashtag` (hashtag).

7. **Metode `getMension`:**
   - Mengambil informasi pengguna berdasarkan mention.
   - Parameter: `$mension` (username atau screenName).

8. **Metode `addTrend` dan `addMention`:**
   - Menambah tren berdasarkan hashtag.
   - Menambah mention dan mengirim notifikasi jika mention bukan milik pengguna yang sama.
   - Parameter: `$hashtag` (hashtag), `$status` (tweet atau pesan), `$user_id` (ID pengguna), `$tweet_id` (ID tweet).

9. **Metode `getTweetLinks`:**
   - Mengubah tautan dalam tweet menjadi tautan HTML yang dapat di-klik.

10. **Metode `getPopupTweet`, `retweet`, `checkRetweet`, dan `tweetPopup`:**
    - Mendapatkan informasi tweet untuk popup atau retweet.
    - Mengecek apakah suatu tweet sudah diretweet oleh pengguna tertentu.
    - Merepost tweet sebagai retweet dan mengirim notifikasi.
    - Parameter: `$tweet_id` (ID tweet), `$user_id` (ID pengguna), `$get_id` (ID pengguna yang diposting tweet), `$comment` (komentar pada retweet).

11. **Metode `comments`:**
    - Mengambil komentar untuk suatu tweet.
    - Parameter: `$tweet_id` (ID tweet).

12. **Metode `countTweets` dan `countLikes`:**
    - Menghitung total tweet dan total like yang dimiliki oleh pengguna.
    - Parameter: `$user_id` (ID pengguna).

13. **Metode `trends`:**
    - Mengambil tren terkini berdasarkan tweet yang mengandung hashtag.
    - Menampilkan tren dalam format HTML.

14. **Metode `getTweetsByHash` dan `getUsersByHash`:**
    - Mengambil tweet dan pengguna berdasarkan hashtag.
    - Parameter: `$hashtag` (hashtag).

Class ini menyediakan berbagai fungsi terkait tweet, termasuk pengelolaan like, retweet, komentar, dan tren. Selain itu, class ini juga menggunakan objek `Message` untuk mengelola notifikasi terkait tweet.
# user
Kode di atas mendefinisikan class PHP yang disebut `User`, yang berfungsi untuk mengelola operasi terkait pengguna dalam aplikasi web. Berikut adalah penjelasan singkat untuk beberapa metode dan properti yang terdapat dalam class ini:

1. **Konstruktor:**
   - Menerima objek PDO sebagai parameter dan menginisialisasi properti `$pdo`.

2. **Metode `checkInput`:**
   - Membersihkan dan mengamankan input data dari serangan XSS, trim, dan stripcslashes.

3. **Metode `preventAccess`:**
   - Mencegah akses ke suatu halaman dengan mengarahkan pengguna ke halaman lain jika kondisi tertentu terpenuhi.

4. **Metode `search`:**
   - Mencari pengguna berdasarkan nama pengguna atau nama tampilan (screenName).

5. **Metode `login`:**
   - Melakukan proses login dengan memeriksa email dan password yang sesuai.
   - Jika login berhasil, mengarahkan pengguna ke halaman home.

6. **Metode `register`:**
   - Mendaftarkan pengguna baru dengan menyimpan informasi email, password, dan nama tampilan (screenName) ke database.

7. **Metode `userData`:**
   - Mengambil data pengguna berdasarkan ID pengguna.

8. **Metode `logout`:**
   - Menghapus sesi pengguna dan mengarahkan ke halaman login.

9. **Metode `create`:**
   - Menyimpan data baru ke dalam tabel database.

10. **Metode `update`:**
    - Memperbarui data pengguna di tabel database berdasarkan ID pengguna.

11. **Metode `delete`:**
    - Menghapus data dari tabel database berdasarkan kondisi yang diberikan.

12. **Metode `checkUsername`, `checkPassword`, dan `checkEmail`:**
    - Memeriksa apakah username, password, atau email sudah ada dalam database.

13. **Metode `loggedIn`:**
    - Memeriksa apakah pengguna sudah login.

14. **Metode `userIdbyUsername`:**
    - Mengambil ID pengguna berdasarkan nama pengguna.

15. **Metode `uploadImage`:**
    - Mengelola proses unggah gambar pengguna, termasuk pemeriksaan ekstensi dan ukuran file.

16. **Metode `timeAgo`:**
    - Menghitung selisih waktu antara waktu tertentu dengan waktu sekarang dalam format yang lebih mudah dibaca (seperti "2m" untuk 2 menit yang lalu).
# DATABASE
# connection
Kode di atas mendefinisikan class PHP `ConnectionDatabase` yang bertanggung jawab untuk mengelola koneksi ke database MySQL menggunakan MySQLi. Berikut adalah penjelasan singkatnya:

1. **Properti:**
   - `$db_host`, `$db_username`, `$db_pass`, dan `$db_name` adalah properti yang menyimpan informasi koneksi database seperti host, nama pengguna, kata sandi, dan nama database.

2. **Konstruktor:**
   - Menginisialisasi objek koneksi ke database menggunakan kelas MySQLi.
   - Jika koneksi gagal, mencetak pesan kesalahan.

3. **Metode `closeConnection`:**
   - Menutup koneksi database.

# CORE
# INIT
Kode di atas digunakan untuk memulai sesi PHP, menyertakan file-file yang dibutuhkan, menginisialisasi objek koneksi database, dan mendefinisikan konstanta untuk URL dasar. Berikut adalah penjelasan singkatnya:

1. **`session_start()`:** Memulai sesi PHP, yang diperlukan untuk menyimpan dan mengakses variabel sesi di seluruh halaman.

2. **Pemanggilan File dan Koneksi Database:**
   - `include 'database/connection.php';`: Memasukkan file yang berisi definisi kelas `ConnectionDatabase` untuk mengelola koneksi database.
   - `include 'classes/user.php';`, `include 'classes/tweet.php';`, dll.: Memasukkan file yang berisi definisi kelas-kelas terkait pengguna, cuitan (tweet), pengikut (follow), dan pesan (message).
   - `global $pdo;`: Membuat variabel global `$pdo` yang akan digunakan untuk koneksi database.

3. **Inisialisasi Objek Kelas:**
   - `$getFromU = new User($pdo);`: Membuat objek dari kelas `User` dengan menggunakan koneksi database `$pdo`.
   - `$getFromT = new Tweet($pdo);`, `$getFromF = new Follow($pdo);`, `$getFromM = new Message($pdo);`: Membuat objek dari kelas `Tweet`, `Follow`, dan `Message` dengan menggunakan koneksi database yang sama.

4. **Konstanta BASE_URL:**
   - `define('BASE_URL', 'http://localhost/twitter/');`: Mendefinisikan konstanta `BASE_URL` dengan nilai URL dasar aplikasi Twitter.

5. **Catatan:**
   - Kode ini menyusun bagian awal dari skrip PHP yang dibutuhkan untuk mengelola fungsi-fungsi dasar dalam aplikasi Twitter.

# i/notification
# index
Kode di atas adalah bagian dari halaman notifikasi dalam aplikasi Twitter. Berikut adalah penjelasan singkatnya:

1. **Sesi dan Koneksi Database:**
   - `session_start();`: Memulai sesi PHP.
   - `include '../../core/init.php';`: Memasukkan file inisialisasi yang mungkin berisi konfigurasi dan fungsi dasar.
   - `user_id` diambil dari variabel sesi `$_SESSION['user_id']` dan digunakan untuk mengambil data pengguna.

2. **Objek dan Notifikasi:**
   - Objek dari kelas `User`, `Tweet`, `Follow`, dan `Message` diinisialisasi.
   - `notificationViewed` dipanggil untuk menandai notifikasi sebagai telah dilihat.
   - Notifikasi dan jumlah notifikasi diambil menggunakan metode `notification` dan `getNotificationCount`.

3. **HTML dan JavaScript:**
   - Berisi markup HTML untuk halaman notifikasi, termasuk pemuatan file CSS dan JavaScript eksternal.
   - Penggunaan PHP untuk mencetak notifikasi yang berbeda sesuai dengan jenisnya (follow, like, retweet, mention).
   - Diberikan tautan ke profil pengguna, cuitan, dan sebagainya.
   - Diperoleh data cuitan, pengguna, dan tindakan seperti retweet dan like menggunakan objek `Tweet` dan `User`.

4. **Script Tambahan:**
   - Terdapat beberapa script JavaScript untuk mengelola tindakan seperti retweet, like, dan fungsi pop-up.
   - Beberapa script dipanggil dari file eksternal, seperti `popuptweets.js`, `hashtag.js`, `delete.js`, `popupForm.js`, `messages.js`, dan `notification.js`.

# SETTINGS
# Account
Kode di atas adalah bagian dari halaman pengaturan akun (account settings) dalam aplikasi Twitter. Berikut adalah penjelasan singkatnya:

1. **Inisialisasi dan Validasi Sesi:**
   - `include '../../core/init.php';`: Memasukkan file inisialisasi yang mungkin berisi konfigurasi dan fungsi dasar.
   - `user_id` diambil dari variabel sesi `$_SESSION['user_id']`.
   - Jika pengguna tidak login (`loggedIn()` mengembalikan `false`), maka dia akan diarahkan ke halaman `index.php`.

2. **Pemrosesan Form:**
   - Jika formulir dikirim (`isset($_POST['submit'])`), maka dilakukan pemrosesan perubahan username.
   - Perubahan username dibatasi hanya untuk karakter alfanumerik dan tanda seru. Jika tidak memenuhi syarat, ditampilkan pesan kesalahan.
   - Jika username sudah ada (berbeda dengan username saat ini) pada basis data, ditampilkan pesan kesalahan.
   - Jika tidak ada kesalahan, pembaruan dilakukan menggunakan metode `$getFromU->update`.

3. **Tampilan Halaman:**
   - Halaman termasuk tautan ke bagian pengaturan akun (`account`) dan pengaturan kata sandi (`password`).
   - Formulir disediakan untuk mengganti username.
   - Pesan kesalahan ditampilkan jika ada kesalahan validasi atau pengguna tidak mengisi semua bidang.

4. **Pustaka Eksternal:**
   - Menggunakan beberapa pustaka eksternal seperti jQuery, Font Awesome, Bootstrap, dan file JavaScript dan CSS lainnya.

5. **Script Tambahan:**
   - Beberapa script JavaScript untuk mengelola tindakan seperti menyukai dan meretweet cuitan.
   - Script untuk manajemen popup cuitan, penggunaan tagar, dan tindakan lainnya.

6. **Catatan:**
   - Kode ini bertanggung jawab untuk mengelola perubahan username pengguna dan menampilkan halaman pengaturan akun.

# password
Kode di atas merupakan bagian dari halaman pengaturan kata sandi (password settings) dalam aplikasi Twitter. Berikut adalah penjelasan singkatnya:

1. **Inisialisasi dan Validasi Sesi:**
   - `include '../../core/init.php';`: Memasukkan file inisialisasi yang mungkin berisi konfigurasi dan fungsi dasar.
   - `user_id` diambil dari variabel sesi `$_SESSION['user_id']`.
   - Jika pengguna tidak login (`loggedIn()` mengembalikan `false`), maka dia akan diarahkan ke halaman `index.php`.

2. **Pemrosesan Form Ganti Kata Sandi:**
   - Jika formulir dikirim (`isset($_POST['submit'])`), maka dilakukan pemrosesan perubahan kata sandi.
   - Perubahan kata sandi harus mencakup kata sandi saat ini, kata sandi baru, dan verifikasi kata sandi baru.
   - Terdapat validasi, seperti memeriksa kesesuaian kata sandi saat ini dan kata sandi baru, serta panjang kata sandi baru yang minimal 6 karakter.
   - Jika semua validasi berhasil, kata sandi pengguna diperbarui pada database dan pengguna diarahkan kembali ke halaman pengaturan kata sandi.

3. **Tampilan Halaman:**
   - Halaman termasuk tautan ke bagian pengaturan akun (`account`) dan pengaturan kata sandi (`password`).
   - Formulir disediakan untuk mengganti kata sandi.
   - Pesan kesalahan ditampilkan jika ada kesalahan validasi atau pengguna tidak mengisi semua bidang.

4. **Pustaka Eksternal:**
   - Menggunakan beberapa pustaka eksternal seperti jQuery, Font Awesome, Bootstrap, dan file JavaScript dan CSS lainnya.

5. **Script Tambahan:**
   - Beberapa script JavaScript untuk mengelola tindakan seperti menyukai dan meretweet cuitan.
   - Script untuk manajemen popup cuitan, penggunaan tagar, dan tindakan lainnya.



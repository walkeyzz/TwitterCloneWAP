# penjelasan
css Dalam folder ini terdapat semua file CSS yang digunakan oleh aplikasi twitter untuk menata tampilan. CSS (Cascading Style Sheets) adalah bahasa yang digunakan untuk mengatur tata letak dan gaya halaman web. CSS memungkinkan pengembang untuk menentukan gaya berdasarkan elemen HTML, id atau class.

images Dalam folder ini terdapat semua gambar yang digunakan oleh aplikasi twitter, seperti logo, foto profil, dll.

js Dalam folder ini terdapat semua file JavaScript yang digunakan oleh aplikasi twitter untuk menambahkan fungsi dan interaktivitas.

Kode yang Anda berikan tampaknya adalah bagian dari suatu aplikasi web yang memungkinkan pengguna untuk membuat tweet. Berikut adalah penjelasan singkat dari beberapa bagian kodenya:

# add tweet.php

1. **Include File dan Inisialisasi Objek:**
   ```php
   include '../init.php';
   $getFromU->preventAccess($_SERVER['REQUEST_METHOD'], realpath(__FILE__), realpath($_SERVER['SCRIPT_FILENAME']));
   ```
   - Menggunakan file `init.php` untuk menginisialisasi dan memuat objek atau fungsi yang diperlukan.
   - Memanggil metode `preventAccess` untuk mencegah akses langsung ke file dengan memeriksa metode permintaan dan jalur skrip.

2. **Pengecekan dan Pemrosesan Form:**
   ```php
   if(isset($_POST) && !empty($_POST)){
   ```
   - Memeriksa apakah ada data yang dikirimkan melalui metode POST.

3. **Pengambilan dan Validasi Data:**
   ```php
   $status     = $getFromU->checkInput($_POST['status']);
   $tweetImage = '';
   $user_id    = $_SESSION['user_id'];
   ```
   - Mengambil status, menetapkan variabel `$tweetImage` untuk gambar tweet, dan mendapatkan ID pengguna dari sesi.

4. **Upload Gambar:**
   ```php
   if(!empty($_FILES['file']['name'][0])){
       $tweetImage = $getFromU->uploadImage($_FILES['file']);
   }
   ```
   - Jika ada file gambar yang diunggah, menggunakan metode `uploadImage` untuk mengunggah gambar dan mendapatkan nama file.

5. **Validasi Panjang Tweet:**
   ```php
   if(strlen($status) > 140){
       $error  = "The text of your tweet is too long";
   }
   ```
   - Memeriksa apakah panjang teks tweet melebihi 140 karakter.

6. **Penyimpanan Tweet dan Pemrosesan Lainnya:**
   ```php
   $tweet_id = $getFromU->create('tweets', array('status' => $status, 'tweetBy' => $user_id, 'tweetImage' => $tweetImage, 'postedOn' => date('Y-m-d H:i:s')));
   ```
   - Membuat tweet dengan memanggil metode `create` dan menyimpan informasi tweet ke dalam tabel 'tweets'.
   - Mengekstrak hashtag dari status dan menambahkan tren menggunakan metode dari objek `$getFromT`.
   - Menambahkan mention (penanda) jika ada mention dalam status.

7. **Respon JSON:**
   ```php
   if(isset($error)){
       $result['error'] = $error;
       echo json_encode($result);
   }
   ```
   - Jika terdapat kesalahan, mengirimkan respon JSON dengan pesan kesalahan.
   - Jika berhasil, mengirimkan respon JSON dengan pesan sukses.

#  comment
Kode ini terlihat seperti bagian dari aplikasi media sosial yang memungkinkan pengguna untuk menambahkan komentar pada suatu tweet. Berikut adalah penjelasan singkat dari beberapa bagian kodenya:

1. **Include File dan Inisialisasi Objek:**
   ```php
   include '../init.php';
   ```

   - Menggunakan file `init.php` untuk menginisialisasi dan memuat objek atau fungsi yang diperlukan.

2. **Pengecekan dan Pemrosesan Form:**
   ```php
   if(isset($_POST['comment']) && !empty($_POST['comment'])){
   ```

   - Memeriksa apakah ada data komentar yang dikirimkan melalui metode POST.

3. **Mengambil dan Validasi Data:**
   ```php
   $comment = $getFromU->checkInput($_POST['comment']);
   $user_id = $_SESSION['user_id'];
   $tweetID = $_POST['tweet_id'];
   ```

   - Mengambil komentar, ID pengguna dari sesi, dan ID tweet dari formulir.

4. **Menyimpan Komentar ke Database:**
   ```php
   $getFromU->create('comments', array('comment' => $comment, 'commentOn' => $tweetID, 'commentBy' => $user_id));
   ```

   - Menyimpan komentar ke dalam tabel 'comments' dengan menggunakan metode `create`.

5. **Mengambil dan Menampilkan Komentar dan Informasi Tweet:**
   ```php
   $comments = $getFromT->comments($tweetID);
   $tweet = $getFromT->tweetPopup($tweetID);
   ```

   - Mengambil daftar komentar dan informasi tweet dari tweet ID.

6. **Menampilkan Komentar:**
   ```php
   foreach ($comments as $comment) {
       echo '<div class="tweet-show-popup-comment-box"> ... </div>';
   }
   ```

   - Menggunakan loop foreach untuk menampilkan setiap komentar dalam HTML dengan informasi seperti foto profil, nama pengguna, dan teks komentar.

7. **Menampilkan Tombol Aksi (Share, Like, Delete):**
   ```php
   '.(($comment->commentBy === $user_id) ?  
       '<li>
           <a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
           <ul> 
             <li><label class="deleteComment" data-tweet="'.$tweet->tweetID.'" data-comment="'.$comment->commentID.'">Delete Tweet</label></li>
           </ul>
       </li>' : '').'
   </ul>
   </div>
   </div>
   ';
   ```

   - Menampilkan tombol aksi berdasarkan apakah pengguna yang sedang masuk adalah pemilik komentar atau tidak.

# delete coment
Kode ini terlihat sebagai bagian dari aplikasi media sosial yang memungkinkan pengguna untuk menghapus komentar pada suatu tweet. Berikut adalah penjelasan singkat dari beberapa bagian kodenya:

1. **Include File dan Inisialisasi Objek:**
   ```php
   include '../init.php';
   ```

   - Menggunakan file `init.php` untuk menginisialisasi dan memuat objek atau fungsi yang diperlukan.

2. **Pengecekan Akses dan Metode Permintaan:**
   ```php
   $getFromU->preventAccess($_SERVER['REQUEST_METHOD'], realpath(__FILE__), realpath($_SERVER['SCRIPT_FILENAME']));
   ```

   - Memanggil metode `preventAccess` untuk mencegah akses langsung ke file dengan memeriksa metode permintaan dan jalur skrip.

3. **Pengecekan dan Pemrosesan Form:**
   ```php
   if(isset($_POST['deleteComment']) && !empty($_POST['deleteComment'])){
   ```

   - Memeriksa apakah ada data penghapusan komentar yang dikirimkan melalui metode POST.

4. **Mengambil dan Validasi Data:**
   ```php
   $user_id   = $_SESSION['user_id'];
   $tweet_id  = $_POST['tweet_id'];
   $commentID = $_POST['deleteComment'];
   ```

   - Mengambil ID pengguna dari sesi, ID tweet, dan ID komentar yang akan dihapus.

5. **Menghapus Komentar dari Database:**
   ```php
   $getFromU->delete('comments', array('commentBy' => $user_id, 'commentID' => $commentID));
   ```

   - Menggunakan metode `delete` untuk menghapus komentar dari tabel 'comments' berdasarkan ID pengguna dan ID komentar.

# delete tweet
Kode ini terlihat sebagai bagian dari aplikasi media sosial yang memungkinkan pengguna untuk menghapus tweet. Berikut adalah penjelasan singkat dari beberapa bagian kodenya:

1. **Menghapus Tweet:**
   ```php
   if(isset($_POST['deleteTweet']) && !empty($_POST['deleteTweet'])){
       // Mendapatkan ID tweet dan ID pengguna dari formulir
       $tweet_id  = $_POST['deleteTweet'];
       $user_id   = $_SESSION['user_id'];
       // Mendapatkan data tweet berdasarkan ID tweet
       $tweet     = $getFromT->tweetPopup($tweet_id);
       // Membuat link untuk menghapus gambar tweet
       $imageLink = '../../'.$tweet->tweetImage;
       // Menghapus tweet dari database
       $getFromT->delete('tweets', array('tweetID' => $tweet_id, 'tweetBy' => $user_id));
       // Memeriksa apakah tweet memiliki gambar
       if(!empty($tweet->tweetImage)){
           // Menghapus file gambar tweet
           unlink($imageLink);
       }
   }
   ```

   - Memeriksa apakah ada permintaan penghapusan tweet melalui metode POST.
   - Mengambil ID tweet dan ID pengguna dari formulir.
   - Mendapatkan data tweet berdasarkan ID tweet.
   - Membuat link untuk menghapus gambar tweet (jika ada).
   - Menghapus tweet dari database menggunakan metode `delete`.
   - Jika tweet memiliki gambar, menghapus file gambar menggunakan fungsi `unlink`.

2. **Menampilkan Popup Konfirmasi Penghapusan Tweet:**
   ```php
   if(isset($_POST['showpopup']) && !empty($_POST['showpopup'])){
       // Mendapatkan ID tweet dan ID pengguna dari formulir
       $tweet_id  = $_POST['showpopup'];
       $user_id   = $_SESSION['user_id'];
       // Mendapatkan data tweet berdasarkan ID tweet
       $tweet     = $getFromT->tweetPopup($tweet_id);
   ```
   - Memeriksa apakah ada permintaan untuk menampilkan popup konfirmasi penghapusan tweet.
   - Mendapatkan ID tweet dan ID pengguna dari formulir.
   - Mendapatkan data tweet berdasarkan ID tweet.

3. **Menampilkan Popup Konfirmasi Penghapusan Tweet (HTML):**
   ```php
   <div class="retweet-popup">
       <!-- ... (Kode HTML untuk tampilan popup konfirmasi penghapusan tweet) ... -->
   </div>
   ```
   - Menampilkan elemen HTML untuk tampilan popup konfirmasi penghapusan tweet.
   - Menampilkan informasi tweet, seperti foto profil, nama pengguna, teks tweet, dan waktu posting.
   - Menambahkan tombol untuk membatalkan atau menghapus tweet.

# fetch post
Kode ini terlihat sebagai bagian dari aplikasi media sosial yang memungkinkan pengguna untuk mengambil sejumlah tweet dari database. Berikut adalah penjelasan singkat dari beberapa bagian kodenya:

1. **Mengambil Tweet dari Database:**
   ```php
   if(isset($_POST['fetchPost']) && !empty($_POST['fetchPost'])){
       // Mendapatkan ID pengguna dari sesi
       $user_id = $_SESSION['user_id'];
       // Mengambil batasan jumlah tweet yang akan diambil dari formulir
       $limit   = (int) trim($_POST['fetchPost']);
       // Memanggil metode 'tweets' untuk mengambil tweet dari database
       $getFromT->tweets($user_id, $limit);
   }
   ```
   - Memeriksa apakah ada permintaan untuk mengambil tweet melalui metode POST.
   - Mengambil ID pengguna dari sesi.
   - Mengambil batasan jumlah tweet yang akan diambil dari formulir.
   - Memanggil metode `tweets` untuk mengambil tweet dari database berdasarkan ID pengguna dan batasan jumlah.

# follow
Kode ini terlihat sebagai bagian dari aplikasi media sosial yang memungkinkan pengguna untuk mengikuti (follow) atau berhenti mengikuti (unfollow) pengguna lain. Berikut adalah penjelasan singkat dari beberapa bagian kodenya:

1. **Pengecekan Akses dan Metode Permintaan:**
   ```php
   include '../init.php';
   $getFromU->preventAccess($_SERVER['REQUEST_METHOD'], realpath(__FILE__), realpath($_SERVER['SCRIPT_FILENAME']));
   ```
   - Menggunakan file `init.php` untuk menginisialisasi dan memuat objek atau fungsi yang diperlukan.
   - Memanggil metode `preventAccess` untuk mencegah akses langsung ke file dengan memeriksa metode permintaan dan jalur skrip.

2. **Unfollow:**
   ```php
   if (isset($_POST['unfollow']) && !empty($_POST['unfollow'])) {
       $user_id = $_SESSION['user_id'];
       $followID = $_POST['unfollow'];
       $profileID = $_POST['profile'];
       $getFromF->unfollow($followID, $user_id, $profileID);
   }
   ```
   - Memeriksa apakah ada permintaan untuk unfollow melalui metode POST.
   - Mengambil ID pengguna dari sesi, ID pengguna yang akan diunfollow, dan ID profil.
   - Memanggil metode `unfollow` dari objek `$getFromF` untuk menghentikan mengikuti pengguna tertentu.

3. **Follow:**
   ```php
   if (isset($_POST['follow']) && !empty($_POST['follow'])) {
       $user_id = $_SESSION['user_id'];
       $followID = $_POST['follow'];
       $profileID = $_POST['profile'];
       $getFromF->follow($followID, $user_id, $profileID);
   }
   ```
   - Memeriksa apakah ada permintaan untuk follow melalui metode POST.
   - Mengambil ID pengguna dari sesi, ID pengguna yang akan diikuti, dan ID profil.
   - Memanggil metode `follow` dari objek `$getFromF` untuk mengikuti pengguna tertentu.

# get hashtag
Kode ini terlihat sebagai bagian dari aplikasi media sosial yang memproses inputan hashtag atau mention untuk menampilkan hasil terkait. Berikut adalah penjelasan singkat dari beberapa bagian kodenya:

1. **Pengecekan dan Pemrosesan Input:**
   ```php
   if(isset($_POST['hashtag'])){	
   	  if(!empty($_POST['hashtag'])){
   	  	 $hashtag = $getFromU->checkInput($_POST['hashtag']);
   	  	 $mension = $getFromU->checkInput($_POST['hashtag']);
   ```
   - Memeriksa apakah ada permintaan untuk mencari hashtag atau mention melalui metode POST.
   - Jika ada, mengambil dan membersihkan input dari formulir.

2. **Pencarian dan Tampilan Hashtag:**
   ```php
   if(substr($hashtag, 0,1) === '#'){
       $trend   = str_replace('#', '', $hashtag);
       $trend   = $getFromT->getTrendByHash($trend);
       foreach ($trend as $hashtag) {
           echo '<li><a href="#"><span class="getValue">#'.$hashtag->hashtag.'</span></a></li>';
       }
   }
   ```
   - Jika input dimulai dengan '#', maka dianggap sebagai hashtag.
   - Menghilangkan karakter '#' dan mencari tren berdasarkan hashtag menggunakan metode `getTrendByHash`.
   - Menampilkan hasil pencarian hashtag dalam bentuk daftar HTML.

3. **Pencarian dan Tampilan Mention:**
   ```php
   if(substr($mension, 0,1) === '@'){
       $mension = str_replace('@', '', $mension);
       $mensions = $getFromT->getMension($mension);
       foreach ($mensions as $mension) {
           echo '<li><div class="nav-right-down-inner"> ... </div></li>';
       }
   }
   ```
   - Jika input dimulai dengan '@', maka dianggap sebagai mention.
   - Menghilangkan karakter '@' dan mencari mention berdasarkan username menggunakan metode `getMension`.
   - Menampilkan hasil pencarian mention dalam bentuk daftar HTML.

# image popup
Kode ini terlihat sebagai bagian dari aplikasi media sosial yang menangani tampilan popup untuk gambar dari suatu tweet. Berikut adalah penjelasan singkat dari beberapa bagian kodenya:

1. **Pengecekan dan Pengambilan Data:**
   ```php
   if(isset($_POST['showImage']) && !empty($_POST['showImage'])){
       $tweet_id   = $_POST['showImage'];
       $user_id    = @$_SESSION['user_id'];
       $tweet      = $getFromT->tweetPopup($tweet_id);
       $likes      = $getFromT->likes($user_id, $tweet_id);
       $retweet    = $getFromT->checkRetweet($tweet_id, $user_id);
   }
   ```
   - Memeriksa apakah ada permintaan untuk menampilkan gambar tweet melalui metode POST.
   - Mengambil ID tweet dan ID pengguna dari sesi.
   - Mengambil data tweet, informasi like, dan status retweet dari tweet menggunakan metode `$getFromT`.

2. **Menampilkan Popup Gambar (HTML):**
   ```php
   <div class="img-popup">
      <!-- ... (Kode HTML untuk tampilan popup gambar) ... -->
   </div><!-- Image PopUp ends-->
   ```
   - Menampilkan elemen HTML untuk tampilan popup gambar.
   - Menampilkan gambar tweet.
   - Menampilkan informasi tentang pengguna yang membuat tweet, termasuk foto profil, nama pengguna, waktu posting, dan teks tweet.
   - Menampilkan menu aksi seperti share, retweet, dan like.

3. **Menu Aksi (Share, Retweet, Like):**
   ```php
   <?php 
       echo '<ul> 
           '.(($getFromU->loggedIn()) ?   '
                   <li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>  
                   <li>'.(($tweet->tweetID === isset($retweet['retweetID']) OR $user_id === isset($retweet['retweetBy'])) ? '<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</span></button>' : '<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</span></button>').'</li>
                   <li>'.((isset($likes['likeOn']) == $tweet->tweetID) ? '<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '').'</span></button>' : '<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '').'</span></button>').'</li>
                   '.(($tweet->tweetBy === $user_id) ? ' 
                   <li>
                       <a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                       <ul> 
                         <li><label class="deleteTweet" data-tweet="'.$tweet->tweetID.'">Delete Tweet</label></li>
                       </ul>
                   </li>' : '').'
               ' : '
                   <li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>  
                   <li><button><i class="fa fa-retweet" aria-hidden="true"></i></button></li>  
                   <li><button><i class="fa fa-heart-o" aria-hidden="true"></i></button></li>  
               ').'
           </ul>';
   ?>
   ```
   - Menampilkan menu aksi berdasarkan status login dan status retweet atau like.
   - Jika pengguna login, menampilkan tombol share, retweet, dan like.
   - Menyesuaikan tampilan tombol retweet dan like berdasarkan apakah tweet tersebut sudah diretweet atau dilike oleh pengguna yang sedang login.

# like
Kode ini terlihat sebagai bagian dari aplikasi media sosial yang menangani logika untuk menyukai (like) atau tidak menyukai (unlike) tweet, serta mengunggah gambar. Berikut adalah penjelasan singkat dari beberapa bagian kodenya:

1. **Menambahkan Like pada Tweet:**
   ```php
   if(isset($_POST['like']) && !empty($_POST['like'])){
       $user_id  = $_SESSION['user_id'];
       $tweet_id = $_POST['like'];
       $get_id   = $_POST['user_id'];
       $getFromT->addLike($user_id, $tweet_id, $get_id);
   }
   ```
   - Memeriksa apakah ada permintaan untuk menyukai tweet melalui metode POST.
   - Mengambil ID pengguna dari sesi, ID tweet, dan ID pengguna yang memiliki tweet tersebut.
   - Memanggil metode `addLike` dari objek `$getFromT` untuk menambahkan like pada tweet.

2. **Menghapus Like dari Tweet:**
   ```php
   if(isset($_POST['unlike']) && !empty($_POST['unlike'])){
       $user_id  = $_SESSION['user_id'];
       $tweet_id = $_POST['unlike'];
       $get_id   = $_POST['user_id'];
       $getFromT->unLike($user_id, $tweet_id, $get_id);
   }
   ```
   - Memeriksa apakah ada permintaan untuk tidak menyukai tweet melalui metode POST.
   - Mengambil ID pengguna dari sesi, ID tweet, dan ID pengguna yang memiliki tweet tersebut.
   - Memanggil metode `unLike` dari objek `$getFromT` untuk menghapus like dari tweet.

3. **Mengunggah Gambar:**
   ```php
   if(isset($_POST['file'])){
       $getFromT->uploadImage($_POST['files']);
   }
   ```
   - Memeriksa apakah ada permintaan untuk mengunggah gambar melalui metode POST.
   - Memanggil metode `uploadImage` dari objek `$getFromT` untuk mengunggah gambar.

# message
Kode ini terlihat seperti bagian dari aplikasi obrolan atau pesan langsung di media sosial. Berikut adalah penjelasan singkat dari beberapa bagian kodenya:

1. **Menghapus Pesan:**
   ```php
   if(isset($_POST['deleteMsg']) && !empty($_POST['deleteMsg'])){
       $user_id   = $_SESSION['user_id'];
       $messageID = $_POST['deleteMsg'];
       $getFromM->deleteMsg($messageID, $user_id);
   }
   ```
   - Memeriksa apakah ada permintaan untuk menghapus pesan melalui metode POST.
   - Mengambil ID pengguna dari sesi dan ID pesan yang akan dihapus.
   - Memanggil metode `deleteMsg` dari objek `$getFromM` untuk menghapus pesan.

2. **Mengirim Pesan Baru:**
   ```php
   if(isset($_POST['sendMessage']) && !empty($_POST['sendMessage'])){
       $user_id  = $_SESSION['user_id'];
       $message  = $getFromU->checkInput($_POST['sendMessage']);
       $get_id   = $_POST['get_id'];
       if(!empty($message)){
           $date = date('Y-m-d H:i:s');
           $getFromU->create('messages', array('messageTo' => $get_id, 'messageFrom' => $user_id, 'message' => $message, 'messageOn' => $date));
       }
   }
   ```
   - Memeriksa apakah ada permintaan untuk mengirim pesan melalui metode POST.
   - Mengambil ID pengguna dari sesi, isi pesan, dan ID pengguna penerima.
   - Memastikan pesan tidak kosong, lalu membuat entri pesan baru menggunakan metode `create` dari objek `$getFromU`.

3. **Menampilkan Pesan pada Percakapan Langsung:**
   ```php
   if(isset($_POST['showChatMessage']) && !empty($_POST['showChatMessage'])){
       $user_id = $_SESSION['user_id'];
       $messageFrom = $_POST['showChatMessage'];
       $getFromM->getMessages($messageFrom, $user_id);
   }
   ```
   - Memeriksa apakah ada permintaan untuk menampilkan pesan dalam percakapan langsung melalui metode POST.
   - Mengambil ID pengguna dari sesi dan ID pengguna lawan bicara.
   - Memanggil metode `getMessages` dari objek `$getFromM` untuk menampilkan pesan dalam percakapan langsung.

4. **Menampilkan Popup Percakapan:**
   ```php
   if(isset($_POST['showChatPopup']) && !empty($_POST['showChatPopup'])){
       $messageFrom = $_POST['showChatPopup'];
       $user_id     = $_SESSION['user_id'];
       $user        = $getFromU->userData($messageFrom);
       // Menampilkan popup percakapan
   }
   ```
   - Memeriksa apakah ada permintaan untuk menampilkan popup percakapan melalui metode POST.
   - Mengambil ID pengguna lawan bicara dan ID pengguna dari sesi.
   - Mendapatkan informasi pengguna menggunakan metode `userData` dari objek `$getFromU`.
   - Menampilkan popup percakapan antara pengguna dan pengguna lawan bicara.

# notification
Kode ini memproses permintaan untuk menampilkan jumlah pemberitahuan dan pesan yang belum terbaca melalui metode GET. Berikut adalah penjelasan singkatnya:

1. **Mengecek Permintaan:**
   ```php
   if(isset($_GET['showNotification']) && !empty($_GET['showNotification'])){
       $user_id = $_SESSION['user_id'];
       $data  = $getFromM->getNotificationCount($user_id);
       echo json_encode(array('notification' => $data->totalN, 'messages' => $data->totalM));
   }else{
       header('Location:'.BASE_URL.'index.php');
   }
   ```
   - Memeriksa apakah terdapat permintaan untuk menampilkan pemberitahuan dan pesan melalui parameter GET `showNotification`.
   - Mengambil ID pengguna dari sesi.
   - Menggunakan metode `getNotificationCount` dari objek `$getFromM` untuk mendapatkan total pemberitahuan dan pesan yang belum terbaca.
   - Mengembalikan respons JSON berisi jumlah pemberitahuan dan pesan yang belum terbaca.
   - Jika tidak ada permintaan yang sesuai, pengguna akan diarahkan ke halaman utama (`index.php`).

# popup tweets
Kode ini menangani tampilan detail tweet dalam bentuk popup. Berikut adalah penjelasan singkatnya:

1. **Pengecekan Permintaan:**
   ```php
   if(isset($_POST['showpopup']) && !empty($_POST['showpopup'])){
       // Mendapatkan informasi tweet dan pengguna terkait
       // ...
   }
   ```
   - Memeriksa apakah ada permintaan untuk menampilkan popup tweet.
   - Mengambil informasi tweet, pengguna, jumlah likes, retweets, dan komentar terkait.

2. **Popup Tampilan Tweet:**
   ```php
   <div class="tweet-show-popup-wrap">
       <!-- Struktur HTML untuk popup tampilan tweet -->
       <!-- Menampilkan informasi tweet, gambar, statistik, dan area komentar -->
   </div>
   ```
   - Membuat struktur HTML untuk popup tampilan tweet.
   - Menampilkan informasi pengguna, isi tweet, gambar terlampir, statistik retweet dan like, serta area komentar.
   - Menampilkan area komentar dengan menggunakan data yang diperoleh dari server.

3. **Ajax dan JavaScript:**
   - Terdapat beberapa script JavaScript yang mungkin terlibat, seperti `comment.js` dan `follow.js`.
   - Kode JavaScript ini kemungkinan digunakan untuk menangani interaksi pengguna seperti mengirim komentar, mengikuti/berhenti mengikuti pengguna, dll.

4. **Catatan Tambahan:**
   - Pada bagian komentar, ada perulangan untuk menampilkan komentar menggunakan data yang diperoleh dari server.
   - Pengguna yang sudah login akan melihat area untuk menulis dan mengirimkan komentar.

# retweet
Kode ini menangani tampilan detail tweet dalam bentuk popup. Berikut adalah penjelasan singkatnya:

1. **Pengecekan Permintaan:**
   ```php
   if(isset($_POST['showpopup']) && !empty($_POST['showpopup'])){
       // Mendapatkan informasi tweet dan pengguna terkait
       // ...
   }
   ```
   - Memeriksa apakah ada permintaan untuk menampilkan popup tweet.
   - Mengambil informasi tweet, pengguna, jumlah likes, retweets, dan komentar terkait.

2. **Popup Tampilan Tweet:**
   ```php
   <div class="tweet-show-popup-wrap">
       <!-- Struktur HTML untuk popup tampilan tweet -->
       <!-- Menampilkan informasi tweet, gambar, statistik, dan area komentar -->
   </div>
   ```
   - Membuat struktur HTML untuk popup tampilan tweet.
   - Menampilkan informasi pengguna, isi tweet, gambar terlampir, statistik retweet dan like, serta area komentar.
   - Menampilkan area komentar dengan menggunakan data yang diperoleh dari server.

3. **Ajax dan JavaScript:**
   - Terdapat beberapa script JavaScript yang mungkin terlibat, seperti `comment.js` dan `follow.js`.
   - Kode JavaScript ini kemungkinan digunakan untuk menangani interaksi pengguna seperti mengirim komentar, mengikuti/berhenti mengikuti pengguna, dll.

4. **Catatan Tambahan:**
   - Pada bagian komentar, ada perulangan untuk menampilkan komentar menggunakan data yang diperoleh dari server.
   - Pengguna yang sudah login akan melihat area untuk menulis dan mengirimkan komentar.

# search
Kode ini menangani fitur retweet dengan menampilkan popup konfirmasi retweet. Berikut adalah penjelasan singkatnya:

1. **Pengecekan Permintaan Retweet:**
   ```php
   if(isset($_POST['retweet']) && !empty($_POST['retweet'])){
       // Mendapatkan informasi tweet yang akan diretweet
       // ...
       $getFromT->retweet($tweet_id, $user_id, $get_id, $comment);
   }
   ```
   - Memeriksa apakah ada permintaan untuk melakukan retweet.
   - Mengambil informasi tweet yang akan diretweet dan menangani retweet menggunakan metode `retweet()`.

2. **Pengecekan dan Tampilan Popup Retweet:**
   ```php
   if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])){
       // Mendapatkan informasi tweet yang akan ditampilkan dalam popup retweet
       // ...
   ?>
   <!-- Struktur HTML untuk popup konfirmasi retweet -->
   <div class="retweet-popup">
       <!-- Isi dari popup konfirmasi retweet -->
   </div>
   ```
   - Memeriksa apakah ada permintaan untuk menampilkan popup konfirmasi retweet.
   - Mengambil informasi tweet yang akan ditampilkan dalam popup retweet.
   - Menampilkan popup konfirmasi retweet dengan struktur HTML yang sesuai.

3. **Popup Konfirmasi Retweet:**
   - Memuat informasi tweet yang akan diretweet, termasuk gambar, status, dan detail pengguna.
   - Menyediakan input untuk pengguna menambahkan komentar.
   - Menampilkan tombol untuk mengkonfirmasi retweet.

4. **Ajax dan JavaScript:**
   - Dapat terlibat dalam penanganan retweet dan interaksi pengguna lainnya.
   - Mungkin ada script JavaScript yang terkait dengan `retweet.js` atau sejenisnya.

# search user
Kode ini menangani pencarian pengguna (user) dalam aplikasi web. Berikut adalah penjelasan singkatnya:

1. **Pengecekan Permintaan Pencarian:**
   ```php
   if(isset($_POST['search']) && !empty($_POST['search'])){
       // Mendapatkan kata kunci pencarian dari input pengguna
       $search = $getFromU->checkInput($_POST['search']);
       
       // Melakukan pencarian menggunakan metode search()
       $result = $getFromU->search($search);
       
       // Menampilkan hasil pencarian jika ditemukan
       if(!empty($result)){
           // Menampilkan hasil pencarian dalam bentuk daftar pengguna
           // ...
       }
   }
   ```

   - Memeriksa apakah ada permintaan pencarian dan kata kunci pencarian tidak kosong.
   - Mengambil kata kunci pencarian dan membersihkannya menggunakan metode `checkInput()`.
   - Melakukan pencarian menggunakan metode `search()`.

2. **Menampilkan Hasil Pencarian:**
   ```php
   echo ' <div class="nav-right-down-wrap"><ul> ';
   foreach ($result as $user) {
       // Menampilkan setiap hasil pencarian dalam bentuk daftar pengguna
       // ...
   }
   echo '</ul></div>';
   ```

   - Menampilkan hasil pencarian dalam bentuk daftar pengguna.
   - Setiap pengguna ditampilkan dengan gambar profil, nama, dan username.
   - Hasil pencarian ditampilkan dalam elemen HTML dengan class dan struktur tertentu.

3. **Struktur HTML untuk Setiap Pengguna:**
   - Setiap pengguna ditampilkan dalam elemen `<li>` dengan struktur HTML yang sesuai.
   - Setiap elemen pengguna terdiri dari gambar profil, nama, dan username.
   - Hasil pencarian dibungkus dalam elemen `<ul>` untuk pembentukan daftar.

# search user in msg
Kode ini menangani pencarian pengguna (user) dan menampilkan hasil pencarian dalam format yang sesuai. Berikut adalah penjelasan singkatnya:

1. **Pengecekan Permintaan Pencarian:**
   ```php
   if(isset($_POST['search']) && !empty($_POST['search'])){
       // Mendapatkan ID pengguna dari sesi
       $user_id = $_SESSION['user_id'];
       
       // Mendapatkan kata kunci pencarian dari input pengguna
       $search  = $getFromU->checkInput($_POST['search']);
       
       // Melakukan pencarian menggunakan metode search()
       $result  = $getFromU->search($search);
       
       // Menampilkan hasil pencarian jika ditemukan
       echo '<h4>People</h4><div class="message-recent"> ';
       foreach ($result as $user) {
           // Menampilkan setiap hasil pencarian dalam bentuk daftar pengguna
           // ...
       }
       echo '</div>';
   }
   ```

   - Memeriksa apakah ada permintaan pencarian dan kata kunci pencarian tidak kosong.
   - Mendapatkan ID pengguna dari sesi.
   - Mendapatkan kata kunci pencarian dan membersihkannya menggunakan metode `checkInput()`.
   - Melakukan pencarian menggunakan metode `search()`.

2. **Menampilkan Hasil Pencarian Pengguna:**
   ```php
   echo '<h4>People</h4><div class="message-recent"> ';
   foreach ($result as $user) {
       // Menampilkan setiap hasil pencarian pengguna dalam bentuk daftar
       if($user->user_id != $user_id){
           // Menampilkan informasi pengguna dalam bentuk yang sesuai
           // ...
       }
   }
   echo '</div>';
   ```

   - Menampilkan pesan judul "People" di atas daftar hasil pencarian.
   - Setiap pengguna yang ditemukan ditampilkan dalam elemen HTML dengan class dan struktur tertentu.
   - Hasil pencarian pengguna dibungkus dalam elemen `<div>` dengan class "message-recent".
   
# tweet form
Kode ini menciptakan formulir pop-up untuk mengirimkan tweet baru dalam aplikasi web. Berikut adalah penjelasan singkatnya:

1. **Pencegahan Akses Langsung:**
   ```php
   <?php 
      include '../init.php';
      $getFromU->preventAccess($_SERVER['REQUEST_METHOD'], realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
   ?>
   ```

   - Memasukkan file `init.php` yang mungkin berisi fungsi dan konfigurasi aplikasi.
   - Memanggil metode `preventAccess` dari objek `$getFromU` untuk mencegah akses langsung ke file ini.

2. **Formulir Tweet Pop-up:**
   ```php
   <div class="popup-tweet-wrap">
      <div class="wrap">
         <div class="popwrap-inner">
            <div class="popwrap-header">
               <!-- Header pop-up tweet -->
            </div>
            <div class="popwrap-full tweet_body">
               <!-- Isi pop-up tweet -->
               <form id="popupForm" method='post' enctype='multipart/form-data'>
                  <!-- Area teks tweet -->
                  <textarea class='status' maxlength='141' name='status' placeholder="What's happening?" rows='3' cols='100%' style="font-size:17px;"></textarea>
                  <div class='hash-box'>
                     <ul>
                        <!-- Daftar tagar (jika ada) -->
                     </ul>
                  </div>
                  <div class='tweet_icons-wrapper'>
                     <!-- Tombol untuk mengunggah gambar dan ikon lainnya -->
                     <div class='t-fo-left tweet_icons-add'>
                        <ul>
                           <input type='file' name='file' id='file' />
                           <li>
                              <label for='file'><i class='fa fa-image' aria-hidden='true'></i></label>
                              <i class="fa fa-bar-chart"></i>
                              <i class="fa fa-smile-o"></i>
                              <i class="fa fa-calendar-o"></i>
                           </li>
                           <!-- Pesan kesalahan jika ada -->
                           <span class='tweet-error'>
                              <?php 
                                 if (isset($error)) {
                                    echo $error;
                                 } else if (isset($imgError)) {
                                    echo '<br>' . $imgError;
                                 }
                              ?>
                           </span>
                        </ul>
                     </div>
                     <!-- Tombol untuk mengirimkan tweet -->
                     <div class='t-fo-right'>
                        <button class="button_tweet" type="submit" name="tweet" style="outline:none;">Tweet</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

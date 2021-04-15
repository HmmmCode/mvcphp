<!-- Options -Multiviews untuk menghindari kesalahan ketika memanggil
folder atau file didalam folder 'public'

RewriteEngine On   -menulis ulang URL yang ada di browser
RewriteCond %{REQUEST_FILENAME} !-d    -jika url yg ditulis merupakan folder maka akan diabaikan
RewriteCond %{REQUEST_FILENAME} !-f     - menghindari nama file atau folder yang sama dengan method kita
RewriteRule ^(.*)$ index.php?url=$1 [L] -->
<!-- ^ = membaca apa yg ditulis di url mulai dari awal, setelah folder 'public'
(.*) = ambil semua karakter sampai selesai
index.php?url=$1 = arahkan ke file index yang mengirimkan url,
isi url nya adalah apapun yang ditulis di regex diisi ke -> $1(placeholder)
[L] = kalau ada rule yang sudah terpenuhi, jgn jalankan rule lain setelah ini -->
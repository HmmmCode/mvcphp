<?php
//Option -Indexes yang ada di htaccess, 
//jika ada user yang membuka folder lain 
//selama di folder tsb tidak ada index, maka block aksesnya
if (!session_id()) {
  session_start();
}
require_once '../app/init.php';

$app = new App;

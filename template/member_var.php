<?php
include('../admin/fungsi.php');

$judul = 'Member Area';
$menu = '<div id="kepala"><img src="../gambar/header960.jpg" /></div>'
	.'<div id="dropdownmenuyogi" class="menuyogi">'
    .'<ul id="dropdownmenu">'
    	.'<li><a href="../index.php">Home</a></li>'
		.'<li><a href="index.php">Member Area</a></li>'
        .'<li><a href="profil.php">Profil</a></li>'
        .'<li><a href="index.php?proses=logout">Logout</a></li>'
    .'</ul>'
    .'</div>'
    .'<div class="bersih">&nbsp;</div>';
		
/* Variabel untuk menampilkan judul berita */
/*******************************************/

// tampilkan semua judul berita pada samping halaman
konek_db(); // koneksikan ke MySQL Server
$hasil_news = mysql_query("SELECT * FROM news ORDER BY id_berita DESC");
$side_news = '<ul>';
while ($data = mysql_fetch_array($hasil_news))
{
	// gunakan stripslashes() untuk menghilangkan escaping character 
	$side_news .= '<li><p><a href="news.php?berita='.$data['id_berita'].'">'
				.stripslashes($data['jdl_berita']).'</a></p></li>';
}
$side_news .= '</ul>';

mysql_close();

		
// buatkan link untuk kembali, berguna jika ada error
$kembali = '<br><a href="javascript: history.back()"><< kembali</a>';

?>
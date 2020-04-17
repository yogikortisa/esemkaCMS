<?php

include('template/template.php');
include('template/index_var.php');
konek_db(); // kkoneksikan ke MySQL Server

/* variabel-variabll untuk menampilkan berita */
/*********************************************/

/* tampilkan berita secara lengkap */
@ $berita = $_GET['berita'];
// cegah Cross Site Scripting
$berita = filter_str($berita);
// lakukan query untuk mendapatkan berita selengkapnya
$hasil = mysql_query("SELECT * FROM news WHERE id_berita = '$berita'");
$data = mysql_fetch_array($hasil);
// n12br() fungsi alternatif untuk mengganti \n menjadi <br>
// gunakan stripslashes() untuk menghilangkan secaping character
$isi_berita = stripslashes($data['isi_berita']);
$isi_berita .= str_replace("\n", "<br>", $isi_berita);
$full_news = '<p>'.$isi_berita.'</p><br>'.'<b>Ditulis pada: </b>'.$data['tgl_berita'];
			
$judul = stripslashes($data['jdl_berita']);
mysql_close(); // tutup koneksi

$skin = new skin;
$skin->ganti_skin('template/smk4_skin.php');
$skin->ganti_tag('/{JUDUL}/', $judul);
$skin->ganti_tag('/{MENU}/', $menu);
$skin->ganti_tag('/{UTAMA}/', $full_news);
$skin->ganti_tag('/{NEWS}/', $side_news);
$skin->ganti_tampilan();

?>
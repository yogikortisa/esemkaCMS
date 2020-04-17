<?php

include('template/template.php');
include('template/index_var.php');

$judul = '<a href="index.php?id=1">Blog</a>';

$utama = '
<div class="post-image"><img src="gambarslide/sampah1.jpg" alt="" width="170" height="170" /></div>
            	<div class="post-text">
                	<h1 id="judul"><a href="http://localhost/belajarweb/smkn4batamCMS/news.php?berita=6">Mading SMK 4 Memprihatinkan</a></h1>
<p>Lihat saja foto yang kami ambil dari mading smk 4 ini,, sungguh mengenaskan bukan?? Lihat saja foto yang kami ambil dari mading smk 4 ini,, sungguh mengenaskan bukan?? Lihat saja foto yang kami ambil dari mading smk 4 ini,, sungguh mengenaskan bukan?? Lihat saja foto yang kami ambil dari mading smk 4 ini,, sungguh mengenaskan bukan?? </p>
                	<span><a href="http://localhost/belajarweb/smkn4batamCMS/news.php?berita=6"><img src="readmore4.gif" alt="picture" width="80" height="23" border="0" /></a></span>
                </div>
		</div>

		<div class="post">
        	<div class="post-image"><img src="gambar/hack.jpg" alt="" width="170" height="170" /></div>
            	<div class="post-text">
                	<h1 id="judul"><a href="http://localhost/belajarweb/smkn4batamCMS/news.php?berita=5">Jurusan Baru Tahun Ini</a></h1>
<p>SMK Negeri 4 Batam telah menambah satu jurusan baru di tahun ini, yaitu jurusan Animasi.. SMK Negeri 4 Batam telah menambah satu jurusan baru di tahun ini, yaitu jurusan Animasi.. SMK Negeri 4 Batam telah menambah satu jurusan baru di tahun ini, yaitu jurusan Animasi.. SMK Negeri 4 Batam telah menambah satu jurusan baru di tahun ini, yaitu jurusan Animasi..</p>
                    <span><a href="http://localhost/belajarweb/smkn4batamCMS/news.php?berita=5"><img src="readmore4.gif" alt="picture" width="80" height="23" border="0" /></a></span>
                </div>
		</div>
      
		<div class="post">
        	<div class="post-image"><img src="gambarslide/sampah2.jpg" alt="" width="170" height="170" /></div>
            	<div class="post-text">
                	<h1 id="judul"><a href="http://localhost/belajarweb/smkn4batamCMS/news.php?berita=4">Taati Rambu Lalu Lintas</a></h1>
<p>Poster ini sengaja dipajang agar para siswa dapat mentaati semua rambu-rambu lalu lintas di jalan.. Poster ini sengaja dipajang agar para siswa dapat mentaati semua rambu-rambu lalu lintas di jalan.. Poster ini sengaja dipajang agar para siswa dapat mentaati semua rambu-rambu lalu lintas di jalan.. </p>
                    <span><a href="http://localhost/belajarweb/smkn4batamCMS/news.php?berita=4"><img src="readmore4.gif" alt="picture" width="80" height="23" border="0" /></a></span>
                </div>
		</div>

		<div class="post">
        	<div class="post-image"><img src="gambarslide/sampah3.jpg" alt="" width="170" height="170" /></div>
            	<div class="post-text">
                	<h1 id="judul"><a href="http://localhost/belajarweb/smkn4batamCMS/news.php?berita=3">Pemandangan di Pagi Hari</a></h1>
<p>Pemandangan yang indah suasana di pagi hari, di sekolah kita tercinta SMK Negeri 4 tentunya.. Pemandangan yang indah suasana di pagi hari, di sekolah kita tercinta SMK Negeri 4 tentunya.. Pemandangan yang indah suasana di pagi hari, di sekolah kita tercinta SMK Negeri 4 tentunya.. Pemandangan yang indah suasana di pagi hari, di sekolah kita tercinta SMK Negeri 4 tentunya.. </p>
                     <span><a href="http://localhost/belajarweb/smkn4batamCMS/news.php?berita=3"><img src="readmore4.gif" alt="picture" width="80" height="23" border="0" /></a></span>
                </div>

';


	$skin = new skin;
	$skin->ganti_skin('template/smk4_skin.php');
	$skin->ganti_tag('/{JUDUL}/', $judul);
	$skin->ganti_tag('/{MENU}/', $menu);
	$skin->ganti_tag('/{UTAMA}/', $utama);
	$skin->ganti_tag('/{NEWS}/', $side_news);
	$skin->ganti_tampilan();
	
?>

    
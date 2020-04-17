<?php

// panggil file fungsi.php pada direktori admin
include('admin/fungsi.php');

$judul = 'Blog';

$menu = 	'<div id="kepala"><img src="gambar/header960.jpg" /></div>
	<div id="dropdownmenuyogi">
<ul id="dropdownmenu">
				<li><a href="index.php">Home</a></li>
				<li><a href="about.php">About</a>
					<ul>
						<li><a href="#">Test</a></li>
						<li><a href="#">Test</a></li>
						<li><a href="#">Test</a>
							<ul>
								<li><a href="#">Test</a></li>
								<li><a href="#">Test</a></li>
								<li><a href="#">Test</a></li>
							</ul>
						<li><a href="#">Test</a>

						</li>
						<li><a href="#">Test</a></li>
						<li><a href="#">Test</a>
							<ul>
								<li><a href="#">Test</a></li>
								<li><a href="#">Test</a></li>
								<li><a href="#">Test</a></li>
								<li><a href="#">Test</a>									
									<ul>
										<li><a href="#">Test2</a></li>
										<li><a href="#">Test2</a></li>
										<li><a href="#">Test2</a></li>
										<li><a href="#">Test2</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</li>
				<li><a href="member.php">Users</a></li>
				<li><a href="authors.php">Authors</a></li>
				<li><a href="/admin/index.php">Librarians</a></li>
				<li><a href="daftar.php">Register</a></li>
				<li><a href="sitemap.php">Site Map</a></li>
				<li><a href="bukutamu.php">Guest Book</a></li>
				<li><a href="kontak.php">Contact Us</a></li>
			</ul>
    </div>
    <div class="bersih">&nbsp;</div>';
	   
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
$kembali = '<br><a href="javascript: history.back()" style="color:#333; text-decoration: none; font-weight: bold;"><< kembali</a>';

?>
<?php
// panggil fungsi session_start()
session_start();

include('../template/template.php');
include('../template/member_var.php');

if (!cek_session('member'))
{
	$menu = '<div id="kepala"><img src="../gambar/header960.jpg" /></div>
	<div id="dropdownmenuyogi" class="menuyogi">
<ul id="dropdownmenu">
				<li><a href="../index.php">Home</a></li>
				<li><a href="profil.php">Profil</a>
					<ul>
						<li><a href="kepsek.php">Kepala Sekolah</a></li>
						<li><a href="sejarah.php">Sejarah</a></li>
						<li><a href="jurusan.php">Jurusan</a>
							<ul>
								<li><a href="#">RPL</a></li>
								<li><a href="#">KI</a></li>
								<li><a href="#">Animasi</a></li>
							</ul>
						<li><a href="fasilitas.php">Fasilitas</a>

						</li>
						<li><a href="visimisi.php">Visi dan Misi</a></li>
						<li><a href="tujuan.php">Tujuan Sekolah</a>
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
				<li><a href="blog.php">Blog</a></li>
				<li><a href="daftar.php">Daftar</a></li>
				<li><a href="login.php">Member Area</a></li>
				<li><a href="bukutamu.php">Buku Tamu</a></li>
				<li><a href="kontak.php">Contact</a></li>
			</ul>
    </div>
    <div class="bersih">&nbsp;</div>';
	$utama = 'Anda belum login. Silahkan <a style="color:#111; text-decoration: none; font-weight: bold" href="../login.php">Login</a> dulu.';
}
else
{
	@ $proses = $_GET['proses'];
	if ($proses == '')
		$proses = 'view';
	// cegah Corss Site Scripting
	$proses = filter_str($proses);
	
	switch ($proses)
	{
		case 'view':
			$utama = '<h3>Selamat Datang di Member Area</h3>'
					.'Anda login sebagai: <b>'.$_SESSION['member']
					.'</b>';
		break; // akhir dari proses view
		
		case 'logout':
			if (!logout('member'))
				$utama = 'Tidak bisa logout. <a style="color:#111; text-decoration: none; font-weight: bold" href="../login.php">Login</a> dulu.';
			else
				$utama = 'Anda telah logout dari sistem. Klik '
						.'<a style="color:#111; text-decoration: none; font-weight: bold;" href="../login.php">di sini</a> untuk login kembali.';
		break; // akhir dari proses logout
	} // akhir dari switch
} // akhir dari else

$skin = new skin;
$skin->ganti_skin('../template/member_skin.php');
$skin->ganti_tag('/{MENU}/', $menu);
$skin->ganti_tag('/{JUDUL}/', $judul);
$skin->ganti_tag('/{NEWS}/', $side_news);
$skin->ganti_tag('/{UTAMA}/', $utama);
$skin->ganti_tampilan();

?>
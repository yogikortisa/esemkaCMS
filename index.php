<?php
session_start();
include('template/template.php');
include('template/index_var.php');
		
// dapatkan isi page dari URL
/* @ $page = $_GET['page'];
if ($page == '')
	$page = 0; */
$page = isset($_GET['page']) ? $_GET['page'] : 0;
	
// cegah Cross Site Scripting
$page = filter_str($page);

// tentukan berita per halaman
$berita_per_hal = 3;

// lakukan query lalu hitung jumlah halaman dengan ceil()
konek_db(); // koneksikan ke MySQL Server
$query_hal = mysql_query("SELECT * FROM news");
$jml_baris = mysql_num_rows($query_hal);
$jml_hal = ceil($jml_baris / $berita_per_hal); // jumlah halaman

// dapatkan nilai $offset
$record = $page * $berita_per_hal;

// cuplikan berita yang ada pada halaman utama
$hasil = mysql_query("SELECT * FROM news ORDER BY id_berita DESC LIMIT $record,
		 $berita_per_hal");
while ($data = mysql_fetch_array($hasil))
{
	$isi_berita = str_replace("\n", "<br>", $data['isi_berita']);
	// mencuplik berita, 25 kata pertama
	$cuplikan = array();
	$pecahan_kata = explode(" ", $isi_berita);
	for ($i=0; $i<25; $i++)
		@$cuplikan[$i] = $pecahan_kata[$i];
		
	// gabungkan setiapkan array kata dipisahkan kembali dengan spasi
	$cuplikan = implode(" ", $cuplikan);
	// gunakan stripslashes() untuk menghilangkan escaping character
	$cuplikan = stripslashes($cuplikan);
	$jdl_berita = stripslashes($data['jdl_berita']);
	$link = '<a href="news.php?berita='.$data['id_berita'].'"><blink><b>&raquo; Read More</b></blink></a>';
	
@	$news .= '<p>'.$data['tgl_berita'].'<br><b>'.$jdl_berita.'</b>'
		  .'<p>'.$cuplikan.' . . .<br>'.$link.'</p></p><hr>';
}

if (cek_session('member'))
{
	@ $proses = $_GET['proses'];
	if ($proses == '')
		$proses = 'view';
	// cegah Corss Site Scripting
	$proses = filter_str($proses);
	
	switch ($proses)
	{
		case 'logout':
			if (logout('member')) {
				echo "<script>document.location='index.php'</script>";
	}
		break; // akhir dari proses logout
	} // akhir dari switch
	
	$loginnya = '';
	$menu = '<div id="kepala"><img src="gambar/header960.jpg" /></div>
	<div id="dropdownmenuyogi" class="menuyogi">
<ul id="dropdownmenu">
				<li><a href="index.php">Home</a></li>
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
				<li><a href="index.php?proses=logout" onClick="return confirm(\'Apakah anda yakin ingin Logout?\')">Logout</a></li>
				<li id="status"><a href="#"><font color="red" size="2.5px">Status: Member</font></a></li>
				<li id="user"><a href="#"><font color="red" size="2.5px">User: '.$_SESSION['member'].'</font></a></li>
				
				
			</ul>
    </div>
    <div class="bersih">&nbsp;</div>';
}
else
{
		$loginnya = '<div id="bg_menu">Login</div>
        <div id="content_menu">
                <form name="form" method="post" action="login.php?login_id=proses_login"> 
        <table width="100%" border="0" cellspacing="2" cellpadding="2" style="font-family:tahoma; font-size:12px;"> 
            <tr> 
              <td>Username</td> 
              <td>:</td> 
              <td><input name="username" type="text" id="username" size="23"></td> 
            </tr> 
            <tr> 
              <td>Password</td> 
              <td>:</td> 
              <td><input name="password" type="password" id="password" size="23"></td> 
            </tr> 
			<tr>
            	<td><input type="submit" name="submit" value="Login" id="tombol" /></td>
            </tr>
        </table> 
        Belum punya akun? <blink><a href="daftar.php"><strong>Daftar</strong></a></blink> sekarang juga!
        		</form>
        </div>';
}


// jika jumlah halaman lebih dari satu tampilkan link halaman
if ($jml_hal > 1)
{
	$news .= 'Halaman: ';
	for ($a=0; $a<$jml_hal; $a++)
		$news .= ' <a href="index.php?page='.$a.'">'.intval($a+1)
				.'</a> ';
}
mysql_close(); // tutup koneksi

$skin = new skin;
$skin->ganti_skin('template/smk4_skin2.php');
$skin->ganti_tag('/{MENU}/', $menu);
$skin->ganti_tag('/{NEWS}/', @$news);
	$skin->ganti_tag('/{LOGINNYA}/', $loginnya);
$skin->ganti_tampilan();
?>
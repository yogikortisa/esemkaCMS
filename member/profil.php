<?php

// mulai session
session_start();

include('../template/template.php');
include('../template/member_var.php');

$judul = 'Update Profil';

// cek apakah user sudah login atau belum
if (!cek_session('member'))
{
	$menu = '<div id="kepala"><img src="../gambar/header960.jpg" /></div>'
		   .'<div class="bersih">&nbsp;</div>';
	$profil = 'Anda belum login. Silahkan <a style="color:#111; text-decoration: none; font-weight: bold" href="../login.php">Login</a> dulu.';
}
else
{
	@ $proses = $_GET['proses'];
	if ($proses == '')
		$proses = 'view';
	// cegah Cross Site Scripting
	$proses = filter_str($proses);
	
	switch ($proses)
	{
		case 'view':
			// alkukan query database untuk mendapatkan profil
			$user = $_SESSION['member']; // user yang sedang login
			konek_db(); // koneksikan ke MysQL Server
			$hasil = mysql_query("SELECT * FROM member WHERE username='$user'");
			$data = mysql_fetch_array($hasil);
			mysql_close(); // tutup koneksi
			
			$profil = '<p>Silahkan mengubah data-data anda. Tekan UPDATE untuk memproses.</p>'
					.'<form action="profil.php?proses=update" method="post">'
					.'<table border="0" cellpadding="4">'
					.'<tr><td>Username: </td>'
						.'<td>'.$data['username'].'</td>'
					.'<tr><td>Password: </td>'
						.'<td><input type="password" maxlength="16" name="password" value="'.$data['password'].'"></td></tr>'
					.'<tr><td>Nama Lengkap: </td>'
						.'<td><input type="text" name="nama" value="'.$data['nama'].'"></td></tr>'
					.'<tr><td>Email: </td>'
						.'<td><input type="text" name="email" value="'.$data['email'].'"></td></tr>'
					.'<tr><td>Alamat: </td>'
						.'<td><input type="text" name="alamat" value="'.$data['alamat'].'" size="50"></td></tr>'
					.'<tr><td>Kode Pos: </td>'
						.'<td><input type="text" name="kodepos" size="7" maxlength="7" value="'.$data['kode_post'].'"></td></tr>'
					.'<tr><td>Kota: </td>'
						.'<td><input type="text" name="kota" value="'.$data['kota'].'"></td></tr>'
					.'<tr><td><input type="submit" value="UPDATE"></td></tr>'
					.'</table></form>';
		break; // akhir dari proses view
		
		case 'update':
			$password = $_POST['password'];
			$nama = $_POST['nama'];
			$email = $_POST['email'];
			$alamat = $_POST['alamat'];
			$kodepos = $_POST['kodepos'];
			$kota = $_POST['kota'];
			
			$pesan_error = '';
			// cek setiap field sebelum memasukkan ke database
			if (!cek_field($_POST))
				$pesan_error = 'Error: masih ada field yang kosong<br>';
			// cek password selain alpabet, numerik dan _ maka Error
			if (preg_match('/[^a-zA-Z0-9_]/', $password))
				$pesan_error .= 'Error: password hanya boleh terdiri dari huruf, angka dan _<br>';
			// cek email
			if (!cek_email($email))
				$pesan_error .= 'Error: email tidak valid<br>';
				
			if ($pesan_error != '')
				$profil = $pesan_error.$kembali;
			else
			{
				// masukkan data ke database
				konek_db(); // koneksikan ke MySQL Server
				$user = $_SESSION['login']; // user yang sedang login
				$query = "UPDATE member SET password='$password', nama='$nama', email='$email', alamat='$alamat', kode_post='$kodepos', kota='$kota' WHERE username='$user'";
				$hasil = mysql_query($query);
				if (!$hasil)
					$profil = 'Error: tidak dapat mengupdate profil ke database.';
				else
					$profil = 'Profil berhasil diupdate. <a style="color:#111; text-decoration: none; font-weight: bold" href="profil.php">Lihat Profil</a>';
			} // akhir dari else ke dua
	} // akhir dari switch
} // akhir dari else pertama

// ganti tampilan
$skin = new skin;
$skin->ganti_skin('../template/member_skin.php');
$skin->ganti_tag('/{MENU}/', $menu);
$skin->ganti_tag('/{NEWS}/', $side_news);
$skin->ganti_tag('/{JUDUL}/', $judul);
$skin->ganti_tag('/{UTAMA}/', $profil);
$skin->ganti_tampilan();

?>
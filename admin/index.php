<?php

// mulai session
session_start();
include('fungsi.php');

// ambil data dari URL yaitu proses
@ $proses = $_GET['proses'];
if ($proses == '')
	$proses = 'login';	

// cegah Cross Site Scripting
$proses = filter_str($proses);

switch ($proses)
{
	case 'login': // titik dua, bukan titik koma
		//cek apakah user sudah login atau belum
		if (!cek_session('admin'))
		{
			echo '<center><h3>SMK Negeri 4 Batam - Admin Area</h3>'
				.'<form action="index.php?proses=proses_login" method="post">'
				.'<table border="0" cellpadding="0">'
				.'<tr><td>Username: </td>'
					.'<td><input type="text" name="username"></td></tr>'
				.'<tr><td>Password: </td>'
					.'<td><input type="password" name="password"></td></tr>'
				.'<tr><td><input type="submit" value="LOGIN"></td></tr>'
				.'</table></form>';
		}
		else
		{
			echo '<h3>Selamat Datang di Member Area</h3>'
				.'<p>Hey <b>'.$_SESSION['admin'].'</b>! Silahkan rusak website Anda!!! :D</p>'
				.'<a href="berita.php">Manajemen Berita</a><br />'
				.'<a href="member.php">Manajemen Member</a><br />'
				.'<a href="bukutamu.php">Manajemen Buku Tamu</a><br />'
				.'<a href="index.php?proses=logout">Logout</a><br />';
		}
	break;

	case 'proses_login':
		// cegah dari SQL Injection
		$username = filter_str($_POST['username']);
		$password = filter_str($_POST['password']);
		
		// panggil fungsi login untuk mencocokkan data
		konek_db(); // koneksikan ke MySQL Server
		if (!login('admin', $username, $password))
		{
			echo 'Username atau Password salah!. <br><br>'
				.'<a href="javascript: history.back()"><< Kembali</a>';
		}
		else
		{
			// buatkan session karena berhasil login
			$_SESSION['admin'] = $username; // buat session bernama admin
			echo '<center>Login berhasil.<br />Anda Login sebagai <b>'.$username.'</b> dengan level Administrator.<br />Klik <a href="index.php">disini</a> untuk masuk ke admin area.</center>';
		}
	break; // akhir dari proses proses_login
	
	case 'logout':
		if (!logout('admin'))
			echo 'Tidak bisa logout. <a href="index.php>Login</a> dulu.</a>';
		else
			echo 'Anda telah logout dari sistem. Silahkan <a href="index.php">Login</a> lagi';
	break; // akhir dari proses logout
} // akhir dari switch

?>
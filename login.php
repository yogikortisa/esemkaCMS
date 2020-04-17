<?php
// panggil session_start() karena berhubungan dengan session
session_start();

	include('template/template.php');
	include('template/index_var.php');

if (cek_session('member')) {
	echo "<script>document.location='member/index.php'</script>";
}

	
/* variabel-variabel untuk halaman login */
/****************************************/
@ $login = $_GET['login_id'];
if ($login == '')
	$login = 'form';
// cegah Cross Site Scripting
$login = filter_str($login);

switch ($login)
{
	case 'form': // jika login_id = form maka eksekusi kode berikut
		$page_login = '<p>Untuk masuk ke member area silahkan login terlebih dahulu.</p>'
					.'<form action="login.php?login_id=proses_login" method="post">'
					.'<table border="0" cellpadding="4">'
					.'<tr><td>Username: </td>'
						.'<td><input type="text" name="username"></td></tr>'
					.'<tr><td>Password: </td>'
						.'<td><input type="password" name="password"></td><tr>'
					.'<tr><td colspan="2" align="center">'
						.'<input type="submit" value="Login"></td></tr>'
					.'</table>'
					.'</form>'
					.'<p>Lupa password? klik <a href="lupa_pass.php" style="text-decoration:none; color: #222222"><b>di sini</b></a></p>';
	break; // akhir dari proses form
	
	case 'proses_login': // jika login_id = proses_login eksekusi berikut
		// cegah SQL Injection
		$username = filter_str($_POST['username']);
		$password = filter_str($_POST['password']);
		
		konek_db(); // koneksikan ke MySQL Server
		
		//panggil fungsi login()
		if (!login('member', $username, $password))
			$page_login = 'Username atau password salah.<br>'.$kembali;
		else
		{
			$_SESSION['member'] = $username; // buat session bernama member
			$page_login = 'Login berhasil. Silahkan klik <a href="member/index.php" style="color:#111; text-decoration: none; font-weight: bold"> '
						.'disini</a> untuk masuk ke member area.';
		}
		mysql_close(); // tutup koneksi
	break; // akhir dari proses proses_login
} // akhir dari switch
$judul = 'Login';
$skin = new skin;
$skin->ganti_skin('template/smk4_skin.php');
$skin->ganti_tag('/{JUDUL}/', $judul);
$skin->ganti_tag('/{MENU}/', $menu);
$skin->ganti_tag('/{UTAMA}/', $page_login);
$skin->ganti_tag('/{NEWS}/', $side_news);
$skin->ganti_tampilan();

?>
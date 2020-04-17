<?php

	include('template/template.php');
	include('template/index_var.php');
	
/* variabel-variabel untuk halaman daftar */
/*****************************************/
konek_db(); // koneksikan ke MySQL Server
@ $daftar = $_GET['daftar_id'];
if ($daftar == '')
	$daftar = 'form';

// cegah Cross Site Scripting
$daftar = filter_str($daftar);

switch ($daftar)
{
	case 'form': // jika daftar_id = form eksekusi kode berikut
	$page_daftar = '<center><h3>Silahkan Mengisi Form Berikut</h3>'
		.'<form action="daftar.php?daftar_id=proses_form" method="post">'
		.'<table border="0" cellpadding="4">'
		.'<tr><td>Username: </td>'
			.'<td><input type="text" name="username" maxlength="16">'
			.' max. 16 karakter</td></tr>'
		.'<tr><td>Password: </td>'
			.'<td><input type="password" name="password" maxlength="16">'
			.' max. 16 karakter</td></tr>'
		.'<tr><td>Nama Lengkap: </td>'
			.'<td><input type="text" name="nama" maxlength="30"></td></tr>'
		.'<tr><td>Email: </td>'
			.'<td><input type="text" name="email" maxlength="30"></td></tr>'
		.'<tr><td>Alamat: </td>'
			.'<td><input type="text" name="alamat" maxlength="50"></td></tr>'
		.'<tr><td>Kode Pos: </td>'
			.'<td><input type="text" name="kodepos" maxlength="6" size="6"></td></tr>'
		.'<tr><td>Kota: </td>'
			.'<td><input type="text" name="kota" maxlength="20"></td></tr>'
		.'</table><br />'
		.'<input type="submit" value="Daftar">'.' '.'<input type="reset" value="Batal">'
		.'</form>';
	break; // akhir dari proses form
	
	case 'proses_form': // jika daftar_id = proses_form eksekusi berikut
		$username = $_POST['username'];
		$password = $_POST['password'];
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];
		$kodepos = $_POST['kodepos'];
		$kota = $_POST['kota'];
		
		$pesan_error = '';
		// sebelum memasukkan ke database cek setiap field dulu
		// panggil fungsi cek_field() untuk mengecek field
		if (!cek_field($_POST))
			$pesan_error = 'Error: masih ada field yang kosong<br>';
			
		// cek username apakah mengandung karakter aneh
		if (preg_match('/[^a-zA-Z0-9_]/', $username)) // [^ artinya "kalau tidak ada string berikut"
			$pesan_error .= 'Error: username hanya boleh terdiri dari huruf, angka dan _<br>';
			
		// cek password
		if (preg_match('/[^a-zA-Z0-9_]/', $password)) // ^[ artinya "kalau ada string berikut"
			$pesan_error .= 'Error: passworrd hanya boleh terdiri dari huruf, angka dan _<br>';
			
		// cek email
		if (!cek_email($email))
			$pesan_error .= 'Error: email tidak valid<br>';
			
		// cek aakah username sudah terpakai atau belum
		$q_cek = mysql_query("SELECT * FROM member WHERE username='$username'");
		if (mysql_num_rows($q_cek) > 0)
			$pesan_error .= 'Error: username sudah terpakai, silahkan pilih yang lain<br>';
			
		// cek isi dari $pesan_error jika tidak sama dengan '' maka ada error
		if ($pesan_error != '')
			$page_daftar = $pesan_error.$kembali;
		else
		{
			$query = "INSERT INTO member VALUES ('$username', '$password', '$nama', '$email', '$alamat', '$kodepos', '$kota')";
			$hasil = mysql_query($query);
			mysql_close(); // tutup koneksi
			
		if (!$hasil)
			$page_daftar = 'Error: gagal memasukkan data ke database. Mohon coba lagi nanti!<br>'.$kembali;
		else
		{
			$page_daftar = 'Registrasi suskes. Data registrasi juga kami kirim ke email anda, '
						  .'silahkan dicek.<br><br>Klik <a href="login.php" style="text-decoration:none; color: #222222;"><b>Login</b></a> untuk '
						  .'masuk ke member area.';
						  
		
			
		// buat variabel untuk proses pengiriman email
		$to = $email; // email dari user yang baru mendaftar
		$subject = 'Selamat Anda Sudah Terdaftar!';
		$isi_email = "www.smkn4batam.sch.id\n\n"
					."Saudara/i $nama, terima kasih telah menjadi member dari website kami.\n"
					."Berikut ini adalah username dan password untuk login di member area\n\n"
					."======================================================\n"
					."Username: $username\n"
					."Password: $password\n"
					."======================================================\n"
					."SMK Negeri 4 Batam - Unggul dan Kompetitif";
		$from = 'From: yogi@smkn4batam.sch.id';
		
		// jika tidak memiliki mail server atau belum di server sebernarnya
		// beri komentar pada fungsi mail() dibawah ini
		// mail($to, $subject, $isi_email, $from); // harus memiliki mail server dan terhubung ke internet
		} // akhir dari else ke dua
		} // akhir dari else pertama
	break; // akhir dari proses proses_form
} // akhir dari switch

//mysql_close(); // tutup koneksi
$judul = 'Pendaftaran Online';

$skin = new skin;
$skin->ganti_skin('template/smk4_skin.php');
$skin->ganti_tag('/{JUDUL}/', $judul);
$skin->ganti_tag('/{MENU}/', $menu);
$skin->ganti_tag('/{UTAMA}/', $page_daftar);
$skin->ganti_tag('/{NEWS}/', $side_news);
$skin->ganti_tampilan();

?>
<?php

// fungsi untuk koneksi ke MySQL
function konek_db($localhost='localhost', $user='root', $pass='', $db='smkn4batam')
{
	@ $koneksi = mysql_connect($localhost, $user, $pass);
	if (!$koneksi)
		return false;
		
	mysql_select_db($db);
}

// fungsi untuk login
function login($tabel, $username, $password)
{
	$query = "SELECT * FROM $tabel WHERE username='$username' AND password='$password'";
	$hasil = mysql_query($query);
	// cek jumlah baris yang dikembalikan
	if (@ mysql_num_rows($hasil) > 0)
		return true;
	else
		return false;
}

// cegah dari SQL Injection dan Cross Site Scripting
function filter_str($string)
{
	$filter = preg_replace('/[^a-zA-Z0-9_]/', '', $string);
	return $filter;
}

// cek setiap field apa ada yang kosong?
function cek_field($var)
{
	foreach ($var as $field)
		{
			if ($field == '' || !isset($field))
				return false;
		}
	return true;
}

// cek kevalidan email
function cek_email($email)
{
	// fungsi untuk mengecek kevalidan email
	if (preg_match('/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\.]+$/', $email))
		return true;
	else
		return false;
}

// fungsi untuk logout
function logout($nama_session)
{
	if (isset($_SESSION[$nama_session]))
	{
		unset ($_SESSION[$nama_session]);
		session_destroy();
		return true;
	}
	else
		return false;
}

// cek session
function cek_session($nama_session)
{
	if (isset($_SESSION[$nama_session]))
		return true; // session login terisi
	else
		return false; // session login kosong
}

?>


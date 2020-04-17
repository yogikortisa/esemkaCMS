<?php

include('template/template.php');
include('template/index_var.php');

$judul = '<a href="index.php?id=1">Profil SMK Negeri 4 Batam</a>';

$utama = '<b>1. SMK NEGERI 4 BATAM</b>
<p>SMK NEGERI 4 Batam bagian terpadu dari Sistem Pendidikan Nasional,dalam hal ini Dinas Pendidikan Kota Batam dan Pemerintah Kota Batam dan  Pemerintahan kota Batam,mengemban misi untuk meningkatkan pendidikan kejuruan di indonesia khususnya Kota Batam.Dalam mempersiapkan tugas penting tersebut,tenaga pendidik dan kependidikan telah mengikuti program pengembangakan baik ddi dalam maupun di luar negeri.
  SMK NEGERI 4 BATAM mengembangkan jasa diklat, diklat untuk siswa/i yang berada di Kota Batam dan sekitarnya serta kegiatan unit produksi dan jasa.Dengan fasilitas pendidikan yang cukup memadai dan institusi pasangan yang sesuai dengan program keahlian yang ada, SMK NEGERI 4 Batam siap memberikan layanan prima dengan sistem manajemen mutu ISO 90001:2008 agar siap menghadapi persaingan global.</p>';


	$skin = new skin;
	$skin->ganti_skin('template/smk4_skin.php');
	$skin->ganti_tag('/{JUDUL}/', $judul);
	$skin->ganti_tag('/{MENU}/', $menu);
	$skin->ganti_tag('/{UTAMA}/', $utama);
	$skin->ganti_tag('/{NEWS}/', $side_news);
	$skin->ganti_tampilan();
	
?>
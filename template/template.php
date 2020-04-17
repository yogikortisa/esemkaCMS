<?php

class skin
{
	var $tag = array();
	var $file_skin;
	var $halaman;
	
	function ganti_tag($namatag, $str_pengganti)
	{
		$this->tag[$namatag] = $str_pengganti;
	}
	
	function ganti_skin($namafile)
	{
		$this->file_skin = $namafile;
	}
	
	function ganti_tampilan()
	{
		$this->halaman = file($this->file_skin);
		$this->halaman = implode("", $this->halaman);
		foreach($this->tag as $str_dicari => $str_baru)
		{
			$this->halaman = preg_replace($str_dicari, $str_baru, $this->halaman);
		}
		echo $this->halaman;
	}
}

?>
<?php

$konek = mysql_connect("localhost","root","jogja");
$db = mysql_select_db("mahasiswa");

if($konek)
	{
		echo("berhasil<br>");
	}
else
	{
		echo("gagal terhubung<br>");
	}

if ($db)
	{
		echo ("database tersedia<br>");
	}
else
	{
		echo ("database tidak ditemukan<br>");
	}

$query = "select * from mahasiswa";
$hasil = mysql_query($query);

$data_mahasiswa = array();

	while ($data = mysql_fetch_array($hasil))
	{
		$data_mahasiswa[] = array('nim' => $data['nim'],
			'nama' => $data['nama'],
			'alamat' => $data['alamat'],
			'prodi' => $data['prodi']);
	}


$document = new DOMDocument();
	$document->formatOutput = true;
	$root = $document->createElement("data");
	$document->appendChild($root);
	foreach($data_mahasiswa as $mahasiswa)
	{
		$block = $document->createElement("mahasiswa");

		$nim = $document->createElement("nim");
		$nim->appendChild($document->createTextNode($mahasiswa['nim']));
		$block->appendChild($nim);

		$nama = $document->createElement("nama");
		$nama->appendChild($document->createTextNode($mahasiswa['nama']));
		$block->appendChild($nama);

		$alamat = $document->createElement("alamat");
		$alamat->appendChild($document->createTextNode($mahasiswa['alamat']));
		$block->appendChild($alamat);

		$prodi = $document->createElement("prodi");
		$prodi->appendChild($document->createTextNode($mahasiswa['prodi']));
		$block->appendChild($prodi);

		$root->appendChild($block);
	}

	//menyimpan data dalam bentuk file XML
	$generateXML = $document->save("mahasiswa.xml");
	if($generateXML)
		{
			echo "berhasil di generate <br><br>";
		}
	else
		{
			echo "gagal <br><br>";
		}

	//membaca file XML
		//membuka file
	$url = "http://localhost:8080/sit/mahasiswa.xml";
	$client = curl_init($url);
	curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($client);
	curl_close($client);

	//ditampilkan dalam bentuk HTML
	$data_mahasiswaxml = simplexml_load_string($response);
	//print_r($data_mahasiswaxml);
	echo "
	<table border='1'>
		<tr>
			<td>NIM</td>
			<td>Nama</td>
			<td>Alamat</td>
			<td>Prodi</td>
		</tr>";
		foreach ($data_mahasiswaxml->mahasiswa as $mahasiswa)
		 {
			echo "
			<tr>
				<td>".$mahasiswa->nim."</td>
				<td>".$mahasiswa->nama."</td>
				<td>".$mahasiswa->alamat."</td>
				<td>".$mahasiswa->prodi."</td>
			</tr>";
		}
	echo "</table>";

?>

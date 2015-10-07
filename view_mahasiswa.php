<html>
<head>
	<title>View Data Bukti</title>
</head>
<body>
	<?php

	$url = "http://localhost:8080/sit/mhs.php";
	$client = curl_init($url);
	curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($client);
	curl_close($client);

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
</body>
</html>

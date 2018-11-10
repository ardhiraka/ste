<?php

require_once '../../db.php';

$splits 	= $db->fetch_all('select kode, angka, SUM(nominal) as nominal from split WHERE inRekap = 0 AND tanggal = ? GROUP BY kode, angka ORDER BY nominal DESC, kode ASC, angka ASC', date('Y-m-d'));
$response 	= ['status' => 'success'];
$insert 	= [];

if ($splits) :
	$crossover 	= [
		'J' 	=> 'P',
		'P'		=> 'J',
		'T'		=> 'S',
		'S'		=> 'T',
		'PING'	=> 'TENG',
		'TENG'	=> 'PING',
		'TS'	=> 'TT',
		'TT'	=> 'TS',
		'JP'	=> 'JJ',
		'JJ'	=> 'JP',
		'H'		=> 'H'
	];
	$crossed = [];

	foreach ($splits as $item) :
		$exp 	= explode(".", $item['kode']);
		$fCode	= $exp[0];

		// jika termasuk 50:50
		if (in_array($fCode, array_keys($crossover))) :
			if (in_array($item['kode'], $crossed)) continue;

			if ($fCode == 'H') :
				$iCode 		= $item['kode'];
				$iLawan 	= str_replace($exp[1], $crossover[$exp[1]], $item['kode']);
			else :
				$withHead 	= count($exp) > 1 ? true : false;
				$iCode		= $withHead ? $item['kode'] : $fCode;
				$iLawan 	= $withHead ? str_replace($fCode, $crossover[$fCode], $item['kode']) : $crossover[$fCode];
			endif;

			$iLawanIn 	= array_search($iLawan, array_column($splits, 'kode'));
			$iLawanDt 	= $iLawanIn ? $splits[$iLawanIn] : null;

			if ($iLawanIn) :
				if ($item['nominal'] >= $iLawanDt['nominal']) :
					$uCode 		= $iCode;
					$uNominal	= $item['nominal'] - $iLawanDt['nominal'];
				else :
					$uCode 		= $iLawanDt['kode'];
					$uNominal	= $iLawanDt['nominal'] - $item['nominal'];
				endif;

				$crossed[] = $iCode;
				$crossed[] = $iLawan;
			else :
				$uCode 		= $iCode;
				$uNominal	= $item['nominal'];

				$crossed[] 	= $iCode;
			endif;

			$insert[] = [
				'kode'		=> $uCode,
				'angka'		=> null,
				'nominal'	=> $uNominal,
				'tanggal'	=> date('Y-m-d')
			];
		else :
			$insert[] = [
				'kode'		=> $item['kode'],
				'angka'		=> $item['angka'],
				'nominal'	=> $item['nominal'],
				'tanggal'	=> date('Y-m-d')
			];
		endif;
	endforeach;

	$db->insert('rekap', $insert);
	$db->query("UPDATE split SET inRekap = 1 WHERE inRekap = 0 AND tanggal = ?", date('Y-m-d'));

	$logActivity->setLog("Check in data moved to recap");
else :
	$response = ['status' => 'error', 'error' => 'Tidak ada data!'];
endif;

echo json_encode($response);
<?php

require_once 'db.php';

$splits = $db->fetch_all("select * from split where isProcessed = 0 and tanggal = ?", '2018-10-12');
$inData = [];

foreach ($splits as $split) :
	if (in_array($split['kode'], ['2D', '3D', '4D'])) :
		$angka = explode('.', $split['angka']);

		if (array_key_exists($split['kode'], $inData)) :
			foreach ($angka as $item) :
				if (array_key_exists($item, $inData[$split['kode']])) :
					$inData[$split['kode']][$item]['id'][] 			= $split['id'];
					$inData[$split['kode']][$item]['nominal'][] 	= $split['nominal'];
					$inData[$split['kode']][$item]['total']			+= $split['nominal'];
				else :
					$inData[$split['kode']][$item] = [
						'id'		=> [$split['id']],
						'nominal'	=> [$split['nominal']],
						'total'		=> $split['nominal']
					];
				endif;
			endforeach;
		else :
			foreach ($angka as $item) :
				$inData[$split['kode']][$item] = [
					'id'		=> [$split['id']],
					'nominal'	=> [$split['nominal']],
					'total'		=> $split['nominal']
				];
			endforeach;
		endif;
	else :
		if (array_key_exists($split['kode'], $inData)) :
			if ($inData[$split['kode']]['child']) :
				if (array_key_exists($split['angka'], $inData[$split['kode']]['children'])) :
					$inData[$split['kode']]['children'][$split['angka']]['id'][] 		= $split['id'];
					$inData[$split['kode']]['children'][$split['angka']]['nominal'][] 	= $split['nominal'];
					$inData[$split['kode']]['children'][$split['angka']]['total']		+= $split['nominal'];
				else :
					$inData[$split['kode']]['child'] = true;
					$inData[$split['kode']]['children'][$split['angka']] = [
						'id'		=> [$split['id']],
						'nominal'	=> [$split['nominal']],
						'total'		=> $split['nominal']
					];
				endif;
			else :
				$inData[$split['kode']]['id'][] 		= $split['id'];
				$inData[$split['kode']]['nominal'][] 	= $split['nominal'];
				$inData[$split['kode']]['total']		+= $split['nominal'];
			endif;
		else :
			if (is_null($split['angka'])) :
				$inData[$split['kode']] = [
					'child'		=> false,
					'id'		=> [$split['id']],
					'nominal'	=> [$split['nominal']],
					'total'		=> $split['nominal']
				];
			else :
				$inData[$split['kode']]['child'] = true;
				$inData[$split['kode']]['children'][$split['angka']] = [
					'id'		=> [$split['id']],
					'nominal'	=> [$split['nominal']],
					'total'		=> $split['nominal']
				];
			endif;
		endif;
	endif;
endforeach;


echo "<pre>";
// print_r($t);
// print_r($splits);
print_r($inData);
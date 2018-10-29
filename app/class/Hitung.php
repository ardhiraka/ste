<?php

class Hitung
{
	
	private $for;
	private $db;
	private $winNumber;
	private $data;
	private $config;
	private $result;
	private $memberTotal;
	private $smsOut;
	private $total;
	public 	$log = false;

	public function for(string $for) : self
	{
		$this->for = $for;

		return $this;
	}

	public function setDBHelper($db) : self
	{
		$this->db = $db;

		return $this;
	}

	public function setWinNumber($number) : self
	{
		$this->winNumber = $number;

		return $this;
	}

	public function setTotalFromMember($total) : self
	{
		$this->memberTotal = $total;

		return $this;
	}

	public function getTotal()
	{
		return $this->total;
	}

	public function exec()
	{
		$this->getData();

		if ($this->data) :
			$this->calcData();
			
			$this->smsOutCalc();

			$this->log = true;
		endif;
	}

	public function saveLog()
	{
		$this->db->insert('log_hitung', ['tgl' => date('Y-m-d')]);
	}

	private function getData()
	{
		if ($this->for == 'dealer') :
			$this->data = $this->db->fetch_all("SELECT * FROM `rekap` WHERE isCalc = 0 AND tanggal = ?", date('Y-m-d'));
			
			if ($this->data) :
				$config = $this->db->fetch_all("SELECT * FROM `member_config` WHERE member_id = ?", 1);
				$maping = [];

				foreach ($config as $item) :
					$maping[$item['member_id']] = (array) json_decode($item['config']);
				endforeach;

				$this->config = $maping;
			endif;
		elseif ($this->for == 'member') :
			$this->data = $this->db->fetch_all("SELECT * FROM `split` WHERE isCalc = 0 AND tanggal = ?", date('Y-m-d'));
			
			if ($this->data) :
				$ids 		= array_values(array_unique(array_column($this->data, 'member_id')));
				$config 	= $this->db->fetch_all("SELECT * FROM `member_config` WHERE member_id IN (" . implode(',', $ids) . ")");
				$maping 	= [];

				foreach ($config as $item) :
					$maping[$item['member_id']] = (array) json_decode($item['config']);
				endforeach;

				$this->config = $maping;
			endif;
		else :
			$this->data = false;
		endif;
	}

	private function calcData()
	{
		foreach ($this->data as $index => $item) :
			$member = ($this->for == 'dealer') ? 1 : $item['member_id'];

			$this->data[$index] = $this->calcDataCore($item, $member, $this->for);
		endforeach;
	}

	private function calcDataCore(array $data, int $id, string $type) : array
	{
		$exp 	= explode('.', $data['kode']);
		$fCode 	= $exp[0];
		$config = $this->config[$id];
		$indexByHead 	= ['A' => 0, 'KP' => 1, 'K' => 2, 'E' => 3];
		$indexDefault	= ['J' => 3, 'P' => 3, 'T' => 2, 'S' => 2];
		$codeNumber 	= [
			'J'		=> [1, 3, 5, 7, 9],
			'P'		=> [0, 2, 4, 6, 8],
			'T'		=> [5, 6, 7, 8, 9],
			'S'		=> [0, 1, 2, 3, 4],
			'PING'	=> array_merge(range(0, 24), range(75, 99)),
			'TENG'	=> range(25, 74)
		];
		$codeString		= [
			'TS'	=> [['besar', 'kecil'], ['kecil', 'besar']],
			'TT'	=> [['besar', 'besar'], ['kecil', 'kecil']],
			'JP'	=> [['ganjil', 'genap'], ['genap', 'ganjil']],
			'JJ'	=> [['ganjil', 'ganjil'], ['genap', 'genap']],
		];
		$codeStringIdv 	= ['J' => ['ganjil'], 'P' => ['genap'], 'T' => ['besar'], 'S' => ['kecil']];

		if (in_array($fCode, ['2D', '3D', '4D'])) :
			$correctNumber 	= $this->getCorrectNumber($fCode);
			$isCorrect 		= $correctNumber == $data['angka'];
			$iWin 	= $isCorrect ? 1 : 0;
			$iLose	= $isCorrect ? 0 : 1;

			if ($type == 'dealer') :
				$rWinMakan	= $this->getNomWin($iWin, $data['nom_makan'], $config["WIN_{$fCode}"]);
				$rLoseMakan	= $this->getNomLose($iLose, $data['nom_makan'], $config["DISC_{$fCode}"]);
				$rWinDealer		= $this->getNomWin($iWin, $data['nom_dealer'], $config["WIN_{$fCode}"]);
				$rLoseDealer	= $this->getNomLose($iLose, $data['nom_dealer'], $config["DISC_{$fCode}"]);
				$hasilMakan 	= $rWinMakan - $rLoseMakan;
				$hasilDealer 	= $rWinDealer - $rLoseDealer;
			else :
				$rWin 	= $this->getNomWin($iWin, $data['nominal'], $config["WIN_{$fCode}"]);
				$rLose	= $this->getNomLose($iLose, $data['nominal'], $config["DISC_{$fCode}"]);
				$hasil 	= $rWin - $rLose;
			endif;

		elseif (in_array($fCode, ['J', 'P', 'T', 'S', 'PING', 'TENG', 'TS', 'TT', 'JP', 'JJ', 'H'])) :
			$iConfig	= str_replace('.', '_', $data['kode']);

			if (in_array($fCode, ['J', 'P', 'T', 'S'])) :
				$index 		= count($exp) > 1 ? $indexByHead[$exp[1]] : $indexDefault[$fCode];
				$winData 	= [];
				$loseData 	= [];
				$correctNumber = (int) strval($this->winNumber)[$index];

				foreach ($codeNumber[$fCode] as $number) :
					if ($number == $correctNumber) :
						$winData[] 	= $number;
					else :
						$loseData[] = $number;
					endif;
				endforeach;

				$iWin 	= count($winData);
				$iLose	= count($loseData);

			elseif (in_array($fCode, ['PING', 'TENG'])) :
				$correctNumber = $this->getCorrectNumber($fCode);
				$winData 	= [];
				$loseData 	= [];

				foreach ($codeNumber[$fCode] as $number) :
					$number = str_pad($number, 2, 0, STR_PAD_LEFT);

					if ($number == $correctNumber) :
						$winData[] 	= $number;
					else :
						$loseData[] = $number;
					endif;
				endforeach;

				$iWin 	= count($winData);
				$iLose	= count($loseData);

			elseif (in_array($fCode, ['TS', 'TT', 'JP', 'JJ'])) :
				$index = count($exp) > 1 ? [$indexByHead[$exp[1]], $indexByHead[$exp[2]]] : [2, 3];
				$correctString = $this->getCorrectString($index);
				$theFirst 	= array_intersect($codeString[$fCode][0], $correctString[0]);
				$theSecond 	= array_intersect($codeString[$fCode][1], $correctString[1]);

				if ($theFirst && $theSecond) :
					$iWin 	= 1;
					$iLose 	= 0;
				else :
					$iWin 	= 0;
					$iLose 	= 1;
				endif;
			elseif ($fCode == 'H') :
				$number = array_sum([substr($this->winNumber, 2, 1), substr($this->winNumber, 3, 1)]);
				$number = (strlen($number) > 1) ? array_sum(str_split($number)) : $number;
				$correctString = [
					($number % 2) ? 'ganjil' : 'genap',
					($number < 5) ? 'kecil' : 'besar'
				];
				$uString 	= $codeStringIdv[$exp[1]];
				$isCorrect 	= array_intersect($correctString, $uString);

				if ($isCorrect) :
					$iWin 	= 1;
					$iLose 	= 0;
				else :
					$iWin 	= 0;
					$iLose 	= 1;
				endif;
			endif;

			if ($type == 'dealer') :
				$rWinMakan	= $this->getTaxWin($iWin, $data['nom_makan']);
				$rLoseMakan	= $this->getTaxLose($iWin, $iLose, $data['nom_makan'], $config["DISC_{$iConfig}"]);
				$rWinDealer		= $this->getTaxWin($iWin, $data['nom_dealer']);
				$rLoseDealer	= $this->getTaxLose($iWin, $iLose, $data['nom_dealer'], $config["DISC_{$iConfig}"]);
				$hasilMakan 	= $rWinMakan - $rLoseMakan;
				$hasilDealer 	= $rWinDealer - $rLoseDealer;
			else :
				$rWin	= $this->getTaxWin($iWin, $data['nominal']);
				$rLose	= $this->getTaxLose($iWin, $iLose, $data['nominal'], $config["DISC_{$iConfig}"]);
				$hasil 	= $rWin - $rLose;
			endif;

		elseif (in_array($fCode, ['C', 'CM', 'CN', 'M'])) :
			if ($fCode == 'C') :
				$numbers = count($exp) > 1 ? substr($this->winNumber, $indexByHead[$fCode], 1) : str_split($this->winNumber);

				if (in_array($data['angka'], $numbers)) :
					$iWin	= 1;
					$iLose	= 0;
				else :
					$iWin	= 0;
					$iLose	= 1;
				endif;

			elseif (in_array($fCode, ['CM', 'CN'])) :
				$correctLength 	= ($fCode == 'CM') ? 2 : 3;
				$numbers 		= str_split($this->winNumber);
				$uNumbers		= str_split($data['angka']);
				$correctNumber 	= array_intersect($numbers, $uNumbers);

				if (count($correctNumber) == $correctLength) :
					$iWin	= 1;
					$iLose	= 0;
				else :
					$iWin	= 0;
					$iLose	= 1;
				endif;

			elseif ($fCode == 'M') :
				$index = [$indexByHead[$exp[1]], $indexByHead[$exp[3]]];
				$correctString = $this->getCorrectString($index);
				$theFirst 	= array_intersect($codeStringIdv[$exp[2]], $correctString[0]);
				$theSecond 	= array_intersect($codeStringIdv[$exp[4]], $correctString[1]);

				if ($theFirst && $theSecond) :
					$iWin 	= 1;
					$iLose 	= 0;
				else :
					$iWin 	= 0;
					$iLose 	= 1;
				endif;
			endif;

			if ($type == 'dealer') :
				$rWinMakan	= $this->getNomWin($iWin, $data['nom_makan'], $config["WIN_{$fCode}"]);
				$rLoseMakan	= $this->getNomLose($iLose, $data['nom_makan'], $config["DISC_{$fCode}"]);
				$rWinDealer		= $this->getNomWin($iWin, $data['nom_dealer'], $config["WIN_{$fCode}"]);
				$rLoseDealer	= $this->getNomLose($iLose, $data['nom_dealer'], $config["DISC_{$fCode}"]);
				$hasilMakan 	= $rWinMakan - $rLoseMakan;
				$hasilDealer 	= $rWinDealer - $rLoseDealer;
			else :
				$rWin	= $this->getNomWin($iWin, $data['nominal'], $config["WIN_{$fCode}"]);
				$rLose	= $this->getNomLose($iLose, $data['nominal'], $config["DISC_{$fCode}"]);
				$hasil 	= $rWin - $rLose;
			endif;
		endif;

		$data['win']	= $iWin;
		$data['lose']	= $iLose;

		if ($type == 'dealer') :
			$data['hasil_makan'] 	= $hasilMakan;
			$data['hasil_dealer'] 	= $hasilDealer;
		else :
			$data['hasil']	= $hasil;
		endif;

		$this->updateDB($data);

		return $data;
	}

	private function updateDB(array $data) : void
	{
		$tableName = ($this->for == 'dealer') ? 'rekap' : 'split';

		if ($this->for == 'dealer') :
			$update = [
				'hasil_makan'	=> $data['hasil_makan'],
				'hasil_dealer'	=> $data['hasil_dealer'],
			];
		else :
			$update = [
				'member_id'	=> $data['member_id'],
				'hasil'		=> $data['hasil'],
			];
		endif;

		$update['win']		= $data['win'];
		$update['lose']		= $data['lose'];

		$this->result[$this->for][] = $update;

		$this->db->update($tableName, ['win' => $data['win'], 'lose' => $data['lose'], 'isCalc' => 1], ['id' => $data['id']]);
	}

	public function smsOutCalc()
	{
		$data 	= $this->result[$this->for];
		$result	= [];
		$total 	= 0;

		if ($this->for == 'member') :
			$perMember = [];

			foreach ($data as $item) :
				$perMember[$item['member_id']][] = $item;
			endforeach;

			foreach ($perMember as $id => $item) :
				$result[$id]['member_id'] 	= $id;
				$result[$id]['win'] 		= array_sum(array_column($item, 'win'));
				$result[$id]['lose'] 		= array_sum(array_column($item, 'lose'));
				$result[$id]['hasil'] 		= array_sum(array_column($item, 'hasil'));
				$result[$id]['tgl']			= date('Y-m-d');
			endforeach;

			$result = array_values($result);
			$total 	= array_sum(array_column($result, 'hasil'));

		else :
			$_result['win']				= array_sum(array_column($data, 'win'));
			$_result['lose'] 			= array_sum(array_column($data, 'lose'));
			$_result['hasil_makan'] 	= array_sum(array_column($data, 'hasil_makan'));
			$_result['hasil_dealer'] 	= array_sum(array_column($data, 'hasil_dealer'));
			$_result['tgl'] 			= date('Y-m-d');

			$_total = $_result['hasil_makan'] + $_result['hasil_dealer'];

			if ($_total < $this->memberTotal) :
				$makan = $this->memberTotal - $_result['hasil_dealer'];
				$_result['hasil_makan'] = $makan;
			endif;

			$result[]	= $_result;
			$total 		= $_result['hasil_makan'] + $_result['hasil_dealer'];
		endif;

		$this->total 	= $total;
		$this->smsOut 	= $result;

		$this->saveSmsOut();
	}

	private function saveSmsOut()
	{
		$tableName = ($this->for == 'dealer') ? 'smsout_dealer' : 'smsout_member';

		$this->db->insert($tableName, $this->smsOut);
	}

	private function getCorrectNumber($kode) : int
	{
		switch ($kode) :
			case '2D':
			case 'PING':
			case 'TENG':
				return (int) substr($this->winNumber, -2);
				break;
			case '3D':
				return (int) substr($this->winNumber, 0, 3);
				break;
			case '4D':
				return (int) substr($this->winNumber, 0, 4);
				break;
		endswitch;
	}

	public function getCorrectString($indexes) : array
	{
		$result = [];
		foreach ($indexes as $index) :
			$number = (int) substr($this->winNumber, $index, 1);
			$jpStr 	= $number % 2 ? 'ganjil' : 'genap';
			$tsStr	= $number < 5 ? 'kecil' : 'besar';

			$result[$index][] = $jpStr;
			$result[$index][] = $tsStr;
		endforeach;

		return array_values($result);
	}

	private function getNomWin(int $jumlah, int $nominal, int $config)
	{
		$rumus = $jumlah * $nominal * $config;

		return $rumus;
	}

	private function getNomLose(int $jumlah, int $nominal, int $config)
	{
		$rumus = ($jumlah * $nominal) - (($jumlah * $nominal) * ($config / 100));

		return $rumus;
	}

	private function getTaxWin(int $jumlah, int $nominal)
	{
		$rumus = ($jumlah >= 1) ? ($jumlah * $nominal) : 0;

		return $rumus;
	}

	private function getTaxLose(int $win, int $jumlah, int $nominal, int $config)
	{
		$rumus = ($win >= 1) ? 0 : ($jumlah * $nominal) - (($jumlah * $nominal) * ($config / 100));

		return $rumus;
	}

	private function dd($data) {
		echo "<pre>";print_r($data);echo "</pre>";die();
	}
}
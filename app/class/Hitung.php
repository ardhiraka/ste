<?php

class Hitung
{
	
	private $for;
	private $db;
	private $winNumber;
	private $data;
	private $config;

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

	public function exec()
	{
		$this->getData();

		if ($this->data) :
			$this->calcData();
		endif;

		$this->dd($this);
	}

	private function getData()
	{
		if ($this->for == 'dealer') :
			$this->data = $this->db->fetch_all("SELECT * FROM `rekap` WHERE isCalc = 0 AND tanggal = ?", date('Y-m-d'));
			
			$config = $this->db->fetch_all("SELECT * FROM `member_config` WHERE member_id = ?", 1);
			$maping = [];

			foreach ($config as $item) :
				$maping[$item['member_id']] = (array) json_decode($item['config']);
			endforeach;

			$this->config = $maping;
		elseif ($this->for == 'member') :
			$this->data = 'member';
		else :
			$this->data = false;
		endif;
	}

	private function calcData()
	{
		switch ($this->for) :
			case 'dealer':
				$this->calcDataDealer();
				break;
			case 'member':
				# code...
				break;
		endswitch;
	}

	private function calcDataDealer()
	{
		foreach ($this->data as $index => $item) :
			$this->data[$index] = $this->calcDataCore($item, 1);
		endforeach;

		$this->dd($this->data);
	}

	private function calcDataMember()
	{
		# code...
	}

	private function calcDataCore(array $data, int $id) : array
	{
		$exp 	= explode('.', $data['kode']);
		$fCode 	= $exp[0];
		$config = $this->config[$id];

		if (in_array($fCode, ['2D', '3D', '4D'])) :
			$correctNumber 	= $this->getCorrectNumber($fCode);
			$isCorrect 		= $correctNumber == $data['angka'];
			$iWin 	= $isCorrect ? 1 : 0;
			$iLose	= $isCorrect ? 0 : 1;
			$rWinMakan	= $this->getNomWin($iWin, $data['nom_makan'], $config["WIN_{$fCode}"]);
			$rLoseMakan	= $this->getNomLose($iLose, $data['nom_makan'], $config["DISC_{$fCode}"]);
			$rWinDealer		= $this->getNomWin($iWin, $data['nom_dealer'], $config["WIN_{$fCode}"]);
			$rLoseDealer	= $this->getNomLose($iLose, $data['nom_dealer'], $config["DISC_{$fCode}"]);
			$hasilMakan 	= $rWinMakan - $rLoseMakan;
			$hasilDealer 	= $rWinDealer - $rLoseDealer;

			$data['win']	= $iWin;
			$data['lose']	= $iLose;
			$data['hasil_makan'] 	= $hasilMakan;
			$data['hasil_dealer'] 	= $hasilDealer;

		elseif (in_array($fCode, ['J', 'P', 'T', 'S', 'PING', 'TENG', 'TS', 'TT', 'JP', 'JJ'])) :
			$iConfig		= str_replace('.', '_', $data['kode']);
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
			$iWin	= 0;
			$iLose	= 0;

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
			endif;

			$rWinMakan	= $this->getTaxWin($iWin, $data['nom_makan']);
			$rLoseMakan	= $this->getTaxLose($iWin, $iLose, $data['nom_makan'], $config["DISC_{$iConfig}"]);
			$rWinDealer		= $this->getTaxWin($iWin, $data['nom_dealer']);
			$rLoseDealer	= $this->getTaxLose($iWin, $iLose, $data['nom_dealer'], $config["DISC_{$iConfig}"]);
			$hasilMakan 	= $rWinMakan - $rLoseMakan;
			$hasilDealer 	= $rWinDealer - $rLoseDealer;

			$data['win']	= $iWin;
			$data['lose']	= $iLose;
			$data['hasil_makan'] 	= $hasilMakan;
			$data['hasil_dealer'] 	= $hasilDealer;

		elseif (in_array($fCode, ['C', 'CM', 'CN', 'M', 'H'])) :
			
		endif;

		return $data;
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

		return $result;
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
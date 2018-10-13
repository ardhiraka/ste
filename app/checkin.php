<?php
include('header.php');

$splits = $db->fetch_all('select * from split where inRekap = 0 and tanggal = ?', date('Y-m-d'));

$inData = [];
foreach ($splits as $split) :
    if (in_array($split['kode'], ['2D', '3D', '4D'])) :
        $angka = explode('.', $split['angka']);

        if (array_key_exists($split['kode'], $inData)) :
            foreach ($angka as $item) :
                if (array_key_exists($item, $inData[$split['kode']])) :
                    $inData[$split['kode']][$item]['id'][]              = $split['id'];
                    $inData[$split['kode']][$item]['nominal'][]         = $split['nominal'];
                    $inData[$split['kode']][$item]['total']             += $split['nominal'];
                    $inData[$split['kode']][$item]['win']             	+= $split['win'];
                    $inData[$split['kode']][$item]['lose']             	+= $split['lose'];
                else :
                    $inData[$split['kode']][$item] = [
                        'id'            => [$split['id']],
                        'nominal'       => [$split['nominal']],
                        'total'         => $split['nominal'],
                        'win'         	=> $split['win'],
                        'lose'         	=> $split['lose'],
                    ];
                endif;
            endforeach;
        else :
            foreach ($angka as $item) :
                $inData[$split['kode']][$item] = [
                    'id'            => [$split['id']],
                    'nominal'       => [$split['nominal']],
                    'total'         => $split['nominal'],
                    'win'         	=> $split['win'],
                    'lose'         	=> $split['lose'],
                ];
            endforeach;
        endif;
    else :
        if (array_key_exists($split['kode'], $inData)) :
            if ($inData[$split['kode']]['child']) :
                if (array_key_exists($split['angka'], $inData[$split['kode']]['children'])) :
                    $inData[$split['kode']]['children'][$split['angka']]['id'][]            = $split['id'];
                    $inData[$split['kode']]['children'][$split['angka']]['nominal'][]       = $split['nominal'];
                    $inData[$split['kode']]['children'][$split['angka']]['total']           += $split['nominal'];
                    $inData[$split['kode']]['children'][$split['angka']]['win']           	+= $split['win'];
                    $inData[$split['kode']]['children'][$split['angka']]['lose']           	+= $split['lose'];
                else :
                    $inData[$split['kode']]['child'] = true;
                    $inData[$split['kode']]['children'][$split['angka']] = [
                        'id'            => [$split['id']],
                        'nominal'       => [$split['nominal']],
                        'total'         => $split['nominal'],
                        'win'         	=> $split['win'],
                        'lose'         	=> $split['lose'],
                    ];
                endif;
            else :
                $inData[$split['kode']]['id'][]         = $split['id'];
                $inData[$split['kode']]['nominal'][]    = $split['nominal'];
                $inData[$split['kode']]['total']        += $split['nominal'];
                $inData[$split['kode']]['win']        	+= $split['win'];
                $inData[$split['kode']]['lose']        	+= $split['lose'];
            endif;
        else :
            if (is_null($split['angka'])) :
                $inData[$split['kode']] = [
                    'child'         => false,
                    'id'            => [$split['id']],
                    'nominal'       => [$split['nominal']],
                    'total'         => $split['nominal'],
                    'win'         	=> $split['win'],
                    'lose'         	=> $split['lose'],
                ];
            else :
                $inData[$split['kode']]['child'] = true;
                $inData[$split['kode']]['children'][$split['angka']] = [
                    'id'            => [$split['id']],
                    'nominal'       => [$split['nominal']],
                    'total'         => $split['nominal'],
                    'win'        	=> $split['win'],
                    'lose'         	=> $split['lose'],
                ];
            endif;
        endif;
    endif;
endforeach;
?>

<div class="container">
	<br />
	<br />
	<br />

	<div align="center">
		<h3>
			Check In
		</h3>
	</div>

	<div class="action-button mb-3">
		<button type="button" class="saveToRekap btn btn-primary">Masukkan ke rekap</button>
	</div>

	<div class="mb-3">
		<table class="table table-sm" width="500px">
			<thead>
				<tr>
					<th>Kode</th>
					<th>Angka</th>
					<th>Nominal</th>
					<th>Win</th>
					<th>Lose</th>
				</tr>
			</thead>
			<tbody id="list_slpit">
				<?php
					foreach ($inData as $kode => $data) :
					    if (in_array($kode, ['2D', '3D', '4D'])) :
					        foreach ($data as $angka => $item) :
					            echo "<tr data-id='" . join($item['id'], ',') . "'>";
					            echo "<td><a href='info.php?by=kode&with={$kode}'>{$kode}</a></td>";
					            echo "<td align='center'><a href='info.php?by=number&with=" . join($item['id'], ',') . "'>{$angka}</a></td>";
					            echo "<td>{$item['total']}</td>";
					            echo "<td>{$item['win']}</td>";
					            echo "<td>{$item['lose']}</td>";
					            echo "</tr>";
					        endforeach;
					    else :
					        if ($data['child']) :
					            foreach ($data['children'] as $angka => $item) :
					                echo "<tr data-id='" . join($item['id'], ',') . "'>";
					                echo "<td><a href='info.php?by=kode&with={$kode}'>{$kode}</a></td>";
					                echo "<td align='center'><a href='info.php?by=number&with=" . join($item['id'], ',') . "'>{$angka}</a></td>";
					                echo "<td>{$item['total']}</td>";
					                echo "<td>{$item['win']}</td>";
					                echo "<td>{$item['lose']}</td>";
					                echo "</tr>";
					            endforeach;
					        else :
					            // No Link SMS Detail
					            echo "<tr data-id='" . join($data['id'], ',') . "'>";
					            echo "<td><a href='info.php?by=kode&with={$kode}'>{$kode}</a></td>";
					            echo "<td align='center'>-</td>";
					            echo "<td>{$data['total']}</td>";
					            echo "<td>{$data['win']}</td>";
					            echo "<td>{$data['lose']}</td>";
					            echo "</tr>";
					        endif;
					    endif;
					endforeach;
				?>
			</tbody>
		</table>
	</div>

	<div class="action-button mb-5">
		<button type="button" class="saveToRekap btn btn-primary">Masukkan ke rekap</button>
	</div>
</div>

<script>
	$('.saveToRekap').on('click', function() {
		let inData 	= [];
		let ids 	= [];

		$('tbody#list_slpit tr').each((el, item) => {
			let data = {
				kode: $(item).find('td:nth-child(1)').text(),
				angka: $(item).find('td:nth-child(2)').text(),
				nominal: $(item).find('td:nth-child(3)').text(),
				win: $(item).find('td:nth-child(4)').text(),
				lose: $(item).find('td:nth-child(5)').text(),
			};
			
			inData.push(data);

			$(item).data('id').toString().split(',').forEach(item => {
				if (!ids.includes(item)) {
					ids.push(item);
				}
			});
		});

		$.post('ajax/rekap/saveToRekap.php', {save: inData, ids: ids}, response => {
			if (response.status == 'success') {
                alert("Data berhasil disimpan!");
                window.location.reload();
            } else {
                alert(response.error);
            }
		}, 'json');
	});
</script>

<?php
include('footer.php');
?>
  <!-- SCRIPTS -->
	<!-- JQuery -->
	<script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="../assets/js/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="../assets/js/mdb.min.js"></script>
	<script type="text/javascript" src="../assets/js/addons/datatables.min.js"></script>
  <!-- SMS Parse Module - Aris - Techarea -->
  <script type="text/javascript" src="../assets/js/sms.js"></script>


	<script>
		jQuery(function($) {
			let formatNumber = function(number) {
				return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number * 1000);
			}
      let dataTable = $('#tablesms').DataTable({
          scrollY: "200px",
          scrollCollapse: true,
          ajax: {
              url: 'ajax/getMessages.php'
          },
          order: [[0, "desc"]],
          columns: [
            {data: 'ID'},
            {data: 'SenderNumber'},
            {data: 'UDH'},
            {data: 'TextDecoded'},
            {
              data: 'id',
              render() {
                return '<a href="javascript:;" message-delete class="btn btn-danger btn-sm" title="Delete SMS"><i class="fa fa-trash"></i></a>\
                        <a href="javascript:;" message-view class="btn btn-default btn-sm" title="View SMS"><i class="fa fa-eye"></i></a>';
              }
            }
          ],
          fnCreatedRow: function(el, data, iDataIndex) {
             $(el).attr('data-id', data.ID);
             $(el).attr('data-message', data.TextDecoded);
						 $(el).attr('data-number', data.SenderNumber);
          }
      });
			$('.dataTables_length').addClass('bs-select');
      
      // New message submit format
      $('#newMessageForm').on('submit', function(event) {
        event.preventDefault();
        
        $.post('ajax/newMessage.php', $(this).serialize(), function(response) {
          if (response.status == 'success') {
            alert('Data berhasil disimpan!');
            $('#newMessageForm').trigger('reset');
            dataTable.ajax.reload(null, false);
          } else {
            alert('Error: ' + response.error);
          }
        }, 'json');
      });
      
      // View message format
      $(document).on('click', '[message-view]', function() {
        let container = $(this).closest('tr');
				let finalNum 	= $('#angkaout').val();
        let message   = {
          id: container.data('id'),
          data: container.data('message')
        };

        $('#submitSms').attr('data-id', message.id).attr('data-message', message.data);
        
        SMS.setData(message.data).filter().parse().setNumber(finalNum).match();
        
        $('#smsedit').val(SMS.data);
        $('#smsasli').val(SMS.data);
        $('#smssalah').val(SMS.filtered.inCorrect.join("\n"));
        $('#smsbenar').val(SMS.filtered.correct.join("\n"));
				
				let hasil 	= [];
				let result 	= SMS.matchResult;
				let totalWin 	= 0;
				let totalLose	= 0;
				let totalPWin = 0;
				let totalPLose = 0;
				$.post('ajax/getDataByNumber.php', {number: container.data('number')}, function(response) {
					for (var i in result) {
						let theCode 	= SMS.searchCode(i, true);
						let thePrice 	= SMS.searchPrice(i);
						
						if (theCode.code == 'N/A') {
							let iWin				= 0;
							let iLose 			= 0;
							let hasilWin 		= 0;
							let hasilLose		= 0;
							let hasilTotal	= 0;
							for (let code in result[i]) {
								let icode = result[i][code];
								
								totalWin 	+= icode.win.length;
								totalLose += icode.lose.length;
// 								iWin 			+= icode.win.length;
// 								iLose 		+= icode.lose.length;
								hasilWin 	+= icode.win.length * thePrice * response[code + '_win'];
								hasilLose += (icode.lose.length * thePrice) - ((icode.lose.length * thePrice) * (response[code + '_disc'] / 100));
								let cWin 	= icode.win.length * thePrice * response[code + '_win'];
								let cLose	= (icode.lose.length * thePrice) - ((icode.lose.length * thePrice) * (response[code + '_disc'] / 100));
								hasil.push(code + ": " + icode.win.length + "/" + icode.lose.length + " | " + formatNumber(cWin) + "/" + formatNumber(cLose));
// 								console.log(icode.win.length+"*"+thePrice+"*"+response[code + '_win']);
// 								console.log('('+icode.lose.length+"*"+thePrice+') - (('+icode.lose.length+'*'+thePrice+') * ('+response[code + '_disc']+'/'+100+'))');
							}
							totalPWin 	= hasilWin;
							totalPLose	= hasilLose;
							hasilTotal 	= hasilWin - hasilLose;
							
// 							hasil.push("d: " + iWin + "/" + iLose + " | " + formatNumber(hasilWin) + "/" + formatNumber(hasilLose));
						} else {
							totalWin 	+= result[i].win.length;
							totalLose += result[i].lose.length;
							let theCodeRumusWin = SMS.code.head.includes(theCode.head)
								? 'Jitu'
								: theCode.code == 'CM'
									? 'CM1'
									: theCode.code;
							let theCodeRumusLose = SMS.code.head.includes(theCode.head)
								? 'Jitu'
								: theCode.code;
							let unique = ['J', 'P', 'T', 'S'];
							let rumusWin = 0;
							let rumusLose = 0;

							if (unique.includes(theCode.code) || theCode.code == 'M') {
								rumusWin = result[i].win.length > 0
									? result[i].win.length * thePrice * response[theCodeRumusWin+'_win']
									: 0;
								rumusLose = result[i].win.length > 0
									? 0
									: (result[i].lose.length * thePrice) + ((result[i].lose.length * thePrice) * (response[theCodeRumusLose+'_disc'] / 100));
							} else {
								rumusWin = result[i].win.length * thePrice * response[theCodeRumusWin+'_win'];
								rumusLose = (result[i].lose.length * thePrice) - ((result[i].lose.length * thePrice) * (response[theCodeRumusLose+'_disc'] / 100));
							}
							let rumus = rumusWin - rumusLose;
							totalPWin += rumusWin;
							totalPLose += rumusLose;

							hasil.push(theCode.full + ": " + result[i].win.length + "/" + result[i].lose.length + " | " + formatNumber(rumusWin) + "/" + formatNumber(rumusLose));
						}
					}
					hasil.push("Total: " + totalWin + "/" + totalLose + " | " + formatNumber(totalPWin) + "/" + formatNumber(totalPLose) + " | " + formatNumber(totalPWin - totalPLose));

					$('#hasildapat').val(hasil.join("\n"));
				}, 'json');
      });
      
      // Delete message
      $(document).on('click', '[message-delete]', function() {
        let container = $(this).closest('tr');
        let message   = {
          id: container.data('id'),
          data: container.data('message')
        };
        let hapus    = confirm('Anda yakin ingin menghapusnya?');
        
        if (hapus) {
          $.post('ajax/deleteMessage.php', {id: message.id}, function(response) {
            if (response.status == 'success') {
              alert('Data berhasil dihapus!');
              dataTable.ajax.reload(null, false);
            } else {
              alert('Error: ' + response.error);
            }
          }, 'json');
        }
      });
			
			let wait = null;
			$('#smsedit').keyup(function() {
				let message = $(this).val();
				
				if (wait != null) clearTimeout(wait);
				
				wait = setTimeout(function() {
					SMS.setData(message).filter();

					$('#smsasli').val(SMS.data);
					$('#smssalah').val(SMS.filtered.inCorrect.join("\n"));
					$('#smsbenar').val(SMS.filtered.correct.join("\n"));
				}, 500);
			});

            $(document).on('click', '#submitSms', function() {
                let data    = this.dataset;
                let sms     = SMS.setData(data.message).filter().parse();

                $.post('ajax/storeSplitData.php', {...data, split: sms.messages.correct}, function(response) {
                    console.log(response);
                }, 'json');

                console.log(sms.messages.correct);
            });
		});
	</script>

</body>
</html>

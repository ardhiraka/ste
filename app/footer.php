  <!-- SCRIPTS -->
	<!-- JQuery -->
	<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="../js/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="../js/mdb.min.js"></script>
	<script type="text/javascript" src="../js/addons/datatables.min.js"></script>
  <!-- SMS Parse Module - Aris - Techarea -->
  <script type="text/javascript" src="../js/sms.js"></script>


	<script>
		jQuery(function($) {
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
        
        SMS.setData(message.data).filter().parse().setNumber(finalNum).match();
        
        $('#smsedit').val(SMS.data);
        $('#smsasli').val(SMS.data);
        $('#smssalah').val(SMS.filtered.inCorrect.join("\n"));
        $('#smsbenar').val(SMS.filtered.correct.join("\n"));
				
				let hasil 	= [];
				let result 	= SMS.matchResult;
				let totalWin 	= 0;
				let totalLose	= 0;
				for (var i in result) {
					totalWin 	+= result[i].win.length;
					totalLose += result[i].lose.length;
					hasil.push(SMS.searchCode(i) + ":" + result[i].win.length + "/" + result[i].lose.length);
				}
				hasil.push("Total: " + totalWin + "/" + totalLose);
				
				$('#hasildapat').val(hasil.join("\n"));
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
		});
	</script>

</body>
</html>
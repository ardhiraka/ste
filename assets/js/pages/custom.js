jQuery(function($) {
	let wait = null;

	$(document).on('keyup', '.in_m_asli', function() {
		let asli 	= this.value.toUpperCase();
		let cusIn 	= $(this).closest('.custom_m_item').find('.in_m_custom');

		if (wait != null) clearTimeout(wait);

		wait = setTimeout(function() {
			cusIn.attr('name', asli);

			if (asli.length >= 1) {
				cusIn.attr('placeholder', 'Custom ' + asli);
			} else {
				cusIn.attr('placeholder', 'Custom');
			}
		}, 500);
	});

	$(document).on('click', '.add_item', function() {
		let newInp 	= $('#forClone .custom_m_item').clone();
		let list 	= $('.custom_m_list');

		list.append(newInp);
	});

	$(document).on('click', '.delete_item', function() {
		$(this).closest('.custom_m_item').remove();
	});

	$('#customForm').on('submit', function(e) {
		e.preventDefault();

		let customs 		= [];
		let customsClash 	= [];
		$('#customForm input:not(.in_m_asli)').each(function(i, el) {
			if (customs.includes(el.value.toUpperCase())) {
				customsClash.push(el.value.toUpperCase());
			} else {
				customs.push(el.value.toUpperCase());
			}
		});

		let mAsli 		= [];
		let mAsliClash 	= [];
		$('#customForm input.in_m_asli').each(function(i, el) {
			if (mAsli.includes(el.value.toUpperCase())) {
				mAsliClash.push(el.value.toUpperCase());
			} else {
				mAsli.push(el.value.toUpperCase());
			}
		});

		if (customsClash.length != 0 || mAsliClash != 0) {
			let message;

			if (customsClash.length != 0) {
				message = "Custom kode sama: " + customsClash.join(', ');

				if (mAsliClash != 0) {
					message += "\nM asli sama: " + mAsliClash.join(', ');
				}
			} else {
				message = "M asli sama: " + mAsliClash.join(', ');
			}

			alert(message);
			return;
		}
		
		e.target.submit();
	});
});
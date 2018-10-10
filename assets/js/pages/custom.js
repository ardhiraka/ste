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
});
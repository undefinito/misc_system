$(document).ready(
	function()
	{
		// Current menu selection
		$('[data-list=menu]').on('click','[data-toggle=tab][href]',
			function()
			{
				var is_active = $(this).is('.active');

				if( ! is_active)
				{
					$(this)
						.addClass('active')
							.siblings('[data-toggle=tab][href]')
							.removeClass('active');
				}
			});

		// Information save btn
		$('#info_save_btn').on('click',
			function()
			{
				var $info_tab = $('#info_tab');
				var $form = $info_tab.find('.form-horizontal');


				// check if same as original values
				var inputs_arr = $.map($form.find('input[type=text]'),
					function(o)
					{
						var val = $(o).val();
						var orig = $(o).data('orig');

						return val !== orig ? val : undefined;
					});

				console.log(inputs_arr);

				// if no new inputs
				if(inputs_arr.length == 0)
				{
					return;
				}

				///////////////////////
				// show loading icon //
				///////////////////////
				var $fa = $(this).find('.fa');

				// disable btn
				$(this)
					.html('Saving...')
					.prop('disabled',true);

				// loading icon
				$fa.attr('class','fa fa-circle-o-notch fa-spin');

				// Saving...
				$(this).prepend(' ').prepend($fa);
				///////////////////////

				//////////////////////////////////////
				// "Disable" (readonly) form inputs //
				//////////////////////////////////////
				// set inputs as readonly
				$form.find('input[name][type!=hidden]').prop('readonly',true);
				//////////////////////////////////////
			});
	});
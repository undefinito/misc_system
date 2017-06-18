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

		// show save btn on new input
		$('#info_tab').on('change','input[type=text][name]',
			function()
			{
				var orig_val = $(this).data('orig');
				var val = $(this).val();

				if(val !== orig_val)
				{
					$('#info_save_btn').removeClass('hidden');
				}
			});

		// Information save btn
		$('#info_save_btn').on('click',
			function()
			{
				var $info_tab = $('#info_tab');
				var $form = $info_tab.find('.form-horizontal');
				var $this = $(this);
				var $fa = $this.find('.fa');

				// check if same as original values
				var inputs_arr = $.map($form.find('input[type=text]'),
					function(o)
					{
						var val = $(o).val();
						var orig = $(o).data('orig');
						var input_name = $(o).attr('name');

						return val !== orig ? {name: input_name,value: val} : undefined;
					});

				// if no new inputs
				if(inputs_arr.length == 0)
				{
					return;
				}

				ajaxRequest({
					url: baseurl+'account/edit/'+user_id,
					method: 'POST',
					dataType: 'json',
					data: array_to_object(inputs_arr),
					beforeSend: function()
					{
						///////////////////////
						// show loading icon //
						///////////////////////

						// disable btn
						$this
							.html('Saving...')
							.prop('disabled',true);

						// loading icon
						$fa.attr('class','fa fa-circle-o-notch fa-spin');

						// Saving...
						$this.prepend(' ').prepend($fa);
						///////////////////////

						//////////////////////////////////////
						// "Disable" (readonly) form inputs //
						//////////////////////////////////////
						// set inputs as readonly
						$form.find('input[name][type!=hidden]').prop('readonly',true);
						//////////////////////////////////////
					}
				})
				.always(
					function()
					{
						// enable btn
						$this
							.html('Save')
							.prop('disabled',false)
							.addClass('hidden');

						// save icon
						$fa.attr('class','fa fa-save');
						$this.prepend(' ').prepend($fa);

						// enable inputs again
						$form.find('input[name][type!=hidden]').prop('readonly',false);

						// show alert
						$('#alert')
							.slideDown()
							.delay(4500)
							.slideUp();
					})
				.done(
					function(result)
					{
						$('#alert').html(result['html']);
						if(result['success'])
						{
							// show alert
							$('#alert').attr('class','alert alert-success');

							// update original values of inputs
							$.map($form.find('input[type=text][name]'),
								function(o)
								{
									var val = $(o).val();
									$(o).data('orig',val)
										.attr('placeholder',val);
									console.info(o,val);
								});

							// show last update
							if(!!result['last_update'])
							{
								$('#last_update_disp').text(result['last_update']);
							}

							// update full name
							if(!!result['full_name'])
							{
								$('.menu_full_name').text(result['full_name']);
							}
						}
						else if(result['error'])
						{
							$('#alert').attr('class','alert alert-danger');
						}
					})
				.fail(
					function()
					{
						$('#alert').attr('class','alert alert-danger')
							.html('<i class="fa fa-exclamation-circle"></i> An error has occurred.');
					});
			});
	});
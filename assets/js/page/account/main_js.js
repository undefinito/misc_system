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

		//////////////
		// INFO TAB //
		//////////////

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
					url: baseurl+'account/edit/info/'+user_id,
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

		// ===================================================

		//////////////////
		// SECURITY TAB //
		//////////////////

		$('#secu_tab')
			// toggle visibility of password
			.on('click','a[data-view=pw]',
				function()
				{
					var $input = $(this).closest('.input-group').children('input');
					var input_type = $input.attr('type');

					switch(input_type)
					{
						case 'password':
							$input.attr('type','text');
							break;

						case 'text':
							$input.attr('type','password');
							break;
					}
				})
			// on type of correct old password, enable new password inputs
			.on('keyup','input[name=old_pw]',
			function()
			{
				var val = $(this).val();
				var $this = $(this);

				ajaxRequest({
					url: baseurl+'account/verify/password',
					method: 'POST',
					data: { pass: val, user: user_name }
				})
				.done(
					function(result)
					{
						var is_verified = result['verified'];
						var $form = $('#secu_tab').find('.form-horizontal');

						if( ! is_verified)
						{
							$form.find('input[data-confirm=new_pw]').prop('readonly',true).val('');
						}
						// enable new password inputs
						$form.find('input[name=new_pw]').prop('readonly', ! is_verified).val('').trigger('keyup');
						// indication of correct password
						$this.parent()[ ! is_verified ? 'removeClass' : 'addClass']('has-success');
						// show/hide check
						$('[data-check=old]')[ ! is_verified ? 'addClass' : 'removeClass']('hidden');
					});
			})
			// new password validation and visuals
			.on('keyup','input[name=new_pw],input[data-confirm=new_pw]',
				function()
				{
					var val = $(this).val();
					var is_correct_length = (val.length>=4 && val.length<=50);

					// indicate if correct/invalid/mismatch of new password
					if($(this).is('input[name=new_pw]'))
					{
						// show error indicator if under/above charcter limit
						$(this).parent()[ ! is_correct_length ? 'addClass' : 'removeClass']('has-error');
						// enable/disable confirm password input and clear current value
						$('[data-confirm=new_pw]').prop('readonly', ! is_correct_length).val('');
						// show/hide check
						$('[data-check="new"]')[ ! is_correct_length ? 'addClass' : 'removeClass']('hidden');
					}
					// check confirm password if same with new password
					else if($(this).is('input[data-confirm=new_pw]'))
					{
						var new_val = $('input[name=new_pw]').val();

						console.info(val,' == ',new_val,':',val == new_val)

						// show error indicator if under/above charcter limit
						$(this).parent()[ ! is_correct_length ? 'addClass' : 'removeClass']('has-error');
						// show/hide save btn
						$('#secu_save_btn')[ val == new_val && is_correct_length ? 'removeClass' : 'addClass' ]('hidden');
						// show/hide check
						$('[data-check="confirm"]')[ val == new_val && is_correct_length ? 'removeClass' : 'addClass']('hidden');
						// show success color
						$('input[name=new_pw],input[data-confirm=new_pw]').parent()[ val == new_val && is_correct_length ? 'addClass' : 'removeClass']('has-success');
					}
				});
		// Security save btn
		$('#secu_save_btn').on('click',
			function()
			{
				var new_pass = $('input[name=new_pw]').val();
				var $this = $(this);
				var $fa = $this.find('.fa');

				ajaxRequest({
					url: baseurl+'account/edit/security/'+user_id,
					data: { new_pw: new_pass },
					beforeSend: function()
					{
						// loading icon
						$fa.attr('class','fa fa-circle-o-notch fa-spin');

						// show loading
						$this.text('Saving...')
							.prop('disabled',true)
							.prepend(' ')
							.prepend($fa);
					}
				})
				.always(
					function()
					{
						// save icon
						$fa.attr('class','fa fa-save');

						// enable save btn again
						$this.text('Save')
							.prop('disabled',false)
							.prepend(' ')
							.prepend($fa);

						// hide checks and correct/incorrect input indicators
						$('i[data-check]').addClass('hidden');
						$('#secu_tab').find('.has-success').removeClass('has-success');
						$('#secu_tab').find('.has-error').removeClass('has-error');

						// clear password inputs
						$('#secu_tab').find('input[type=password],input[type=text]').val('');

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
							// alert success
							$('#alert').attr('class','alert alert-success');
						}
						else if(result['error'])
						{
							// alert error
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
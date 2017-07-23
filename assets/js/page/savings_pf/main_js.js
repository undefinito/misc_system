$(document).ready(
	function()
	{
		$('#accounts_tbl').DataTable(accounts_table);

		// add account btn
		$('.btn[data-action=add_account]').on('click',
			function(e)
			{
				var $btn = $(this);
				var $loading = $('<h1 class="jumbotron bg-none text-center"><span class="label label-default"><i class="fa fa-circle-o-notch fa-pulse"></i> Loading</span></h1>');

				ajaxRequest({
					url: baseurl+'page/fragment',
					method: 'GET',
					timeout: 3000,
					data: 
					{
						fragment: 'new_account'
					},
					beforeSend: function()
					{
						$('#action_modal').html($loading);
					}
				})
				.done(
					function(result)
					{
						$('#action_modal')
							.html(result)
								.find('input[name=acct_name]')
								.trigger('focus');

						$('#action_modal')
							.find('input')
							.filter(
							function(idx)
							{
								var val = $(this).val();
								var name = $(this).attr('name');

								switch(name)
								{
									case 'acct_name':
										$(this).filter_input({regex: '[a-zA-Z|-]'});
										break;

									case 'initial_amt':
										$(this).inputmask({
											alias: 'decimal', 
											autoUnmask: true, 
											digits: 2, 
											groupSeparator: ',', 
											autoGroup: true 
										});
										break;
								}
							});
					})
				.fail(
					function(a,b,c)
					{
						$('#action_modal').modal('hide');
					});
			});

		// validation of availability of account name
		var acct_name_timer;
		$('#action_modal').on('keyup','input[name=acct_name]',
			function()
			{
				var val = $(this).val();
				var $indicator = $('#action_modal').find('.fa[data-indicator=valid_name]');

				// hide check/X
				$indicator.addClass('hidden');

				// remove "account name not available"
				$('#action_modal')
					.find('.help-block[data-name=acct_name] > .label')
					.empty();

				if( ! val)
				{
					clearTimeout(acct_name_timer);
					return false;
				}

				if(acct_name_timer) 
				{
					clearTimeout(acct_name_timer);
				}
				
				acct_name_timer = setTimeout(
					function()
					{
						ajaxRequest({
								url: '/web_service/accounts/search',
								method: 'GET',
								data:
								{
									verify_only: true,
									acct_name: val
								}
							},true)
						.done(
							function(result)
							{
								if(typeof result === 'boolean')
								{
									var $indicator = $('#action_modal').find('.fa[data-indicator=valid_name]');
									// valid flag
									$('#action_modal').find('input[name=acct_name]').data('is_valid',result===false);

									// show indicator of valid/invalid account name
									$indicator.removeClass('hidden')
										[ ! result ? 'removeClass' : 'addClass' ]('fa-remove text-red')
										[ ! result ? 'addClass' : 'removeClass' ]('fa-check text-green');

									if(result===true)
									{
										$('#action_modal')
											.find('.help-block[data-name=acct_name] > .label')
											.html('Account name not available.');
									}
								}
								else
								{
									$('#action_modal')
											.find('.help-block[data-name=acct_name] > .label')
											.html('An error occurred.');
								}
							});
					},1000);
			})
		// save btn
		.on('click','.btn[data-action=save]',
			function()
			{
				var $modal = $('#action_modal');
				var name_val = $modal.find('input[name=acct_name]').val();
				var name_is_valid = ($modal.find('input[name=acct_name]').data('is_valid') === true);
				var account_data = 
				{
					name: $modal.find('input[name=acct_name]').val(),
					amt: $modal.find('input[name=initial_amt]').val(),
				};

				if( ! name_is_valid)
				{
					$('#action_modal')
						.find('.help-block[data-name=acct_name] > .label')
						.html(name_val ? 'Account name not available.' : 'Name cannot be blank.');

				}
				else
				{
					ajaxRequest({
						url: '/web_service/accounts/create',
						data: account_data
					})
					.done(
						function(result)
						{
							if(result['success'])
							{
								$('#page_alert')
									.slideDown()
									.delay(4000)
									.slideUp()
									.attr('class',result['success'] ? 'alert alert-success' : 'alert alert-danger')
									.html((result['success'] ? '<i class="fa fa-check"></i> ' : '<i class="fa fa-exclamation-circle"></i> ')+(result['msg'] ? result['msg'] : 'An error occurred.'));
							}
							else
							{

							}
						});
				}
			});

	});

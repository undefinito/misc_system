$(document).ready(
	function()
	{
		$('#accounts_tbl').DataTable(accounts_table);

		// add account btn
		$('.btn[data-action=add_account]').on('click',
			function(e)
			{
				var $btn = $(this);

				ajaxRequest({
					url: baseurl+'page/fragment',
					method: 'GET',
					timeout: 3000,
					data: 
					{
						fragment: 'new_account'
					}
				})
				.done(
					function(result)
					{
						$('#action_modal')
							.find('.modal-content')
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

		$('#action_modal').on('keyup','input[name=acct_name]',
			function()
			{
				var val = $(this).val();
				// TODO: .done() and .fail()
				ajaxRequest({
						url: baseurl+'savings_monitor/account',
						method: 'GET',
						data:
						{
							acct_name: val
						}
					});
			});
	});

var accounts_table = 
{
	dom: '<"#srch_grp" <"row" > >ltpri',
	language: 
	{
		lengthMenu: '<div class="input-group"><span class="input-group-addon bold">Show</span> _MENU_</div>',
		info: '<span class="label label-primary">Total: _TOTAL_</span>',
		infoEmpty: '',
		infoFiltered: '<span class="label label-info">Filtered _MAX_</span>',
		emptyTable: '<span class="label label-default"><i class="fa fa-remove"></i> No accounts found</span>'
	},
	serverSide: true,
	ajax:
	{
		url: '/web_service/accounts',
		method: 'GET',
		dataType: 'json'
	},
	columnDefs: [
		{
			targets: 'col-account',
			className: 'col-xs-2 text-center',
			name: 'id',
			data: 'id',
			render: new default_func()['dt_render'],
		},
		{
			targets: 'col-name',
			className: 'col-xs-5',
			name: 'name',
			data: 'name',
			render: new default_func()['dt_render'],
		},
		{
			targets: 'col-amount',
			className: 'col-xs-2 text-right',
			name: 'amount',
			data: 'amount',
			render: new default_func()['dt_render'],
			createdCell: function(td,data,rowData,x,y)
			{
				$(td)
					.inputmask({
						alias: 'decimal', 
						autoUnmask: true, 
						digits: 2, 
						groupSeparator: ',', 
						autoGroup: true 
					});
			}
		},
		{
			targets: 'col-activity',
			className: 'col-xs-3',
			name: 'date_created',
			data: 'date_created',
			render: new default_func()['dt_render_date']('MMM DD YYYY HH:MM A'),
		},
	]
};
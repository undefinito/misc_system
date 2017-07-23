/**
 * array_to_object - converts array of objects([{name:'',value:''}]) to single object({name1:value1,name2:value2})
 * @param  {Array}   arr       input array
 * @param  {Boolean} is_simple whether arr is array of objects({name:'',value:''}) or simple array([val1,val2,...valn-1]) 
 * @return object
 */
function array_to_object(arr=[], is_simple=false)
{
	var o = {};
	// array is similar to output of
	// $(form).serializeArray()
	if( ! is_simple)
	{
		for (var i = 0; i < arr.length; i++)
		{
			o[arr[i]['name']] = arr[i]['value'];
		}
	}
	else
	{
		for (var i = 0; i < arr.length; i++)
		{
			o[i] = arr[i];
		}
	}

	return o;
}

function ajaxRequest(options,debug=false)
{
	if( ! options && (typeof options !== 'object'))
	{
		return false;
	}

	options['url'] = options['url'] || '';
	options['method'] = options['method'] || 'POST';
	options['dataType'] = options['dataType'] || 'json';

	if( ! debug)
	{
		return $.ajax(options);
	}
	else
	{
		return $.ajax(options).always(function(){console.log(arguments)});
	}
}

function default_func()
{
	this.dt_render_date = function(format)
	{
		return function(data,type,row,meta)
		{
			if(type=='display')
			{
				return moment(data).isValid() ? moment(data).format(format)
						: '-';
			}
			else
			{
				return data;
			}
		};
	};

	this.dt_render = function(data,type,row,meta)
	{
		if(type=='display')
		{
			return !data ? '-' : data;
		}
		else
		{
			return data;
		}
	};
}
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

function ajaxRequest(options)
{
	if( ! options && (typeof options !== 'object'))
	{
		return false;
	}


	var opt_keys = Object.keys(options);
	for (var i = 0; i < opt_keys.length; i++)
	{
		switch(opt_keys[i])
		{
			case 'url':
				options['url'] = options['url'] || '';
				break;

			case 'method':
				options['method'] = options['method'] || 'POST';
				break;

			case 'dataType':
				options['dataType'] = options['dataType'] || 'json';
				break;
		}
	}

	return $.ajax(options);
}
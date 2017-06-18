/**
 * array_to_object - converts array of objects([{name:'',value:''}]) to single object({name1:value1,name2:value2})
 * @param  {Array}   arr       input array
 * @param  {Boolean} is_simple whether arr is array of objects({name:'',value:''}) or simple array([val1,val2,...valn-1]) 
 * @return object
 */
function array_to_object(arr=[], is_simple=false)
{
	if( ! is_simple)
}
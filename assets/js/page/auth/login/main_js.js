$(document).ready(
function()
{
	$('input[name=u],input[name=pw]').on('keyup',
		function(e)
		{
			// if enter key was pressed
			if(e.which==13)
			{
				$('#sign_in_btn').trigger('click');
			}
		});

	$('#sign_in_btn').on('click',
		function()
		{
			// get login credentials
			var u = $('#login_frm').find('input[name=u]').val();
			var pw = $('#login_frm').find('input[name=pw]').val();

			// check login credentials
			$.ajax({
				url: 	  baseurl+'login/verify',
				method:   'POST',
				dataType: 'json',
				data: 
				{
					u: u,
					pw: pw,
				}
			})
			.done(
				function(result)
				{ 
					var alert_class = '';
					var html = '';

					if(result['verified'])
					{
						$('#login_alert')
							.attr('class','alert alert-success')
							.html('<i class="fa fa-check"></i> Logged in');
						$('#login_alert')
							.slideDown()
							.delay(3000)
							.slideUp();
						setTimeout(
							function()
							{
								$('#login_frm').submit();
							},1000);
					}
					else
					{
						$('#login_alert')
							.attr('class','alert alert-warning')
							.html('<i class="fa fa-exclamation-triangle"></i> Wrong username/password');
						$('#login_alert')
							.slideDown()
							.delay(3000)
							.slideUp();
					}
				})
			.fail(
				function(a,b,c)
				{
					var error_html = '<h4>'+
										'<i class="fa fa-exclamation-circle"></i> '+
										'Login Error'+
									 '</h4>'+
									 '<p>An error occurred.</p>';
					$('#login_alert')
						.attr('class','alert alert-danger')
						.html(error_html);
					$('#login_alert')
						.slideDown()
						.delay(3000)
						.slideUp();
				});
		});
});
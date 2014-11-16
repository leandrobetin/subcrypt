(function($){
	
	$.fn.subcrypt = function(options)
	{
		
		var target = $(this).attr('action');
		var form = this.selector;
		
		var settings = $.extend({		
			
				path: '/subcrypt/', 
				separator : '/'

			}, options);				
		
		var cookie_name = createCookieName(30);
		var cookie_value = createCookieValue(form, settings.separator);
		
		
		
		document.cookie = cookie_name + "=" + cookie_value + "; expires=" + expirationTime() + "; path=" + settings.path;
		
		
		
		$.post(settings.path + 'subcrypt.php',{ 1: cookie_name, 2: settings.separator },function(result){
			
			console.clear();
			
			var html_form = createHtmlForm(target);
				
			for(var i in result)
			{
				for(var prop in result[i])
				{
					    				    
					html_form.append("<input type='hidden' name='"+prop+"' value='"+ result[i][prop] +"' >");
				}
			}
				
			html_form.submit();
			
		},'json');
		
		
		document.cookie = cookie_name + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=" + settings.path;
				
		
		
		
		//---------------------------- Helpers ----------------------------------------------------------
		
		function clear(value)
		{
			return value.replace(settings.separator,"_").replace("=","_").replace(/(\r\n|\n|\r)/gm," "); 
		}
		
		function createCookieValue(form,separator)
		{
						
			var values = "";
			
			$(form+' input[type=password],' + form +' input[type=text],'+ form +' select, '+ form + ' textarea').each(function(){
				
				values += clear($(this).attr('name')) + "=" + clear($(this).val()) + separator;
				
			});
			
			return values ;
		}
		
		function createCookieName(length)
		{
			var ramdom_name = "";
			var symbols = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','x','w','y','z','$','#','@','_','-'];
			
			for(var i=0; i < length; i++)
			{
				ramdom_name += symbols[ Math.ceil( (Math.random() * ( (symbols.length -1) - 0) + 0) ) ];
			}
			
			return ramdom_name;
		}
		
		
		function expirationTime()
		{
			var now = new Date();
			
			now.setTime(now.getTime() + ( 1 * 1000 ) );
			
			return now.toUTCString();
		}
		
		
		function createHtmlForm(target)
		{
			
			$('html > body').append("<form action='"+target+"' method='POST' id='subcrypttempform' style='display: none;'></form>");
			return $('#subcrypttempform');
			
		}
		
		//---------------------------- Helpers ----------------------------------------------------------
		
	};
	
}) (jQuery);
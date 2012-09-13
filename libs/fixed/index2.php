
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>Full page demo | table fixed header</title>			
			
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>
		
        <!---
		<link rel="stylesheet" type="text/css" href="jquery-ui/css/redmond/jquery-ui-1.8.4.custom.css"/>
		<link rel="stylesheet" type="text/css" href="jquery-ui/css/smoothness/jquery-ui-1.8.4.custom.css"/>
		<link rel="stylesheet" type="text/css" href="jquery-ui/css/flick/jquery-ui-1.8.4.custom.css" id="link"/>
        -->
        	
		<link rel="stylesheet" type="text/css" href="css/base.css" />
	
       
        <link rel="stylesheet" type="text/css" href="jquery-ui/css/ui-lightness/jquery-ui-1.8.4.custom.css"/>
		<script type="text/javascript" src="highlighter/codehighlighter.js"></script>	
		<script type="text/javascript" src="highlighter/javascript.js"></script>			
		<script type="text/javascript" src="javascript/jquery.fixheadertable.min.js"></script>		
		
		<script type="text/javascript">  
					
			$(document).ready(function() {  	

			
				$.ajax({						
					url: 'data.php',						
					success: function(data) {
					$('#0').html(data).fixheadertable({ 							
						
							height : 200, 
							width : 500, 
							minWidth : 1000,
							zebra : true
							
						});
					}
				});
				
				
			});
		</script>		
		
	</head>
	<body>
	
		<!--  EXAMPLES -->
		
		
		
		 
			
		  <table id="0"></table>
			
		
</body>
</html>

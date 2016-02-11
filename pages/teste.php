<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    
    <!--JAnela Modal-->
    <link rel="stylesheet" href="./js/jquery.superbox.css" type="text/css" media="all" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="./js/jquery.superbox-min.js"></script>

	<script type="text/javascript">

		$(function(){
			$.superbox.settings = {
				boxId: "superbox", // Id attribute of the "superbox" element
				boxClasses: "", // Class of the "superbox" element
				overlayOpacity: .8, // Background opaqueness
				boxWidth: "600", // Default width of the box
				boxHeight: "400", // Default height of the box
				loadTxt: "Loading...", // Loading text
				closeTxt: "Close", // "Close" button text
				prevTxt: "Previous", // "Previous" button text
				nextTxt: "Next" // "Next" button text
			};
			$.superbox();
		});
	</script>
    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>
</head>
<body>
	 
	 <IFRAME name=Criar Sites src="clientes_new.php" frameBorder=0 width=650 height=800 scrolling=auto></IFRAME>

     <p>Date: <input type="text" id="datepicker"></p>
</body>

</html>


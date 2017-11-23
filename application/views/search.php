<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Empire Archival Discovery Cooperative | Finding Aids at Your Fingertips</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<!-- Bootstrap core CSS -->
		<link href="styles/bootstrap.css" rel="stylesheet">
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="http://library.marist.edu/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<link href="styles/main.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script type="text/javascript" src="http://library.marist.edu/js/jquery-ui.js"></script>
		<link rel="stylesheet" href="http://library.marist.edu/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="./js/nprogress.js"></script>
		<link rel="stylesheet" type="text/css" href="./styles/nprogress.css" />

		<!--style>
            @media all and (min-width:1000px) {


            #searchResults{
                width: 100%;
                float: right;
                clear: right;

            }
            }

        </style-->
       
	</head>
	<body>
		
		
		<div id="headerContainer">
			<a href="http://library.marist.edu/" target="_self"> <div id="header"></div> </a>
		</div>
		
		
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div id="main-container" class="container">
			<div class="jumbotron" style="background: #ffffff;">
				<div class="container" style="margin-top: -36px;">
					<!-- Example row of columns -->
					<div class="row">
						<div class="col-md-12">
							<div id="logo" style="width: 300px; margin-left: auto; margin-right: auto;"><img src='https://www.empireadc.org/sites/www.empireadc.org/files/ead_logo.gif' style='width:300px;'/></div>
							<!--input type="text" id="searchBox" placeholder="Search Honor's Thesis Repository" /-->
							<div id="custom-search-input">
								<div class="input-group col-md-12">
									<input type="text" class="form-control input-lg" id="searchBox" placeholder="Finding Aids at Your Fingertips" />
									<input type="hidden" class="form-control input-lg" id="queryTag" />
									<span class="input-group-btn">
										<button id="initiateSearch" class="btn btn-info btn-lg" type="button" style="background: #ffffff; border-color: #ccc;">
											<img src="./icons/search.png"  style="height: 25px;"/>
										</button> </span>
								</div>
									<p id="message" style="display: none;color: #B31B1B"> Please enter any text or word to search</p>
							</div>
							<div id="selectedFacet" >
							
							</div>
							<div id="searchResults" style="position: relative;display: inline-block">

							</div>

						</div>
					</div><!-- row -->
				</div><!-- container -->
			</div>
			<!-- jumbotron -->

			</br>

		</div></br>
		<!-- main-container -->
		<div class="container">
			<p  class = "foot">
			</p>

		</div>
</body>
<script type="text/javascript">
		$('#initiateSearch').click(function(){
			var searchTerm = $('input#searchBox').val();
			var searchTerm = searchTerm.trim();
			var searchTerm = searchTerm.replace(/ /g,"%20");
			var searchTerm = encodeURIComponent(searchTerm);
			if(searchTerm != "" ) {
				var resultUrl = "<?php echo base_url("?c=eaditorSearch&m=searchKeyWords&key=")?>" + searchTerm;
				$('#searchResults').load(resultUrl);
			}else{
				$("p#message").show().delay(3000).fadeOut();

			}
		});
		
		$('#searchBox').keypress(function(e){
			var key = e.which;
			if(key == 13){
				var searchTerm = $('input#searchBox').val();
				var searchTerm = searchTerm.trim();
				var searchTerm = searchTerm.replace(/ /g,"%20");
				var searchTerm = encodeURIComponent(searchTerm);

				if(searchTerm != "") {
					var resultUrl = "<?php echo base_url("?c=eaditorSearch&m=searchKeyWords&key=")?>" + searchTerm;
					$('#searchResults').load(resultUrl);
				}else{
					$("p#message").show().delay(3000).fadeOut();}}
		});
</script>
</html>

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
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.css">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="<?php echo base_url("/css/ie10-viewport-bug-workaround.css"); ?>" rel="stylesheet">
		<link href="<?php echo base_url("/styles/main.css"); ?>" rel="stylesheet">

		<script type="text/javascript" src="<?php echo base_url("/js/jquery-ui.js"); ?>"></script>
		<link rel="stylesheet" href="<?php echo base_url("/font-awesome/css/font-awesome.min.css"); ?>" />
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="<?php echo base_url("/js/nprogress.js"); ?>"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("/styles/nprogress.css"); ?>" />
	</head>
	<body>

		<div id="headerContainer">
			<a href="https://beta.empireadc.org/" target="_self"> <div id="header"></div> </a>
		</div>
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div id="main-container" class="container">
			<div class="jumbotron" style="background: #ffffff;">
				<div class="container" style="margin-top: -36px;">
					<!-- Example row of columns -->
					<div class="row">
						<div class="col-md-12">
							<div id="logo" style="width: 300px; margin-left: auto; margin-right: auto;"><a href='/'><img src='https://www.empireadc.org/sites/www.empireadc.org/files/ead_logo.gif' style='width:300px;'/></div></a>
							<!--input type="text" id="searchBox" placeholder="Search Honor's Thesis Repository" /-->
							<div id="custom-search-input">
								<div class="input-group col-md-12">
									<input type="text" class="form-control input-lg" id="searchBox" placeholder="Finding Aids at Your Fingertips" />
									<input type="hidden" class="form-control input-lg" id="queryTag" />
									<span class="input-group-btn">
										<button id="initiateSearch" class="btn btn-info btn-lg" type="button" style="background: #ffffff; border-color: #ccc;">
											<img src="<?php echo base_url("/icons/search.png"); ?>" style="height: 25px;"/>
										</button> </span>
								</div>
									<!--p id="message" style="display: none;color: #B31B1B"> Please enter any text or word to search</p-->
									<a href='<?php echo base_url("/eaditorsearch/browse")?>' target='_self'><button class="btn btn-default btn-md" style='margin-top: 5px;'>Browse</button></a>
									<a href='https://drive.google.com/open?id=1hsFy_xJ9uIP_wkRZjityXVdWVHSQF3X9eVALv2sMEo4' target='_self' style='float:right;'>Feedback/Issue</a>
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
			// Clear the selected facets of the previous search
			$("#selectedFacet").empty();
			$('input#queryTag').val('');
			var searchTerm = $('input#searchBox').val();
			var searchTerm = searchTerm.trim();
			var searchTerm = searchTerm.replace(/ /g,"%20");
			var searchTerm = searchTerm.replace(/'/g,"%27");
			var searchTerm = encodeURIComponent(searchTerm);
			var facet = 'NULL';

			if(searchTerm != "" ) {
				if(searchTerm == "*"){
					var resultUrl = "<?php echo base_url("/eaditorsearch/searchAll")?>";
				}else{
					var resultUrl = "<?php echo base_url("/eaditorsearch/searchKeyWords")?>" + "/" + searchTerm + "/" + facet ;
				}
			}
			$('#searchResults').load(resultUrl);
		});

		$('#searchBox').keypress(function(e){
			var key = e.which;
			if(key == 13){
				// Clear the selected facets of the previous search
				$("#selectedFacet").empty();
				$('input#queryTag').val('');
				var searchTerm = $('input#searchBox').val();
				var searchTerm = searchTerm.trim();
				var searchTerm = searchTerm.replace(/ /g,"%20");
				var searchTerm = searchTerm.replace(/'/g,"%27");
				var searchTerm = encodeURIComponent(searchTerm);
				var facet = 'NULL';

			if(searchTerm != "" ) {
				if(searchTerm == "*"){
					var resultUrl = "<?php echo base_url("/eaditorsearch/searchAll")?>";
				}else{
					var resultUrl = "<?php echo base_url("/eaditorsearch/searchKeyWords")?>" + "/" + searchTerm + "/" + facet ;
				}
			}

			var backUrl ="<?php echo base_url("/eaditorsearch/?key=")?>" + searchTerm +"&facet=NULL" ;
			<!--allows backbutton to work -->
			history.replaceState(null, null, backUrl);
			$('#searchResults').load(resultUrl);
			}
		});

        $(document).ready(function(){
  	   var searchTerm = "<?php echo $key; ?>";
		  	if(searchTerm == "" || searchTerm == null){
				$("p#message").show().delay(3000).fadeOut();
		  	}else{
					document.getElementById("searchBox").value = decodeURIComponent(searchTerm);
					var searchTerm = searchTerm.trim();
					var searchTerm = searchTerm.replace(/ /g,"%20");
					var searchTerm = searchTerm.replace(/'/g,"%27");

					var searchTerm = encodeURIComponent(searchTerm);
					var facet = "<?php echo $facet; ?>";
					var resultUrl = "<?php echo base_url("/eaditorsearch/searchKeyWords")?>" + "/" + searchTerm + "/" + facet ;
					$('#searchResults').load(resultUrl);
			}
		});


</script>
</html>

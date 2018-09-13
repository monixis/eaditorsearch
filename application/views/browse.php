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
		<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link href="https://empireadc.org/sites/empireadc.org/themes/esln_ead/css/style.css" rel="stylesheet">
		<link href="https://empireadc.org/sites/empireadc.org/themes/esln_ead/css/media.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
		  <link rel="stylesheet" type="text/css" href="<?php echo base_url("/styles/main.css"); ?>"/>
		<script src="<?php echo base_url("/js/isotope.pkgd.min.js"); ?>"></script>
		<script src="<?php echo base_url("/js/empireadc.js"); ?>"></script>
</head>
	<body>

		<div id="headerContainer">
			<a href="https://www.empireadc.org/" target="_self"> <div id="header"></div> </a>
		</div>

		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div id="main-container" class="container">
			<div class="jumbotron" style="background: #ffffff;">


				<div class="senylrc_top_container">
			     <div class="top_left">
			               <div id="logo">
			           <a href="/" title="Home"><img src="https://empireadc.org/sites\empireadc.org\files/ead_logo.gif"/></a>
			         </div>

			       <h1 id="site-title">
			         <a href="/" title="Home"></a>

			       </h1>
			     </div>

			     <div class="top_right">
			 	<div id="site-description">Finding Aids at Your Fingertips</div>
			       <nav id="main-menu"  role="navigation">
			         <a class="nav-toggle" href="#">Menu</a>
			         <div class="menu-navigation-container">
			           <ul class="menu"><li class="first leaf"><a href="/empiresearch/browse" title="">Browse</a></li>
			 <li class="leaf"><a href="/empiresearch/advsearch" title="">Search</a></li>
			 <li class="leaf"><a href="/participate">Participate</a></li>
			 <li class="last leaf"><a href="/about">About</a></li>
			 </ul>        </div>
			         <div class="clear"></div>
			       </nav>
			     </div>
			 	</div>

			     <div class="clear"></div>



				<div class="container" style="margin-top: -36px;">
					<!-- Example row of columns -->
					<div class="row">

						<div class="col-md-12">

							<!--input type="text" id="searchBox" placeholder="Search Honor's Thesis Repository" /-->
							<h2>Sort by: </h2>
							<div id="sorts" class="button-group">
								<button class="button is-checked" data-sort-by="original-order">Total Finding Aids</button>
  								<button class="button" data-sort-by="name">Organization Name</button>
								<!--button class="button" data-sort-by="number">Total EADs - Ascending</button-->
							</div>

							<div id="browseList" class="grid">
								<?php
                                    $facets = $results->facet_counts->facet_fields->agency_facet;
                                        $facetList = " ";
                                        $i = 0;
                                        foreach ($facets as $row) {
                                            if ($i % 2 == 0) {
                                                $facetList = $row;
                                            } else {
                                                $facetList = $facetList;
                                                //$facetList = trim($facetList);
                                                //$link = base_url("agency") . "/" . rawurlencode($facetList);?>
											<div class="element-item"><h3 class='name'><a href='#' id='browseLink'><?php echo $facetList ; ?></a></h3><p class="number"><?php echo $row ; ?></p></div><?php
                                            }
                                            $i += 1;
                                        }
                                ?>
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
// init Isotope
var $grid = $('.grid').isotope({
  itemSelector: '.element-item',
  layoutMode: 'fitRows',
  getSortData: {
    name: '.name',
    symbol: '.symbol',
    number: '.number parseInt',
    category: '[data-category]',
    weight: function( itemElem ) {
      var weight = $( itemElem ).find('.weight').text();
      return parseFloat( weight.replace( /[\(\)]/g, '') );
    }
  }
});

// filter functions
var filterFns = {
  // show if number is greater than 50
  numberGreaterThan50: function() {
    var number = $(this).find('.number').text();
    return parseInt( number, 10 ) > 50;
  },
  // show if name ends with -ium
  ium: function() {
    var name = $(this).find('.name').text();
    return name.match( /ium$/ );
  }
};

// bind filter button click
$('#filters').on( 'click', 'button', function() {
  var filterValue = $( this ).attr('data-filter');
  // use filterFn if matches value
  filterValue = filterFns[ filterValue ] || filterValue;
  $grid.isotope({ filter: filterValue });
});

// bind sort button click
$('#sorts').on( 'click', 'button', function() {
  var sortByValue = $(this).attr('data-sort-by');
  $grid.isotope({ sortBy: sortByValue });
});

// change is-checked class on buttons
$('.button-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});
$('.element-item').click(function(){
        var searchTerm = $(this).children('h3').text();
                        //var searchTerm = searchTerm.replace(/ /g,"%20");
                        /*var searchTerm = searchTerm.trim();
                        var searchTerm = searchTerm.replace(/ /g,"%20");                */
        var searchTerm = encodeURIComponent(searchTerm);
        var resultUrl = "<?php echo base_url("/agency")?>" + "/" + searchTerm;
        window.open(resultUrl, '_self');
});
</script>

</html>

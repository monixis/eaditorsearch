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
		<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1//jquery.min.js"></script>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url("/js/isotope.pkgd.min.js"); ?>"></script>
	<style>
* { box-sizing: border-box; }

body {
  font-family: sans-serif;
}

/* ---- button ---- */

.button {
  display: inline-block;
  padding: 0.5em 1.0em;
  background: #EEE;
  border: none;
  border-radius: 7px;
  background-image: linear-gradient( to bottom, hsla(0, 0%, 0%, 0), hsla(0, 0%, 0%, 0.2) );
  color: #222;
  font-family: sans-serif;
  font-size: 16px;
  text-shadow: 0 1px white;
  cursor: pointer;
}

.button:hover {
  background-color: #8CF;
  text-shadow: 0 1px hsla(0, 0%, 100%, 0.5);
  color: #222;
}

.button:active,
.button.is-checked {
  background-color: #28F;
}

.button.is-checked {
  color: white;
  text-shadow: 0 -1px hsla(0, 0%, 0%, 0.8);
}

.button:active {
  box-shadow: inset 0 1px 10px hsla(0, 0%, 0%, 0.8);
}

/* ---- button-group ---- */

.button-group {
  margin-bottom: 20px;
}

.button-group:after {
  content: '';
  display: block;
  clear: both;
}

.button-group .button {
  float: left;
  border-radius: 0;
  margin-left: 0;
  margin-right: 1px;
}

.button-group .button:first-child { border-radius: 0.5em 0 0 0.5em; }
.button-group .button:last-child { border-radius: 0 0.5em 0.5em 0; }

/* ---- isotope ---- */

.grid {
  padding-left: 40px;
}

/* clear fix */
.grid:after {
  content: '';
  display: block;
  clear: both;
}

/* ---- .element-item ---- */

.element-item {
  position: relative;
  float: left;
  width: 200px;
  height: 200px;
  margin: 15px;
  padding: 10px;
  background: #ddd;
  color: #262524;
}

.element-item > * {
  margin: 0;
  padding: 0;
}

.element-item .name {
  position: absolute;
  left: 10px;
  top: 50px;
  text-transform: none;
  letter-spacing: 0;
  font-size: 18px;
  font-weight: normal;
  padding: 10px;
}

.element-item .symbol {
  position: absolute;
  left: 10px;
  top: 0px;
  font-size: 42px;
  font-weight: bold;
  color: white;
}

.element-item .number {
  position: absolute;
  right: 8px;
  top: 5px;
}

.element-item .weight {
  position: absolute;
  left: 10px;
  top: 76px;
  font-size: 12px;
}
</style>

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
							<h2>Sort by: </h2>
							<div id="sorts" class="button-group">
								<button class="button is-checked" data-sort-by="original-order">Total Finding Aids</button>
  								<button class="button" data-sort-by="name">Orgizatio Name</button>
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
                                                //$link = base_url("eaditorsearch/agency") . "/" . rawurlencode($facetList);?>
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
			var searchTerm = searchTerm.replace(/ /g,"%20");		*/
	var searchTerm = encodeURIComponent(searchTerm);
	var resultUrl = "<?php echo base_url("/eaditorsearch/agency")?>" + "/" + searchTerm;
	window.open(resultUrl, '_self');
});
</script>
</html>

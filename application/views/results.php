<!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script-->
<meta charset="utf-8">
<!--script type="text/javascript" src="http://library.marist.edu/crrs/js/jquery-ui.js"></script-->
 <script type="text/javascript" src="http://library.marist.edu/js/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/list.pagination.js/0.1.1/list.pagination.min.js"></script>
<script src="./js/jquery.easyPaginate.js"></script>
<script src="./js/nprogress.js"></script>
<style>
	p.labelInfo {font-size: 10pt; margin-top: -10px;}
	span.labelName {color: #b31b1b;font-weight:bold; }
	.easyPaginateNav a {padding:5px;float: inherit}
	.easyPaginateNav a.current {font-weight:bold;text-decoration:underline;}
	/*@media all and (min-width:992px) {
		#facets {
			width: 240px;
			height: auto;
			margin-left: -240px;
		}
	}
/*
	@media all and (max-width:950px) {

		#facets {

			width: 100%;
			float: left
			height: 400px;
		}
	}
*/
</style>
<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<link rel="stylesheet" type="text/css" href="./styles/nprogress.css" />


	<div class="row">	
		<div id="facets" class="page-sidebar col-md-3">
			<h4>Filter By:</h4>
			<?php

				$facets = (array) $results->facet_counts->facet_fields;

				foreach ($facets as $key => $value){
					if(sizeof($value)>0){
			?>
					<button class="accordion" id="<?php echo $key ; ?>"><?php echo $key ; ?></button>
					<div class="panel" id="<?php echo $key ; ?>">
					<?php
						$facetList = " ";
						$i = 0;
						foreach ($value as $row) {
							if ($i % 2 == 0){
								$facetList = $row;
							}else{
								$facetList = $facetList . " - " . $row ;
					?><a href="#" class='tags'><?php echo $facetList ; ?></a><br/><?php
							}
							$i += 1;
						}
					?>
					</div>
			<?php
             }
				}
			?>
		</div>
		
	
	<div class="col-md-9">
		<h2>Results:</h2>
		 <div id="tabs-1" >
  	<!--ol id="list"-->
			<?php
				foreach ($results->response->docs as $row) {
					$title = $row -> Title;
					$year = $row -> Year;
					$date = $row -> Date;
					$collection = $row -> Collection[0];
					$id = $row -> unitid;
					$abstract = $row -> abstract;
					$author = $row -> Publisher;
					$department = $row -> Department[0];
					$display = $row -> Display;
			?>
				<li class="results" style="height: auto; padding: 10px;">
						<a href="<?php echo base_url("?c=repository&m=fileInfo&id=".$id)?>" target="_blank"><?php echo $title; ?> -  <?php echo $year; ?></a></br>
						<p class="labelInfo"><span class="labelName">Author: </span><?php echo $author ?></p>
						<p class="labelInfo"><span class="labelName">Department: </span><?php echo $department ?></p>
						<p class="labelInfo"><span class="labelName">Collection: </span><?php echo $collection ?></p>
						<p class="labelInfo"><span class="labelName">Abstract: </span><?php echo $abstract ?></p>
						<p class="labelInfo" style="font-size: 8pt;"><?php echo $display ?></p>
				</li>
			<?php
				}
			?>	
		<!--/ol></br-->
		<div id="pagination"></div>
</div><!-- Tab 1 ends -->
</br>
		
	</div>
</div>
	
<script type="text/javascript">
	var acc = document.getElementsByClassName("accordion");
	var i;

    for (i = 0; i < acc.length; i++)
    {
        acc[i].onclick = function()
        {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";

            } else {
                panel.style.display = "block";
            }
        }
    }

    $('a.tags').click(function(){
        var searchTerm = $('input#searchBox').val();
        var selectedTag = ($(this).parents('div.panel').attr('id')) + ' : ' + ($(this).text().substr(0, $(this).text().indexOf('-')));
        $('#selectedFacet').append('<button class="taglist" style="border: 1px solid #cccccc; background: #eeeeee; padding: 5px; margin-right: 10px; margin-top: 5px;">'+ selectedTag +'<a href="#" class="remove" id="'+ selectedTag +'" style="margin-left:10px;"> X </a></button>');
        $('input#queryTag').val($('input#queryTag').val() + "fq=" + selectedTag);
        var queryTag = $('input#queryTag').val();
        searchTerm = searchTerm + queryTag;
        searchTerm = searchTerm.replace(/ /g,"%20");
        var resultUrl = "<?php echo base_url("?c=repository&m=searchKeyWords&key=")?>"+searchTerm;
        NProgress.start();
        NProgress.configure({ showSpinner: true });
        $('#searchResults').load(resultUrl);
        NProgress.done();

    });

    $('#selectedFacet').on('click', '.remove', function() {
        var searchTerm = $('input#searchBox').val();
        var unselectedTag ="fq=" + $(this).attr('id');
        $(this).closest('button.taglist').remove();
        $('input#queryTag').val($('input#queryTag').val().replace(unselectedTag, ' '));
        var queryTag = $('input#queryTag').val();
        searchTerm = searchTerm + queryTag;
        searchTerm = searchTerm.replace(/ /g,"%20");
        NProgress.start();
        NProgress.configure({ showSpinner: true });
        var resultUrl = "<?php echo base_url("?c=repository&m=searchKeyWords&key=")?>"+searchTerm;
        $('#searchResults').load(resultUrl);
        NProgress.done();
    });

   $('#tabs-1').easyPaginate({
        paginateElement: 'li',
        elementsPerPage: 10
        /* effect: 'climb'*/
  });
   


</script>


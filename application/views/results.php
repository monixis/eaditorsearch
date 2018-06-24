<!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script-->
<meta charset="utf-8" xmlns="http://www.w3.org/1999/html">
<script type="text/javascript" src="<?php echo base_url("/js/jquery-ui.js"); ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/list.pagination.js/0.1.1/list.pagination.min.js"></script>
<script src="<?php echo base_url("/js/jquery.easyPaginate.js"); ?>"></script>
<style>
	p.labelInfo {font-size: 10pt; margin-top: -10px;}
	span.labelName {color: #b31b1b;font-weight:bold; }
	.easyPaginateNav a {padding:5px;float: inherit}
	.easyPaginateNav a.current {font-weight:bold;text-decoration:underline;}
	
</style>

<link rel="stylesheet" type="text/css" href="./styles/main.css" />

	<div class="row">
		<div id="facets" class="page-sidebar col-md-3">
			<h4>Filter By:</h4>
			<?php
	
			for ($i=0; $i < 8; $i++){
				if(sizeof($facetsList[$i][0])>0){ ?>
					<button class="accordion" id="<?php echo $facetsOrgLabels[$i] ;?>"><?php echo ucfirst($facetsLabels[$i]); ?></button>
					<div class="panel" id="<?php $facetsOrgLabels[$i] ;?>">
						<form class="form-horizontal">
							<div class="form-group has-feedback">
	                      		<span class="input-group-btn">
									<input id="<?php echo $facetsOrgLabels[$i] ;?>" class="facetList form-control hasclear" type="text" placeholder="Search" >
								</span>
							</div>
						</form>
						
						<ul id="<?php echo $facetsOrgLabels[$i] ;?>" style="padding-left: 5px;">
                        <?php
							foreach ($facetsList[$i][0] as $row) {
						?>
								<li id="<?php echo $facetsOrgLabels[$i] ;?>" style="margin-bottom:5px;"><a href="#" class='tags'><?php echo $row ; ?></a></li><?php
							}
						?>
                        </ul>
					</div>

				<?php }}?>	

		</div> <!-- facets ends -->

	<div class="col-md-9">
		
		<h4>Total <?php echo $results->response->numFound; ?> Results:</h4>
		 <div id="tabs-1" >
  	<!--ol id="list"-->
			<?php
				foreach ($results->response->docs as $row) {

					$title = $row -> unittitle_display;
					$date = (isset($row -> unitdate_display) ? $row -> unitdate_display : FALSE) ;
					$publisher = (isset($row -> publisher_display) ? $row -> publisher_display : FALSE) ;
					$collId = (isset($row -> agencycode_facet[0] ) ? str_replace('US-','',$row -> agencycode_facet[0]) : FALSE);
					$fileId = $row -> id ;
					//$link = "https://www.empireadc.org/ead/". $collection ."/id/".$row -> id.".xml"; 
					//$link = base_url('?c=eaditorsearch&m=viewEAD&collId='.$collId.'&eadId='.$row -> id);
					$link = base_url("eaditorsearch/ead") . "/" . $collId . "/" . $fileId;
					
			?>
				<li class="results" style="height: auto; padding: 10px;">
						<a href=<?php echo $link ?> target="_blank"><?php echo $title ?></a></br>
						<p class="labelInfo"><span class="labelName">Date: </span><?php echo $date ?></p>
						<p class="labelInfo"><span class="labelName">Publisher: </span><?php echo $publisher ?></p>
				</li>
			<?php
				}
			?>	
		<!--/ol></br-->

		</div><!-- Tab 1 ends --></br>
	</div><!-- col-md-9 ends -->
</div><!-- row ends -->

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
		var selectedTag = ($(this).parents().attr('id')) + ':"' + ($(this).text()) + '"';
		var selectedTagId = selectedTag.replace(/"/g, '');
		var selectedFacet = $(this).parents().attr('id');
		//User friendly display for selected facets
		if(selectedFacet == "subject_facet")
		{
			selectedFacetDisplay = selectedTag.replace("subject_facet", "Subject");
		}else if(selectedFacet == "agency_facet"){
			selectedFacetDisplay = selectedTag.replace("agency_facet", "Agency");
		}else if(selectedFacet == "corpname_facet"){
			selectedFacetDisplay = selectedTag.replace("corpname_facet", "Organization");
		}else if(selectedFacet == "genreform_facet"){
			selectedFacetDisplay = selectedTag.replace("genreform_facet", "Genre/Format");
		}else if(selectedFacet == "persname_facet"){
			selectedFacetDisplay = selectedTag.replace("persname_facet", "Person");
		}else if(selectedFacet == "century_num"){
			selectedFacetDisplay = selectedTag.replace("century_num", "Date");
		}else if(selectedFacet == "famname_facet"){
			selectedFacetDisplay = selectedTag.replace("famname_facet", "Family");
		}else if(selectedFacet == "geogname_facet"){
			selectedFacetDisplay = selectedTag.replace("geogname_facet", "Place");
		}else if(selectedFacet == "language_facet"){
			selectedFacetDisplay = selectedTag.replace("language_facet", "Language");
		}
        $('#selectedFacet').append('<a href="#" class="remove" style="margin-left:10px;"><button class="taglist" id="'+ selectedTagId +'" style="border: 1px solid #cccccc; background: #eeeeee; padding: 5px; margin-right: 10px; margin-top: 5px;">'+ selectedFacetDisplay +' X</button></a>');
        $('input#queryTag').val($('input#queryTag').val() + "fq=" + selectedTag);
		
	   	if (searchTerm == '*'){ 
			var facet = selectedFacet;
			searchTerm = $(this).text();
			var searchTerm = encodeURIComponent(searchTerm);
       		var searchTerm = searchTerm.replace(/\(/g,"%28");
       		var searchTerm = searchTerm.replace(/\)/g,"%29");
		   	var searchTerm = searchTerm.replace(/'/g,"%27");
		}else{
			var queryTag = $('input#queryTag').val();
        	searchTerm = searchTerm + queryTag;
       		var searchTerm = encodeURIComponent(searchTerm);
       		var searchTerm = searchTerm.replace(/\(/g,"%28");
       		var searchTerm = searchTerm.replace(/\)/g,"%29");
			var searchTerm = searchTerm.replace(/'/g,"%27");
        		// encoding string into UTF - 8 to carry all the required characters in the ajax request.
				// facet = 'NULL' indicates that we are not using the facet searching. In this case selected facets are dynamically attached to the keywords itself. Facet searching is used when links are clicked on the EAD page.
			var facet = 'NULL';
		}
       	
		var resultUrl = "<?php echo base_url("/eaditorsearch/searchKeyWords")?>" + "/" + searchTerm + "/" + facet ;
        $('#searchResults').load(resultUrl);
	});

    $('button.taglist').click(function() {
        var searchTerm = $('input#searchBox').val();
        var unselectedTag ='fq=' + $(this).attr('id');
        unselectedTag = unselectedTag.replace(':',':"')+'"';
		$('input#queryTag').val($('input#queryTag').val().replace(unselectedTag, ' '));
		if(searchTerm == '*'){
			searchTerm = $('input#queryTag').val();
			searchTerm = searchTerm.replace('fq=', '');
		}else{
			var queryTag = $('input#queryTag').val();
			searchTerm = searchTerm + queryTag;
		}	

		$(this).closest('button.taglist').remove();

		if(searchTerm == ' '){
			var resultUrl = "<?php echo base_url("/eaditorsearch/searchAll")?>";
		}else{	
			searchTerm = encodeURIComponent(searchTerm);
			var facet = 'NULL';
			var resultUrl = "<?php echo base_url("/eaditorsearch/searchKeyWords")?>" + "/" + searchTerm + "/" + facet ;
		}
     	$('#searchResults').load(resultUrl);
    });

  	$('#tabs-1').easyPaginate({
        paginateElement: 'li',
        elementsPerPage: 50,
		effect: 'climb',
		prevButtonText: 'Prev',
		nextButtonText: 'Next'
  	});
 
 	$('input.facetList').keyup(function(e){
		var id = $(this).attr('id');
		var sel = 'li#' + id;
		var selectedFacet = 'input#' + id;
		var filter = $(selectedFacet).val();
		if(e.which = 8){
			$(sel).each(function(){
				$(this).show();
			});	
		}
		$(sel).each(function(){
			var currFacet = $(this).text().toLowerCase();
			if(!currFacet.includes(filter)){
				$(this).hide();
			}
		});
	});

	$(".hasclear").keyup(function () {
		var t = $(this);
		t.next('span').toggle(Boolean(t.val()));
	});

	$(".clearer").hide($(this).prev('input').val());

	$(".clearer").click(function () {
		$(this).prev('input').val('').focus();
		$(this).hide();
	});

</script>


<!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script-->
<meta charset="utf-8" xmlns="http://www.w3.org/1999/html">
 <script type="text/javascript" src="//beta.empireadc.org/js/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/list.pagination.js/0.1.1/list.pagination.min.js"></script>
<script src="./js/jquery.easyPaginate.js"></script>

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

	<div class="row">
		<div id="facets" class="page-sidebar col-md-3">
			<h4>Filter By:</h4>
			<?php
				$facets = (array) $results->facet_counts->facet_fields;

				foreach ($facets as $key => $value){
					if(sizeof($value)>0){
			?>
					<button class="accordion" id="<?php echo $key ; ?>"><?php
						if($key == "subject_facet"){
							echo "Subject";
					     }
					     else if($key == "agency_facet"){
							 echo "Agency";

						}else if($key == "corpname_facet"){
							 echo "Organization";

						 }else if($key == "genreform_facet"){
							 echo "Genre/Format";

						 }else if($key == "language_facet"){
							 echo "Language";

						 }else if($key == "persname_facet"){
							 echo "Person";

						 }else if($key == "century_num"){
							 echo "Date";

						 }else if($key == "famname_facet"){
							 echo "Family";

						 }else if($key == "geogname_facet"){
							 echo "Place";
						 }
						?></button>
					<div class="panel" id="<?php echo $key ; ?>">
							<form class="form-horizontal">
								<div class="form-group has-feedback">
                        <input id="searchInput_<?php echo $key;?>" class="form-control hasclear" oninput="sFacet.filterHTML('#<?php echo $key ; ?>', 'li#<?php echo $key;?>', this.value)" type="text" placeholder="Search">
						<span></span>

						</div>
							</form>
						<ul id="<?php echo $key?>" style="padding-left: 5px;">
                        <?php
						$facetList = " ";
						$i = 0;
						foreach ($value as $row) {
							if ($i % 2 == 0){
								$facetList = $row;
							}else{
								$facetList = $facetList . "[" . $row ."]";

					?>
								<li id="<?php echo $key;?>" style="margin-bottom:5px;"><a href="#" class='tags'><?php echo $facetList ; ?></a></li><?php
							}
							$i += 1;
						}
					?>
                        </ul>
					</div>
			<?php
             }
				}
			?>
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
        var selectedTag = ($(this).parents().attr('id')) + ':"' + ($(this).text().substr(0, $(this).text().indexOf('['))) + '"';
        var selectedTagId = selectedTag.replace(/"/g, '');
		var selectedFacet = $(this).parents().attr('id');
		//User friendly display for selected facets
		if(selectedFacet == "subject_facet")
		{
			selectedFacet = selectedTag.replace("subject_facet", "Subject");
		}else if(selectedFacet == "agency_facet"){
			selectedFacet = selectedTag.replace("agency_facet", "Agency");
		}else if(selectedFacet == "corpname_facet"){
			selectedFacet = selectedTag.replace("corpname_facet", "Organization");
		}else if(selectedFacet == "genreform_facet"){
			selectedFacet = selectedTag.replace("genreform_facet", "Genre/Format");
		}else if(selectedFacet == "persname_facet"){
			selectedFacet = selectedTag.replace("persname_facet", "Person");
		}else if(selectedFacet == "century_num"){
			selectedFacet = selectedTag.replace("century_num", "Date");
		}else if(selectedFacet == "famname_facet"){
			selectedFacet = selectedTag.replace("famname_facet", "Family");
		}else if(selectedFacet == "geogname_facet"){
			selectedFacet = selectedTag.replace("geogname_facet", "Place");
		}else if(selectedFacet == "language_facet"){
			selectedFacet = selectedTag.replace("language_facet", "Language");
		}
        $('#selectedFacet').append('<a href="#" class="remove" style="margin-left:10px;"><button class="taglist" id="'+ selectedTagId +'" style="border: 1px solid #cccccc; background: #eeeeee; padding: 5px; margin-right: 10px; margin-top: 5px;">'+ selectedFacet +' X</button></a>');
        $('input#queryTag').val($('input#queryTag').val() + "fq=" + selectedTag);
        var queryTag = $('input#queryTag').val();
        searchTerm = searchTerm + queryTag;
		//var searchTerm = searchTerm.replace(/ /g,"%20");
		// encoding string into UTF - 8 to carry all the required characters in the ajax request.
		var searchTerm = encodeURIComponent(searchTerm);
		//var resultUrl = "<!--?php echo base_url("?c=eaditorsearch&m=searchKeyWords&key=")?>"+searchTerm;
        var resultUrl = "<?php echo base_url("/eaditorsearch/searchKeyWords")?>" + "/" + searchTerm;
		NProgress.start();
        NProgress.configure({ showSpinner: true });
        $('#searchResults').load(resultUrl);
        NProgress.done();

    });

    $('button.taglist').click(function() {
        var searchTerm = $('input#searchBox').val();
        var unselectedTag ='fq=' + $(this).attr('id');
        unselectedTag = unselectedTag.replace(':',':"')+'"';
       	$(this).closest('button.taglist').remove();
        $('input#queryTag').val($('input#queryTag').val().replace(unselectedTag, ' '));
        var queryTag = $('input#queryTag').val();
        searchTerm = searchTerm + queryTag;
		//searchTerm = searchTerm.replace(/ /g,"%20");
		// encoding string into UTF - 8 to carry all the required characters in the ajax request.
		var searchTerm = encodeURIComponent(searchTerm);
        NProgress.start();
        NProgress.configure({ showSpinner: true });
        //var resultUrl = "<!--?php echo base_url("?c=eaditorsearch&m=searchKeyWords&key=")?>"+searchTerm;
        var resultUrl = "<?php echo base_url("/eaditorsearch/searchKeyWords")?>" + "/" + searchTerm;
		$('#searchResults').load(resultUrl);
        NProgress.done();
    });

   $('#tabs-1').easyPaginate({
        paginateElement: 'li',
        elementsPerPage: 10
        /* effect: 'climb'*/
  });

    var sFacet = {};
    sFacet.filterHTML = function(id, sel, filter) {
        var a, b, c, i, ii, iii, hit;
        a = sFacet.getElements(id);
        for (i = 0; i < a.length; i++) {
            b = sFacet.getElements(sel);
            for (ii = 0; ii < b.length; ii++) {
                hit = 0;
                if (b[ii].innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1) {
                    hit = 1;
                }
                c = b[ii].getElementsByTagName("*");
                for (iii = 0; iii < c.length; iii++) {
                    if (c[iii].innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1) {
                        hit = 1;
                    }
                }
                if (hit == 1) {
                    b[ii].style.display = "";
                } else {
                    b[ii].style.display = "none";
                }
            }
        }
    };
    sFacet.getElements = function (id) {
        if (typeof id == "object") {
            return [id];
        } else {
            return document.querySelectorAll(id);
        }
    };

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


<!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script-->
<meta charset="utf-8" xmlns="http://www.w3.org/1999/html">
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
							<form class="form-horizontal">
								<div class="form-group has-feedback">
                        <input id="searchInput_<?php echo $key;?>" class="form-control hasclear" oninput="sFacet.filterHTML('#<?php echo $key ; ?>', 'li#li_<?php echo $key;?>', this.value)" type="text" placeholder="Search">
						<span class="clearer glyphicon glyphicon-remove-circle form-control-feedback"></span>

						</div>
							</form>
						<ul id="<?php echo $key?>">
                        <?php
						$facetList = " ";
						$i = 0;
						foreach ($value as $row) {
							if ($i % 2 == 0){
								$facetList = $row;
							}else{
								$facetList = $facetList . " - " . $row ;

					?>
								<li id="li_<?php echo $key;?>"><a href="#" class='tags'><?php echo $facetList ; ?></a></li><?php
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
		<h2>Results:</h2>
		 <div id="tabs-1" >
  	<!--ol id="list"-->
			<?php
				foreach ($results->response->docs as $row) {
					$title = $row -> unittitle_display;
					$date = (isset($row -> unitdate_display) ? $row -> unitdate_display : FALSE) ;
					$publisher = (isset($row -> publisher_display) ? $row -> publisher_display : FALSE) ;
					$collId = str_replace('US-','',$row -> agencycode_facet[0]);
					$fileId = $row -> id ;
					//$link = "https://www.empireadc.org/ead/". $collection ."/id/".$row -> id.".xml"; 
					$link = base_url('?c=eaditorSearch&m=viewEAD&collId='.$collId.'&eadId='.$row -> id);
			?>
				<li class="results" style="height: auto; padding: 10px;">
						<p class="labelInfo"><span class="labelName">Title:</span><a href=<?php echo $link ?> target="_blank"><?php echo $title ?></a></p>
						<p class="labelInfo"><span class="labelName">Date: </span><?php echo $date ?></p>
						<p class="labelInfo"><span class="labelName">Publisher: </span><?php echo $publisher ?></p>
				</li>
			<?php
				}
			?>	
		<!--/ol></br-->
				<div id="pagination"></div>
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


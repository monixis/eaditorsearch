<!DOCTYPE html>
<html lang="en">
<head>
  <title>EADitor EAD view</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"-->
    <link rel="stylesheet" href="styles/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      /*background-color: #f1f1f1;*/
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }

	#componentList {
    width:auto;
    margin:0 auto;
    height: 600px;
    overflow-y: auto;
}

.fileRow {
    line-height:10pt;
    padding: 5px;
    border-top: 1px solid #ddd;
    padding-left: 20px;
}
    .big-checkbox {width: 20px; height: 20px; float: right}

.seriesRow {
	line-height:10pt;
    padding: 5px;
    border-top: 1px solid #ddd;
 }

label{
  margin-right: 25px;
}

button{
  margin-bottom: 5px;
}

    .show-when-loading {
      display: none;
    }

    body.loading .show-when-loading {
      display: inline-block;
    }

    .researchCart{
      float: right;
      margin-bottom: 20px;
      border-collapse: collapse;
    }
    .researchCart, th, td{
      border: 1px solid #cdcdcd;
    }
    .researchCart th{

      text-align: center;
      background-color:#cdcdcd ;

    }
      #reserve{
          float: right;
          margin-bottom: 30px;
          border-collapse: collapse;

      }



</style>
<script>
  function removeCartItem(a)
  {
    var row = document.getElementById("trow-"+a);

    row.parentNode.removeChild(row);
    document.getElementById(a).checked = false;
    localStorage.removeItem(a);
      if($('#researchCart tbody tr').length == 1) {

          document.getElementById("researchCart").style.visibility = "hidden";
      }

  }

  $(document).ready(function () {

    for (var i = 0; i < localStorage.length; i++) {
         var checkbox = localStorage.key(i);
         var checkbox_value = decodeURIComponent(localStorage.getItem(checkbox));
      if(checkbox.substring(0,6) == 'crtitm') {
          if(document.getElementById(checkbox)) {
              document.getElementById(checkbox).checked = true;
          }
          var remove_anchor = "<a href=\"#\" onclick=removeCartItem("+"\""+checkbox+"\""+");>Remove</a>";
          var trow = "trow-";

          var checkbox_disp_val = decodeURIComponent(checkbox_value);
          var markup = "<tr id=\"" +trow+ checkbox + "\"><td><p>" + checkbox_disp_val+ "</p></td><td>" + remove_anchor + "</td></tr>";
          $("table#researchCart tbody").append(markup);
          document.getElementById("cart").style.visibility = "visible";

      }

    }

  $(':checkbox').change(function() {
    var checkbox_id = $(this).attr('id');
    var checkbox_value = encodeURIComponent($(this).val());
    if($(this).is(':checked')){
      localStorage.setItem(checkbox_id, checkbox_value);
      var remove_anchor = "<a href=\"#\" onclick=removeCartItem("+"\""+checkbox_id+"\""+");>Remove</a>";
      var trow = "trow-";
      var markup = "<tr id=\""+trow+checkbox_id+"\"><td><p>"+decodeURIComponent(checkbox_value)+"</p></td><td>"+remove_anchor+"</td></tr>";
      $("table#researchCart tbody").append(markup);
      document.getElementById("cart").style.visibility = "visible";

    }else if(!$(this).is(':checked')){
      localStorage.removeItem(checkbox_id);
      var row = document.getElementById("trow-"+checkbox_id);
      row.parentNode.removeChild(row);
        if($('#researchCart tbody tr').length <1){
            document.getElementById("cart").style.visibility = "hidden";

        }
    }


  });

  });

</script>
<!--script>
  	$(document).ready(function() {
	    $(".fileRow:even").css("background-color","#f2f2f2"); 
    	$(".fileRow:odd").css("background-color","#ffffff"); 
	});
</script-->
    <?php
    // $xml = simplexml_load_file('https://www.empireadc.org/ead/nalsu/id/ua950.015.xml');
    //$xml = simplexml_load_file('https://www.empireadc.org/ead/nalsu/id/apap134.xml');

    $link = "https://www.empireadc.org/ead/". strtolower($collId) ."/id/".$eadId.".xml";
    $rdf = "https://www.empireadc.org/ead/". $collId ."/id/".$eadId.".rdf";
    $xml = simplexml_load_file($link);
    $title = $xml->archdesc->did->unittitle;
    $repository = (isset($xml->archdesc->did->repository->corpname)? $xml->archdesc->did->repository->corpname : $xml->archdesc->did->repository);
    $extent = $xml->archdesc->did->physdesc->extent;
    $creator =  (isset($xml->archdesc->did->origination->corpname)? $xml->archdesc->did->origination->corpname : FALSE);
    if ($creator == FALSE){
      $creator =  (isset($xml->archdesc->did->origination->persname)? $xml->archdesc->did->origination->persname : $xml->archdesc->did->origination->famname);
    }
    $location = (isset($xml->archdesc->did->physloc)? $xml->archdesc->did->physloc : 'Unspecified');
    $language = (isset($xml->archdesc->did->langmaterial-> language)? $xml->archdesc->did->langmaterial-> language : $xml->archdesc->did->langmaterial);
    $abstract = (isset($xml->archdesc->did->abstract)? $xml->archdesc->did->abstract : 'Unspecified');
    $processInfo = (isset($xml->archdesc->processinfo->p)? $xml->archdesc->processinfo->p : 'Unspecified');
    $access = (isset($xml->archdesc->accessrestrict->p)? $xml->archdesc->accessrestrict->p : 'Unspecified');
    $copyright = (isset($xml->archdesc->userestrict->p)? $xml->archdesc->userestrict->p : 'Unspecified');
    $acqInfo = (isset($xml->archdesc->acqinfo->p)? $xml->archdesc->acqinfo->p : 'Unspecified');
    $prefCitation = (isset($xml->archdesc->prefercite->p[1])? $xml->archdesc->prefercite->p[1] : 'Unspecified');
    $histNote = 'Unspecified';
    if (isset($xml->archdesc->bioghist)){
        foreach($xml->archdesc->bioghist->children() as $p){
            if($p->getname() == 'p'){
                $histNote = $histNote . $p . "<br /><br />\n" ;
            }
        }
    }
    $scopeContent = 'Unspecified';
    if(isset($xml->archdesc->scopecontent)){
        foreach($xml->archdesc->scopecontent->children() as $p){
            if($p->getname() == 'p'){
                $scopeContent = $scopeContent  . $p . "<br /><br />\n" ;
            }
        }
    }
    $arrangement = '';
    if(isset($xml->archdesc->arrangement)){
        foreach($xml->archdesc->arrangement->children() as $p){
            if($p->getname() == 'p'){
                $arrangement = $arrangement . $p . "<br />\n" ;
            }
        }
    }
    $componentList = (isset($xml->archdesc->dsc->c)? TRUE : FALSE);
    $digitalObject = (isset($xml->archdesc->did->daogrp)? TRUE : FALSE);
    $otherfindaids = (isset($xml->archdesc->otherfindaid->bibref->extptr)? $xml->archdesc->otherfindaid->bibref->extptr : FALSE);
    if ($otherfindaids != FALSE){
      $otherfindaidsAttr = $otherfindaids -> attributes('http://www.w3.org/1999/xlink');
      $filename = $otherfindaidsAttr['href'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $iconLink = 'https://www.empireadc.org/ead/ui/images/';
      if ($ext == 'docx'){
          $iconLink = $iconLink . 'word.png';
      }else if ($ext == 'pdf'){
        $iconLink = $iconLink . 'adobe.png';
      }else if ($ext == 'xlsx'){
        $iconLink = $iconLink . 'excel.png';
      }
      $downloadLink = "https://www.empireadc.org/ead/uploads/". $collId ."/".$otherfindaidsAttr['href'];
    }
    $dateRange = array();
    foreach($xml->archdesc->did->unitdate as $x){
      $dateValue = ucfirst($x['type']). ' Date: '.$x ;
      array_push($dateRange, $dateValue);
    }
    ?>
</head>
<body>

<?php 
	function seriesLevel($level, $obj, $collId , $repository){ //recursive function that creates placeholder for series and other sub levels
    $flag = 0;
    $component = 0;
    $fileLevel = 0;
	?>
		<div class="<?php echo $level; ?> seriesRow">
					<?php
						foreach ($obj->did->children() as $childObj){
							if($childObj->getname() == 'unittitle'){
            					if(count($childObj) > 0){?>
            						<!--h4><?php echo $childObj->title; ?></h4>
                				<h4><?php echo $childObj->title->emph; ?></h4-->
                				<h4><?php echo ucfirst($level) . " " . $obj->did->unitid . ": " . $childObj->title . $childObj->title->emph . $childObj->emph; ?></h4>                        
           						<?php }else{?>
           							<h4><?php echo ucfirst($level) . " " . $obj->did->unitid . ": " . $childObj; ?></h4>
           						<?php }
          					}elseif($childObj->getname() == 'unitdate'){?>
          						<p><?php echo ucfirst($childObj['type']).' Date: '.$childObj; ?></p><?php
          					}elseif($childObj->getname() == 'container'){?>
          						<p><?php echo ucfirst($childObj['type']).": ". $childObj; ?></p><?php
          					}?>
          			<?php } ?>
          			<p style="line-height: 24px;"><?php echo isset($obj->scopecontent->p)?$obj->scopecontent->p : '' ;?></p>	
          			
          			<!-- Check if this series has children levels -->
          			<?php
          			foreach ($obj->children() as $grandchildObj){
          				if($grandchildObj->getname() == 'c'){
          					$cAttr1 = $grandchildObj->attributes();
                    
								     $cLevel1 = $cAttr1["level"];

									     if($cLevel1 == 'otherlevel' || $cLevel1 == 'subseries'){
									        $flag = 1;
                          seriesLevel($cLevel1, $grandchildObj, $collId, $repository);
                        }elseif($cLevel1 == 'file'){
                          $fileLevel = 1;
                        }else{
                          $fileLevel = 1 ;
                        }
								  }
							  }
					if ($flag == 0){ // if no other level exists, display the files 
            if($fileLevel == 1){ ?>
              	<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#<?php echo $obj['id']; ?>" style="margin-bottom: 5px;">View the files.</button>
                <div id="<?php echo $obj['id']; ?>" class="collapse" style="width: 75%; border-left: 1px solid #ccc; border-right: 1px solid #ccc; margin-left:auto; margin-right: auto;">
								<?php 
									foreach ($obj->c as $fileObj){?>
										<div class="fileRow">
											<?php	
												foreach ($fileObj->did->children() as $file){
													if($file->getname() == 'unittitle'){
     													if(count($file) > 0){?>
            												<h4><?php echo $file->title; $component = $file->title;?></h4>
                										<h4><?php echo $file->emph; ?><?php	echo $file; ?></h4>
           												<?php }else{?>
           													<h4><?php	echo $file; $component = $file;?></h4>
           												<?php }
													}elseif($file->getname() == 'unitdate'){?>
          												<p><?php echo ucfirst($file['type']).' Date: '.$file; ?></p><?php
          											}elseif($file->getname() == 'container'){?>
          												<p><?php echo ucfirst($file['type']).": ". $file;     $arr = explode(' ',ucfirst($file['type'])."-". $file);
                                      $component = $component."-". $arr[0];  ?></p><?php
          											}	
												}?>
                                         <!--   <input type="checkbox" class="big-checkbox" id="<?php echo  "crtitm"."-".$collId."-".$component; ?>" value="<?php echo  $repository.substr(0,13)."..."."-".$collId."-".$component; ?>">
                                          -->
                                        </div>
								<?php } ?>	
						</div>
                <?php } ?>
					<?php
					}
					?>
          </div>			
<?php	} 
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <!--a class="navbar-brand" href="/"><img src='https://www.empireadc.org/sites/www.empireadc.org/files/ead_logo.gif' /></a-->
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!--li class="active"><a href="#">Home</a></li-->
       </ul>
      <ul class="nav navbar-nav navbar-right">
        <!--li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li-->
        <!--li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li-->
        <li><a href='https://drive.google.com/open?id=1hsFy_xJ9uIP_wkRZjityXVdWVHSQF3X9eVALv2sMEo4' target='_blank'>Feedback/Issue</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
		<a href='<?php echo base_url( ); ?>'><img src='https://www.empireadc.org/sites/www.empireadc.org/files/ead_logo.gif' style='width:220px; margin-top: -75px'/></a>
      <!--p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p-->
    </div>
    <div class="col-sm-8 text-left"> 
    	

<div id="eadInfo" style="margin-bottom: 30px;">
       <h1><?php echo $title; ?></h1>
       <h4 style="font-style: italic"><?php echo $repository; ?></h4> 
       <div>
         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#descId" style="font-size: 14px;">Descriptive Identification</button>
         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminInfo" style="font-size: 14px;">Administrative Information</button>
         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#controlHeadings" style="font-size: 14px;">Controlled Access Headings</button>
       </div>
		<h4>Output formats:</h4>
		 <a href='<?php echo $link; ?>' target='_blank' style='text-decoration: none; color: #ffffff;'><button type="button" class="btn btn-info" >XML</button></a>
     <a href='<?php echo $rdf; ?>' target='_blank' style='text-decoration: none; color: #ffffff;'><button type="button" class="btn btn-info" >RDF/XML</button> </a>      
       <!--?php if($digitalObject == TRUE) { ?>
          <h5> Digital Images: </h5>
          <!--?php foreach ($xml->archdesc->did->daogrp->daoloc as $file){ ?>
              
                  <p><!--?php echo $file['xlink:label']; ?></p>
         
     
      <!--?php }} ?-->


<div id="controlHeadings" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Controlled Access Headings</h4>
      </div>
      <div class="modal-body">
         <?php 
         $controlledAccess = (isset($xml->archdesc->controlaccess)? TRUE : FALSE);

         if($controlledAccess == TRUE){
          $controlHeading = array();
          foreach($xml->archdesc->controlaccess->children() as $list) {
            $included = FALSE;
              foreach($controlHeading as $value){
                if ($value == $list->getname()){
                  $included = TRUE;
                }
              }
              if($included == FALSE){
                array_push($controlHeading, $list->getname());
              }
          }
      foreach($controlHeading as $value){
          $headValue = $value;
           if($value == 'subject'){
             $headValue = 'Subject:';
           } elseif($value == 'persname'){
             $headValue = 'Person:';
           } elseif($value == 'genreform'){
             $headValue = 'Genre/Format:';
           } elseif($value == 'corpname'){
             $headValue = 'Corporation:';
           } elseif($value == 'geogname'){
             $headValue = 'Place:';
           }
           ?>
           <h5><?php echo $headValue; ?></h5>
            <?php  foreach($xml->archdesc->controlaccess->children() as $list) {
                if ($value == $list->getname()){ ?>
                    <ul><li><a href="#" class='controlledHeader'><?php echo $list; ?></a></li></ul>
            <?php }
             }
          }
         }else{ ?>
            <h4 style="font-style: italic">Not available</h4>
      <?php  }

      ?>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</div> 
 
<div id="descId" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Descriptive Identification</h4>
      </div>
      <div class="modal-body">
        <label>Repository: </label><p><?php echo $repository; ?></p>
        <label>Date: </label>
        <?php foreach ($dateRange as $y){ ?>
          <p><?php echo $y; ?></p>
        <?php } ?>
        <label>Extent: </label><p><?php echo $extent; ?></p>
        <label>Creator: </label><p><?php echo $creator; ?></p>
        <label>Location: </label><p><?php echo $location; ?></p>
        <label>Language: </label><p><?php echo $language; ?></p>
        <label>Abstract: </label><p><?php echo $abstract; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="adminInfo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Administrative Information</h4>
      </div>
      <div class="modal-body">
        <label>Processing Information: </label><p><?php echo $processInfo; ?></p>
        <label>Access: </label><p><?php echo $access; ?></p>
        <label>Copyright: </label><p><?php echo $copyright; ?></p>
        <label>Acquisition Information: </label><p><?php echo $acqInfo; ?></p>
        <label>Preferred Citation: </label><p><?php echo $prefCitation; ?></p>
        <label>Historical Note: </label><p><?php echo $histNote; ?></p>
        <label>Scope and Content: </label><p><?php echo $scopeContent; ?></p>
        <label>Arrangement: </label><p><?php echo $arrangement; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div>
<!--h4>Components List <p style="float: right">Add to Cart</p></h4-->
</div>

<div id="componentList">
<?php if ($componentList == TRUE){
  /* For cases where high level series list exists but a more detailed container list is available for download*/
   if ($otherfindaids != FALSE){ ?>
    <h4>Download Container List:</h4>
    <a href='<?php echo $downloadLink; ?>' itemprop="url"><img src='<?php echo $iconLink;?>' class="doc-icon"></a></br></br> 
  <?php }
  $component = 0;
	foreach ($xml->archdesc->dsc->c as $c){
		$cAttr = $c->attributes();
		$cLevel = $cAttr["level"];
			if ($cLevel == 'file'){?> 
				<div class="fileRow">
					<?php	
						foreach ($c->did->children() as $child){
	       					if($child->getname() == 'unittitle'){
            					if(count($child) > 0){
                              if(isset($child->title->emph)){?>
                                 <h4><?php echo ucfirst($cLevel).": "; $component = $child->title->emph; echo $component; $component = str_replace(" ","", $component) ?></h4> 
                              <?php } else { ?>
                                 <h4><?php echo ucfirst($cLevel).": "; $component = $child->title; echo $component; $component = str_replace(" ","", $component)?></h4>
                              <?php }                                   				
           						}else{?>
           							<h4><?php echo ucfirst($cLevel).": "; $component =  $child; echo $component; $component = str_replace(" ","", $component) ?></h4>
           						<?php }
          					}elseif($child->getname() == 'unitdate'){?>
          						<p><?php echo ucfirst($child['type']).' Date: '.$child; ?></p><?php
          					}elseif($child->getname() == 'container'){?>
          						<p><?php echo ucfirst($child['type']).": ". $child;
                                $arr = explode(' ',ucfirst($child['type'])."-". $child);
                                $component = $component."-". $arr[0];  ?></p><?php
          					}
						}?>
                <!--    <input type="checkbox" class="big-checkbox" id="<?php echo  "crtitm"."-".$collId."-".$component; ?>" value="<?php echo  $repository.substr(0,13)."..."."-".$collId."-".$component; ?>">
                -->
                </div>
			<?php } elseif ($cLevel == 'series' || $cLevel == 'collection'){
					seriesLevel($cLevel, $c, $collId, $repository);
			 }	
  } /* for each */
}else if ($otherfindaids != FALSE){ ?>
  <h4>Download Container List:</h4>
  <a href='<?php echo $downloadLink; ?>' itemprop="url"><img src='<?php echo $iconLink;?>' class="doc-icon"></a> 
<?php }
else{?>
		<h4 style="font-style: italic">Container List Not Available</h4>
	<?php	
}
?>
				</div><!-- componentList -->

    </div></br></br>
    <!--div id="cart" style="visibility:hidden;">
          <div align="right">
          </div>
              <table id="researchCart" class="researchCart">

      <thead>
      <tr>

          <th> <button class="btn" id="reserve"><a href="<?php echo base_url("?c=eaditorsearch&m=help");?>">Help</a></button><h4>Your Research Cart</h4></th>
          <th><button class="btn" id="reserve"><a href="<?php echo base_url("?c=eaditorsearch&m=reserve");?>">Reserve</a></button></th>
      </tr>
      <tr>
          <th>Item</th>
        <th>Remove</th>
      </tr>
      </thead>
      <tbody>
      <tr>
      </tr>
      </tbody>

    </table>

    </div-->

	</div>
</div>

</br>
<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>
</body>
<script>
	$('a.controlledHeader').click(function(){
      var selectedHeader = $(this).text();
      var selectedHeader = selectedHeader.trim();
      var selectedHeader = selectedHeader.replace(/ /g,"%20");
      var selectedHeader = encodeURIComponent(selectedHeader);
      resultUrl = "<?php echo base_url("?key=")?>" + selectedHeader;
	  window.open(resultUrl);
    });
</script>
</html>









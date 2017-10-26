<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
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
}

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

</style>
<!--script>
  	$(document).ready(function() {
	    $(".fileRow:even").css("background-color","#f2f2f2"); 
    	$(".fileRow:odd").css("background-color","#ffffff"); 
	});
</script-->
</head>
<body>

<!--nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><img src='https://www.empireadc.org/sites/www.empireadc.org/files/ead_logo.gif' class="navbar-brand" style='height: 150px;'/></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav-->

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><img src='https://www.empireadc.org/sites/www.empireadc.org/files/ead_logo.gif' style='height:85px; width:165px;'/></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!--li class="active"><a href="#">Home</a></li-->
       </ul>
      <ul class="nav navbar-nav navbar-left">
        <!--li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li-->
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <!--p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p-->
    </div>
    <div class="col-sm-8 text-left"> 
<?php
  // $xml = simplexml_load_file('https://www.empireadc.org/ead/nalsu/id/ua950.015.xml');
   //$xml = simplexml_load_file('https://www.empireadc.org/ead/nalsu/id/apap134.xml');
   $link = "https://www.empireadc.org/ead/". $collId ."/id/".$eadId.".xml"; 
   $rdf = "https://www.empireadc.org/ead/". $collId ."/id/".$eadId.".rdf";
   $xml = simplexml_load_file($link);
   $title = $xml->archdesc->did->unittitle;
   $repository = (isset($xml->archdesc->did->repository->corpname)? $xml->archdesc->did->repository->corpname : $xml->archdesc->did->repository);
   $extent = $xml->archdesc->did->physdesc->extent;
   $creator =  (isset($xml->archdesc->did->origination->corpname)? $xml->archdesc->did->origination->corpname : $xml->archdesc->did->origination->persname);
   $location = (isset($xml->archdesc->did->physloc)? $xml->archdesc->did->physloc : 'Unspecified');
   $language = (isset($xml->archdesc->did->langmaterial-> language)? $xml->archdesc->did->langmaterial-> language : $xml->archdesc->did->langmaterial);
   $abstract = $xml->archdesc->did->abstract;
   $processInfo = (isset($xml->archdesc->processinfo->p)? $xml->archdesc->processinfo->p : 'Unspecified');
   $access = $xml->archdesc->accessrestrict->p;
   $copyright = $xml->archdesc->userestrict->p;
   $acqInfo = (isset($xml->archdesc->acqinfo->p)? $xml->archdesc->acqinfo->p : 'Unspecified');
   $prefCitation = $xml->archdesc->prefercite->p[1];
   $histNote = $xml->archdesc->bioghist->p;
   $scopeContent = $xml->archdesc->scopecontent->p;
   $arrangement = (isset($xml->archdesc->arrangement->p)? $xml->archdesc->arrangement->p : 'Unspecified');  
   $componentList = (isset($xml->archdesc->dsc->c)? TRUE : FALSE);
   $digitalObject = (isset($xml->archdesc->did->daogrp)? TRUE : FALSE);
?>
<div id="eadInfo" style="margin-bottom: 30px;">
       <h1><?php echo $title; ?></h1> 
       <h4 style="font-style: italic"><?php echo $repository; ?></h4> 
       <div>
         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#descId" style="font-size: 14px;">Descriptive Identification</button>
         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminInfo" style="font-size: 14px;">Administrative Information</button>
         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#controlHeadings" style="font-size: 14px;">Controlled Access Headings</button>
       </div>
		<h4>Output formats:</h4>
		  <button type="button" class="btn btn-info" ><a href='<?php echo $link; ?>' target='_blank' style='text-decoration: none; color: #ffffff;'>XML</a></button>
      <button type="button" class="btn btn-info" ><a href='<?php echo $rdf; ?>' target='_blank' style='text-decoration: none; color: #ffffff;'>RDF/XML</a></button>       
  
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
                  <ul><li><?php echo $list; ?></li></ul>
          <?php }
           }
        }
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

<h4>Components List</h4>
<div id="componentList">
<?php if ($componentList == TRUE){
	foreach ($xml->archdesc->dsc->c as $c){
		$cAttr = $c->attributes();
		$cLevel = $cAttr["level"];
			if ($cLevel == 'series'){?>
				<div class="seriesRow">
					<?php 
						foreach ($c->did->children() as $seriesObj){
							if($seriesObj->getname() == 'unittitle'){
            					if(count($seriesObj) > 0){?>
            						<h4><?php echo $seriesObj->title; ?></h4>
                					<h4><?php echo $seriesObj->title->emph; ?></h4>
           						<?php }else{?>
           							<h4><?php echo ucfirst($cLevel) . " " . $c->did->unitid . ": " . $seriesObj; ?></h4>
           						<?php }
          					}elseif($seriesObj->getname() == 'unitdate'){?>
          						<p><?php echo ucfirst($seriesObj['type']).' Date: '.$seriesObj; ?></p><?php
          					}elseif($seriesObj->getname() == 'container'){?>
          						<p><?php echo ucfirst($seriesObj['type']).": ". $seriesObj; ?></p><?php
          					}?>
          					
          			<?php } ?>
          			<p style="line-height: 24px;"><?php echo isset($c->scopecontent->p)?$c->scopecontent->p : '' ;?></p>
          			<?php /* when component list includes sub series (otherlevel) */	
          				foreach ($c->children() as $seriesChild){
          					if($seriesChild->getname() == 'c'){
          						$cAttr1 = $seriesChild->attributes();
								$cLevel1 = $cAttr1["level"]; 
									if($cLevel1 == 'otherlevel'){?>
										<div class="otherLevel">
											<h4><?php echo $seriesChild->did->unitid . ": " . $seriesChild->did->unittitle ;?></h4>
											<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#<?php echo str_replace(".", "-", $seriesChild->did->unitid); ?>" style="margin-bottom: 5px;">View the files.</button>
											<div id="<?php echo str_replace(".", "-", $seriesChild->did->unitid); ?>" class="collapse" style="width: 75%; border-left: 1px solid #ccc; border-right: 1px solid #ccc; margin-left:auto; margin-right: auto;">
												<?php 
													foreach ($seriesChild->c as $fileObj){?>
														<div class="fileRow">
															<?php	
															foreach ($fileObj->did->children() as $file){
																if($file->getname() == 'unittitle'){
           															
           															if(count($file) > 0){?>
            															<h4><?php echo $file->title; ?></h4>
                														<h4><?php echo $file->emph; ?><?php	echo $file; ?></h4>
           															<?php }else{?>
           																<h4><?php	echo $file; ?></h4>
           															<?php }

																}elseif($file->getname() == 'unitdate'){?>
          															<p><?php echo ucfirst($file['type']).' Date: '.$file; ?></p><?php
          														}elseif($file->getname() == 'container'){?>
          															<p><?php echo ucfirst($file['type']).": ". $file; ?></p><?php
          														}	
															}?>
														</div>
													<?php } ?>	
											</div>
										</div> <!-- otherlevel -->
									<?php }
          					}
          				}
          			if($cLevel1 == 'file'){?>
									<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#<?php echo $c->did->unitid; ?>" style="margin-bottom: 5px;">View the files.</button>
									<div id="<?php echo $c->did->unitid;?>" class="collapse" style="width: 75%; border-left: 1px solid #ccc; border-right: 1px solid #ccc; margin-left:auto; margin-right: auto;">
									<?php	
										foreach ($c->c as $fileObj){?>
											<div class="fileRow">
												<?php	
													foreach ($fileObj->did->children() as $file){
													if($file->getname() == 'unittitle'){?>
           												<h4><?php echo $file; ?></h4>
        											<?php 
													}elseif($file->getname() == 'unitdate'){?>
          												<p><?php echo ucfirst($file['type']).' Date: '.$file; ?></p><?php
          											}elseif($file->getname() == 'container'){?>
          												<p><?php echo ucfirst($file['type']).": ". $file; ?></p><?php
          											}	
												}?>
											</div>
										<?php } ?>	
									</div> <!-- collapsable div listing files -->
					<?php } ?> <!-- if level is file -->
				</div> <!-- seriesRow -->	
			<?php }else{?> <!-- when the component list only has files -->
				<div class="fileRow">
					<?php	
						foreach ($c->did->children() as $child){
	       					if($child->getname() == 'unittitle'){
            					if(count($child) > 0){?>
            						<h4><?php echo $child->title; ?></h4>
                					<h4><?php echo $child->title->emph; ?></h4>
           						<?php }else{?>
           							<h4><?php	echo $child; ?></h4>
           						<?php }
          					}elseif($child->getname() == 'unitdate'){?>
          						<p><?php echo ucfirst($child['type']).' Date: '.$child; ?></p><?php
          					}elseif($child->getname() == 'container'){?>
          						<p><?php echo ucfirst($child['type']).": ". $child; ?></p><?php
          					}
						}?>
				</div>
			<?php }		
	} /* for each */
}?>
				</div><!-- componentList -->
			</div>
		</div>
	</div>
</div>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>









<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
    line-height:24pt;
    padding: 5px;
    border-top: 1px solid #ddd;
}

div#componentList1 > div:nth-of-type(odd) {
    background: #f1f1f1;
}

label{
  margin-right: 25px;
}


  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
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
   $xml = simplexml_load_file($link);
   $title = $xml->archdesc->did->unittitle;
   $repository = $xml->archdesc->did->repository->corpname;
   $extent = $xml->archdesc->did->physdesc->extent;
   $creator =  $xml->archdesc->did->origination->corpname;
   $location = $xml->archdesc->did->physloc;
   $language = $xml->archdesc->did->langmaterial;
   $abstract = $xml->archdesc->did->abstract;
   $processInfo = $xml->archdesc->processinfo->p;
   $access = $xml->archdesc->accessrestrict->p;
   $copyright = $xml->archdesc->userestrict->p;
   $acqInfo = $xml->archdesc->acqinfo->p;
   $prefCitation = $xml->archdesc->prefercite->p[1];
   $histNote = $xml->archdesc->bioghist->p;
   $scopeContent = $xml->archdesc->scopecontent->p;
   $arrangement = $xml->archdesc->arrangement->p; 
?>
<div id="eadInfo" style="margin-bottom: 30px;">
       <h1><?php echo $title; ?></h1> 
       <h4><?php echo $repository; ?></h4> 
       <div>
         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#descId" style="font-size: 14px;">Descriptive Identification</button>
         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminInfo" style="font-size: 14px;">Administrative Information</button>
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

<div id="componentList">	
<?php		
    foreach ($xml->archdesc->dsc->c as $file){
?>		
	<div class="fileRow">
	<?php	
		foreach ($file->did->children() as $child){
	?>	
			<?php 
          if($child->getname() == 'unittitle'){
            if(count($child) > 0){
                ?><h4><?php		echo $file->did->unittitle->title; ?></h4>
                <h4><?php		echo $file->did->unittitle->title->emph; ?></h4>
           <?php }else{
                ?><h4><?php		echo $child; ?></h4>
           <?php }
          }elseif($child->getname() == 'unitdate'){
             ?><p><?php echo ucfirst($child['type']).' Date: '.$child; ?></p><?php
          }elseif($child->getname() == 'container'){
              ?><p><?php echo ucfirst($child['type']).": ". $child; ?></p><?php
          }
		}
	?>
	</div>	
<?php } ?>	
		</div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>










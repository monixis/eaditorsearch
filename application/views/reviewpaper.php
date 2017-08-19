<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="http://library.marist.edu/images/jac-m.png"/>
    <link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Honor's Thesis Repository</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="http://library.marist.edu/css/bootstrap.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://library.marist.edu/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link href="http://library.marist.edu/css/library.css" rel="stylesheet">
	<link href="http://library.marist.edu/css/menuStyle.css" rel="stylesheet">
	<link href="styles/main.css" rel="stylesheet">
	<link href="styles/processstatus.css" rel="stylesheet">
    <link href="styles/repository.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script type="text/javascript" src="http://library.marist.edu/js/libraryMenu.js"></script>
	<script type="text/javascript" src="http://library.marist.edu/js/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

</head>
 <?php
$ID = $_GET['id'];
 $history = $history;
foreach($paperinfo as $paper)
    $title = $paper['title'];
$date = $paper['updatedate'];
$name = $paper['name'];
$url =  $paper['url'];
$abstract = $paper['abstract'];
$cwid = $paper['cwid'];
$email = $paper['email'];
$status = $paper['status'];
$license = $paper['license'];
$display = $paper['display'];
$year = $paper['year'];
$department = $paper['dept_name'];
?>
<script type="text/javascript">
    $(document).ready(function() {
        if("<?php echo $status ?>" == 2 || "<?php echo $status ?>" == 3){
            document.getElementById("approve").style.display = "none";
            document.getElementById("return").style.display = "none";
        }
            });

</script>

<body>
<div id="headerContainer">
    <a href="http://library.marist.edu/" target="_self"> <div id="header"></div> </a>
</div>
<a class="menu-link" href="#menu"><img src="http://library.marist.edu/images/r-menu.png" style="width: 20px; margin-top: 4px;" /></a>
<div id="menu">
    <div id="menuItems"></div>
</div>
<div id="miniMenu" style="width: 100%;border: 1px solid black; border-bottom: none;">

</div>


<!-- Main jumbotron for a primary marketing message or call to action -->
<div id="main-container" class="container">
    <div class="jumbotron">
        <div class="container" style="margin-top: -36px;">
            <!-- Example row of columns -->
                <div class="col-md-12">
                    <h2 style="text-align: center; margin: 30px; font-size: 40px;">Honors Thesis Repository</h2>
                    <div class="col-md-12">
                        <h4 style="text-align: center; margin: 30px; font-size: 20px;"><span style="color: #b31b1b;font-weight:bold; ">Review Paper</span></h4>
                    </div>

                    <div class="container">

                        <h3 style="color: #b31b1b;text-align: right; vertical-align:middle;line-height: 30px;">Paper ID : <?php echo $ID ?></h3>
                        <h3 style="color: #b31b1b;text-align: left; vertical-align:middle;line-height: 30px;">Paper Status</h3>

                        <div class="row">
                            <?php if($status==1) {?>
                            <ul class="breadcrumb">
                                <li class="active"><a href="javascript:void(0);">Submitted</a></li>
                                <li ><a href="javascript:void(0);">Returned</a></li>
                                <li><a href="javascript:void(0);">Approved</a></li>
                            </ul>
                            <?php } else if($status ==2){?>
                            <ul class="breadcrumb">
                                <li class="completed"><a href="javascript:void(0);">Submitted</a></li>
                                <li class="completed" ><a href="javascript:void(0);">Returned</a></li>
                                <li class="completed"><a href="javascript:void(0);">Approved</a></li>
                            </ul>
                         <?php }else if($status ==3){?>
                            <ul class="breadcrumb">
                                <li class="active"><a href="javascript:void(0);">Submitted</a></li>
                                <li class="danger" ><a href="javascript:void(0);">Returned</a></li>
                                <li><a href="javascript:void(0);">Approved</a></li>
                            </ul>
                            <?php }?>

                        </div>
                    </div>
                    <div class="container">
                        <?php
                        if(sizeof($history)>0) {

                            ?>
                            <div class="accordion" id="1"><h4 align="left" id="1" class="accordion">Comments</h4></div>
                        <?php }?>
                        <div id="1-contents">

                            <?php foreach($history as $hist){ ?>

                                <div class="conversations">
                                    <strong><?php echo "<td>Commented By:".$hist['commented_by']." </td>";?></strong><strong><?php echo "<td align='center'>-".$hist['date'].":"." </td></strong>";?> <br/>
                                    <?php echo "<td aria-autocomplete='inline'>".$hist['comments'] . "</td>";?>

                                </div>
                            <?php } ?>
                        <table class="table">

                            <h4 style="font-color:: #b31b1b;"  align="left"><span style="color: #b31b1b;font-weight:bold; ">Details:</span></h4>

                            <thead>
                            <tr></tr>
                            </thead></br>
                            <tbody>
                            <tr>
                                <td class ="col-md-2"><span style="color: #b31b1b;font-weight:bold; ">Title</span></td><td> <?php echo $title ?></td>
                            </tr>
                            <tr>
                                <td class ="col-md-2"><span style="color: #b31b1b;font-weight:bold; ">Year</span></td><td> <?php echo $year ?></td>
                            </tr>
                            <tr>
                                <td class ="col-md-2" ><span style="color: #b31b1b;font-weight:bold; ">Author</span></td> <td><a href="<?php echo base_url("?c=repository&m=searchResultsByKeyWord&q=".$name);?>"><?php echo $name ?></a></td>
                            </tr>
                            <tr>
                                <td class ="col-md-2" ><span style="color: #b31b1b;font-weight:bold; ">CWID</span></td> <td><?php echo $cwid ?></td>
                            </tr>
                            <tr>
                                <td class ="col-md-2" ><span style="color: #b31b1b;font-weight:bold; ">Email</span></td> <td><?php echo $email ?></td>
                            </tr>
                            <tr>
                                <td class ="col-md-2" ><span style="color: #b31b1b;font-weight:bold; ">Submitted On</span></td> <td><?php echo $date ?></td>
                            </tr>
                            <tr>
                                <td class ="col-md-2" ><span style="color: #b31b1b;font-weight:bold; ">Abstract</span></td> <td><?php echo $abstract ?></td>
                            </tr>
                            <tr>
                                <td class ="col-md-2" ><span style="color: #b31b1b;font-weight:bold; ">Department</span></td> <td><?php echo $department ?></td>
                            </tr>
                            <tr>
                                <td class ="col-md-2"> <span style="color: #b31b1b;font-weight:bold; ">Associated Tags</span></td> <td>
                                    <?php
                                    foreach ($associatedTags as $associatedTag){?>
                                        <a href="<?php echo base_url("?c=repository&m=searchResultsByTag&q=".$associatedTag['tag']);?>"> <?php echo $associatedTag['tag'].","; ?> </a>

                                    <?php  } ?></td>
                            </tr>
                            <tr>
            					<td class ="col-md-2" ><span style="color: #b31b1b;font-weight:bold; ">License</span></td> <td><?php echo $display ?></td>
            				</tr>

                            </tbody></table></br>

                        <iframe align="center" src="<?php echo $url ?>"  style="width:100%; height:700px;frameborder="1"></iframe></br></br>

                    </div>


                    <div align="center">
                       <?php if($status == 1){ ?>
                        <span style="color: #b31b1b;font-weight:bold;height: 50%;">Comments:</span>

                        <textarea id="comments" rows="8" cols="75" style="display: block; margin-bottom: 10px;"></textarea>
                      <?php } ?>

                        <button id="approve" name="approve"  class="btn btn-primary" type="button" onclick="confirmApprove()" style="background:#333;">Approve</button>
                        <button id="return" name="return" class="btn btn-primary" type="button" onclick="confirmDisapprove()" style="background:#333;">Return</button></br>
                     </div>

                </div>
            </div><!-- row -->
        </div><!-- container -->
    </div>
    <!-- jumbotron -->

    <br>

</div></br>
<!-- main-container -->
<div class="container">
    <p  class = "foot">
        James A. Cannavino Library, 3399 North Road, Poughkeepsie, NY 12601; 845.575.3106
        <br />
        &#169; Copyright 2007-2016 Marist College. All Rights Reserved.

        <a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> | <a href="http://library.marist.edu/repository/?c=repository&m=ack">Acknowledgements</a>
    </p>

</div>
<script type="text/javascript">
    function confirmApprove() {

        var r = confirm("Are you sure you want to approve?");
        if (r == true) {
            var comments = $('textarea#comments').val();
            var name = "<?php echo $name;?>";
            var email= "<?php echo $email;?>";

            $.post("<?php echo base_url("?c=repository&m=approvePaper&id=".$ID);?>", {
                name:name,
                email:email,
                comments:comments
            }).done(function (id) {
                if(id>0) {

                    $.ajax({
                        type: "POST",
                        url: "http://35.162.165.138:8983/solr/repository/dataimport?command=full-import&indent=on&wt=json",
                        data: "",
                        contentType: false,
                        processData: false,
                        success: function (message) {
                        },
                        async: false
                    });
                    alert("Approved Successfully");
                    location.reload();
                }
            });
        } else {

        }
    }
    function confirmDisapprove(){
        var r = confirm("Are you sure you want to return?");
        if (r == true) {
            var comments = $('textarea#comments').val();
            var name = "<?php echo $name ?>";
            var email ="<?php echo $email ?>";
            $.post("<?php echo base_url("?c=repository&m=returnPaper&id=".$ID);?>", {
                comments:comments,
                name: name,
                email:email
            }).done(function (id) {
                if(id>0) {
                    alert("Returned Successfully");
                    location.reload();
                }
            });
        } else {

        }

    }
    /*$('button#approve').click(function(){

        var comments = $('textarea#comments').val();
        var name = "<!--?php echo $name;?>";
        var email= "<!--?php echo $email;?>";
        
        $.post("<!--?php echo base_url("?c=repository&m=approvePaper&id=".$ID);?>", {
            name:name,
            email:email,
            comments:comments
        }).done(function (id) {
            if(id>0) {
                alert("Approved Successfully");
                location.reload();
            }
        });
    });

    $('button#return').click(function() {
        var comments = $('textarea#comments').val();
        var name = "<1--?php echo $name ?>";
        var email ="<!--?php echo $email ?>";
        $.post("<!--?php echo base_url("?c=repository&m=returnPaper&id=".$ID);?>", {
            comments:comments,
            name: name,
            email:email
        }).done(function (id) {
            if(id>0) {
                alert("Returned Successfully");
                location.reload();
            }
        });
    });*/

</script>
</body>
</html>
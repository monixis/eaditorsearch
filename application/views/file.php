<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="http://library.marist.edu/images/jac-m.png"/>
    <link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!--script type="text/javascript" src="http://library.marist.edu/archives/mainpage/scripts/archivesChildMenu.js"></script-->
    <!-- HTML5 shim and Respond.js for IE8 support o
    f HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="http://library.marist.edu/js/libraryMenu.js"></script>
    <script type="text/javascript" src="http://library.marist.edu/js/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://library.marist.edu/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script>
        $(document).ready(function(){

        })
    </script>
    <style>


    </style>
    <?php
$ID = $_GET['id'];
foreach($paperinfo as $paper)
    $title = $paper['title'];
$date = $paper['updatedate'];
$name = $paper['name'];
$url =  $paper['url'];
$abstract = $paper['abstract'];
$cwid = $paper['cwid'];
$email = $paper['email'];
$status = $paper['status'];
    $department = $paper['dept_name'];

    ?>
</head>
<body>
<div>
    <div id="headerContainer">
        <a href="http://library.marist.edu/" target="_self"> <div id="header"></div> </a>
    </div>
    <a class="menu-link" href="#menu"><img src="http://library.marist.edu/images/r-menu.png" style="width: 20px; margin-top: 4px;" /></a>
    <div id="menu">
        <div id="menuItems"></div>
    </div>
    <div id="miniMenu" style="width: 100%;border: 1px solid black; border-bottom: none;">

    </div>

    <div class="col-md-12">
        <h2 style="text-align: center; margin: 30px; font-size: 40px;">Honors Thesis Repository</h2>
    </div></br>
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

    <div class="col-md-12">

        <h5 style="text-align: center; margin: 30px; font-size: 20px;">Title: <?php echo $title?></h5>
    </div>

    <div class="container">
        <table class="table">

            <h4 style="font-color:: #b31b1b;"  align="left">Details:</h4>
            <thead>
            <tr></tr>
            </thead></br>
            <tbody>

            <tr>
                <td class ="col-md-2" >Submited By</td> <td><a href="<?php echo base_url("?c=repository&m=searchResultsByKeyWord&q=".$name);?>"><?php echo $name ?></a></td>
            </tr>
            <tr>
                <td class ="col-md-2" >Submitted On</td> <td><?php echo $date ?></td>
            </tr>
            <tr>
                <td class ="col-md-2" >Abstract</td> <td><?php echo $abstract ?></td>
            </tr>
            <tr>
                <td class ="col-md-2" >Department</td> <td><?php echo $department ?></td>
            </tr>
            <tr>
                <td class ="col-md-2"> Associated Tags</td> <td>
                    <?php
                    foreach ($associatedTags as $associatedTag){?>
                        <a href="<?php echo base_url("?c=repository&m=searchResultsByTag&q=".$associatedTag['tag']);?>"> <?php echo $associatedTag['tag'].","; ?> </a>

                    <?php  } ?></td>
            </tr>
            </tbody></table></br>
        <iframe align="center" src="<?php echo $url ?>"  style=" width:100%; height:700px ;frameborder="0"></iframe></br></br>

    </div>

</div>
<br>
<footer>
    <p class = "foot">
        James A. Cannavino Library, 3399 North Road, Poughkeepsie, NY 12601; 845.575.3106
        <br />
        &#169; Copyright 2007-2016 Marist College. All Rights Reserved.

        <a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> | <a href="http://library.marist.edu/repository/?c=repository&m=ack">Acknowledgements</a>
    </p>
</footer>
</body>
<script type="text/javascript">
    $('button#resubmit').click(function(){

        window.location.replace("<?php echo base_url("?c=repository&m=fileInfo&id=".$ID)?>");

    });
</script>
</html>


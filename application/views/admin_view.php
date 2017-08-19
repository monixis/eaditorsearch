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

<body>
<div id="headerContainer">
    <div id="header">
    </div>
    <!-- /header -->
</div>
<a class="menu-link" href="#menu"><img src="http://library.marist.edu/images/r-menu.png" style="width: 20px; margin-top: 4px;" /></a>
<div id="menu">
    <div id="menuItems"></div>
</div>
<div id="miniMenu" style="width: 100%;border: 1px solid black; border-bottom: none;">
</div>

</br></br>
<!-- /menu -->
<!--<div id="passcode" style="margin-top:0px; margin-left: auto; margin-right: auto; width: 300px; height: 0px;">
    <strong></strong>
    <label for="textinput">EMAIL:</label>
    <input type="text" name='email' id='email' style="height:23px; margin-left: 10px;"/><br/>
    <label for="textinput">PASSCODE:</label>
    <input type="password" name='passcode' id='passcode' style="height:23px; margin-left: 10px;"/><br/>
    <input type="button" class="btn" id="submit" value="Submit" style="margin-left:95px; margin-top:10px; width:100px;"/>
</div></br>-->
<!--<div id="container" class="container">
</div></br>-->
<div id="logout" align="right"><button id="logout" class="btn btn-primary">Logout</button></div>
<div id="container" class="container">
    <div class="row bs-wizard" style="border-bottom:0;">
        <div id="step1" class="col-xs-4 bs-wizard-step disabled"><!-- complete -->
            <div class="text-center bs-wizard-stepnum">Submitted</div>
            <div class="progress"><div class="progress-bar"></div></div>
            <div class="bs-wizard-dot"></div>
        </div>

        <div id="step2" class="col-xs-4 bs-wizard-step disabled"><!-- complete -->
            <div class="text-center bs-wizard-stepnum">Returned</div>
            <div class="progress"><div class="progress-bar"></div></div>
            <div class="bs-wizard-dot"></div>
            <div class="bs-wizard-info text-center"><p>(If the submitted request is incomplete/any changes reuqired).</p></div>
        </div>

        <div id="step3" class="col-xs-4 bs-wizard-step disabled"><!-- active -->
            <div class="text-center bs-wizard-stepnum">Approved</div>
            <div class="progress"><div class="progress-bar"></div></div>
            <div class="bs-wizard-dot"></div>
        </div>

    </div></br>
    <div class="page-header">
        <h3 align="center">Honors Thesis Repository</h3></br>
        <h4 align="center"><?php if($department != ""){echo "(".$department.")"; }?></h4>

    </div>
    <label class="label" style="color: #0c0c0c" for="collection">Filter By Status:</label>
    <select id ="status" style="width: 100px;" >
        <option value="All" class="selectinput">All</option>
        <option value="Submitted" class="selectinput">Submitted</option>
        <option value="Returned" class="selectinput">Returned</option>
        <option value="Approved" class="selectinput">Approved</option>

    </select>
    <?php if($department == ""){ ?>
    <label class="label" style="color: #0c0c0c" for="collection">Filter By Department:</label>
    <select id ="department" style="width: 100px;" >
        <option value=0 class="selectinput">All</option>
        <?php  foreach ($departments as $dept) {?>
        <option value="<?php echo $dept-> dept_id;?>" class="selectinput"><?php echo $dept -> name?></option>
        <?php } ?>
    </select>
     <?php } ?>
    </br></br>


    <div class="table-responsive" id="the-content">


        <table align="center" id="results_table" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>title</th>
                <th>Status</th>
                <th>Date</th>
                <th>Author</th>

            </tr>
            </thead>
            <tbody>
            <?php $offset = $this->uri->segment(3, 0) + 1; ?>
            <?php foreach ($query->result() as $row): ?>
                <tr>
                    <td><a target="_blank" href="<?php echo base_url("?c=repository&m=reviewPaper&id=").$row ->paperid?>"><?php echo $row ->paperid ?></a></td>
                    <td><a target="_blank" href="<?php echo base_url("?c=repository&m=reviewPaper&id=").$row ->paperid?>"><?php echo $row->title; ?></a></td>
                    <td><?php if($row->status == 1){ ?>
                            Submitted
                        <?php } else if($row->status == 2){ ?>
                            Approved
                        <?php } else if($row->status == 3){ ?>
                            Returned
                        <?php }?>

                    </td>
                    <td><?php echo $row->updatedate; ?></td>

                    <td><a target="_blank" href="<?php echo base_url("?c=repository&m=reviewPaper&id=").$row ->paperid?>"><?php echo $row->name; ?></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div align="right" id="NumRecords">
            <label class="label" style="color: #0c0c0c" for="collection">Total:<?php echo $total_rows?></label>
        </div>
        <nav class='text-center'>
            <?php echo $pagination_links; ?>


        </nav>

    </div>
</div>
</br></br></br><div class="bottom_container">
    <p class = "foot">
        James A. Cannavino Library, 3399 North Road, Poughkeepsie, NY 12601; 845.575.3199
        <br />
        &#169; Copyright 2007-2016 Marist College. All Rights Reserved.

        <a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> | <a href="http://library.marist.edu/repository/?c=repository&m=ack">Acknowledgements</a>
    </p>
</div>

<script>
    $(document).ready(function(){
     //   $("#passcode").css('visibility','visible');
        //      $("#container").css('visibility', 'hidden');


    });
    $("#status").change(function(){
        if ($(this).val() == "Submitted") {
            <?php if($department =="") { ?>
              var dept_id = $("select#department").val();
            var url = "<?php echo base_url("?c=repository&m=papers&status=1&dept_id=")?>"+dept_id;

            <?php } else{  ?>

            var url = "<?php echo base_url("?c=repository&m=papers&status=1&dept_id=").$dept_id?>";
            <?php } ?>
            document.getElementById('step1').className= "col-xs-4 bs-wizard-step complete";
            document.getElementById('step2').className= "col-xs-4 bs-wizard-step disabled";
            document.getElementById('step3').className= "col-xs-4 bs-wizard-step disabled";

            $("#the-content").load(url);
        }else if($(this).val() == "Approved"){
            <?php if($department =="") { ?>
            var dept_id = $("select#department").val();
            var url = "<?php echo base_url("?c=repository&m=papers&status=2&dept_id=")?>"+dept_id;

            <?php } else{  ?>

            var url = "<?php echo base_url("?c=repository&m=papers&status=2&dept_id=").$dept_id?>";
            <?php } ?>
            document.getElementById('step1').className= "col-xs-4 bs-wizard-stepp complete";
            document.getElementById('step2').className= "col-xs-4 bs-wizard-stepp complete";
            document.getElementById('step3').className= "col-xs-4 bs-wizard-stepp complete";

            //var url = "<!--?php echo base_url("?c=repository&m=papers&status=2&dept_id=").$dept_id?>.";
            $("#the-content").load(url);

        }else if($(this).val() == "Returned"){
            <?php if($department =="") { ?>
            var dept_id = $("select#department").val();
            var url = "<?php echo base_url("?c=repository&m=papers&status=3&dept_id=")?>"+dept_id;

            <?php } else{  ?>

            var url = "<?php echo base_url("?c=repository&m=papers&status=3&dept_id=").$dept_id?>";
            <?php } ?>
            document.getElementById('step1').className= "col-xs-4 bs-wizard-stp complete";
            document.getElementById('step2').className= "col-xs-4 bs-wizard-stp active";
            document.getElementById('step3').className= "col-xs-4 bs-wizard-stp disabled";

           // var url = "<!--?php echo base_url("?c=repository&m=papers&status=3&dept_id=").$dept_id?>";
            $("#the-content").load(url);
        }
        else if($(this).val() == "All") {
            <?php if($department =="") { ?>
            var dept_id = $("select#department").val();
            var url = "<?php echo base_url("?c=repository&m=pages&dept_id=")?>"+dept_id;

            <?php } else{  ?>

            var url = "<?php echo base_url("?c=repository&m=pages&dept_id=").$dept_id?>";
            <?php } ?>
            document.getElementById('step1').className = "col-xs-4 bs-wizard-step disabled";
            document.getElementById('step2').className = "col-xs-4 bs-wizard-step disabled";
            document.getElementById('step3').className = "col-xs-4 bs-wizard-step disabled";

            //var url = "<!--?php echo base_url("?c=repository&m=pages&dept_id=").$dept_id?>";
            $("#the-content").load(url);
        }
    });
    $("#department").change(function() {
        var dept_id = $(this).val();
        var status = $("select#status").val();
        if(status != "All") {
            if(status == "Submitted"){
                status = 1;
            }else if(status =="Approved"){
                status = 2;

            }else if(status == "Returned"){
                status = 3;
            }
            var url = "<?php echo base_url("?c=repository&m=papers&dept_id=")?>" + dept_id + "&status=" + status;
        }else{

            var url = "<?php echo base_url("?c=repository&m=pages&dept_id=")?>" + dept_id;

        }
        $("#the-content").load(url);

    });

    $("#logout").click(function(){
        window.location.href = "https://login.marist.edu/cas/logout";
    });


    /*$("input#submit").click(function() {

        var pcode = $("input#passcode").val();
        var email = $("input#email").val();

        $.post("<!--?php echo base_url("?c=repository&m=admin_verify&pass=");?>"+pcode+"&email="+email, {

        }).done(function (authorized) {
            if (authorized == 1) {
                $("#passcode").css('visibility', 'hidden');
                var url = "<!--?php echo base_url("?c=repository&m=getPapers&pass=") ?>"+pcode+"&email="+email;
                $("#container").load(url);
                //  $("#container").css('visibility', 'visible');

            } else {
                $("input#passcode").css('border', '3px solid red');
                setTimeout(function () {
                    $("input#passcode").css('border', '1px solid grey');
                }, 2000)
            }
        });
    });
    $('#passcode').keypress(function(e){
        var key = e.which;
        if(key == 13){
            var pcode = $("input#passcode").val();
            var email = $("input#email").val();

            $.post("<!--?php echo base_url("?c=repository&m=admin_verify&pass=");?>"+pcode+"&email="+email, {

            }).done(function (authorized) {
                if (authorized == 1) {
                    $("#passcode").css('visibility', 'hidden');
                    var url = "<!--?php echo base_url("?c=repository&m=getPapers&pass=") ?>"+pcode+"&email="+email;
                    $("#container").load(url);
                    //   $("#container").css('visibility', 'visible');

                } else {
                    $("input#passcode").css('border', '3px solid red');
                    setTimeout(function () {
                        $("input#passcode").css('border', '1px solid grey');
                    }, 2000)
                }
            });
        }
    });*/

    $("body").on("click", ".pagination a", function() {
        var url = $(this).attr('href');
        $("#the-content").load(url);
        return false;
    });


</script>

</body>
</html>
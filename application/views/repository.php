<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="http://library.marist.edu/images/jac-m.png"/>
    <link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Honors Thesis Program Repository</title>
<!--    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
-->
 <!--   <script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>-->
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="http://library.marist.edu/css/bootstrap.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://library.marist.edu/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="http://library.marist.edu/css/library.css" rel="stylesheet">
    <link href="http://library.marist.edu/css/menuStyle.css" rel="stylesheet">
    <link href="styles/main.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="http://library.marist.edu/js/libraryMenu.js"></script>
    <script type="text/javascript" src="http://library.marist.edu/js/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <style>
        #loader-img{
            margin: 0 auto;
            display: block;
            margin-top: 35%;
        }

        #loader{
            width: auto;
            height: auto;
            position: absolute;
            z-index: 100;
            visibility:hidden;
            left:50%;
            top:60%;
        }

    </style>
</head>

<body>
<div id="headerContainer">
    <a href="http://library.marist.edu/" target="_self"> <div id="header"></div> </a>
</div>
<a class="menu-link" href="#menu"><img src="http://library.marist.edu/images/r-menu.png" style="width: 20px; margin-top: 4px;" /></a>
<div id="menu">
    <div id="menuItems">
    </div>
</div>
<div id="miniMenu" style="width: 100%;border: 1px solid black; border-bottom: none;">

</div>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div id="main-container" class="container">

    <div class="jumbotron">

        <div class="container" style="margin-top: -36px;">

            <!-- Example row of columns -->

            <div class="row">

                <div class="col-md-12">

                    <div id="loader">
                        <img id="loader-img" alt="" src="http://library.marist.edu/images/pacman.gif" width="130" height="130" />
                    </div> <!-- loader -->

                    <form class="form-horizontal" >
                        <fieldset>
                            <!--div class="form-horizontal" id="fieldset"-->

                            <h2 style="text-align: center; margin: 30px; font-size: 40px;">Honors Thesis Repository</h2>

                            <!-- Text input-->
                            <div id='author' name="author" class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Author(s)</label>
                                <div class="col-md-4">
                                    <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="">

                                </div>
                                <input type="button" style="background-color: #B31B1B ;color: white" value="+" name="add_author" id="add_author">
                            </div>


                            <!-- Text input-->
                            <div id="cwid" name="cwid" class="form-group">
                                <label class="col-md-4 control-label" for="textinput">CWID</label>
                                <div class="col-md-4">
                                    <input id="cwid" name="cwid" type="text" placeholder="Your Marist Campus Wide Number" class="form-control input-md" required="">
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Email address</label>
                                <div class="col-md-4">
                                    <input class="form-control" name="email" id="email" type="email" data-fv-emailaddress-message="The value is not a valid email address"  required=""/>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Title">Title</label>
                                <div class="col-md-5">
                                    <input id="title" name="title" type="text" placeholder="" class="form-control input-md" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Year">Year</label>
                                <div class="col-md-2">
                                    <input id="year" name="year" type="text" placeholder="" class="form-control input-md" required="">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Tags">Select a Collection</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="collectionSelection">
                                        <?php foreach ($collections as $collection){ ?>
                                            <option value='<?php echo $collection -> collection_id; ?>'><?php  echo $collection -> collection_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Tags">Select a Department</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="departmentSelection">
                                        <?php foreach ($departments as $department){ ?>
                                        <option value='<?php echo $department -> dept_id; ?>'><?php  echo $department -> name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textarea">Abstract</label>
                                <div class="col-md-4">
                                    <textarea name="abstract" id="word_count" style="height: 150px; overflow: auto; width: 400px;" required=""></textarea>
                                    Total word Count : <span id="display_count">0</span> words(Maximum words allowed: 250).

                                </div>
                            </div>
                            <!-- Appended Input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Tag">Add a subject heading</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <!--div id="tagList"></div-->
                                        <input id="subjects" name="tag" class="form-control" placeholder=" " type="text">
                                        <button id="Add" name="Add" class="btn btn-primary" type="button" style="margin-top: 10px; margin-bottom: -19px; background: #333;">Add</button>
                                    </div>
                                    <p class="help-block"> </p>
                                </div>
                            </div>

                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textarea">Associated subject headings</label>
                                <div class="col-md-4">
                                    <!--textarea class="form-control" id="associatedTags" name="textarea" style="height: 100px;"></textarea-->
                                    <ul class="form-control" id="associatedTags" style="height: 150px; overflow: auto; width: 400px;">
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="upload">Select the upload option:</label>
                                <div class="col-md-4">


                                       <input type="radio" checked value="file" name="uploadRadio"><b> File(PDF only)</b>

                                       <input type="radio" value="link" name="uploadRadio"><b> Link</b>

                                    </div>
                          </div>
                            <div class="form-group" id="Upload">
                                <label class="col-md-4 control-label" for="Tags"></label>
                                <div class="col-md-4">
                                    <form action="" id='complete' enctype="multipart/form-data" method="post">
                                            <input name='fileToUpload' id='fileToUpload' style="display: block"  class='btn' type="file" />
                                            <input id="linkToUpload" name="link" type="text" style="display: none; " class="form-control input-md" placeholder="Add a link">

                                            <!--div id="fileList"></div-->
                                    </form>
                                </div>
                            </div>

    <!--                        <div class="form-group" id="linkUpload" style="visibility: hidden">
                                <label class="col-md-4 control-label" for="textInput">Add Link</label>
                                <div class="col-md-4">

                                </div>
                            </div>-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Tags">Select a license</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="licenseSelection">
                                        <option value='1'>Attribution CC BY</option>
                                        <!--option value='2'>Attribution-NonCommercial CC BY-NC</option-->
                                        <option value='3'>Limit to Marist Users</option>
                                    </select><br/>
                                    <textarea name="license" id="license" style="height: 150px; overflow: auto; width: 400px;" readonly></textarea>
                                    <a href="http://libguides.marist.edu/c.php?g=87412&p=562362" target="_blank">Learn about Creative Common Licenses.</a>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="upload"></label>
                                <div class="col-md-4">
                                    <button id="upload" name="upload" class="btn btn-primary" type="submit" style="background: #333;">Submit</button>
                                </div>
                            </div>

                            <!--/div-->
                        </fieldset>

                            <!--                                    <input type="button" style="background-color: #B31B1B" value="-" id="remove_author"> -->

                    </form>


                </div>

            </div><!-- row -->

        </div><!-- container -->
    </div> <!-- jumbotron -->

    <br>

</div> <!-- main-container -->
<div  class="bottom_container">
    <p class = "foot">
        James A. Cannavino Library, 3399 North Road, Poughkeepsie, NY 12601; 845.575.3106
        <br />
        &#169; Copyright 2007-2016 Marist College. All Rights Reserved.

        <a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> | <a href="http://library.marist.edu/repository/?c=repository&m=ack">Acknowledgements</a>
    </p>

</div>
<script type="text/javascript">
    var tagList = new Array();
    $(document).ready(function() {
        $("#word_count").on('keyup', function() {
            if(this.value.match(/\S+/g)) {
                var words = this.value.match(/\S+/g).length;
            }
            if (words > 250) {
                var trimmed = $(this).val().split(/\s+/, 250).join(" ");
                $(this).val(trimmed + " ");
            }
            else {
                $('#display_count').text(words);
                $('#word_left').text(250-words);
            }
        });
    });
    $('input[type=radio][name=uploadRadio]').change(function() {

        //  alert($('input[name="uploadRadio"]:checked', '#uploadType').val());

        var uploadOption = $("input[name='uploadRadio']:checked").val();
        if(uploadOption=="file"){

            //$("div#linkUpload").replaceWith(fileUpload);
             document.getElementById("fileToUpload").style.display= 'block';
             document.getElementById("linkToUpload").style.display= 'none';

        }else if(uploadOption=="link"){
            //$("div#fileUpload").replaceWith(linkUpload);
            document.getElementById("fileToUpload").style.display= 'none';
            document.getElementById("linkToUpload").style.display= 'block';

        }
    });

    $("form").submit(function( e ) {

        var fileTypes = ['pdf'];
       /// if ($('input#fileToUpload')[0].files[0] || $('input#link').val()) {
          if($('input#fileToUpload')[0].files[0]){
            var extension = $('input#fileToUpload')[0].files[0].name.split('.').pop().toLowerCase();  //file extension from input file
            isSuccess = fileTypes.indexOf(extension) > -1;
              var name = $('input#name').val();
            if(author_form_index  > 0){
                for(var i = 1; i <= author_form_index; i++) {
                    var str1 = "input#name";
                    var str2 = str1.concat(i);
                    name = name + ", " + $(str2).val();
                }

            }
            if (isSuccess) {
                if (tagList.length > 0) {
                    var taglist = JSON.stringify(tagList);
                    if ($('input#name').val() && $('input#title').val() && $('input#cwid').val() && $('input#email').val()) {
                        var name = $('input#name').val();
                        var cwid = $('input#cwid').val();

                        if(author_form_index  > 0){
                            var str1 = "input#name";
                            var str3 = "input#cwid";

                            for(var i = 1; i <= author_form_index; i++) {
                                var str2 = str1.concat(i);
                                name = name + ", " + $(str2).val();
                                var str2 = str3.concat(i);
                                cwid = cwid+", "+ $(str2).val();
                            }
                        }
                        if ($('input#fileToUpload')[0].files[0]) {
                            var filesize = $('input#fileToUpload')[0].files[0].size / 1024 / 1024;
                            if (filesize <= 8.0) {
                                var form_data = new FormData();
                                form_data.append('name', name);
                                form_data.append('title', $('input#title').val());
                                form_data.append('cwid', cwid);
                                form_data.append('email', $('input#email').val());
                                form_data.append('abstract', $('textarea#word_count').val().replace(/'/g , "&#39"));
                                form_data.append('tags', taglist);
                                form_data.append('licenseId', $('#licenseSelection').val());
                                form_data.append('deptId', $('#departmentSelection').val());
                                form_data.append('collectionId', $('#collectionSelection').val());
                                form_data.append('year', $('input#year').val());
                                form_data.append('link', $('input#linkToUpload').val());

                                // if ($('input#fileToUpload')[0].files[0]) {

                                    form_data.append('file_attach', $('input#fileToUpload')[0].files[0]);
                                //}
                                var file_data = new FormData();
                                if ($('input#fileToUpload')[0].files[0]) {
                                    file_data.append('file_attach', $('input#fileToUpload')[0].files[0]);
                                }
                                 $('#loader').css('visibility','visible');
                                 $('fieldset').css('opacity','0.1');
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url("?c=repository&m=insertDetails");?>",
                                    data: form_data,
                                    processData: false,
                                    contentType: false,
                                    // cache: false,
                                    success: function (data) {

                                        if (data > 0) {

                                             file_data.append('pageid', data);
                                             $.ajax({
                                             type: "POST",
                                             url: "http://148.100.181.189/uploadtorepo/accept-file.php",
                                             data: file_data,
                                             contentType:false,
                                             processData: false,
                                             //cache: false,
                                             success: function (message) {

                                             if(message) {
                                             var email_data = new FormData();
                                             email_data.append('name', $('input#name').val());
                                             email_data.append('email', $('input#email').val());
                                             email_data.append('paperid', data);
                                             email_data.append('file_attach', $('input#fileToUpload')[0].files[0]);
                                             $.ajax({
                                             type: "POST",
                                             url: "<?php echo base_url("?c=repository&m=email_user");?>",
                                             data: email_data,
                                             contentType:false,
                                             processData: false,
                                             //    cache: false,
                                             success: function (paperid) {
                                             if(paperid) {
                                             setTimeout(function(){
                                             $('#loader').css('visibility','hidden');
                                             $('fieldset').css('opacity','1');
                                             alert("PaperId #" + data + ": Paper has been uploaded successfully");
                                             location.reload();
                                             }, 6000);
                                             e.preventDefault();
                                             }else{

                                             alert("Failure: 001 Something went wrong while uploading paper. Please contact administrator");
                                             }

                                             },
                                             async: false

                                             });

                                             }else{

                                             alert("Failure: 002  Something went wrong while uploading paper. Please contact administrator");
                                             }

                                             },

                                             async: false

                                             });


                                             $('#requestStatus').show().css('background', '#66cc00').append("#" + data + ": File has been uploaded successfully");


                                        } else {
                                            alert("Failure: Something went wrong. Please contact administrator");
                                            //   location.reload();
                                            e.preventDefault();
                                            // $('#requestStatus').show().css('background', '#b31b1b').append("Something went wrong.Please contact adminstrator");
                                        }
                                    }
                                });
                                return false;
                            } else {
                                e.preventDefault();
                                alert("Uploaded file size should be less than or equal to 8MB.");
                            }
                        } else {
                            e.preventDefault();
                            alert("Please select the paper to upload into repository.");
                        }
                    } else {
                        e.preventDefault();
                        alert("Please fill the requied fields.");
                    }
                } else {
                    e.preventDefault();
                    alert("Please add atleast one subject heading.");
                }
            } else {
                e.preventDefault();
                alert("The file should be in the PDF format.");
            }
         }else if($('input#linkToUpload').val()){
              if (tagList.length > 0) {
                  var taglist = JSON.stringify(tagList);
                  if ($('input#name').val() && $('input#title').val() && $('input#cwid').val() && $('input#email').val()) {
                      var name = $('input#name').val();
                      var cwid = $('input#cwid').val();

                      if(author_form_index  > 0){
                          var str1 = "input#name";
                          var str3 = "input#cwid";

                          for(var i = 1; i <= author_form_index; i++) {
                              var str2 = str1.concat(i);
                              name = name + "," + $(str2).val();
                              var str2 = str3.concat(i);
                              cwid = cwid+","+ $(str2).val();
                          }
                      }
                      var form_data = new FormData();
                      form_data.append('name', name);
                      form_data.append('title', $('input#title').val());
                      form_data.append('cwid', cwid);
                      form_data.append('email', $('input#email').val());
                      form_data.append('abstract', $('textarea#word_count').val().replace(/'/g , "&#39"));
                      form_data.append('tags', taglist);
                      form_data.append('licenseId', $('#licenseSelection').val());
                      form_data.append('deptId', $('#departmentSelection').val());
                      form_data.append('collectionId', $('#collectionSelection').val());
                      form_data.append('link', $('input#linkToUpload').val());
                      form_data.append('year', $('input#year').val());
                      $('#loader').css('visibility','visible');
                      $('fieldset').css('opacity','0.1');
                      $.ajax({
                          type: "POST",
                          url: "<?php echo base_url("?c=repository&m=insertDetails");?>",
                          data: form_data,
                          processData: false,
                          contentType: false,
                          // cache: false,
                          success: function (data) {

                              if (data > 0) {
                                  var email_data = new FormData();
                                  email_data.append('name', $('input#name').val());
                                  email_data.append('email', $('input#email').val());
                                  email_data.append('paperid', data);
                                  email_data.append('link', $('input#linkToUpload').val());
                                  $.ajax({
                                      type: "POST",
                                      url: "<?php echo base_url("?c=repository&m=email_user");?>",
                                      data: email_data,
                                      contentType:false,
                                      processData: false,
                                      //    cache: false,
                                      success: function (paperid) {
                                          if(paperid) {
                                              setTimeout(function(){
                                                  $('#loader').css('visibility','hidden');
                                                  $('fieldset').css('opacity','1');
                                                  alert("PaperId #" + data + ": Paper has been uploaded successfully");
                                                  location.reload();
                                              }, 6000);
                                              e.preventDefault();
                                          }else{

                                              alert("Failure: 001 Something went wrong while uploading paper. Please contact administrator");
                                          }

                                      },
                                      async: false

                                  });
                              }


                          },
                          async: false
                      });
                  }else{
                      e.preventDefault();
                      alert("Please fill the requied fields.");
                  }

              }else{
                  e.preventDefault();
                  alert("Please add atleast one subject heading.");

              }

          } else{
            e.preventDefault();
            alert("Failed: Please select a paper to upload (or) add a link to your work.");
        }

    });

    $("#Add").click(function(){

        var newtag = $('input#subjects').val();
       // tagList.push(newtag);

        if ($('input#subjects').val() == ""){
            alert('Please select or enter a new tag to add.');
        }else{
            $.post("<?php echo base_url("?c=repository&m=addATag"); ?>",{tagname: newtag}).done(function(data){
                //alert(data);
                if(data > 0)
                {
                     tagList.push(data);

                    //alert('Tag addeid successfully');
                    $('#associatedTags').append('<span class="taglist" id='+ data +' style="border: 1px solid #cccccc; display: inline-block; background: #eeeeee; padding: 5px; margin-right: 5px; margin-bottom: 5px;">'+ newtag +'<a href="" class="remove"> X </a></span>');
                    $('input#subjects').val('');

                    //$("#tagList").load("<!--?php echo base_url("?c=repository&m=loadTags");?>");
                }
                else
                {
                    alert('Something went wrong. Please contact site administrator.');
                }
            });
        }

    });

    $('#associatedTags').on('click', '.remove', function(e) {
        var span =  $(this).closest('span.taglist');
        span.remove();
        e.preventDefault();

        var tId = span.attr("id");
        for (var i=tagList.length-1; i>=0; i--) {
            if (tagList[i] === tId) {
                tagList.splice(i, 1);

            }
        }

        //  alert($(this).closest('span.taglist').text().replace('X',''));
        // var  removetag = $(this).closest('span.taglist').text().replace('X','');
        // var removeIndex = tagList.indexOf(removetag.trim());
        //if(removeIndex> -1) {
        //   tagList.splice(removeIndex, 1);
        //}

    });
    $("#word_count").keydown(function(e){
// Enter was pressed without shift key
        if (e.keyCode == 13 && !e.shiftKey)
        {
            // prevent default behavior
            e.preventDefault();
        }
    });
    $('#subjects').keypress(function(e){
        var subject = $(this).val() + e.key;
        var availableTags = [];
        $.getJSON("http://fast.oclc.org/searchfast/fastsuggest?&query=" + subject + "&callback=?", function (data) {
            //console.log(data);
            $.each(data.response.docs, function(k,v){
                //console.log(v.suggestall);
                availableTags.push(v.suggestall);
            });
        });
        $( "#subjects" ).autocomplete({
            source: availableTags
        });
    });


    /* if(uploadOption=="file"){

         document.getElementById("fileUpload").style.visibility= 'visible';
         document.getElementById("linkUpload").style.visibility= 'hidden';

     }else if(uploadOption=="link"){
         document.getElementById("fileUpload").style.visibility= 'hidden';
         document.getElementById("linkUpload").style.visibility= 'visible';

     }*/

    $("select#licenseSelection").change(function () {
        var str = 0;
        $( "select option:selected" ).each(function() {
            str = $(this).attr('value');
        });
        if (str == 1){
            $('#license').text('This license lets others distribute, remix, tweak, and build upon the work, even commercially, as long as they credit the creator for the original creation. This is the most flexible and accommodating of the available Creative Commons licenses. Recommended for maximum dissemination and use of licensed materials.');
        }else if (str == 2){
            $('#license').text('This license lets others remix, tweak, and build upon the work non-commercially, and although their new works must also acknowledge the creator and be non-commercial, they don’t have to license their derivative works on the same terms.');
        }else if (str == 3){
            $('#license').text('This license allows Marist users to download your works and share them with other Marist users as long as they credit the creator. They cannot change them in any way or use them commercially.');
        }
    }).change();

        //We will be using an unique index number for each new instance of the cloned form
        var author_form_index=0;
        //When the button is clicked (or Enter is pressed while it's selected)
        $("#add_author").click(function(){

            //Increment the unique index cause we are creating a new instance of the form
            author_form_index++;

            //Clone the form and place it just before the button's <p>. Also give its id a unique index

            if(author_form_index==1) {

                $("#cwid").after($("#cwid").clone().attr("id", "cwid" + author_form_index).find("input:text").val("").end());
                $("#cwid").after($("#author").clone().attr("id", "author" + author_form_index).find("input:text").val("").end());

            }else if(author_form_index > 1){

                var cwid = "#cwid"+(author_form_index-1);
                $(cwid).after($("#cwid").clone().attr("id", "cwid" + author_form_index).find("input:text").val("").end());
                $(cwid).after($("#author").clone().attr("id", "author" + author_form_index).find("input:text").val("").end());

            }

            //Make the clone visible by changing CSS

            $("#author" + author_form_index).css("display","inline");
            $("#cwid" + author_form_index).css("display","inline");

            //For each input fields contained in the cloned form...
            $("#author" + author_form_index + " :input").each(function(){
                //Modify the name attribute by adding the index number at the end of it
                $(this).attr("name",$(this).attr("name") + author_form_index);
                //Modify the id attribute by adding the index number at the end of it
                $(this).attr("id",$(this).attr("id") + author_form_index);
            });
            $("#cwid" + author_form_index + " :input").each(function(){
                //Modify the name attribute by adding the index number at the end of it
                $(this).attr("name",$(this).attr("name") + author_form_index);
                //Modify the id attribute by adding the index number at the end of it
                $(this).attr("id",$(this).attr("id") + author_form_index);
            });
            var remove_author = "<input type='button' style='background-color: #B31B1B;color: white' value='-' id='remove_author"+author_form_index+"'>";
            $("#add_author"+author_form_index).replaceWith(remove_author);

            //When the Remove button is clicked (or Enter is pressed while it's selected)
            $("#remove_author" + author_form_index).click(function(){
                //Remove the whole cloned div
                $("#author" +author_form_index ).remove();
                $("#cwid" +author_form_index ).remove();

                author_form_index = author_form_index -1;
            });
        });



</script>
</body>
</html>

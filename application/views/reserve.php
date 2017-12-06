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
    <script src="js/jsPDF.js" type="text/javascript"></script>

    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {height: 100px}

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


        label{
            margin-right: 25px;
        }

        button{
            margin-bottom: 5px;
        }


        body.loading .show-when-loading {
            display: inline-block;
        }

    .cart-heading{
        background-color: #727272;
        color: white;
        width: 100%;
        font-family: "Calibri", Arial, sans-serif;
        font-size: 15pt;
        text-align: center;
    }
    .bodyContent{

        padding-bottom: 50px;
    }
 #cart{

     display: block;
     width: 800px;
     margin: auto;
     height: 500px;
     border-style: solid;
     -webkit-border-radius: 6px;
     -moz-border-radius: 6px;
     border-radius: 6px;
     -moz-box-shadow: 0px 0px 5px 5px #ccc;
     -webkit-box-shadow: 0px 0px 5px 5px #ccc;
     box-shadow: 0px 0px 5px 5px #ccc;

 }


        #cartItems th, #cartItems td {
            text-align: left;
            border: 1px solid #CCCCCC;
            padding: 3px 8px;
            border-collapse: collapse;
        }

.item{


            width: 700px;
}
        .remove{

            width: 100px;
        }
        div#finalize {
            top: 600px;
            width: 800px;
            height: 50px;
            margin-top: 45px;
        }
    </style>
    <script>

        function removeCartItem(a)
        {
            var row = document.getElementById("trow-"+a);

            row.parentNode.removeChild(row);
            localStorage.removeItem(a);


        }

        $(document).ready(function () {

            for (var i = 0; i < localStorage.length; i++) {
                var checkbox = localStorage.key(i);
                var checkbox_value = localStorage.getItem(checkbox);
                if (checkbox.substring(0, 6) == 'crtitm') {

                    var remove_anchor = "<a href=\"#\" onclick=removeCartItem(" + "\"" + checkbox + "\"" + ");>Remove</a>";
                    var trow = "trow-";
                    var markup = "<tr id=\"" + trow + checkbox + "\"><td><p>" + decodeURIComponent(checkbox_value) + "</p></td><td>" + remove_anchor + "</td></tr>";

                    $("table#cartItems tbody").append(markup);

                }
            }

        });

        $(document).on('click', '#btnEmail', function () {
            var finalized_cart = new Array();

            for (var i = 0; i < localStorage.length; i++) {
                var checkbox = localStorage.key(i);
                var checkbox_value = localStorage.getItem(checkbox);
                if (checkbox.substring(0, 6) == 'crtitm') {
                    finalized_cart[i] = checkbox_value;
                }
            }

            //
            $.post("<?php echo base_url("?c=eaditorsearch&m=sendEmail")?>", {

                final_cart: JSON.stringify(finalized_cart),
                firstName: $('input#firstName').val(),
                lastName:$('input#lastName').val(),
                emailId:$('input#emailId').val(),
                message:$('textarea#message').val()

            }).done(function (data) {
                if (data > 0) {
                    alert("success");
                } else {
                    alert("failure");

                }
            });
        });

    </script>


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
            <!--a class="navbar-brand" href="#"><img src='https://www.empireadc.org/sites/www.empireadc.org/files/ead_logo.gif' /></a-->
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <!--li class="active"><a href="#">Home</a></li-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
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
            <a href='<?php echo base_url( ); ?>'><img src='https://www.empireadc.org/sites/www.empireadc.org/files/ead_logo.gif' style='width:220px; margin-top: -75px'/></a>
            <!--p><a href="#">Link</a></p>
            <p><a href="#">Link</a></p>
            <p><a href="#">Link</a></p-->
        </div>

    </div>
    <div class="bodyContent">
        <div id="cart">

            <div class="cart-heading">
                Finalize the items you want to reserve
            </div>
            <table id="cartItems">
                <thead>
                <tr>
                    <th class="item">Item</th>
                    <th class="remove">Remove</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
           <div id="finalize">
               <button class="btn btn-blk btn-lg" id="sendEmail" data-toggle="modal" data-target="#myModalNorm" >Email the Finalized Items</button>
           </div>

        </div>


    </div>
    <div id="editor"></div>

</div>


<!-- Modal -->
<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Email your finalized cart to administrator
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form role="form">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control"
                               id="firstName" placeholder="First Name"/>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control"
                               id="lastName" placeholder="Last Name"/>
                    </div>
                    <div class="form-group">
                        <label for="emailId">Email address</label>
                        <input type="email" class="form-control"
                               id="emailId" placeholder="Email Id"/>
                    </div>
                    <div class="form-group">
                        <label for="message">Message(If any)</label>
                        <textarea type="text" class="form-control" id="message"></textarea>
                    </div>

                </form>


            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                    Close
                </button>
                <button type="button" id="btnEmail" class="btn btn-primary">
                    Send Email
                </button>
            </div>
        </div>
    </div>
</div>




<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>
</body>
<script>
    $('a.controlledHeader').click(function(){
        var selectedHeader = $(this).text();
        resultUrl = "<?php echo base_url("?c=eaditorsearch&m=searchKeyWords&key=")?>" + selectedHeader;
        window.open(resultUrl);
    });
</script>
</html>






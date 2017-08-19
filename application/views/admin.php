

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
        <h3 align="center">Honors Thesis Repository</h3>
    </div>

    <label class="label" for="collection">Filter By Status:</label><br/>
    <select id ="status" style="width: 100px;" >
        <option value="All" class="selectinput">All</option>
        <option value="Submitted" class="selectinput">Submitted</option>
        <option value="Returned" class="selectinput">Returned</option>
        <option value="Approved" class="selectinput">Approved</option>

    </select></br></br>


    <div class="table-responsive" id="the-content">


        <table align="center" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>title</th>
                <th>Status</th>
                <th>Date</th>

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
<script>
    $("#status").change(function(){
        if ($(this).val() == "Submitted") {
            var url = "<?php echo base_url("?c=repository&m=papers&status=1&dept_id=").$dept_id?>";
            document.getElementById('step1').className= "col-xs-4 bs-wizard-step complete";
            document.getElementById('step2').className= "col-xs-4 bs-wizard-step disabled";
            document.getElementById('step3').className= "col-xs-4 bs-wizard-step disabled";

            $("#the-content").load(url);
        }else if($(this).val() == "Approved"){
            document.getElementById('step1').className= "col-xs-4 bs-wizard-stepp complete";
            document.getElementById('step2').className= "col-xs-4 bs-wizard-stepp complete";
            document.getElementById('step3').className= "col-xs-4 bs-wizard-stepp complete";

            var url = "<?php echo base_url("?c=repository&m=papers&status=2&dept_id=").$dept_id?>.";
            $("#the-content").load(url);

        }else if($(this).val() == "Returned"){
            document.getElementById('step1').className= "col-xs-4 bs-wizard-stp complete";
            document.getElementById('step2').className= "col-xs-4 bs-wizard-stp active";
            document.getElementById('step3').className= "col-xs-4 bs-wizard-stp disabled";

            var url = "<?php echo base_url("?c=repository&m=papers&status=3&dept_id=").$dept_id?>";
            $("#the-content").load(url);
        }
        else if($(this).val() == "All") {
            document.getElementById('step1').className = "col-xs-4 bs-wizard-step disabled";
            document.getElementById('step2').className = "col-xs-4 bs-wizard-step disabled";
            document.getElementById('step3').className = "col-xs-4 bs-wizard-step disabled";

            var url = "<?php echo base_url("?c=repository&m=pages&dept_id=").$dept_id?>";
            $("#the-content").load(url);
        }
    });
</script>
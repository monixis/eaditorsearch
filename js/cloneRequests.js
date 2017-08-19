/**
 * @author Monish.Singh1
 */
$.fn.clone = function(){
	/*this.css("border", "1px solid black");*/
	var requestsCnt = $("#formcontents > div").length-1 ;
	var request_input = "";
	var fields = this.html();
	if(requestsCnt>0){
		request_input = "request_input" + requestsCnt + "";
		//$("#" + request_input).remove();
		$('#buttonRemove-request').attr('disabled', false).css('opacity', 1);

	}
	 $("#buttonAdd-request").click(function(){
    	requestsCnt = requestsCnt + 1;
    	request_input = "request_input" + requestsCnt + "";
    	var requests = "<div id=" + request_input + " style='border-bottom: 1px solid; padding: 10px;'>" + fields;
    	$('div#formcontents').append(requests);
    	$('#buttonRemove-request').attr('disabled', false).css('opacity', 1);
    });
	$('#buttonRemove-request').click(function() {
    	if (confirm("Are you sure you wish to remove a Request?"))
            {
             	$("#" + request_input).remove();
             	requestsCnt = requestsCnt-1 ;
		    	request_input = "request_input" + requestsCnt + "";
		    	if (requestsCnt == 0){
		    		$(this).attr('disabled', true).css('opacity', 0.5);
		    	}else{
		    		$(this).attr('disabled', false).css('opacity', 1);
		    	}
            }
    });
}



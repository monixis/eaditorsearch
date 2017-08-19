$.validator.addMethod("matches", function(value, element, param) {
    return this.optional(element) || value.match(param);
},'Please enter a valid value.');

$(document).ready(function() {
    $('#theForm').validate({
		groups: {
		  Phone_Num: "Phone_Num Extension"
		},
		rules: {
			Name: {
				required: true,
				minlength: 2
			},
			Email: {
				required: true,
			},
			Phone_Num: {
				required: function(element) {
					return $("input[name*=Extension]").val() == 0
				},
				minlength: 10,
				maxlength: 11
			},
			Extension: {
				required: function(element) {
					return $("input[name*=Phone_Num]").val() == 0
				},
				minlength: 4,
				maxlength: 4
			},
			Address: {
				required: false,
				minlength: 100
			}
		},
		messages: {
			Name: "<br>Please enter your full name.",
			Phone_Num: "<br>Please enter a valid phone number.",
		},
		submitHandler: function(form) {
			$.ajax({
		       // url: "verifyAsk.php",
		        type: "post",
		        data: $(form).serialize(),
		        // callback handler that will be called on success
		        success: function(response){
		            if (response==1 && $("#theForm").valid()) {
		                document.location.href="querySubmission.php";
		            } else if (response==0) {
			                $("#after_submit").html('');
			                $("#reset").after('<div><label class="error" id="after_submit">Invalid captcha code.</label></div>');
		              }
			    }
	        });
		}
	});
});
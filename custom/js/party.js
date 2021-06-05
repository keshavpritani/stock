var managePartyTable;

$(document).ready(function() {
	// active top navbar Party
	$('#navParty').addClass('active');	

	managePartyTable = $('#managePartyTable').DataTable({
		'ajax' : 'php_action/fetchParties.php',
		'order': []
	}); // manage Party Data Table

	// on click on submit Party form modal
	$('#addPartyModal').unbind('click').bind('click', function() {
		// reset the form text
		// $("#submitPartyForm")[0].reset();
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// submit Party form function
		$("#submitPartyForm").unbind('submit').bind('submit', function() {

			var PartyName = $("#partyName").val();
			if(PartyName == "") {
				$("#partyName").after('<p class="text-danger">Party Name field is required</p>');
				$('#partyName').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#partyName").find('.text-danger').remove();
				// success out for form 
				$("#partyName").closest('.form-group').addClass('has-success');	  	
			}

			if(PartyName) {
				var form = $(this);
				// button loading
				$("#createPartyBtn").button('loading');
				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),
					dataType: 'json',
					success:function(response) {
						// button loading
						$("#createPartyBtn").button('reset');

						if(response.success == true) {
							// reload the manage member table 
							managePartyTable.ajax.reload(null, false);						

	  	  			// reset the form text
							$("#submitPartyForm")[0].reset();
							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');
	  	  			
	  	  			$('#add-Party-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
						}  // if

					} // /success
				}); // /ajax	
			} // if

			return false;
		}); // submit Party form function
	}); // /on click on submit Party form modal	

}); // /document

// edit Party function
function editParty(PartyId = null) {
	if(PartyId) {
		// remove the added Party id 
		$('#editPartyId').remove();
		// reset the form text
		$("#editPartyForm")[0].reset();
		// reset the form text-error
		$(".text-danger").remove();
		// reset the form group errro		
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// edit Party messages
		$("#edit-Party-messages").html("");
		// modal spinner
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-Party-result').addClass('div-hide');
		//modal footer
		$(".editPartyFooter").addClass('div-hide');		

		$.ajax({
			url: 'php_action/fetchSelectedParty.php',
			type: 'post',
			data: {PartyId: PartyId},
			dataType: 'json',
			success:function(response) {
				console.log(response);
				// modal spinner
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-Party-result').removeClass('div-hide');
				//modal footer
				$(".editPartyFooter").removeClass('div-hide');	

				// set the Party name
				$("#editPartyName").val(response.party_name);
				// set the Party status
				// add the Party id 
				$(".editPartyFooter").after('<input type="hidden" name="editPartyId" id="editPartyId" value="'+response.party_id+'" />');


				// submit of edit Party form
				$("#editPartyForm").unbind('submit').bind('submit', function(e) {
					var PartyName = $("#editPartyName").val();
					if(PartyName == "") {
						$("#editPartyName").after('<p class="text-danger">This field is required</p>');
						$('#editPartyName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editPartyName").find('.text-danger').remove();
						// success out for form 
						$("#editPartyName").closest('.form-group').addClass('has-success');	  	
					}

					if(PartyName) {
						var form = $(this);
						// button loading
						$("#editPartyBtn").button('loading');
						var formData = new FormData(form);

						$.ajax({
							url : 'php_action/editParty.php',
							type: 'POST',
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								// button loading
								$("#editPartyBtn").button('reset');

								if(response.success == true) {
									// reload the manage member table 
									managePartyTable.ajax.reload(null, false);									  	  			
									
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-Party-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								}  // if

							} // /success
						}); // /ajax	
						e.preventDefault();
					} // if


					return false;
				}); // /submit of edit Party form

			} // /success
		}); // /fetch the selected Party data

	} else {
		alert('Oops!! Refresh the page');
	}
} // /edit Party function

// remove Party function
function removeParty(PartyId = null) {
		
	$.ajax({
		url: 'php_action/fetchSelectedParty.php',
		type: 'post',
		data: {PartyId: PartyId},
		dataType: 'json',
		success:function(response) {			

			// remove Party btn clicked to remove the Party function
			$("#removePartyBtn").unbind('click').bind('click', function() {
				// remove Party btn
				$("#removePartyBtn").button('loading');

				$.ajax({
					url: 'php_action/removeParty.php',
					type: 'post',
					data: {PartyId: PartyId},
					dataType: 'json',
					success:function(response) {
						if(response.success == true) {
 							// remove Party btn
							$("#removePartyBtn").button('reset');
							// close the modal 
							$("#removePartyModal").modal('hide');
							// update the manage Party table
							managePartyTable.ajax.reload(null, false);
							// udpate the messages
							$('.remove-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
 						} else {
 							// close the modal 
							$("#removePartyModal").modal('hide');

 							// udpate the messages
							$('.remove-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
 						} // /else
						
						
					} // /success function
				}); // /ajax function request server to remove the Party data
			}); // /remove Party btn clicked to remove the Party function

		} // /response
	}); // /ajax function to fetch the Party data
} // remove Party function
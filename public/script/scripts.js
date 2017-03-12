jQuery(document).ready(function(){
	var base = "";
	jQuery("#nextBtn").click(function(){
		jQuery("#studentNumber").slideUp('slow', function(){
			var student_number = jQuery("#student_number").val();
			jQuery.get(base + '/parties/getParties/' + student_number, function(data){
				if(data.indexOf("voted") > 0 ){
					jQuery("#already_voted").slideDown();
				} else {
					if(data.indexOf("No student") > 0){
						jQuery("#no_student").slideDown();
					} else { 
						data = jQuery.parseJSON( data );
						var i = 0;
						jQuery("#name").html(data.firstname);
						jQuery(".btn-party").each(function(){
							var party = data.parties[i];
							jQuery(this).html(party.name).data("party-id", party.id).data("party-id", party.id).click(function(){
								jQuery.get(base + '/parties/vote/' + student_number + "/" + party.id, function(){
									jQuery("#buttons").slideUp();
								});
							});
							i++;
						});

						jQuery("#buttons").slideDown();
					}
				}
			});		
		});
	});
});
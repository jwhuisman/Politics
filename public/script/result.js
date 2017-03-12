jQuery(document).ready(function(){
	var base = "";
	jQuery.get(base + '/parties/getResult', function(data){
		data = jQuery.parseJSON( data );

		jQuery("#votes").html(data.total_votes);



		var parties = data.votes;
		var count = 0;

		jQuery(".voteContainer").each(function(){
			var party = parties[count];
			jQuery(this).html(party.name + ": " + party.votes + " stemmen" );
			count++;
		});
	});

	jQuery("#showBtn").click(function(){
		jQuery("#result").slideDown();
		jQuery(this).slideUp();
	});
});
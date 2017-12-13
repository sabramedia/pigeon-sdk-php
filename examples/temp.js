$(document).ready(function(){
	var Pigeon = new PigeonClass({
		subdomain:'my.wapacklabs.com',
		fingerprint:true
	});

	Pigeon.paywall({
		redirect:false,
		free:true
	});

	$('a[href="#upgrade-subscriptions"]').click(function(){
		Pigeon.promotionDialog();
	});
});
$(function () {

	var ouverture = $('#compteur').attr('title');
	var date_ouverture = new Date();
	
	date_ouverture.setDate(ouverture.substr(0,2));
	date_ouverture.setMonth((parseFloat(ouverture.substr(3,2)) - 1).toString());
	date_ouverture.setFullYear(ouverture.substr(6,4));
	date_ouverture.setHours(ouverture.substr(11,2));
	date_ouverture.setMinutes(ouverture.substr(14,2));
	date_ouverture.setSeconds(ouverture.substr(17,2));

	$('#countdown').countdown({until: date_ouverture, compact: true, expiryUrl: 'http://assos.utc.fr/picasso/', onExpiry: function(){location.reload();}, layout: '<div id=\'until\'><div id=\'cd\'><span id=\'cd_days\'>{dn}</span></div><div id=\'cd\'><span id=\'cd_hours\'>{hnn}</span></div><div id=\'cd\'><span id=\'cd_minutes\'>{mnn}</span></div><div id=\'cd\'><span id=\'cd_seconds\'>{snn}</span></div></div>'});
});

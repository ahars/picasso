$(function () {

	var split = $('#compteur').attr('title').split('/');

	var ouverture_matin = split[0];
	var ouverture_soir = split[1];
	
	var date_ouverture_matin = new Date();
	date_ouverture_matin.setDate(ouverture_matin.substr(0,2));
	date_ouverture_matin.setMonth((parseFloat(ouverture_matin.substr(3,2)) - 1).toString());
	date_ouverture_matin.setFullYear(ouverture_matin.substr(6,4));
	date_ouverture_matin.setHours(ouverture_matin.substr(11,2));
	date_ouverture_matin.setMinutes(ouverture_matin.substr(14,2));
	date_ouverture_matin.setSeconds(ouverture_matin.substr(17,2));

	var date_ouverture_soir = new Date();
	date_ouverture_soir.setDate(ouverture_soir.substr(0,2));
	date_ouverture_soir.setMonth((parseFloat(ouverture_soir.substr(3,2)) - 1).toString());
	date_ouverture_soir.setFullYear(ouverture_soir.substr(6,4));
	date_ouverture_soir.setHours(ouverture_soir.substr(11,2));
	date_ouverture_soir.setMinutes(ouverture_soir.substr(14,2));
	date_ouverture_soir.setSeconds(ouverture_soir.substr(17,2));

	var debut_countdown_soir = new Date();
	debut_countdown_soir.setDate(ouverture_soir.substr(0,2));
	debut_countdown_soir.setMonth((parseFloat(ouverture_soir.substr(3,2)) - 1).toString());
	debut_countdown_soir.setFullYear(ouverture_soir.substr(6,4));
	debut_countdown_soir.setHours(ouverture_soir.substr(11,2) - 1);
	debut_countdown_soir.setMinutes(ouverture_soir.substr(14,2) - 30);
	debut_countdown_soir.setSeconds(ouverture_soir.substr(17,2));

	$('#countdown').countdown({until: date_ouverture_matin, compact: true, onExpiry: function(){location.reload();}, layout: '<div class=\'cd_element cd_value\'><span id=\'cd_days\'>{dnn}</span></div><div class=\'cd_element cd_label\'><span id=\'cd_label_j\'>j</span></div><div class=\'cd_element cd_value\'><span id=\'cd_hours\'>{hnn}</span></div><div class=\'cd_element cd_label\'><span id=\'cd_label_h\'>h</span></div><div class=\'cd_element cd_value\'><span id=\'cd_minutes\'>{mnn}</span></div><div class=\'cd_element cd_label\'><span id=\'cd_label_m\'>m</span></div><div class=\'cd_element cd_value\'><span id=\'cd_seconds\'>{snn}</span></div><div class=\'cd_element cd_label\'><span id=\'cd_label_s\'>s</span></div>'});
	$('#countdown2').countdown({until: debut_countdown_soir, compact: true, onExpiry: function(){location.reload();}});
	$('#countdown3').countdown({until: date_ouverture_soir, compact: true, onExpiry: function(){location.reload();}, layout: '<div class=\'cd_element cd_value\'><span id=\'cd_days\'>{dnn}</span></div><div class=\'cd_element cd_label\'><span id=\'cd_label_j\'>j</span></div><div class=\'cd_element cd_value\'><span id=\'cd_hours\'>{hnn}</span></div><div class=\'cd_element cd_label\'><span id=\'cd_label_h\'>h</span></div><div class=\'cd_element cd_value\'><span id=\'cd_minutes\'>{mnn}</span></div><div class=\'cd_element cd_label\'><span id=\'cd_label_m\'>m</span></div><div class=\'cd_element cd_value\'><span id=\'cd_seconds\'>{snn}</span></div><div class=\'cd_element cd_label\'><span id=\'cd_label_s\'>s</span></div>'});

});

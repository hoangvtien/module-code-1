/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 1 - 31 - 2010 5 : 12
 */

$(document).ready(function() {
	var cachesource = {};
	$("#AjaxSourceText").autocomplete({
		minLength : 2,
		delay : 500,
		source : function(request, response) {
			var term = request.term;
			if ( term in cachesource) {
				response(cachesource[term]);
				return;
			}
			$.getJSON(script_name + "?" + nv_name_variable + "=" + nv_module_name + "&" + nv_fc_variable + "=sourceajax", request, function(data, status, xhr) {
				cachesource[term] = data;
				response(data);
			});
		}
	});
});

function nv_show_list_source() {
	if (document.getElementById('module_show_list')) {
		$('#module_show_list').load(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=list_source&nocache=' + new Date().getTime());
	}
	return;
}

function nv_del_source(sourceid) {
	if (confirm(nv_is_del_confirm[0])) {
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=del_source&nocache=' + new Date().getTime(), 'sourceid=' + sourceid, function(res) {
			var r_split = res.split('_');
			if (r_split[0] == 'OK') {
				nv_show_list_source();
			} else {
				alert(nv_is_del_confirm[2]);
			}
		});
	}
	return false;
}
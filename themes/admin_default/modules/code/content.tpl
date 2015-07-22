<!-- BEGIN: main -->
<script src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/codemirror/lib/codemirror.js"></script>
<link rel="stylesheet" href="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/codemirror/lib/codemirror.css">
<script src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/codemirror/mode/javascript/javascript.js"></script>
<script src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/codemirror/mode/css/css.js"></script>
<script src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/codemirror/mode/xml/xml.js"></script>
<script src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/codemirror/mode/php/php.js"></script>
<script src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/codemirror/mode/clike/clike.js"></script>

<!-- BEGIN: error -->
<div class="alert alert-warning">
	{ERROR}
</div>
<!-- END: error -->

<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post" id="form">
	<div class="row">
		<div class="col-md-19">
			<div class="panel panel-default">
				<div class="panel-body">
					<input type="hidden" name="id" value="{ROW.id}" />
					<div class="form-group">
						<label class="col-sm-5 col-md-3 control-label"><strong>{LANG.title}</strong><span class="red"> (*)</span></label>
						<div class="col-sm-14 col-md-21">
							<input class="form-control" type="text" name="title" value="{ROW.title}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 col-md-3 control-label"><strong>{LANG.alias}</strong></label>
						<div class="col-sm-14 col-md-21">
							<div class="input-group">
								<input class="form-control" type="text" name="alias" value="{ROW.alias}" id="id_alias" />
								<span class="input-group-btn">
									<button class="btn btn-default" type="button">
										<i class="fa fa-refresh fa-lg" onclick="nv_get_alias('id_alias');">&nbsp;</i>
									</button> </span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 col-md-3 control-label"><strong>{LANG.description}</strong></label>
						<div class="col-sm-14 col-md-21">
							<textarea class="form-control" name="description" rows="4">{ROW.description}</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 col-md-3 control-label"><strong>{LANG.code_php}</strong></label>
						<div class="col-sm-14 col-md-21">
							<textarea class="form-control" id="code_php" name="code_php">{ROW.code_php}</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 col-md-3 control-label"><strong>{LANG.code_php_template}</strong></label>
						<div class="col-sm-14 col-md-21">
							<textarea class="form-control" id="code_php_template" name="code_php_template">{ROW.code_php_template}</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 col-md-3 control-label"><strong>{LANG.code_html}</strong></label>
						<div class="col-sm-14 col-md-21">
							<textarea class="form-control" id="code_html" name="code_html">{ROW.code_html}</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 col-md-3 control-label"><strong>{LANG.code_css}</strong></label>
						<div class="col-sm-14 col-md-21">
							<textarea class="form-control" id="code_css" name="code_css">{ROW.code_css}</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 col-md-3 control-label"><strong>{LANG.code_js}</strong></label>
						<div class="col-sm-14 col-md-21">
							<textarea class="form-control" name="code_js" id="code_js">{ROW.code_js}</textarea>
						</div>
					</div>
					<input type="hidden" name="submit" />
					<div class="form-group" style="text-align: center"><input class="btn btn-primary" type="submit" value="{LANG.save}" />
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-body">
					<label><input type="checkbox" name="viewdemo" value="1" {ROW.ck_viewdemo} />{LANG.viewdemo}</label>
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	//<![CDATA[
	var CodeMirror_HTML = CodeMirror.fromTextArea(document.getElementById("code_html"), {
		mode : "htmlmixed",
		lineNumbers : true
	});

	var CodeMirror_CSS = CodeMirror.fromTextArea(document.getElementById("code_css"), {
		mode : "text/css",
		lineNumbers : true
	});

	var CodeMirror_JS = CodeMirror.fromTextArea(document.getElementById('code_js'), {
		mode : "javascript",
		lineNumbers : true
	});

	var CodeMirror_PHP = CodeMirror.fromTextArea(document.getElementById('code_php'), {
		mode : "application/x-httpd-php",
		lineNumbers : true
	});

	var CodeMirror_PHP_TEMP = CodeMirror.fromTextArea(document.getElementById('code_php_template'), {
		mode : "application/x-httpd-php",
		lineNumbers : true
	});

	$('#form').submit(function() {
		var form_data = $(this).serializeArray();
		for ( index = 0; index < form_data.length; ++index) {
			if (form_data[index].name == "code_html" || form_data[index].name == "code_css" || form_data[index].name == "code_js" || form_data[index].name == "code_php_template" || form_data[index].name == "code_php") {
				form_data[index].value = htmlspecialchars(form_data[index].value);
			}
		}
		$.ajax({
			method : "POST",
			url : script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=content&&nocache=' + new Date().getTime(),
			data : form_data
		}).done(function(res) {
			var r_split = res.split('_');
			if (r_split[0] == 'OK') {
				window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name;
			} else {
				alert(r_split[1]);
			}
		});
		return false;
	});

	function htmlspecialchars(str) {
		if ( typeof (str) == "string") {
			str = str.replace(/&/g, "&amp;");
			/* must do &amp; first */
			str = str.replace(/"/g, "&quot;");
			str = str.replace(/'/g, "&#039;");
			str = str.replace(/</g, "&lt;");
			str = str.replace(/>/g, "&gt;");
		}
		return str;
	}

	function nv_get_alias(id) {
		var title = strip_tags($("[name='title']").val());
		if (title != '') {
			$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=content&nocache=' + new Date().getTime(), 'get_alias_title=' + encodeURIComponent(title), function(res) {
				$("#" + id).val(strip_tags(res));
			});
		}
		return false;
	}

	//]]>
</script>

<!-- BEGIN: auto_get_alias -->
<script type="text/javascript">
	//<![CDATA[
	$("[name='title']").change(function() {
		nv_get_alias('id_alias');
	});
	//]]>
</script>
<!-- END: auto_get_alias -->
<!-- END: main -->
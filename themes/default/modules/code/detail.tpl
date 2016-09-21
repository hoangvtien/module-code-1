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

<script type="text/javascript" data-show="after">
  window.___gcfg = {lang: nv_lang_data};
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

{HEADER}

<!-- BEGIN: tabs -->
<div class="clearfix">&nbsp;</div>
<ul class="nav nav-tabs" role="tablist">
	<!-- BEGIN: descriptionhtml -->
	<li role="presentation" class="active">
		<a href="#tab_descriptionhtml" aria-controls="tab_descriptionhtml" role="tab" data-toggle="tab">{LANG.content}</a>
	</li>
	<!-- END: descriptionhtml -->
	<!-- BEGIN: code_php -->
	<li role="presentation">
		<a href="#tab_code_php" aria-controls="tab_code_php" role="tab" data-toggle="tab">{LANG.code_php}</a>
	</li>
	<!-- END: code_php -->
	<!-- BEGIN: code_php_template -->
	<li role="presentation">
		<a href="#tab_code_php_template" aria-controls="tab_code_php_template" role="tab" data-toggle="tab">{LANG.code_php_template}</a>
	</li>
	<!-- END: code_php_template -->
	<!-- BEGIN: code_html -->
	<li role="presentation">
		<a href="#tab_code_html" aria-controls="tab_code_html" role="tab" data-toggle="tab">{LANG.code_html}</a>
	</li>
	<!-- END: code_html -->
	<!-- BEGIN: code_css -->
	<li role="presentation">
		<a href="#tab_code_css" aria-controls="tab_code_css" role="tab" data-toggle="tab">{LANG.code_css}</a>
	</li>
	<!-- END: code_css -->
	<!-- BEGIN: code_js -->
	<li role="presentation">
		<a href="#tab_code_js" aria-controls="tab_code_js" role="tab" data-toggle="tab">{LANG.code_js}</a>
	</li>
	<!-- END: code_js -->
</ul>
<script type="text/javascript">
	$(document).ready(function(){
		if(window.location.hash) {
			var hash = window.location.hash.substring(1);
			$('.nav-tabs a[href="#' + hash + '"]').tab('show');
		}
		else
		{
			$(".nav-tabs li:eq(0) a").tab('show');
		}
	});
</script>
<!-- END: tabs -->

<!-- BEGIN: tabs_content -->
<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="tab_descriptionhtml">
		<div class="panel panel-default" style="border-top: none">
			<div class="panel-body" id="descriptionhtml">{ROW.descriptionhtml}</div>
		</div>
	</div>
	<div role="tabpanel" class="tab-pane" id="tab_code_php">
		<textarea id="code_php">{ROW.code_php}</textarea>
	</div>
	<div role="tabpanel" class="tab-pane" id="tab_code_php_template">
		<textarea id="code_php_template">{ROW.code_php_template}</textarea>
	</div>
	<div role="tabpanel" class="tab-pane" id="tab_code_html">
		<textarea id="code_html">{ROW.code_html}</textarea>
	</div>
	<div role="tabpanel" class="tab-pane" id="tab_code_css">
		<textarea id="code_css">{ROW.code_css}</textarea>
	</div>
	<div role="tabpanel" class="tab-pane" id="tab_code_js">
		<textarea id="code_js">{ROW.code_js}</textarea>
	</div>
</div>

<script type="text/javascript">
	//<![CDATA[
	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
		var target = $(e.target).attr("href");
		//window.history.pushState( window.location.href , '', target );
		if (target == '#tab_code_php') {
			$('#tab_code_php').html('<textarea id="code_php">' + $('#code_php').val() + '</textarea>');
			var CodeMirror_PHP = CodeMirror.fromTextArea(document.getElementById('code_php'), {
				mode : "application/x-httpd-php",
				lineNumbers : true,
				readOnly : true
			});
		} else if (target == '#tab_code_php_template') {
			$('#tab_code_php_template').html('<textarea id="code_php_template">' + $('#code_php_template').val() + '</textarea>');
			var CodeMirror_PHP_TEMP = CodeMirror.fromTextArea(document.getElementById('code_php_template'), {
				mode : "application/x-httpd-php",
				lineNumbers : true,
				readOnly : true
			});
		} else if (target == '#tab_code_html') {
			$('#tab_code_html').html('<textarea id="code_html">' + $('#code_html').val() + '</textarea>');
			var CodeMirror_HTML = CodeMirror.fromTextArea(document.getElementById("code_html"), {
				mode : "htmlmixed",
				lineNumbers : true,
				readOnly : true
			});
		} else if (target == '#tab_code_css') {
			$('#tab_code_css').html('<textarea id="code_css">' + $('#code_css').val() + '</textarea>');
			var CodeMirror_HTML = CodeMirror.fromTextArea(document.getElementById("code_css"), {
				mode : "text/css",
				lineNumbers : true,
				readOnly : true
			});
		} else {
			$('#tab_code_js').html('<textarea id="code_js">' + $('#code_js').val() + '</textarea>');
			var CodeMirror_JS = CodeMirror.fromTextArea(document.getElementById('code_js'), {
				mode : "javascript",
				lineNumbers : true,
				readOnly : true
			});
		}
	});
	//]]>
</script>
<!-- END: tabs_content -->
<div class="clearfix">&nbsp;</div>

<!-- BEGIN: other -->
<div class="other">
	<h2 class="m-bottom">{LANG.other}</h2>
	<div class="row">
		<!-- BEGIN: loop -->
		<div class="col-sm-8 col-md-8 item">
			<div class="image text-center">
				<a href="{OTHER.url_view}" title="{OTHER.title}">
					<!-- BEGIN: image -->
					<img src="{OTHER.image}" alt="{OTHER.title}"  />
					<!-- END: image -->
					<!-- BEGIN: icon -->
					<em class="fa fa-code fa-5x list-image">&nbsp;</em>
					<!-- END: icon -->
				</a>
			</div>
			<a href="{OTHER.url_view}" title="{OTHER.title}"><strong>{OTHER.title}</strong></a>
		</div>
		<!-- END: loop -->
	</div>
</div>
<!-- END: other -->

<!-- END: main -->
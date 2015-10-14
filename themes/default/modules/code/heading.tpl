<!-- BEGIN: main -->
<div class="row">
	<div class="col-md-20">
		<!-- BEGIN: title -->
		<h1>{DATA.title}</h1>
		<strong>{LANG.cat}</strong>: <a href="{DATA.cat_link}" title="{DATA.cat_title}">{DATA.cat_title}</a>&nbsp;&nbsp;&nbsp;<span><strong>{LANG.poster}</strong>: {DATA.adduser}</span>
		<!-- END: title -->
		<div style="margin-top: 10px" class="clearfix"><div style="float: left; margin-right: 30px" class="fb-like" data-href="' . $client_info['selfurl'] . '" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div><div class="g-plusone" data-size="medium"></div></div>
	</div>
	<div class="col-md-4">
		[QR_CODE]
	</div>
</div>
<hr />
<!-- END: main -->
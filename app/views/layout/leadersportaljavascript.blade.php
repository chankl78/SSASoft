<!-- basic scripts -->
<!--[if !IE]>-->
<script type="text/javascript">
	window.jQuery || document.write("<script src='{{{ asset('assets/js/jquery.min.js') }}}'>"+"<"+"/script>");
</script>
<!--<![endif]-->

<!--[if IE]>
<script type="text/javascript">
	window.jQuery || document.write("<script src='{{{ asset('assets/js/jquery-1.10.2.min.js') }}}>"+"<"+"/script>");
</script>
<![endif]-->

<script type="text/javascript">
	if("ontouchend" in document) document.write("<script src='{{{ asset('assets/js/jquery.mobile.custom.min.js') }}}'>"+"<"+"/script>");
</script>
<script src="{{{ asset('assets/js/bootstrap.min.js') }}}"></script>
<!-- page specific plugin scripts -->

<!--[if lt IE 9]>
<script type="text/javascript" src="assets/js/excanvas.min.js"></script>
<![endif]-->

<script type="text/javascript" src="https://use.fontawesome.com/c5e7f60685.js"></script>
<script type="text/javascript" src="{{{ asset('assets/js/jquery-ui.custom.min.js') }}}"></script>
<script type="text/javascript" src="{{{ asset('assets/js/jquery.ui.touch-punch.min.js') }}}"></script>
<script type="text/javascript" src="{{{ asset('assets/js/jquery.slimscroll.min.js') }}}"></script>
<script type="text/javascript" src="{{{ asset('assets/js/date-time/bootstrap-datepicker.min.js') }}}"></script>
<script type="text/javascript" src="{{{ asset('assets/js/noty/packaged/jquery.noty.packaged.min.js') }}}"></script>
<script type="text/javascript" src="{{{ asset('assets/js/bootbox.min.js') }}}"></script>
<script type="text/javascript" src="{{{ asset('assets/js/moment.min.js') }}}"></script>
<script type="text/javascript" src="{{{ asset('assets/js/jquery.dataTables.min.js') }}}"></script>
<script type="text/javascript" src="{{{ asset('assets/js/jquery.dataTables.bootstrap.js') }}}"></script>
<script type="text/javascript" src="{{{ asset('assets/js/dataTables.responsive.min.js') }}}"></script>
<script type="text/javascript" src="{{{ asset('assets/js/jquery.dataTables.pipeline.js') }}}"></script>
<script type="text/javascript" src="{{{ asset('assets/js/jquery.dataTables.rowGrouping.js') }}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>

<!-- ace scripts -->
<script src="{{{ asset('assets/js/ace-elements.min.js') }}}"></script>
<script src="{{{ asset('assets/js/ace.min.js') }}}"></script>


<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
		$('[data-rel=tooltip]').tooltip();
		$('[data-rel=popover]').popover({html:true});

		$("#sbsc").on(ace.click_event, function() {
			bootbox.confirm("Do you want to logout?", function(result) {
				if(result) {
					window.location.href = "/getLeadersPortalLogout";
				}
			});
		});

		$("#sbscm").on(ace.click_event, function() {
			bootbox.confirm("Do you want to logout?", function(result) {
				if(result) {
					window.location.href = "/getLeadersPortalLogout";
				}
			});
		});

		$("#hlo").on(ace.click_event, function() {
			bootbox.confirm("Do you want to logout?", function(result) {
				if(result) {
					window.location.href = "/getLeadersPortalLogout";
				}
			});
		});
	});
</script>

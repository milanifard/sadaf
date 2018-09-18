<?php
	function CreateCssPart()
	{
		echo '
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link href="global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->		
		<link rel=\"stylesheet\"  href=\"css/lab.css\" type=\"text/css\">	
		';
	}
	
	function CreateJsPart()
	{
		echo '
		<!-- BEGIN CORE PLUGINS -->
        <script src="global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js" type="text/javascript"></script>
        <script src="global/scripts/datatable.js" type="text/javascript"></script>
        <script src="global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
		
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->		
		
		<script src="pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script> ';
	}
	
	function HTMLBegin($bgcolor = '#C8DEF0') 
	{
		echo "<!doctype html>
		<html lang=\"en\">
		  <head>
			<!-- Required meta tags -->
			<meta charset=\"utf-8\">
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
			
			<!-- Bootstrap CSS -->
			<link rel=\"stylesheet\" href=\"css/bootstrap.css\">
			<link rel=\"stylesheet\" href=\"css/font-awesome.min.css\">

			<link rel=\"stylesheet\" href=\"css/jquery-ui.css\">
			<link rel=\"stylesheet\" href=\"css/bootstrap-theme.css\" />
			<!---<link rel=\"stylesheet\" href=\"css/dataTables.bootstrap4.min.css\" />--->
			
			<link href=\"plugins/datatables/datatables.css\" rel=\"stylesheet\" type=\"text/css\" />
			<link href=\"plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css\" rel=\"stylesheet\" type=\"text/css\" />			
			
			<link rel=\"stylesheet\" href=\"css/jquery.Bootstrap-PersianDateTimePicker.css\" />
			<link rel=\"stylesheet\" href=\"css/bootstrap-switch.css\" />
			<!-- Modified Metronic CSS -->
			<link rel=\"stylesheet\" href=\"css/components-rtl.css\" />
			<link rel=\"stylesheet\" href=\"css/plugins-rtl.css\" />
			
			<link rel=\"stylesheet\" href=\"css/lab.css\" />

			<script src=\"js/jquery-3.3.1.min.js\"></script>
			<script src=\"js/popper.min.js\"></script>
			<script src=\"js/bootstrap.min.js\"></script>
			<script src=\"js/jquery-ui.js\"></script>
			<script src=\"js/jquery.dataTables.min.js\"></script>
			<script src=\"js/dataTables.bootstrap4.min.js\"></script>
			
			<script src=\"js/bootstrap-confirmation.min.js\"></script>
			<script src=\"js/bootstrap-switch.min.js\"></script>
			
			<script src=\"js/general-sadaf.js\"></script>
			
			<title></title>
		  </head>
		<body class='page-content'>";
	}
	
	function HTMLEnd()
	{
		echo "<script src=\"js/app-sadaf.js\"></script>";
		echo "<script src=\"js/jalaali.js\" type=\"text/javascript\"></script>";
		echo "<script src=\"js/jquery.Bootstrap-PersianDateTimePicker.js\" type=\"text/javascript\"></script>";
	}
	
	// create a boot strap modal div html code
	function BootStrapModal($ModalDivID, $ModalHeaderID, $ModalContentSpanID, $title)
	{
		echo '<div class="modal fade" id="'.$ModalDivID.'" tabindex="-1" role="dialog" aria-labelledby="..." aria-hidden="true">';
		echo '  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">';
		echo '    <div class="modal-content">';
		echo '		<div class="modal-header align-right DivRtl">';
		echo '        <h5 class="modal-title" id="'.$ModalHeaderID.'">'.$title.'</h5>';
		echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
		echo '          <span aria-hidden="true">&times;</span>';
		echo '        </button>';
		echo '      </div>';
		echo '      <div class="modal-body">';
		echo '		<div class="container-fluid">';
		echo '			<div class="row">';
		echo '			<div class="col">';
		echo '			<span id="'.$ModalContentSpanID.'" name="'.$ModalContentSpanID.'"></span>';
		echo '			</div>';
		echo '			</div>';
		echo '		</div>';
		echo '      </div>';
		echo '    </div>';
		echo '  </div>';
		echo '</div>';
	}
	
?>
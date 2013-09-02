<?php date_default_timezone_set('Europe/London'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
     
         <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
        
        
        
        <!--<script src="<?= base_url(); ?>assets/css/docsupport/jquery.min.js" type="text/javascript" charset="utf-8"></script>-->
        
        
        
     
 	 <!--<script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery-1.9.1.js"></script>-->
         <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
         <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

         <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery-ui-1.10.1.custom.js"></script>
 	<!--<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom.js"></script>-->
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/redactor.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery.fileupload.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery.iframe-transport.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/bootbox.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/datatable/jquery.dataTables.js"></script>
        <!--<script class="jsbin" src="http://datatables.net/download/build/jquery.dataTables.nightly.js"></script>-->
        
        <script src="<?= base_url(); ?>assets/js/chosen.jquery.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/css/docsupport/prism.js" type="text/javascript" charset="utf-8"></script> 
         <script>
        $(document).ready(function() {   
         $('#body').redactor();
         var config = {
                    '.chosen-select'           : {},
                    '.chosen-select-deselect'  : {allow_single_deselect:true},
                    '.chosen-select-no-single' : {disable_search_threshold:10},
                    '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                    '.chosen-select-width'     : {width:'95%'}
                  }
                  for (var selector in config) {
                    jQuery(selector).chosen(config[selector]);
                  }

                  jQuery(document).ready(function(){  // it is better if u call your function inside document.ready function
             jQuery('.chosen-select').chosen(); 
              jQuery('.chosen-select- deselect').chosen({allow_single_deselect:true});
           });
        });</script>
    
       
       
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/datatable/table.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/datatable/page.css">
            <link rel="stylesheet" href="<?= base_url(); ?>assets/css/docsupport/style.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/docsupport/prism.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/chosen.css">
        <style type="text/css" media="all">
          /* fix rtl for demo */
          .chosen-rtl .chosen-drop { left: -9000px; }
        </style>
        
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.css"/>                                
 	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css"/>
 	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/redactor.css"/>
 	 <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css"/>  
 	<link rel="stylesheet" href="<?= base_url(); ?>assets/less/main.css"/>

   <title>1st Social</title>
 </head>
 <body>

<div class="loader">
</div>
<?php date_default_timezone_set('Europe/London'); ?>
<!DOCTYPE html> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!--new js-->
       <script src="<?= base_url(); ?>assets/js/jquery-1.8.3.min.js"></script>
                                        <script src="<?= base_url(); ?>assets/js/jquery-ui-1.10.3.custom.min.js"></script>
                                        <script src="<?= base_url(); ?>assets/js/jquery.ui.touch-punch.min.js"></script>
                                        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
                                        <script src="<?= base_url(); ?>assets/js/bootstrap-select.js"></script>
                                        <script src="<?= base_url(); ?>assets/js/bootstrap-switch.js"></script>
                                        <script src="<?= base_url(); ?>assets/js/flatui-checkbox.js"></script>
                                        <script src="<?= base_url(); ?>assets/js/flatui-radio.js"></script>
                                        <script src="<?= base_url(); ?>assets/js/jquery.tagsinput.js"></script>
                                        <script src="<?= base_url(); ?>assets/js/jquery.placeholder.js"></script> 
            
             
            
        <!--old js-->    
        <script>
            var selectVar = null;
        </script>
        <!--<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>-->
        <!--<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>-->
        <!--<script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery-ui-1.10.1.custom.js"></script>-->
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/redactor.js"></script>
        <!--<script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/bootstrap.min.js"></script>-->
        <!--<script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery.dataTables.min.js"></script>-->

        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery.fileupload.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery.iframe-transport.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/bootbox.js"></script>

        <script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/datatable/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery.form.js"></script>
        <!--<script src="<?= base_url(); ?>assets/js/chosen.jquery.js" type="text/javascript"></script>-->
        <script src="<?= base_url(); ?>assets/css/docsupport/prism.js" type="text/javascript" charset="utf-8"></script> 

        <!--js for image gallery-->

        <script src="<?= base_url(); ?>assets/js/gallery/load-image.js"></script>
        <script src="<?= base_url(); ?>assets/js/gallery/bootstrap-image-gallery.js"></script>
        <script src="<?= base_url(); ?>assets/js/gallery/main.js"></script>

        <script>
//            $(document).ready(function() {
//                var config = {
//                    '.chosen-select': {},
//                    '.chosen-select-deselect': {allow_single_deselect: true},
//                    '.chosen-select-no-single': {disable_search_threshold: 10},
//                    '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
//                    '.chosen-select-width': {width: '95%'}
//                }
//                for (var selector in config) {
////                    jQuery(selector).chosen(config[selector]);
//                }
//
//                jQuery(document).ready(function() {  // it is better if u call your function inside document.ready function
//                    jQuery('.chosen-select').chosen();
//                    jQuery('.chosen-select- deselect').chosen({allow_single_deselect: true});
//
//
//
//                });
//
//
//
//
//
//            });
//            function myf()
//            {
//
//                var sl = new SelectParser();
//                //   jQuery('.chosen-select').add_option();
//            }

        </script>
        
        <script src="<?= base_url(); ?>assets/js/jquery.uploadify.min.js" type="text/javascript"></script>
        
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/uploadify.css">
            <style type="text/css">
                body {
                    font: 13px Arial, Helvetica, Sans-serif;
                }
            </style>

            <link rel="stylesheet" href="<?= base_url(); ?>assets/css/datatable/table.css">
                <link rel="stylesheet" href="<?= base_url(); ?>assets/css/datatable/page.css">
                    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/docsupport/style.css">
                        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/docsupport/prism.css">
                            <link rel="stylesheet" href="<?= base_url(); ?>assets/css/chosen.css">
                                <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-image-gallery.css"></link>
                                <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-responsive.css"></link>
                                <style type="text/css" media="all">
                                    /* fix rtl for demo */
                                    .chosen-rtl .chosen-drop { left: -9000px; }
                                </style>




                                <link href="<?= base_url(); ?>assets/css/flat-ui.css" rel="stylesheet">
                                <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.ico">
                                <link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.css"/>
                                <link rel="stylesheet" href="<?= base_url(); ?>assets/js/bootstrap-fileupload/bootstrap-fileupload.css">

                                    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css"/>  

                                    <!--<link rel="stylesheet" href="<?= base_url(); ?>assets/less/main.css"/>-->
                                    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/redactor.css"/>


                                <link rel="stylesheet" href="<?= base_url(); ?>assets/css/image_upload/css/jquery.fileupload-ui.css">
 <!--CSS adjustments for browsers with JavaScript disabled--> 
<noscript><link rel="stylesheet" href="<?= base_url(); ?>assets/css/image_upload/css/jquery.fileupload-ui-noscript.css"></noscript>
                                    <title>1st Social</title>
                                    </head>
                                    <body>
                                        <script>
//                                                $("select").selectpicker({style: 'btn-hg btn-primary', menuStyle: 'dropdown-inverse'});
                                       </script>
            <div class="loader">
                                        </div>
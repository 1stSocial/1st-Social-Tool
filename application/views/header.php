<?php date_default_timezone_set('Europe/London'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <link rel="stylesheet/less" href="<?= base_url(); ?>assets/css/user/temp.less"></link>

        <script>

            var selectVar = null;
        </script>
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery-ui-1.10.1.custom.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/redactor.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery.dataTables.min.js"></script>

        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery.fileupload.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery.iframe-transport.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/bootbox.js"></script>

        <script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/datatable/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/lib/jquery.form.js"></script>
        <script src="<?= base_url(); ?>assets/js/chosen.jquery.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/css/docsupport/prism.js" type="text/javascript" charset="utf-8"></script> 
        
        <!--js for image gallery-->
        
        <script src="<?= base_url(); ?>assets/js/gallery/load-image.js"></script>
        <script src="<?= base_url(); ?>assets/js/gallery/bootstrap-image-gallery.js"></script>
        <script src="<?= base_url(); ?>assets/js/gallery/main.js"></script>
        
        <script>
            $(document).ready(function() {
                var config = {
                    '.chosen-select': {},
                    '.chosen-select-deselect': {allow_single_deselect: true},
                    '.chosen-select-no-single': {disable_search_threshold: 10},
                    '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
                    '.chosen-select-width': {width: '95%'}
                }
                for (var selector in config) {
                    jQuery(selector).chosen(config[selector]);
                }

                jQuery(document).ready(function() {  // it is better if u call your function inside document.ready function
                    jQuery('.chosen-select').chosen();
                    jQuery('.chosen-select- deselect').chosen({allow_single_deselect: true});



                });





            });
            function myf()
            {

                var sl = new SelectParser();
                //   jQuery('.chosen-select').add_option();
            }

     </script>
        
        
        <script src="<?= base_url(); ?>assets/js/jquery.uploadify.min.js" type="text/javascript"></script>
<!--        <script src="<?= base_url(); ?>assets/js/image_upload/js/vendor/jquery.ui.widget.js"></script>
        <script src="<?= base_url(); ?>assets/js/image_upload/js/tmpl.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/image_upload/js/load-image.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/image_upload/js/canvas-to-blob.min.js"></script>
         The File Upload processing plugin 
<script src="<?= base_url(); ?>assets/js/image_upload/js/jquery.fileupload-process.js"></script>
 The File Upload image preview & resize plugin 
<script src="<?= base_url(); ?>assets/js/image_upload/js/jquery.fileupload-image.js"></script>
 The File Upload audio preview plugin 
<script src="<?= base_url(); ?>assets/js/image_upload/js/jquery.fileupload-audio.js"></script>
 The File Upload video preview plugin 
<script src="<?= base_url(); ?>assets/js/image_upload/js/jquery.fileupload-video.js"></script>
 The File Upload validation plugin 
<script src="<?= base_url(); ?>assets/js/image_upload/js/jquery.fileupload-validate.js"></script>
 The File Upload user interface plugin 
<script src="<?= base_url(); ?>assets/js/image_upload/js/jquery.fileupload-ui.js"></script>
<script src="<?= base_url(); ?>assets/js/image_upload/js/main.js"></script>-->
        
        
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




     <!--<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.css"/>-->                                
                            <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css"/>
                            <link rel="stylesheet" href="<?= base_url(); ?>assets/js/bootstrap-fileupload/bootstrap-fileupload.css">

                                <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css"/>  
                                
                                <link rel="stylesheet" href="<?= base_url(); ?>assets/less/main.css"/>
                                <link rel="stylesheet" href="<?= base_url(); ?>assets/css/redactor.css"/>
                                
                                
<!--                                <link rel="stylesheet" href="<?= base_url(); ?>assets/css/image_upload/css/jquery.fileupload-ui.css">
                                 CSS adjustments for browsers with JavaScript disabled 
                                <noscript><link rel="stylesheet" href="<?= base_url(); ?>assets/css/image_upload/css/jquery.fileupload-ui-noscript.css"></noscript>-->
                                <title>1st Social</title>
                                </head>
                                <body>
                                    <div class="loader">
                                    </div>

<script src="<?= base_url(); ?>assets/js/chosen.jquery.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/css/docsupport/prism.js" type="text/javascript" charset="utf-8"></script> 
 <script>
        $(document).ready(function() {   

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
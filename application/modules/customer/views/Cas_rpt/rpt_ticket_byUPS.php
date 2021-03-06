
 <!-- kendo UI -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/bower_components/kendo-ui/styles/kendo.common-material.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>asset/bower_components/kendo-ui/styles/kendo.material.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>asset/rate_app/css/custom.css"/>
        <!-- kendo UI -->
    <script src="<?php echo base_url();?>asset/assets/js/kendoui_custom.min.js"></script>
    <!--  kendoui functions 
    <script src="<?php echo base_url();?>asset/assets/js/pages/kendoui.min.js"></script>
    -->
<script type="text/javascript">
var statusproses,$statusproses;
$(document).ready(function(){
    
    var date = new Date();
    var d = convertDate(date);

//==================== TANGGAL ===================
        var $dp_start = $('#uk_dp_start'),
            $dp_end = $('#uk_dp_end');

        var start_date = UIkit.datepicker($dp_start, {
            //format:'DD.MM.YYYY'
            format:'YYYY-MM-DD',
        });

        var end_date = UIkit.datepicker($dp_end, {
            //format:'DD.MM.YYYY'
            format:'YYYY-MM-DD',
        });
        

        $dp_start.on('change',function() {
            end_date.options.minDate = $dp_start.val();
        });

        $dp_end.on('change',function() {
            start_date.options.maxDate = $dp_end.val();
        });
        var tgl_sekarang =  new Date().toISOString().slice(0,10);;
        $('#uk_dp_start').val(tgl_sekarang);
        $('#uk_dp_end').val(tgl_sekarang);

//=======================================

});

function print_(ctk=''){
//    var track   = $('#statusproses').val();
//      if(track==' '){
//         swal("Oops... Status Tracking is required", "Please Input Status Tracking!...", "error");
//         exit();
//      }
    var tgl1    = $('#uk_dp_start').val();
    var tgl2    = $('#uk_dp_end').val();
    
    
    switch (ctk) {
    case '1':
        cetakPrev('4|'+tgl1+'|'+tgl2,"<?php echo site_url('cas/Ccas_rpt/rpt_ticket_ups')?>","#preview_his"); 
        UIkit.switcher('#h_tab').show(1);
        break;
    case '2':
    //alert(ctk);
        cetakTri('1|'+tgl1+'|'+tgl2,"<?php echo site_url('cas/Ccas_rpt/rpt_ticket_ups')?>");     
        break;
    case '3':
    //alert(ctk);
        cetakTri('2|'+tgl1+'|'+tgl2,"<?php echo site_url('cas/Ccas_rpt/rpt_ticket_ups')?>"); 
        break;
    }
}
    
</script>
<style>
.md-list > li{
    padding : 2px 1px;
}
.md-list .uk-text-large{
    font-size : 13px;
}
.md-list .uk-text-small{
    font-size : 11px;
}
</style>
<div class="uk-grid" data-uk-grid-margin>
    <div class="uk-width-medium-1-1">
        <div class="md-card" id="cont">
            <div class="md-card-toolbar" style="height: 55px;">
                <div class="md-card-toolbar-actions">
                    
                  <!--  <a onclick="getload()" class="md-btn md-btn-success md-btn-small md-btn-wave-light waves-effect waves-button waves-light"><i class="md-list-addon-icon material-icons md-24 md-color-white">replay</i> Load Data</a> -->
                    <i class="md-icon material-icons md-card-fullscreen-activate" data-uk-tooltip="{pos:'left'}" title="maximaze">&#xE5D0;</i>
                </div>
                <h3 id="title" class="md-card-toolbar-heading-text">REPORT TICKET RESPONSE BY UPS</h3>
            </div>
                <div class="md-card-content">
                    <ul style="display: none;" id="h_tab" class="uk-tab" data-uk-tab="{connect:'#tabs_1'}">
                    <li><a href="#" ><i class="md-list-addon-icon material-icons md-24">list</i></a></li>
                    <li style="display: none;"><a href="#" ><i class="md-list-addon-icon material-icons md-24">list</i> Preview </a></li>
                    </ul>
                    <ul id="tabs_1" class="uk-switcher uk-margin">
    <!-- TAB SATU -->
                    <li>
<!-- LISTING HISTORY IMPORT -->                    
          <div class="uk-grid" >
            <div  class="uk-width-large-1-4 uk-width-medium-1-3">
                <div class="uk-input-group">
                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                    <label for="uk_dp_start">Start Date </label>
                    <input class="md-input" type="text" id="uk_dp_start" />
                </div>
            </div>
            <div  class="uk-width-large-1-4 uk-width-medium-1-3">
                <div class="uk-input-group">
                   <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                   <label for="uk_dp_end">End Date </label>
                  <input class="md-input" type="text" id="uk_dp_end" />
               </div>
            </div>
            <div  class="uk-width-medium-1-3 uk-width-large-1-3">
            </div>
             <div class="uk-width-medium-1-3 uk-width-large-1-3">
             </div>
             <div class="uk-width-medium-1-3 uk-width-large-1-3 ">
             </div>
        </div>
        <div class="uk-grid" style="margin-top: 50px;">
            <div  class="uk-width-large-1-1 uk-width-medium-1-1">
               <a onclick="print_('1');" class="md-btn md-btn-small md-btn-primary waves-effect waves-button ">
               <i class="md-list-addon-icon material-icons md-24 md-color-white">remove_red_eye</i> Preview</a>
               
               <a onclick="print_('2');" class="md-btn md-btn-small md-btn-danger waves-effect waves-button ">
               <i class="md-list-addon-icon material-icons md-24 md-color-white">picture_as_pdf</i> PDF</a>
               
               <a onclick="print_('3');" class="md-btn md-btn-small md-btn-success waves-effect waves-button ">
               <!--<i class="md-list-addon-icon material-icons md-24 md-color-white uk-icon-file-excel-o"></i>--> Excel</a>
            </div>
        </div>
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
<!-- END LIST -->
                    </li>
                    <li>
                    <div class="uk-text-left">
                        <a onclick="UIkit.switcher('#h_tab').show(0);" class="md-btn md-btn-warning md-btn-small md-btn-wave-light waves-effect waves-button waves-light"><i class="md-list-addon-icon material-icons md-24 md-color-white">replay</i>Back To List</a>
                    </div>
                    <br />
                    <div style="max-height: 400px;" id="preview_his" class="uk-overflow-container"></div>
                    </li>
                    </ul>
                </div>
        </div>
    </div>
</di
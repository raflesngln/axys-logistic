<div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <ul class="uk-tab" data-uk-tab="{connect:'#tabs_1_content'}" id="tabs_1">
                                <li class="uk-active"><a href="#"><i class="material-icons">menu</i> List Team</a></li>
                                <li><a href="#"><i class="material-icons">device_hub</i> Role user Team</a></li>
                                <li><a href="#"><i class="material-icons">format_list_numbered</i> Role Team Jobs</a></li>
                            </ul>
                            <ul id="tabs_1_content" class="uk-switcher uk-margin">
             <li><?php echo $this->load->view('master/team/v_list') ;?></li>
             <li><?php echo $this->load->view('master/team/role_status') ;?></li>
              <li><?php echo $this->load->view('master/team/role_abjad/role_abjad') ;?></li>
                          </ul>
                      </div>
                    </div>
                </div>
            </div>
            
<script>
$(document).ready(function(e) {
    $("#nonaktif").html('');
	$("#aktif").html('');
	 $("#nonaktif2").html('');
	$("#aktif2").html('');
	
});
</script>
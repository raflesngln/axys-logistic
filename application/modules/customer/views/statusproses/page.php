<div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <ul class="uk-tab" data-uk-tab="{connect:'#tabs_1_content'}" id="tabs_1">
                                <li class="uk-active"><a href="#"><i class="material-icons">menu</i> List Status</a></li>
                                <li><a href="#"><i class="material-icons">device_hub</i> Managemen Role</a></li>
                            </ul>
                            <ul id="tabs_1_content" class="uk-switcher uk-margin">
             <li><?php echo $this->load->view('cas/statusproses/v_list') ;?></li>
             <li><?php echo $this->load->view('cas/statusproses/role/role_status') ;?></li>
                          </ul>
                      </div>
                    </div>
                </div>
            </div>
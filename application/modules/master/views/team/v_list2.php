<div class="uk-grid uk-grid-width-medium-1-3" data-uk-grid-margin>
                
  <?php 

	  foreach($list_team as $row){
  ;?>              
                <div>
                    <div class="md-card" style="border-bottom:1px #CCC solid">
                        <div class="md-card-toolbar md-bg-cyan-800" data-toolbar-progress="33">
                            <div class="md-card-toolbar-actions">
                                <i class="md-icon material-icons md-card-fullscreen-activate">&#xE5D0;</i>
                                <i class="md-icon material-icons">&#xE5D5;</i>
                            </div>
                            <h3 class="md-card-toolbar-heading-text">
                            <?php echo $row->nm_team;?>
                          </h3>
                        </div>
                        <div class="md-card-content">
<div class="uk-width-1-1">
                                                    <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-1" data-uk-grid-margin="">
                                                        <div class="uk-row-first">
                                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon material-icons">people</i>
                                                                </span>
                                                                <div class="md-input-wrapper md-input-filled">
                                                                
                                                                <p> 66 People's</p>
                                                                <span class="md-input-bar"></span>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon material-icons">sort_by_alpha</i>
                                                                </span>
                                                                <div class="md-input-wrapper md-input-filled">
                                                                <p> 5 Character's</p>
                                                                <span class="md-input-bar"></span></div>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                            </div>
                                        </div>
						
                        </div>
                    </div>
                </div>
              
  <?php } ?>
            </div>
<style>
#aktif li,#nonaktif li{
	list-style:none;
}
.idmn1,.idmn2{
	background-color:transparent;
	border:none;
	cursor:pointer;
}
.idmn1:hover,.idmn2:hover{
	color:red;
	background-color:#F3F3F3;
}
</style>

<div class="md-card">
                        <div class="md-card-content truncate-text">
                          



<div class="uk-grid">
 

    
    
 



<div class="uk-width-medium-1-1"  style="border-left:1px #CCC solid">
      <span class="uk-badge uk-badge-warning"> ACTIVE ROLE</span>
       <div id="aktif">
       
<table width=""  class="uk-table uk-table-hover">
 <thead>
  <tr style="background-color:#F3F3F3">
    <td width="2%" height="29"><div align="center">#</div></td>
    <td width="44%"><div align="center">From</div></td>
    <td width="44%"><div align="center">To</div></td>
    <td width="5%"><div align="center">Action</div></td>
    </tr>
    </thead>
    <tbody>
  <?php 
  $no=1;
 foreach($aktif as $dt){
 ?>  
  <tr>
    <td><?= $no;?></td>
    <td><?php echo $dt->cod1.' - '.$dt->ket1;?></td>
    <td><?php echo $dt->cod2.' - '.$dt->ket2;?></td>
    <td><i class="material-icons" onclick="delete_role('<?php echo $dt->Id ;?>')">close</i></td>
    </tr>
    <?php $no++; } ?>
    </tbody>
</table>

      </div>
</div>



</div>




                        </div>
                        
                    </div>
                    
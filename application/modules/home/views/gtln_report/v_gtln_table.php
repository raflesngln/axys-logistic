<table id="tbl_status" class="uk-table uk-table-hover tbl_status" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                              <th width="4%">No</th>
                                <th width="15%">tglbc </th>
                                <th width="15%">flight_date</th>
                                <th width="11%">mawb</th>
                                <th width="11%">hawb</th>
                                <th width="19%">shipper_name</th>
                                <th width="19%">consignee_name</th>
                            </tr>
                        </thead>
                       <tbody>
                             <?php 
$no=1;
			foreach($list as $data){
				
			?>
                        <tr>
                          <td><?php echo $no?></td>
                            <td><?php echo $data->tglbc?></td>
                          <td><?php echo $data->flight_date?></td>
                            <td><?php echo $data->mawb?></td>
                            <td><?php echo $data->hawb?></td>
                            <td><?php echo $data->shipper_name?></td>
                            <td><?php echo $data->consignee_name?></td>
                         </tr>
           <?php $no++; } ;?>               
                        </tbody>
                         <tfoot>
                        </tfoot>


                    </table>
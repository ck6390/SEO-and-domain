<div class="col-md-10">
     <div class="table-responsive">
      <small class="btn btn-info border_radius_none pull-right"><?php echo anchor('seoclient/add', 'Add');?></small>
      <form action="<?php echo base_url() . "index.php/seoclient/remove"?>" method = "post">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
            <tr>
              <th><INPUT type="checkbox" onchange="checkAll(this)" name="chk[]" />Check All</th> <th>Sl.</th>            
              <th>Clients Name</th>              
              <th>Start Date</th>              
              <th>Renewal Date</th>           
              <th>Total Aomunt (<i class="fa fa-inr"></i>)</th>           
              <th>Paid Aomunt (<i class="fa fa-inr"></i>)</th>           
              <th>Dues Aomunt (<i class="fa fa-inr"></i>)</th>           
              <th>Payment Status</th>              
              <th>Actions</th>              
            </tr>
          </thead>
          <tbody>
            <?php
            $sl=0;
            foreach ($get_data as $data)
            {
            ?>
            <tr>             
              <td><input type="checkbox" name="delete[]" value="<?php echo $data->id ?>" />
                  <input type="hidden" id="updateby" name="updateby" value="<?php echo $email; ?>" >
              </td> 
			  <td><?= ++$sl ?></td>
              <td><?php echo $data->clients_name;?></td>
              <td><?php echo date('d-M-Y',strtotime($data->start_date));?></td>
              <td><?php if($data->renewal_date==null){ echo date('d-M-Y',strtotime($data->renewal_date) );}else{ echo "NA"; }?></td>
              <td><?php echo $data->total_amount;?></td>
              <td><?php echo $data->paid_amount;?></td>
              <td><?php echo $data->total_amount - $data->paid_amount;?></td>
              <td><?php echo $data->payment_status;?></td>              
              <td><a href="<?php echo base_url() . "index.php/seoclient/updateView/" . $data->id; ?>/" class="pull-left"><i class="fa fa-pencil black fa-fw"></i></a></td>
            </tr>
            <?php   }
            ?>
           
        </tbody>
        <tfoot> <tr><td><input type="submit" name = "remove" value = "Selected Delete" class = "btn btn-danger btn-sm" /></td>
            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
          </tr></tfoot>
      </table>
    </form>
</div>
</div>
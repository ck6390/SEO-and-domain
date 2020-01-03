<div class="col-md-10">
     <div class="table-responsive">
      <small class="btn btn-info border_radius_none pull-right"><?php echo anchor('setting/add', 'Add');?></small>
      <form action="<?php echo base_url() . "index.php/setting/remove"?>" method = "post">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
            <tr>
              <th><INPUT type="checkbox" onchange="checkAll(this)" name="chk[]" />Check All</th>              
              <th>Emails</th>              
              <th>CC Emails</th>              
              <th>Numbers</th>             
              <th>Status</th>             
              <th>Actions</th>              
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($get_data as $data)
            {
            ?>
            <tr>
              <td><input type="checkbox" name="delete[]" value="<?php echo $data->id ?>" />
                  <input type="hidden" id="updateby" name="updateby" value="<?php echo $email; ?>" >
              </td>             
              <td><?php echo $data->emails;?></td>
              <td><?php echo $data->cc_emails;?></td>
              <td><?php echo "+91-".$data->contact_number;?></td>              
              <td><?php
                    if($data->active==1)
                      {
                        $active_text = "Unapprove";
                        $btn = "danger";
                        $active = "deactivate/";
                      }
                      else{
                        $active_text = "Approve";
                        $btn = "primary";
                        $active = "activate/";
                      }?>
                      <a href="<?php echo site_url('setting/'.$active.$data->id); ?>" class="btn btn-<?= $btn ?> btn-xs"><?= $active_text ?></a>
                      </td> 

              <td><a href="<?php echo base_url() . "index.php/setting/updateView/" . $data->id; ?>/" class="pull-left"><i class="fa fa-pencil black fa-fw"></i></a></td>
            </tr>
            <?php   }
            ?>
           
        </tbody>
        <tfoot> <tr><td><input type="submit" name = "remove" value = "Selected Delete" class = "btn btn-danger btn-sm" /></td>
            <td></td><td></td><td></td><td></td><td></td>
          </tr></tfoot>
      </table>
    </form>
</div>
</div>
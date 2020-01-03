<div class="col-md-10">
     <div class="table-responsive">
      <small class="btn btn-info border_radius_none pull-right"><?php echo anchor('domain/add', 'Add');?></small>
      <form action="<?php echo base_url() . "index.php/domain/remove"?>" method = "post">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
            <tr>
              <th><INPUT type="checkbox" onchange="checkAll(this)" name="chk[]" />Check All</th>              
              <th>Domain</th>              
              <th>Actions</th>              
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($getNotice as $getNotices)
            {
            ?>
            <tr>
              <td><input type="checkbox" name="delete[]" value="<?php echo $getNotices->id ?>" />
                  <input type="hidden" id="updateby" name="updateby" value="<?php echo $email; ?>" >
              </td>             
              <td><a href="<?php echo $getNotices->domain;?>" target="_new" class="black"><?php echo $getNotices->domain;?></a></td>
              <td><a href="<?php echo base_url() . "index.php/domain/updateView/" . $getNotices->id; ?>/" class="pull-left"><i class="fa fa-pencil black fa-fw"></i></a></td>
            </tr>
            <?php   }
            ?>
           
        </tbody>
        <tfoot> <tr><td><input type="submit" name = "remove" value = "Selected Delete" class = "btn btn-danger btn-sm" /></td>
            <td></td><td></td>
          </tr></tfoot>
      </table>
    </form>
</div>
</div>
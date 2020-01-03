<div class="col-md-10">
     <div class="table-responsive">
      <small class="btn btn-info border_radius_none pull-right"><?php echo anchor('domain/add', 'Add');?></small>
      <form action="<?php echo base_url() . "index.php/domain/remove"?>" method = "post">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
           <tr>
				<th>Sl.No.</th>
				<th>Domain Name</th>
				<th>Expiry Date</th>
				<th>Status</th>
			</tr>
          </thead>
          <tbody>
            <?php
			//var_dump($dn);
			//die();
			$counter = 1;
            for($i=0; $i<sizeOf($dn); $i++)
            {
            ?>
            <tr>		
				<td><?= $counter++ ?></td>
				<td><a href="http://<?= $dn[$i]['domain'] ?>" target="_blank" class="black"><?= $dn[$i]['domain'] ?></a></td>
				<td><?php if(!empty($dn[$i]['expires'])){ echo date('d-M-Y',strtotime($dn[$i]['expires'])); }else{ echo "NA"; } ?></td>
				<td><?= $dn[$i]['status'] ?></td>
			</tr>
            <?php } ?>           
        </tbody>      
      </table>
    </form>
</div>
</div>
<div class="col-md-10">
     <div class="table-responsive">
      <small class="btn btn-info border_radius_none pull-right"><?php echo anchor('tag/add', 'Add');?></small>
      <form action="<?php echo base_url() . "index.php/tag/remove"?>" method = "post">
        <table class="table table-striped table-bordered table-hover table-css" id="dataTables-example">
          <thead>
            <tr>
              <th><INPUT type="checkbox" onchange="checkAll(this)" name="chk[]" />Check All</th>              
              <th>Code Configure</th>              
              <th>Verification</th>              
              <th>Domain</th>              
              <th>Title</th>              
              <th>Meta Keyword</th>              
              <th>Meta Description</th>              
              <th>Google Verification</th>              
              <th>Google Analytics</th>            
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($getNotice as $getNotices)
            {
            ?>
            <tr>
              <td><input type="checkbox" name="delete[]" value="<?php echo $getNotices->id ?>" />
                  <input type="hidden" id="updateby" name="updateby" value="<?php echo $email; ?>" ><br/>
				  <a href="<?php echo base_url() . "index.php/tag/updateview/" . $getNotices->id; ?>/" class="pull-left"><i class="fa fa-pencil black fa-fw"></i></a>
              </td>  
			  <td>
				<select class="form-control code_status" name="code_status" id="code_status">
					<option value="1,<?= $getNotices->id ?>" <?= $getNotices->code_status == "1"? 'selected': ''?>>Yes</option>
					<option value="0,<?=$getNotices->id?>" <?= $getNotices->code_status == "0"? 'selected': ''?>>No</option>
				</select>
			  </td>
			  <td>
				<select class="form-control verification" name="verification" id="verification">
					<option value="1,<?= $getNotices->id ?>" <?= $getNotices->verification == "1"? 'selected': ''?>>Yes</option>
					<option value="0,<?= $getNotices->id ?>" <?= $getNotices->verification == "0"? 'selected': ''?>>No</option>
				</select>
			  </td>
              <td><a href="<?php echo $getNotices->domain;?>" target="_new" class="black"><?php echo $getNotices->domain;?></a></td>
              <td><?php 
              		echo strlen(str_replace(";", " ", $getNotices->title)) >= 60 ? substr($getNotices->title, 0, 60):$getNotices->title;?></td>
              <td><?php echo strlen(str_replace(";", " ", $getNotices->metaKeyword)) >= 60 ? substr($getNotices->metaKeyword, 0, 60):$getNotices->metaKeyword;?>              	
              </td>
              <td><?php echo strlen(str_replace(";", " ", $getNotices->metaDescription)) >= 60 ? substr($getNotices->metaDescription, 0, 60):$getNotices->metaDescription;?></td>
			  <td><?php echo str_replace(";", " ", $getNotices->google_verification); ?></td>
			  <td><?php echo str_replace(";", " ", $getNotices->google_analytics); ?></td>
              
            </tr>
            <?php   }
            ?>
           
        </tbody>
        <tfoot> <tr><td colspan="9"><input type="submit" name = "remove" value = "Selected Delete" class = "btn btn-danger btn-sm" /></td>
           
          </tr></tfoot>
      </table>
    </form>
</div>
</div>
<script>
//Filter data by vendor
	$(".code_status").change(function()
	    {
	        var code_status =$(this).val().toString();
	        $.ajax({
			    url:"<?= site_url();?>/tag/code_staus_update",
			    datatype:'json',
			    data:{data:code_status},				
			    type:"POST",
			    success: function(data){
					alert("Code configure status updated.");
					setInterval(function(){
					   window.location.reload(1);
					}, 1000);
			    	//$("#example1").html(data);
			    },
			    error:function(data){
			        alert("error");
			    }          
			});
		});
		
		$(".verification").change(function()
	    {
	        var verification =$(this).val().toString();
	        $.ajax({
			    url:"<?= site_url();?>/tag/code_verification",
			    datatype:'json',
			    data:{data:verification},				
			    type:"POST",
			    success: function(data){
					alert("Verification status updated.");
					setInterval(function(){
					   window.location.reload(1);
					}, 1000);
			    	//$("#example1").html(data);
			    },
			    error:function(data){
			        alert("error");
			    }          
			});
		});
</script>
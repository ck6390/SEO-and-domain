   <div class="col-md-10">
     <?php 
            $get_url = current_url();
            //$get_url = str_replace("http://localhost/seo-admin/index.php/tag/add/", "0", $get_url);
            $get_url = str_replace("http://micro.filliptechnologies.com/admin-seo/index.php/tag/add/", "0", $get_url);
            if($get_url == "0")
            {
                $title="add";
                $submit = "add";
            }
            else{                           
                foreach ($single_content as $datas)
                  { 
                     $id = $datas->id;
                  }
                  $title="edit";
                  $submit="edit/".$id;
            }
            
        ?>
      <h3 class="text-uppercase"><?php echo $title; ?> Tag</h3>
       <form class="form-horizontal" role="form" method="post" action="<?php echo base_url()."index.php/tag/".$submit; ?>" enctype="multipart/form-data">
        <div class="col-md-6">
			<?php 
				if($get_url == "0")
				 {                               
					$titles = "";
					$metaKeyword = "";
					$metaDescription = "";
					$domain = "";
					$google_analytics = "";
					$google_verification = "";
					foreach($getdomains as $key => $data){
						$str_re = str_replace('http://www.','',$data->domain);
						$str_re1 = str_replace('http://','',$str_re);
						$str_re2 = str_replace('/','',$str_re1);
						$domain_arr[] = $str_re2;
					}
						for($i=0; $i<sizeOf($getdomain); $i++)
						{	
							$server_menu_arr[]=$getdomain[$i]['domain'];							
						}
						$merge_domain = array_merge($domain_arr,$server_menu_arr);
						
					   $result = array_unique($merge_domain);
				 }
				else{
				   foreach ($single_content as $datas)
					{ 
					  $titles = str_replace(";","",$datas->title);
					  $metaKeyword = str_replace(";","",$datas->metaKeyword);
					  $metaDescription = str_replace(";","",$datas->metaDescription);
					  $google_analytics = str_replace(";","",$datas->google_analytics);
					  $google_verification = str_replace(";","",$datas->google_verification);
					  $domain = $datas->domain;
					} 
				}
					//var_dump($getdomains);
					
					 
					
				?>
				<?php echo form_label('Select Domain: ');?><?php echo form_error('domain');?> 
				
				 <select class="form-control" name="domain" id="domain">
				  <?php if($domain)
					{
				  ?>
				  <option value="<?php echo $domain; ?>" readonly><?php echo $domain; ?></option>
				  <?php } else { ?>
				  <option value="">====Select Domain====</option>
				   <?php
					//$merge_domain = array_merge($getdomain,$getdomains);
					for($i=0; $i<sizeOf($result); $i++){
				  ?>
					<option  value="<?php echo @$result[$i]."/";?>"><?php echo preg_replace('/\s+/', '', @$result[$i]);?></option>
					<?php } } ?>
				 </select>
			  <input type="hidden" id="updateby" name="updateby" value="<?php echo $email; ?>" >       
			   <div class="col-md-8 no-padding">
				<label>Title : <b class="text-danger">Should be 65 characters</b></label>
				<?php echo form_error('title');?>
			   </div>
			   <div class="col-md-4 no-padding text-right">
				  <label><b class="text-danger ">Characters Length : <label id="textCount" class="text-danger"></b></label>
			   </div>  			
			  <div class="col-md-12 no-padding"><input type="text" class="form-control" name="title" id="title" value="<?php echo $titles; ?>"></div>
			  <div class="clearfix"></div>
			  <?php echo form_label('Meta keyword :');?><?php echo form_error('metaKeyword');?>          
			  <textarea class="form-control" name="metaKeyword" id="metaKeyword" rows="4"><?php echo $metaKeyword; ?></textarea>
			   <div class="col-md-8 no-padding">
				<label>Description : <b class="text-danger">Should be 160 characters</b></label>
				<?php echo form_error('metaDescription');?>
			   </div>
			   <div class="col-md-4 no-padding text-right">
				  <label><b class="text-danger ">Characters Length : <label id="textCountD" class="text-danger"></b></label>
			   </div>               
			   <textarea class="form-control" name="metaDescription" id="metaDescription" rows="2"><?php echo $metaDescription; ?></textarea>
			 <div class="clearfix"></div><br/>
		</div>
		<div class="col-md-6">
			<div class="col-md-6 no-padding">
				<label>Google Verification : </label>				
			</div>
			<div class="col-md-6 no-padding text-right">
				<label><?php echo form_error('google_verification');?></label>
			</div> 
			<input type="text" class="form-control" name="google_verification" id="google_verification" value="<?php echo $google_verification; ?>">
				<div class="col-md-6 no-padding">
				<label>Google Analytics : </label>				
			</div>
			<div class="col-md-6 no-padding text-right">
				<label><?php echo form_error('google_analytics');?></label>
			</div> 
			<input type="text" class="form-control" name="google_analytics" id="google_analytics" value="<?php echo $google_analytics; ?>">
			<br/><br/>
			<button type="submit" class="btn btn-primary text-uppercase pull-right">
				<?php echo $title; ?>
			</button>
		</div>
		
  </div>
</body>
</html>
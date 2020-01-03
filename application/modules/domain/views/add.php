   <div class="col-md-6">
     <?php 
                        $get_url = current_url();
                        //$get_url = str_replace("http://localhost/seo-admin/index.php/domain/add/", "0", $get_url);
						 $get_url = str_replace("http://micro.filliptechnologies.com/admin-seo/index.php/domain/add/", "0", $get_url);
						 //var_dump($get_url);
						 //die();
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
      <h3 class="text-uppercase"><?php echo $title; ?> Domain</h3>
       <form class="form-horizontal" role="form" method="post" action="<?php echo base_url()."index.php/domain/".$submit; ?>" enctype="multipart/form-data">
         <?php 
                            if($get_url == "0")
                             {                               
                                $domain = "";

                             }
                            else{
                               foreach ($single_content as $datas)
                                { 
                                  $domain = $datas->domain;
                                } 
                            }?>
         <input type="hidden" id="updateby" name="updateby" value="<?php echo $email; ?>" >
       
          <?php echo form_label('Domain : ');?><?php echo form_error('domain');?>          
          <input type="text" class="form-control" name="domain" id="domain" value="<?php echo $domain; ?>">
        
         <div class="clearfix"></div><br/>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary text-uppercase">
                <?php echo $title; ?>
            </button>
        </div>
  </div>
</body>
</html>
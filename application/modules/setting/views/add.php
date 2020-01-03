   <div class="col-md-6 col-md-offset-2">
     <?php 
             $get_url = current_url();
             //$get_url = str_replace("http://192.168.2.28/ftp/micro/admin-seo/index.php/setting/add/", "0", $get_url);
			 $get_url = str_replace("http://micro.filliptechnologies.com/admin-seo/index.php/setting/add/", "0", $get_url);
						 //var_dump($get_url);
						 //die();
                        if($get_url == "0")
                        {
                            $title="add";
                            $submit = "add";
                        }
                        else{ 
                            //$single_content = array(); 
                            if(!empty($single_content)){                         
                              foreach ($single_content as $datas)
                                { 
                                   $id = $datas->id;
                                }
                            }
                              $title="edit";
                              $submit="edit/".$id;
                        }
                        
                    ?>
      <h3 class="text-uppercase"><?php echo $title; ?> Domain</h3>
       <form class="form-horizontal" role="form" method="post" action="<?php echo base_url()."index.php/setting/".$submit; ?>" enctype="multipart/form-data">
         <?php 
                            if($get_url == "0")
                             {                               
                                $emails = "";
                                $contact_number = "";
                                $cc_emails = "";

                             }
                            else{
                              if(!empty($single_content)){     
                               foreach ($single_content as $datas)
                                { 
                                  $emails = $datas->emails;
                                  $contact_number = $datas->contact_number;
                                  $cc_emails = $datas->cc_emails;
                                } 
                              }
                            }?>
         <input type="hidden" id="updateby" name="updateby" value="<?php echo $email; ?>" >
       
          <?php echo form_label('Email Id :');?><?php echo form_error('emails');?>          
          <input type="text" class="form-control" name="emails" id="emails" value="<?= $emails ?>">
          <?php echo form_label('CC Email Id :');?>          
          <input type="text" class="form-control" name="cc_emails" id="cc_emails" value="<?= $cc_emails ?>">
          <?php echo form_label('Contact Number :');?><code class="text-danger">(Enter multiple number with ",")</code><?php echo form_error('contact_number');?>          
          <input type="number" class="form-control" name="contact_number" id="contact_number" value="<?= $contact_number ?>">
         <div class="clearfix"></div><br/>
        <div class="col-md-2 pull-right">
            <button type="submit" class="btn btn-primary text-uppercase">
                <?php echo $title; ?>
            </button>
        </div>
  </div>
</body>
</html>
   <div class="col-md-6 col-md-offset-2">
     <?php 
             $get_url = current_url();
            // $get_url = str_replace("http://192.168.2.28/ftp/micro/admin-seo/index.php/seoclient/add/", "0", $get_url);
			$get_url = str_replace("http://micro.filliptechnologies.com/admin-seo/index.php/seoclient/add/", "0", $get_url);
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
                              $title="Update";
                              $submit="edit/".$id;
                        }
                        
                    ?>
      <h3 class="text-uppercase"><?php echo $title; ?> Seo Clients</h3>
       <form class="form-horizontal" role="form" method="post" action="<?php echo base_url()."index.php/seoclient/".$submit; ?>" enctype="multipart/form-data">
         <?php 
                  if($get_url == "0")
                   {                               
                      $clients_name = "";
					  $start_date = "";								
                      $renewal_date = "";
                      $total_amount = "";
                      $paid_amount = "";
                      $payment_status = "";
					  $readnolny = '';
			     }
                  else{
                    if(!empty($single_content)){     
                     foreach ($single_content as $datas)
                      { 
                        $clients_name = $datas->clients_name;
                        $start_date = $datas->start_date;
                        $renewal_date = $datas->renewal_date;
                        $total_amount = $datas->total_amount;
                        $paid_amount = $datas->paid_amount;
                        $payment_status = $datas->payment_status;
						$readnolny = "readonly";
                      } 
                    }
             }?>
          <div class="col-md-12">
			<input type="hidden" id="updateby" name="updateby" value="<?php echo $email; ?>" >       
			<?php echo form_label('Client Name :');?><?php echo form_error('clients_name');?>  
			 <input type="text" class="form-control" name="clients_name" id="clients_name" value="<?= $clients_name ?>" required>     
         </div>
		 <div class="clearfix"></div>
		 <div class="col-md-6">             
          <?php echo form_label('Start Date :');?><?php echo form_error('start_date');?>
		  <input type="date" class="form-control" name="start_date" id="start_date" value="<?= $start_date ?>" <?= $readnolny ?> required>
		 </div>
		 <div class="col-md-6">
		  <?php echo form_label('Renewal Date :');?><?php echo form_error('renewal_date');?><input type="date" class="form-control" name="renewal_date" id="renewal_date" value="<?= $renewal_date ?>">
		
		  <input type="hidden" class="form-control" name="pre_renewal_date" id="pre_renewal_date" value="<?= $renewal_date ?>" required>
		 </div>
		 <div class="col-md-6">
		  <?php echo form_label('Toatal Amount :');?><?php echo form_error('total_amount');?><input type="number" class="form-control" name="total_amount" id="total_amount" value="<?= $total_amount ?>" required>
		 </div>
		 <div class="col-md-6">
		  <?php echo form_label('Paid Amount :');?><?php echo form_error('paid_amount');?><input type="number" class="form-control" name="paid_amount" id="paid_amount" value="<?= $paid_amount ?>" required>
		 </div>
		 <div class="col-md-6">
          <?php echo form_label('Payment Status :');?><?php echo form_error('payment_status');?>
		  <!--input type="text" class="form-control" name="payment_status" id="payment_status" value=""-->
		  <select class="form-control" name="payment_status" id="payment_status" required>
			<option value="">--Select Payment Status--</option>
			<option <?= $payment_status == 'Paid' ? 'selected':'' ?> value="Paid">Paid</option>
			<option <?= $payment_status == 'Partial' ? 'selected':'' ?> value="Partial">Partial</option>
			<option <?= $payment_status == 'Unpaid' ? 'selected':''?> value="Unpaid">Unpaid</option>
		  </select>
		  </div>
        <div class="col-md-2 pull-right"><br/><br/>
            <button type="submit" class="btn btn-primary text-uppercase">
                <?php echo $title; ?>
            </button>
        </div>		
  </div>
</body>
</html>
   <div class="col-md-8 col-md-offset-1">
     
      <h3 class="text-uppercase">Add Seo Clients</h3>
       <form class="form-horizontal" role="form" method="post" action="<?php echo base_url()."index.php/smsclients/add" ?>" enctype="multipart/form-data">
         
          <div class="col-md-6">             
            <?php echo form_label('First Name <code>*</code>:');?><?php echo form_error('fname');?>  
             <input type="text" class="form-control" name="fname" id="fname" value="" >     
          </div>
          <div class="col-md-6">      			 
      			<?php echo form_label('Last Name <code>*</code>:');?><?php echo form_error('lname');?>  
      			 <input type="text" class="form-control" name="lname" id="lname" value="" >     
          </div>
    		  <div class="clearfix"></div>
          <div class="col-md-6">            
            <?php echo form_label('User Name <code>*</code>:');?><?php echo form_error('user_name');?>  
             <input type="text" class="form-control" name="user_name" id="user_name" value="" >
             <small><code>Not using white space in username eg. - filliptechnologies</code></small>   
          </div>          
    		  <div class="col-md-6">             
            <?php echo form_label('Contact Number <code>*</code>:');?><?php echo form_error('mob_no');?>
		        <input type="number" class="form-control" name="mob_no" id="mob_no" value="" >
		      </div>
           <div class="clearfix"></div>
    		  <div class="col-md-6">
            <?php echo form_label('Email Id <code>*</code>:');?><?php echo form_error('user_email');?>
            <input type="email" class="form-control" name="user_email" id="user_email">
          </div>          
    		 <div class="col-md-6">
    		  <?php echo form_label('Expiry Date <code>*</code>:');?><?php echo form_error('expiry');?>
          <input type="date" class="form-control" name="expiry" id="expiry" >
          <input type="hidden" name="utype" id="utype" value="5" readonly="true">
    		 </div>    		 
          <div class="col-md-2 pull-right"><br/><br/>
            <button type="submit" class="btn btn-primary text-uppercase">Add
            </button>
          </div>		
      </div>
  </body>
</html>
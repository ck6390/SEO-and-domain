<div class="col-md-10">
  <a href="<?=base_url() ?>index.php/smsclients/add" class="pull-right btn btn-success btn-xs">Add Clients</a>
</div>
<div class="col-md-10">
  <div class="table-responsive">     
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
            <tr>
              <th>Sl.</th>          
              <th>Client Id</th>          
              <th>Auth key</th>          
              <th>User Name</th>            
              <th>Password</th> 
              <th>Email Id</th>
              <th>Contact No.</th>
              <th>Expiry Date</th>              
              <th>Action</th>
              <th>Client Name</th>
              <th>Status</th>    
            </tr>
          </thead>
          <tbody>
        <?php 
            $counter = 1;
            $auth_key = get_auth_key();
           // var_dump($auth_key);
            for($i=0; $i<sizeOf($sms_client); $i++){                         
        ?>
        <tr>        
            <td><?= $counter++ ?></td>           
            <td><?= $sms_client[$i]['userId'] ?></td>           
            <td><?php                                   
                 //die();
                $auth_key_sms = '';
                 if(@$auth_key[$sms_client[$i]['userName']]['user_name'] == $sms_client[$i]['userName']){
                   echo$auth_key_sms.=@$auth_key[$sms_client[$i]['userName']]['auth_key'];
                 }
            ?></td>           
            <td><?= $sms_client[$i]['userName'] ?></td>
            <td><?= $sms_client[$i]['password'] == "30de442afa3d35ba116c417f252e7422" ? "Admin_123$$" : '' ?></td>            
            <td><?= $sms_client[$i]['emailed'] ?></td>
            <td><?= '+91-'.$sms_client[$i]['phone'] ?></td>
            <td><?php if(!empty($sms_client[$i]['expiryDate'])){ echo date('d-M-Y',strtotime($sms_client[$i]['expiryDate'])); }else{ echo "NA"; } ?></td>
            <td>  
              <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown">More
                <span class="caret"></span></button>
                <ul class="dropdown-menu">                  
                  <li>
                    <a href="#" id="<?= $sms_client[$i]['userId'] ?>" class="check_sms" c_name ="<?= $sms_client[$i]['userName'] ?>">Check SMS</a>
                  </li>
                  <li>
                    <a href="#" id="<?= $sms_client[$i]['userId'] ?>" class="updateExpiry" c_name ="<?= $sms_client[$i]['userName'] ?>">Update Expiry</a>
                  </li>
                  <li>
                    <a href="#" class="forgetPassword" c_name="<?= $sms_client[$i]['userName'] ?>">Forget Password</a>
                  </li>
                  <li>
                    <a href="#" class="changePassword" c_name="<?= $sms_client[$i]['userName'] ?>">Change Password</a>
                  </li>
                  <li>
                    <a href="#" class="removeClient" c_name="<?= $sms_client[$i]['userName'] ?>" id="<?= $sms_client[$i]['userId'] ?>">Remove User</a>
                  </li>
                  <li>
                    <a href="#" id="<?= $sms_client[$i]['userId'] ?>" class="add_fund" c_name ="<?= $sms_client[$i]['userName'] ?>">Add/Deduct Fund</a>
                  </li>
                </ul>
              </div>
            </td>
            <td><?= $sms_client[$i]['firstName']." ".$sms_client[$i]['lastName'] ?></td>
            <td><?= $sms_client[$i]['isActive'] == 1 ? 'Active' : 'In-active' ?></td>
        </tr>
        <?php } ?>           
        </tbody>      
      </table>
  </div>
</div>
<style type="text/css">
  .dropdown-menu{
    left: auto !important;
    right:0;
  }
</style>
<script type="text/javascript">
$(document).ready(function(){
 // Check SMS Balance
  $(".check_sms").on('click',function()
   {
      var user_name = $(this).attr("c_name").toString();     
      var client_id = $(this).attr("id").toString();     
      $.ajax({
        url:"<?= site_url() ?>/smsclients/check_sms_bal/",
        method: "POST",
        data:{client_id:client_id},     
        success:function(data)
        {
          $("#check_sms_pop").modal('show');
          $('.user_name_bal').html(user_name);
          $('.sms_bal_check').html(data);
        }
      });
    });
    // Open only modal for udate expiry
    $(".updateExpiry").on('click',function()
    {
      var user_id = $(this).attr("id").toString();
      var user_name = $(this).attr("c_name").toString();      
      $("#updateExpiry").modal('show');
      $('.user_name_bal').html(user_name);
      $('#user_name').val(user_name);
      $('#user_id').val(user_id);
      
    });
   // update expiry
    $("#update_exp").on('click',function()
     {
        var user_id = $("#user_id").val();
        var user_name = $("#user_name").val();       
        var exp_date = $("#exp_date").val();       
        $.ajax({
          url:"<?= site_url() ?>/smsclients/update_expiry/",
          method: "POST",
          data:{user_id:user_id,user_name:user_name,exp_date:exp_date},     
          success:function(data)
          {
            $("#updateExpiry").modal('show');
            $('.user_name_bal').html(user_name);
            $('.success_msg').html(data);
          }
        });
      });

    // Forget Password 
    $(".forgetPassword").on('click',function()
     {        
        var user_name = $(this).attr("c_name");
        //alert(user_name);          
        $.ajax({
          url:"<?= site_url() ?>/smsclients/forget_password/",
          method: "POST",
          data:{user_name:user_name},     
          success:function(data)
          {
            $("#forgetPassword").modal('show');
            $('.user_name_bal').html(user_name);
            $('.success_msg_for_pass').html(data);
          }
        });
      });

     // Open only modal for change password
    $(".changePassword").on('click',function()
    {
      var user_name = $(this).attr("c_name").toString();      
      $("#changePassword").modal('show');
      $('.user_name_bal').html(user_name);
      $('#user_name').val(user_name);    
    });

    // change password
    $("#change_pass").on('click',function()
     {
        var user_name = $("#user_name").val();       
        var password = $("#password").val();       
        $.ajax({
          url:"<?= site_url() ?>/smsclients/change_password/",
          method: "POST",
          data:{user_name:user_name,password:password},     
          success:function(data)
          {
            $("#changePassword").modal('show');
            $('.user_name_bal').html(user_name);
            $('.success_msg_change_pass').html(data);
          }
        });
      });

     // send otp
     $(".removeClient").on('click',function()
      {
        var user_id = $(this).attr("id").toString();
        var user_name = $(this).attr("c_name").toString();       
        $.ajax({
          url:"<?= site_url() ?>/smsclients/send_otp/",
          method: "POST",
          data:{user_name:user_name,user_id:user_id},     
          success:function(data)
          {
            $("#removeClient").modal('show');
            $('.user_name_bal').html(user_name);
            $('.success_msg_remove').html(data);
          }
        });
      });

      // verify otp
     $("#verify_otp").on('click',function()
      {
        var otp = $("#otp").val();
        $.ajax({
          url:"<?= site_url() ?>/smsclients/verify_otp/",
          method: "POST",
          data:{otp:otp},     
          success:function(data)
          {
            $("#removeClient").modal('show');
            //$('.user_name_bal').html(user_name);
            $('.success_msg_remove').html(data);
          }
        });
      });

      // Open only modal for add fund
    $(".add_fund").on('click',function()
    {
      var user_id = $(this).attr("id").toString();
      var user_name = $(this).attr("c_name").toString(); 
      $.ajax({
        url:"<?= site_url() ?>/smsclients/send_otp/",
        method: "POST",
        data:{user_name:user_name,user_id:user_id},     
        success:function(data)
        {     
          $("#addFund").modal('show');
          $('.user_name_bal').html(user_name);
          $('#user_id').val(user_id);
        }
      });
    });

      // Add & deduct fund
    $("#add_fund").on('click',function()
    {
      var user_id = $("#user_id").val();       
      var routeId = $("#routeId").val();          
      var sms = $("#sms").val();          
      var amount = $("#amount").val();          
      var trasactiontype = $("#trasactiontype").val();          
      var description = $("#description").val();          
      var otp_fund = $("#otp_fund").val();          
      $.ajax({
          url:"<?= site_url() ?>/smsclients/add_fund/",
          method: "POST",
          data:{routeId:routeId,user_id:user_id,sms:sms,amount:amount,trasactiontype:trasactiontype,description:description,otp_fund:otp_fund},     
          success:function(data)
          {
            $("#addFund").modal('show');
            $('.user_name_bal').html(user_name);
            $('.success_msg_add_fund').html(data);
          }
      });      
    });
  });
</script>
<div class="container">
  <!-- - - - SMS Check ------>
    <div class="modal fade" id="check_sms_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog">     
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h2 class="user_name_bal"></h2>
           </div>

            <table class="table table-bordered table-striped">           
             <tbody class="sms_bal_check text-center">
               
             </tbody>
            </table>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- - - - Update expiry ------>
    <div class="modal fade" id="updateExpiry" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog">     
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h2 class="user_name_bal"></h2>
           </div>
            <div class="col-md-8 col-md-offset-2"><br/>
               <input type="hidden" name="user_id" id="user_id" class="form-control">
               <input type="hidden" name="user_name" id="user_name" class="form-control">
               <input type="date" name="exp_date" id="exp_date" class="form-control" required="">
               <br/>
               <a href="#" class="btn btn-success" id="update_exp">Update</a>
               <br/>
               <div class="success_msg"></div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- - - - Update expiry ------>
    <div class="modal fade" id="forgetPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog">     
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h2 class="user_name_bal"></h2>
           </div>
            <div class="col-md-12"><br/>              
               <div class="success_msg_for_pass"></div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- - - - Change Password ------>
    <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog">     
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h2 class="user_name_bal"></h2>
           </div>
            <div class="col-md-8 col-md-offset-2"><br/>              
               <div class="col-md-8 col-md-offset-2"><br/>               
               <input type="hidden" name="user_name" id="user_name" class="form-control">
               <input type="text" name="password" id="password" class="form-control" placeholder="Password" required>
               <br/>
               <a href="#" class="btn btn-success" id="change_pass">Update</a>
               <br/>
               <div class="success_msg_change_pass"></div>
            </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


    <!-- - - - Remove Client ------>
    <div class="modal fade" id="removeClient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog">     
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h2 class="user_name_bal"></h2>
           </div>
            <div class="col-md-8 col-md-offset-2"><br/>              
               <div class="col-md-8 col-md-offset-2"><br/>               
               <input type="hidden" name="user_name" id="user_name" class="form-control">
               <input type="text" name="otp" id="otp" class="form-control" placeholder="Enter OTP" required>
               <br/>
               <a href="#" class="btn btn-success" id="verify_otp">Verify</a>
               <br/>
               <div class="success_msg_remove"></div>
            </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

     <!-- - - - Add Fund ------>
    <div class="modal fade" id="addFund" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog">     
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h2 class="user_name_bal"></h2>
           </div>
            <div class="col-md-8 col-md-offset-2">
               <input type="hidden" name="user_id" id="user_id" class="form-control">
               <input type="hidden" name="routeId" id="routeId" class="form-control" value="1">
               <div class="clearfix"></div><br/>
               <div class="col-md-6">
                 <input type="text" name="sms" id="sms" class="form-control" placeholder="Quantity" required="true">
               </div>             
               <div class="col-md-6">
                <input type="number" name="amount" id="amount" class="form-control col-md-6" placeholder="Amount per sms" required="true">
               </div>
               <div class="clearfix"></div><br/>
               <div class="col-md-12">
               <select class="form-control" name="trasactiontype" id="trasactiontype">
                 <option value="">--Select Type--</option>
                 <option value="Normal">Normal</option>
                 <option value="Deduct">Deduct</option>
               </select>
               </div>
               <div class="clearfix"></div><br/>
               <div class="col-md-12">
                 <textarea class="form-control" name="description" id="description" required="true" placeholder="Description"></textarea>
                </div> 
               <div class="clearfix"></div><br/>
               <div class="col-md-12">
                <input type="text" name="otp_fund" id="otp_fund" class="form-control" placeholder="OTP">
               </div>
               <div class="clearfix"></div><br/>
               <div class="col-md-12">
                <a href="#" class="btn btn-success" id="add_fund">Add/Deduct Fund</a>
              </div>
              <div class="clearfix"></div><br/>
              <div class="success_msg_add_fund"></div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
</div>

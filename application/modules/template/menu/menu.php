 <div class="col-md-2 no-padding pull-left">
   <ul class="list-group">
      <li class="list-group-item border_radius_none"><i class="fa fa-dashboard"></i> <?php echo anchor('dashboard/dashboards', 'Dashboard');?></li>    
      <li class="list-group-item border_radius_none"><i class="fa fa-dashboard"></i> <?php echo anchor('domain', 'Domain List');?></li>    
      <li class="list-group-item border_radius_none"><i class="fa fa-dashboard"></i> <?php echo anchor('domain/get_domain_from_server', 'Server Domain');?></li>    
      <li class="list-group-item border_radius_none"><i class="fa fa-dashboard"></i> <?php echo anchor('tag', 'Seo Tag');?></li>    
      <li class="list-group-item border_radius_none"><i class="fa fa-dashboard"></i> <?php echo anchor('setting', 'Setting');?></li>    
      <li class="list-group-item border_radius_none"><i class="fa fa-dashboard"></i> <?php echo anchor('seoclient', 'Seo Clients');?></li>    
      <li class="list-group-item border_radius_none"><i class="fa fa-dashboard"></i> <?php echo anchor('smsclients', 'SMS Clients');?></li>   
      <li class="list-group-item border_radius_none"><a href="#" class="ckeck_reseller_balance"><i class="fa fa-dashboard"></i> Check Reseller Balance</a> </li>
   </ul>
 </div> 
<script type="text/javascript">
$(document).ready(function(){
 // Check SMS Balance
  $(".ckeck_reseller_balance").on('click',function()
   {
          
      $.ajax({
        url:"<?= site_url() ?>/smsclients/ckeck_reseller_balance_sms/",
        method: "POST",    
        success:function(data)
        {
          $("#myModal").modal('show');
          $(".check_sms_reseller_bal").html(data);         
        }
      });
    });
});
</script>
 <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reseller Balance</h4>
        </div>
        <div class="modal-body table-responsive">
          <table class="table-bordered table-striped table">
            <thead>
              <tr>
                <th>Sl.No.</th>
                <th>Route Type</th>
                <th>Available Balance</th>
            </thead>
              </tr>
            <tbody class="check_sms_reseller_bal">              
             
            </tbody>
          </table>         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
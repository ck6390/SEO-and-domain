<script src="<?php echo base_url(); ?>assets/js/uploadProfile.js"></script>
<div class="col-md-10">
    <?php if($this->session->flashdata('login_success')) : ?>
    <div class="col-md-10">
        <div class="alert alert-success auto_hide" role="alert">
            <h3><?php echo $name; ?> <small><?php echo $this->session->flashdata('login_success');?></small></h3>
            
        </div>
    </div>
    <?php endif; ?>
    <div class="row mt-10px Lobster mt-20px">        
        <div class="col-md-8">
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-globe fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"> <?php
                                    $result = $this->db->query("SELECT * FROM f_domain WHERE status= 1");
                                    echo $result->num_rows();
                                ?></div>
                                <div>Domain List</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL();?>index.php/domain/" class="text-warning">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-globe fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"> <?php
                                    $result = $this->db->query("SELECT * FROM f_tag WHERE status= 1");
                                    echo $result->num_rows();
                                ?></div>
                                <div>Tag List</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL();?>index.php/tag/" class="text-warning">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div> 
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-globe fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"> 
                                <?php echo count(get_domain_lists());?></div>
                                <div>Domain Server</div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="text-warning">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
			<div class="col-lg-4 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"> <?php
                                   $result = $this->db->query("SELECT * FROM seo_clients WHERE status= 1");
                                    echo $result->num_rows();
                                ?></div>
                                <div>SEO Clients</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL();?>index.php/seoclient/" class="text-warning">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div> 
			<div class="col-lg-4 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-inr fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"> 
								<?php									
									echo total_amount_of_seo()->total_amt;
                                ?></div>
                                <div>Total Amount</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL();?>index.php/seoclient/" class="text-warning">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
			<div class="col-lg-4 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-inr fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"> 
								<?php									
									echo total_amount_of_seo()->total_amt_collection;
                                ?></div>
                                <div>Total Collection</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL();?>index.php/seoclient/" class="text-warning">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    	<div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading">Current Month Domains Expiry (<?= date('M-Y') ?>)</div>
            <div class="panel-body">                
                <ul class="no-padding list-unstyled">
                    <marquee direction="up" scrollamount="2" onmouseover="stop();" onmouseout="start();" height="200px">
                        <?php 
                            $dn = get_domain_lists();
                            for($i=0; $i<sizeOf($dn); $i++)
                            {
                                if(date('M-Y',strtotime(@$dn[$i]['expires'])) == date('M-Y'))
                                {
                        ?>
                      <li class="pl-8px">
                          <a href="http://<?= $dn[$i]['domain'] ?>" target="_blank" class="<?=date('d-m-Y',strtotime(@$dn[$i]['expires'])) == date('d-m-Y') ? 'text-danger' : 'black' ?>">
                            <?=date('d-m-Y',strtotime(@$dn[$i]['expires'])) == date('d-m-Y') ? '<b>' : '' ?>
                                <?= $dn[$i]['domain']." - (".date('d-M-Y',strtotime(@$dn[$i]['expires'])).")" ?>
                                </b>
                            </a>
                      </li>
                      <hr class="mt-5px" />
                      <?php } }

                       ?>
                    </marquee>
                  </ul>                
            </div>
          </div>
		   <div class="panel panel-primary">
            <div class="panel-heading">Current Month Seo Clients Expiry (<?= date('M-Y') ?>)</div>
            <div class="panel-body">                
                <ul class="no-padding list-unstyled">
                    <marquee direction="up" scrollamount="2" onmouseover="stop();" onmouseout="start();" height="200px">
                        <?php 
							foreach($get_data as $obj){								
							//}
                            //$dn = get_domain_lists();
                            //for($i=0; $i<sizeOf($get_data); $i++)
                           // {
                                if(date('M-Y',strtotime(@$obj->renewal_date)) == date('M-Y'))
                                {
                        ?>
                      <li class="pl-8px">
                          <a href="#" class="<?=date('d-m-Y',strtotime(@$obj->renewal_date)) == date('d-m-Y') ? 'text-danger' : 'black' ?>">
                            <?=date('d-m-Y',strtotime(@$obj->renewal_date)) == date('d-m-Y') ? '<b>' : '' ?>
                                <?= $obj->clients_name." - (".date('d-M-Y',strtotime(@$obj->renewal_date)).")" ?>
                                </b>
                            </a>
                      </li>
                      <hr class="mt-5px" />
                      <?php } }

                       ?>
                    </marquee>
                  </ul>
                
            </div>
          </div>
        </div>
        <?php  

        //echo strtotime('+7 days'); ?>
    </div>
</div>
</body>
</html>
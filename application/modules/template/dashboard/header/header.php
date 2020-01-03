<div class="fluid-container full_header">
<div class="col-md-2 col-sm-4 border_right_1">
  <h3 class="white mt-10px">Admin Panel</h3>
</div>
<div class="col-md-8 col-sm-4">
  <h1 class="white mt-10px">Welcome to <?php if(!empty($name)){ echo $name; }?>
  </h1>
</div>
<div class="col-md-2 col-sm-4">
  <ul class="nav navbar-top-links navbar-right">
  <li><?php echo anchor('logout', 'Logout');?></li>
  </ul>
</div>
</div>


          
           
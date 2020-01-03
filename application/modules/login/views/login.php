<?php //print_r($this->session->flashdata());?>
<div class="container-fluid login-bg">
     <div class="row">
        <?php if($this->session->flashdata('logout_success')) : ?>
        <div class="col-md-4 col-md-offset-4">
            <div class="alert alert-success auto_hide" role="alert">
                <?php echo $this->session->flashdata('logout_success');?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="col-md-4 col-md-offset-4 mt-10per login animated slideInDown text-center">
        <p> <?php
            
            if($this->session->flashdata('error')){
            echo $this->session->flashdata('error');
            }
            $form_attr = array('class' => "form-signin" ,  'id' => "form-signin");
            echo form_open('login/process', $form_attr);
        ?>  </p>
        <h2 class="form-signin-heading text-center">Please sign in</h2>
         <input type="hidden" name="url" id="url" value="<?php 
             $this->load->helper('url');
            $url_parts = parse_url(current_url());
            echo str_replace('www.', '', $url_parts['host']);
                          
                ?>" class="form-control">
        <?php
        echo form_label('Email Address', 'inputEmail' , array ( 'class' => "sr-only"));
        $email_attr = array('name'=> 'email','value' => set_value('email',''), 'class'=>'form-control border_radius_none', 'placeholder' => 'Email address', 'id' => 'inputEmail', 'type' => 'email');
        echo form_input($email_attr);
                    echo "<br/>";
        echo form_label('Password', 'inputPassword' , array ( 'class' => "sr-only"));
        $pass_attr = array('name'=> 'password', 'class'=>'form-control border_radius_none', 'placeholder' => 'Password' , 'id' => 'inputPassword');
        echo form_password($pass_attr);
        ?>
        <!-- <select class="form-control border_radius_none" name="usertype" id="usertype">
            <option value="Ad">Admin</option>
            <option value="Ur">User</option>
            
        </select> -->
        <input type="hidden" name="usertype" id="usertype" class="form-control" value="Ad">
        <br/>
        <?php
        $btn_attr = array('name'=> 'submit', 'content'=>'Sign in', 'class' => 'btn btn-primary btn-block border_radius_none' , 'type' => 'submit' );
        echo form_button($btn_attr);
        echo form_close();
        ?>
        
    </div>

    </div> <!-- /container -->
    
</body>
</html>
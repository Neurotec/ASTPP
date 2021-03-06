<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML+RDFa 1.1//EN" "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xml:lang="en" xmlns:fb="http://ogp.me/ns/fb#" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>	ASTPP - Open Source Voip Billing Solution</title>
    <link rel="icon" href="<? echo base_url(); ?>assets/images/favicon.ico">
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/fonts/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/global-style.css" rel="stylesheet" type="text/css">
    
     <!-- IE -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/respond.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/respond.src.js"></script>
    <noscript>
	 <div id="noscript-warning">
	  ASTPP work best with JavaScript enabled
	</div>
    </noscript>
    <style>
    .form-control{
     height:40px;
    }
    .input-group .form-control{
    border-radius: 0px !important;
    }
    </style>
</head>
<body style="overflow-y:hidden !important;background: #343434 none repeat scroll 0% 0%;">
<section class="slice">
	<div class="w-section inverse">
    	<div class="container">
        
            <div class="row">

			<div class="col-md-4 col-md-offset-4">&nbsp;<span class="login_error">
                        <?php if (isset($astpp_notification)){ ?>
                        Login unsuccessful. Please make sure you entered the correct username and password, and that your account is active.
                    <?php }else{
                         echo "&nbsp;";
                    } 
			$astpp_err_msg = $this->session->flashdata('astpp_signupmsg');
			    if ($astpp_err_msg) {
				echo $astpp_err_msg;
			    }
			?>
                    </span></div> <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
            	<div class="col-md-4 col-md-offset-4">
                    <div class="w-section inverse no-padding margin-t-20">                       
                        <div class="w-box dark sign-in-wr box_shadow margin-b-10">
                          <div class="">
                          <div class="col-md-9">
                           	<img alt="login" src="<?= base_url() ?>assets/images/logo.png">
                           </div>
                           <div class="col-md-3">
							   <a class="btn btn-success col-md-12 margin-t-10" href="<?php echo base_url();?>">Login</a>

						   </div>
                           
                            
                           
                           </div> 
<?php 

if ($user_data['success'])
{

	echo "<div class=\"col-md-12 margin-t-20 padding-r-32 padding-l-32\" style=\"color: #232222;\">Your account has been created successfully!!!</div>";
	echo "<div class=\"col-md-12 margin-t-10 padding-r-32 padding-l-32\" style=\"color: #232222;\">Here is your login information :</div>";
	
	echo "<div class=\"col-md-12 margin-t-10 padding-r-32 padding-l-32\" style=\"color: #232222;\">Username : ".$user_data['number']."</div>";
	echo "<div <div class=\"col-md-12 margin-t-10 margin-b-10 padding-r-32 padding-l-32\" style=\"color: #232222;\">Password : ".$this->common->decode($user_data['password'])."</div>";
	echo "<br><br>";
	  
	 }else
	 {
	echo "<div class=\"col-md-12 margin-t-10 margin-b-20 padding-r-32 padding-l-32\" style=\"color: #232222;\">Link is Expire Please Try Again</div><br>";
echo "";
       }
?>
	
                        
                            </div>
                   </div>
            </div>
        </div>
    </div>
</section>
                </body>
                </html>

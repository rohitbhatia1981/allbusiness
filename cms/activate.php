<?php include "../private/settings.php";

print $sqlCheck="select * from tbl_members where member_email_verification_code='".$database->filter($_GET['auth'])."' and member_email_verify=0 and member_id='".$database->filter(decryptId($_GET['e']))."'";

$resCheck=$database->get_results($sqlCheck);
if (count($resCheck)>0)
{

$rowMemberid=$resCheck[0];


							       
			        

$authorize=1;


$update="update tbl_members set member_email_verify=1 where member_id='".$rowMemberid['member_id']."'";
$database->query($update);

include PATH."include/email-templates/email-template.php";
include_once PATH."mail/sendmail.php";

//--------Settings all values--------
				
				$receiverName=$rowMemberid['patient_title']." ".$rowMemberid['patient_first_name']." ".$rowMemberid['patient_middle_name']." ".$rowMemberid['patient_last_name'];
				$email=$rowMemberid['patient_email'];
				$forgotPwd='<a href="'.URL.'cms/forgot-password">here</a>';
				//$contactus='<a href="'.URL.'contact-us">contact us</a>';
				
				//end Settings all values

				$sqlEmail="select * from tbl_emails where email_id=5 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("-","&bull;&nbsp;",$emailContent);
					$emailContent=str_replace("<email>",$email,$emailContent);
					$emailContent=str_replace("<forgot_password_link>",$forgotPwd,$emailContent);
					//$emailContent=str_replace("<contact_us_link>",$contactus,$emailContent);
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				


				$ToEmail=$rowMemberid['member_email'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Welcome to All Business";
				$BodySend=$mailBody;	

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
			
			

}
else
$authorize=0;

include PATH."include/headerhtml.php"
 ?>
  <body style="padding-top:0px;">  
<section class="register_screen">
    <div class="container">
        <div class="logo_box">
        <a href="<?php echo URL?>" class="logo"><img src="<?php echo URL?>images/logo.png"></a>
        </div>
        <div class="register_box">
        
        			 <div align="center">
                     	<h3>Account Activation</h3>
                        <br>
                        <?php if ($authorize==1)
						{
							
							
							$_SESSION['sess_member_id'] = $rowMemberid['member_id'];					
							$_SESSION['sess_member_groupid'] = 4;	
							
							
						?>
                     	<p>Your account has been activated</p>
                        <p><button id="submitBtn" type="button" class="btn btn-danger btn-lg d-inline-flex align-items-center ps-5 pe-5 w50p" onClick="window.location='<?php echo URL?>cms/member/'">My Account</button></div></p>
                        <?php } else {?>
                        <p style="color:#F00">Wrong / expired verification link.</p>
                        <?php } ?>
                     </div>
        
        </div>
    </div>
</section>




  
  </body>
</html>


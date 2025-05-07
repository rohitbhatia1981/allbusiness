<?php //include_once "../../private/settings.php";







function generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading="",$bottomText="")



{







if ($buttonTitle=="")



$buttonTitle="Contact us";







if ($buttonLink=="")



$buttonLink=URL."pages/contact";







$siteurl=URL;







$logoURL=$siteurl."images/logo.png";



$fbImage=$siteurl."images/facebook.png";



$fbURL="https://www.facebook.com/allbusiness.com.au/";



$twitterImage=$siteurl."images/twitter.png";



$twitterURL="https://twitter.com/allbusiness2";







$emailBody = <<<EMAILBODY







    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



    <html xmlns="http://www.w3.org/1999/xhtml">



    <head>



      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



      <title>[SUBJECT]</title>



      <style type="text/css">



      body {
       padding-top: 0 !important;
	   color:#000;
       padding-bottom: 0 !important;
       padding-top: 0 !important;
       padding-bottom: 0 !important;
       margin:0 !important;
       width: 100% !important;
       -webkit-text-size-adjust: 100% !important;
       -ms-text-size-adjust: 100% !important;
       -webkit-font-smoothing: antialiased !important;
	   

     }



     .tableContent img {
       border: 0 !important;
       display: block !important;
       outline: none !important;
     }

     a{
      color:#382F2E;
    }

    p, h1{
      color:#000;
      margin:0;

    }

    p{
      text-align:left;
      color:#000;
      font-size:16px;
      font-weight:normal;
      line-height:19px;

    }
	
	 td{
     
      color:#000;
      font-size:16px;
     

    }
	
    a.link1{
      color:#382F2E;

    }
    a.link2{
      font-size:16px;
      text-decoration:none;
      color:#ffffff;
    }

    h2{
      text-align:left;
       color:#222222; 
       font-size:19px;
      font-weight:normal;
    }
    div,p,ul,h1{
      margin:0;
    }

    .bgBody{
      background: #ffffff;
    }

    .bgItem{
      background: #ffffff;
    }


@media only screen and (max-width:480px)



		



{



		



table[class="MainContainer"], td[class="cell"] 



	{



		width: 100% !important;



		height:auto !important; 



	}



td[class="specbundle"] 



	{



		width:100% !important;



		float:left !important;



		font-size:13px !important;



		line-height:17px !important;



		display:block !important;



		padding-bottom:15px !important;



	}



		



td[class="spechide"] 



	{



		display:none !important;



	}



	    img[class="banner"] 



	{



	          width: 100% !important;



	          height: auto !important;



	}



		td[class="left_pad"] 



	{



			padding-left:15px !important;



			padding-right:15px !important;



	}



		 



}



	



@media only screen and (max-width:540px) 







{



		



table[class="MainContainer"], td[class="cell"] 



	{



		width: 100% !important;



		height:auto !important; 



	}



td[class="specbundle"] 



	{



		width:100% !important;



		float:left !important;



		font-size:13px !important;



		line-height:17px !important;



		display:block !important;



		padding-bottom:15px !important;



	}



		



td[class="spechide"] 



	{



		display:none !important;



	}



	    img[class="banner"] 



	{



	          width: 100% !important;



	          height: auto !important;



	}



	.font {



		font-size:18px !important;



		line-height:22px !important;



		



		}



		.font1 {



		font-size:18px !important;



		line-height:22px !important;



		



		}



}







    </style>















  </head>



  <body paddingwidth="0" paddingheight="0"   style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">



    <table bgcolor="#ffffff" width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent" align="center"  style='font-family:Helvetica, Arial,serif;'>



  <tbody>



    <tr>



      <td><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff" class="MainContainer">



 



  <tbody>



    <tr>



      <td valign="top" width="40">&nbsp;</td>



      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">



  <tbody>



  <!-- =============================== Header ====================================== -->   



    <tr>



    	<td height='75' class="spechide">



			 <a href="$siteurl"><img  src="$logoURL" alt="" style="max-width:200px"></a>



		</td>



        







    </tr>



    <tr>



      <td class='movableContentContainer ' valign='top'>



      	<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">



        	<table width="100%" border="0" cellspacing="0" cellpadding="0">



  <tbody>



    

    <tr>



      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">



  <tbody>



  



  </tbody>



</table>



</td>



    </tr>



  </tbody>



</table>



        </div>



        <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">



        	



        </div>



        <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">



        	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">



                          <tr><td height='25'></td></tr>



                          <tr>



                            <td align='left'>



                              <div class="contentEditableContainer contentTextEditable">



                                <div class="contentEditable" align='center'>



                                  <h2 style='font-family:Helvetica, Arial,serif; font-size:18px'>$headingTemplate</h2>



                                </div>



                              </div>



                            </td>



                          </tr>







                          <tr><td height='15'> </td></tr>







                          <tr>



                            <td align='left'>



                              <div class="contentEditableContainer contentTextEditable">



                                <div class="contentEditable" align='center'>



                                  <p style='color:#000; font-family:Helvetica, Arial,serif'>



                                   $headingContent



                                  



                                  </p>



                                </div>



                              </div>



                            </td>



                          </tr>







                          <tr><td height='25'></td></tr>







							



                          



                          <tr><td height='20'></td></tr>



						 



						   <tr>



                            <td align='left'>



                              <div class="contentEditableContainer contentTextEditable">



                                <div class="contentEditable" align='left'>



                                  <p style='color:#000; font-family:Helvetica, Arial,serif'>




                                    <br><br>Best Regards,



                                    <br>



                                    <span style='color:#222222;'>Allbusiness</span>



                                  </p>



                                </div>



                              </div>



                            </td>



                          </tr>







                        </table>



        </div>



        <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">



        	<table width="100%" border="0" cellspacing="0" cellpadding="0">



  <tbody>

	<tr><td height="20px"></td></tr>

    <tr>



      <td style='text-align:left;color:#999;font-size:12px;font-weight:normal;line-height:20px;'><br><br>You are receiving this email because you are registered on Allbusiness.com.au. For any questions or comments please contact us at support@Allbusiness.com.au.<br><br></td>



    </tr>



    <tr>



      <td  style='border-bottom:1px solid #DDDDDD;'></td>



    </tr>



    <tr><td height='25'></td></tr>



    <tr>



      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">



  <tbody>



    <tr>



      <td valign="top" class="specbundle"><div class="contentEditableContainer contentTextEditable">



                                      <div class="contentEditable" align='center'>



                                        <p  style='text-align:left;color:#999;font-size:12px;font-weight:normal;line-height:20px;'>



                                          <span style='font-weight:bold;'>Copyright &copy; 2025 allbusiness.com.au. All Rights Reserved.</span>



                                         



                                         



                                        </p>



                                      </div>



                                    </div></td>



      <td valign="top" width="30" class="specbundle">&nbsp;</td>



      <td valign="top" class="specbundle"><table width="100%" border="0" cellspacing="0" cellpadding="0">



  <tbody>



    



  </tbody>



</table>



</td>



    </tr>



  </tbody>



</table>



</td>



    </tr>



    <tr><td height='88'></td></tr>



  </tbody>



</table>







        </div>



        







      



      </td>



    </tr>



  </tbody>



</table>



</td>



      <td valign="top" width="40">&nbsp;</td>



    </tr>



  </tbody>



</table>



</td>



    </tr>



  </tbody>



</table>



</td>



    </tr>



  </tbody>



</table>











    



      </body>



      </html>











EMAILBODY;















return $emailBody;















}































/*$headingTemplate="Thank you for Registering";















$headingContent="You have registered with allbusiness now, you can log into your account and start selling your property";















$buttonTitle="My Account";















$buttonLink="#";















































echo generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);







*/







































?>
































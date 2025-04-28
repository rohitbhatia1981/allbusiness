 <?php if ($_SESSION['sess_member_groupid']==4)
				$uTypeMember="Private Seller";
				if ($_SESSION['sess_member_groupid']==5)
				$uTypeMember=$_SESSION['sess_member_tradingname']."";
				 ?>

<style>
.alert-number {
  background-color: red;
  color: white;
  padding: 2px 4px;
  border-radius: 50%;
  font-weight: bold;
  font-size:12px;
}
.side-menu__item {
  border-radius: 6px;
  padding: 10px 15px;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
}
.side-menu__item:hover {
  background: rgba(74,108,247,0.1);
}
.sidemenu_icon {
  margin-right: 10px;
  color: #4a6cf7;
}
.slide-menu {
  padding-left: 20px;
}
.slide-item {
  padding: 8px 15px;
  display: block;
  color: #333;
}
.slide-item:hover {
  background: rgba(74,108,247,0.1);
  border-left: 3px solid #4a6cf7;
}
</style>

<!--aside open-->

<?php if ($_SESSION['sess_member_groupid']==5) { ?>
<aside class="app-sidebar" style="background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%); border-right: 1px solid rgba(0,0,0,0.05); border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
	<div class="app-sidebar__user">
		<div class="dropdown user-pro-body text-center">
			<div class="user-pic">
				<img src="<?php echo URL?>images/allbusiness_Logo.svg" alt="">
			</div>
			<div style="height:20px"></div>
			<div class="user-info">
				
                <h5 style="color:#06C"><?php echo $uTypeMember; ?></h5>
              
                <h6 style="color:#999">Trial Period: <strong>10 days left</strong></h5>
			</div>
		</div>
	</div>

	<ul class="side-menu" style="padding-top:70px">
		<!-- 1) Dashboard -->
		<li class="slide <?php if ($_GET['c']=="") echo "is-expanded"; ?>">
			<a class="side-menu__item" data-toggle="slide" href="<?php echo URL?>cms/member">
				<i class="feather feather-star sidemenu_icon"></i>
				<span class="side-menu__label">Dashboard</span>
			</a>
		</li>
		
		<!-- 2) My Listings -->
		<li class="slide <?php if ($_GET['c']=="b-business" && $_GET['task']!="upgrade") echo "is-expanded"; ?>">
			<a class="side-menu__item" data-toggle="slide" href="javascript:;">
				<i class="feather feather-list sidemenu_icon"></i>
				<span class="side-menu__label">My Listings</span>
				<i class="angle fa fa-angle-right"></i>
			</a>
			<ul class="slide-menu is-expanded">
				<li><a href="<?php echo URL?>cms/member/index.php?c=b-business&status=1" class="slide-item">Active Listings</a></li>
				<li>
					<a href="<?php echo URL?>cms/member/index.php?c=b-business&status=2" class="slide-item">
						Pending Drafts 
                        
                        <?php 
							$sqlCtrDraft="select count(business_id) as ctrDraft from tbl_business where business_status='draft'";
							$resCtrDraft=$database->get_results($sqlCtrDraft);
							$ctrDraft=$resCtrDraft[0]['ctrDraft'];
						
							if ($ctrDraft>0)
							{						
						?>
                        <span class="alert-number"><?php echo $ctrDraft; ?></span>
                        <?php } ?>
                        
                        
					</a>
				</li>
				<li><a href="<?php echo URL?>cms/member/index.php?c=b-business&status=3" class="slide-item">Withdrawn</a></li>
				<li><a href="<?php echo URL?>cms/member/index.php?c=b-business&status=4" class="slide-item">Sold</a></li>
				<li><a href="<?php echo URL?>cms/member/index.php?c=b-business&status=5" class="slide-item">Under Offer</a></li>
			</ul>
		</li>
		
		<!-- 3) Enquiries -->
		<li class="slide <?php if ($_GET['c']=="b-leads") echo "is-expanded"; ?>">
			<a class="side-menu__item" href="<?php echo URL?>cms/member/index.php?c=b-leads">
				<i class="feather feather-mail sidemenu_icon"></i>
				<span class="side-menu__label">Enquiries</span>
			</a>
		</li>
        
          
        <li class="slide <?php if ($_GET['c']=="b-business" && $_GET['task']=="upgrade") echo "is-expanded"; ?>">
            <a class="side-menu__item" href="<?php echo URL?>cms/member/index.php?c=b-business&task=upgrade">
                <i class="feather feather-shopping-cart sidemenu_icon"></i>
                <span class="side-menu__label">Buy Credit</span>
            </a>
		</li>
        
		
		<!-- 4) My Account -->
		<li class="slide <?php if ($_GET['c']=="b-edit-profile" || $_GET['c']=="b-agents") echo "is-expanded"; ?>">
			<a class="side-menu__item" data-toggle="slide" href="javascript:;">
				<i class="feather feather-user sidemenu_icon"></i>
				<span class="side-menu__label">My Account</span>
				<i class="angle fa fa-angle-right"></i>
			</a>
			<ul class="slide-menu">
				<li><a href="<?php echo URL?>cms/member/index.php?c=b-edit-profile" class="slide-item">Company Profile</a></li>
				<li><a href="<?php echo URL?>cms/member/index.php?c=b-agents" class="slide-item">Agents</a></li>
			</ul>
		</li>
		
		<!-- 5) Credit Order -->
		<li class="slide <?php if ($_GET['c']=="orders" || $_GET['c']=="b-credits-usage") echo "is-expanded"; ?>">
			<a class="side-menu__item" data-toggle="slide" href="javascript:;">
				<i class="feather feather-credit-card sidemenu_icon"></i>
				<span class="side-menu__label">Credit Order</span>
				<i class="angle fa fa-angle-right"></i>
			</a>
			<ul class="slide-menu">
				<li><a href="<?php echo URL?>cms/member/index.php?c=orders" class="slide-item">Order History</a></li>
				<li><a href="<?php echo URL?>cms/member/index.php?c=b-credits-usage" class="slide-item">Credit Usage</a></li>
			</ul>
		</li>
	</ul>
</aside>

<?php } ?>
<!-- End Sidemenu -->

<?php if ($_SESSION['sess_member_groupid']==4) { ?>
<aside class="app-sidebar" style="background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%); border-right: 1px solid rgba(0,0,0,0.05); border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
	<div class="app-sidebar__user">
		<div class="dropdown user-pro-body text-center">
			<div class="user-pic">
				<img src="<?php echo URL?>images/allbusiness_Logo.svg" alt="">
			</div>
			<div style="height:20px"></div>
			<div class="user-info">
				
                <h5 style="color:#06C"><?php echo $uTypeMember; ?></h5>
              
               
			</div>
		</div>
	</div>

	<ul class="side-menu" style="padding-top:70px">
		<!-- 1) Dashboard -->
		<li class="slide <?php if ($_GET['c']=="") echo "is-expanded"; ?>">
			<a class="side-menu__item" data-toggle="slide" href="<?php echo URL?>cms/member">
				<i class="feather feather-star sidemenu_icon"></i>
				<span class="side-menu__label">Dashboard</span>
			</a>
		</li>
		
		<!-- 2) My Listings -->
		<li class="slide <?php if ($_GET['c']=="ps-business" && $_GET['task']!="upgrade") echo "is-expanded"; ?>">
			<a class="side-menu__item" data-toggle="slide" href="javascript:;">
				<i class="feather feather-list sidemenu_icon"></i>
				<span class="side-menu__label">My Listings</span>
				<i class="angle fa fa-angle-right"></i>
			</a>
			<ul class="slide-menu is-expanded">
				<li><a href="<?php echo URL?>cms/member/index.php?c=ps-business&status=1" class="slide-item">Active Listings</a></li>
				<li>
					<a href="<?php echo URL?>cms/member/index.php?c=ps-business&status=2" class="slide-item">
						Pending Drafts 
                        
                        <?php 
							$sqlCtrDraft="select count(business_id) as ctrDraft from tbl_business where business_status='draft'";
							$resCtrDraft=$database->get_results($sqlCtrDraft);
							$ctrDraft=$resCtrDraft[0]['ctrDraft'];
						
							if ($ctrDraft>0)
							{						
						?>
                        <span class="alert-number"><?php echo $ctrDraft; ?></span>
                        <?php } ?>
                        
                        
					</a>
				</li>
				<li><a href="<?php echo URL?>cms/member/index.php?c=ps-business&status=3" class="slide-item">Withdrawn</a></li>
				<li><a href="<?php echo URL?>cms/member/index.php?c=ps-business&status=4" class="slide-item">Sold</a></li>
				<li><a href="<?php echo URL?>cms/member/index.php?c=ps-business&status=5" class="slide-item">Under Offer</a></li>
			</ul>
		</li>
		
		<!-- 3) Enquiries -->
		<li class="slide <?php if ($_GET['c']=="b-leads") echo "is-expanded"; ?>">
			<a class="side-menu__item" href="<?php echo URL?>cms/member/index.php?c=b-leads">
				<i class="feather feather-mail sidemenu_icon"></i>
				<span class="side-menu__label">Enquiries</span>
			</a>
		</li>
        
        
        
		
		<!-- 4) My Account -->
		<li class="slide <?php if ($_GET['c']=="edit-profile" ) echo "is-expanded"; ?>">
			<a class="side-menu__item" data-toggle="slide" href="javascript:;">
				<i class="feather feather-user sidemenu_icon"></i>
				<span class="side-menu__label">My Account</span>
				<i class="angle fa fa-angle-right"></i>
			</a>
			<ul class="slide-menu">
				<li><a href="<?php echo URL?>cms/member/index.php?c=edit-profile" class="slide-item">View / Edit Profile</a></li>
				<li><a href="<?php echo URL?>cms/member/index.php?c=edit-profile&mode=edit" class="slide-item">Change Password</a></li>
			</ul>
		</li>
		
		<!-- 5) Credit Order -->
		
        
        <li class="slide <?php if ($_GET['c']=="orders") echo "is-expanded"; ?>">
			<a class="side-menu__item" href="<?php echo URL?>cms/member/index.php?c=orders">
				<i class="feather feather-credit-card sidemenu_icon"></i>
				<span class="side-menu__label">Payments</span>
			</a>
		</li>
	</ul>
</aside>

<?php } ?>
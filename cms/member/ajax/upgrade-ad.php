<?php include "../../../private/settings.php";


$sql = "SELECT * FROM tbl_business WHERE business_id='".base64_decode($_GET['id'])."' and business_owner_id='".$_SESSION['sess_member_id']."'";
$res=$database->get_results($sql);

if (count($res)>0)
$row=$res[0];
else
exit;



	

 ?>
 
 <style>
 .scrollable-div {
    max-height: 200px; /* Set the max height */
    overflow-y: auto;  /* Enable vertical scrolling if content exceeds max height */
    padding: 10px;     /* Optional: Add some padding */
    border: 1px solid #ddd; /* Optional: Add a border */
    border-radius: 5px; /* Optional: Add rounded corners */
    background-color: #f9f9f9; /* Optional: Add background color */
}


    .section-box {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        background: #f9f9f9;
    }
    .section-box h5 {
        font-weight: bold;
        margin-bottom: 15px;
        background: #eee;
        padding: 8px 12px;
        border-radius: 6px;
        border-bottom: 2px solid #ddd;
        display: inline-block;
    }


</style>

						
					
                    <div style="background-color:#fff; border:1px solid #039">
                    
                    	<div class="modal-header">
							<h5 class="modal-title" style="color:#06C;font-size:20px">Upgrade Ad to <?php echo $_GET['name']?></h5>
                            
                           
                            
                            
							<button type="button"  class="close" onclick="closeModal()" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							
							 <div class="row" style="padding-top:15px;padding-left:7px">
									<div class="col-md-12">
											<h4><?php echo fnUpdateHTML($row['business_heading'])?></h4>
									</div>
									
								</div>
          
          <?php
		$getCredits="select * from tbl_agency_ads_inventory where inventory_agency_id='".$_SESSION['sess_member_id']."'";
		$resCredits=$database->get_results($getCredits);
		if (count($resCredits)>0)
		{
			$rowCredits=$resCredits[0];
			$credits90=$rowCredits['inventory_premium_90'];
			$credits180=$rowCredits['inventory_premium_180'];
			
			$credits90_a=$rowCredits['inventory_advanced_90'];
			$credits180_a=$rowCredits['inventory_advanced_180'];
			
			$encryptedAdId=$_GET['id'];
	
			
	if ($_GET['name']=="Premium") { ?>
		
	                    
                                
 <div class="table-responsive mb-5">
    <table class="table card-table table-vcenter  table-primary mb-0">
     
      <tbody>
        <tr style="font-size:16px">
          <td><strong>90 Days Ad</strong></td>
          <td class="price-display">
          
            <strong>Available: <span id="credits_p_90"><?php echo $credits90; ?></span></strong>            
          </td>
          <td class="price-display"> <button class="btn btn-indigo btn-md mb-1" id="btnUpgrade_p_90" type="button" <?php if ($credits90<=0) echo "disabled"; ?> onclick="confirmUpgradeInsideModal('p','90', this)">Click to Upgrade</button> </td>
        </tr>
        
        <tr style="font-size:16px">
          <td><strong>180 Days Ad</strong></td>
          <td class="price-display">
          
            <strong>Available: <span id="credits_p_180"><?php echo $credits180; ?></span></strong>            
          </td>
          <td class="price-display" style="width:60%"> <button class="btn btn-indigo btn-md mb-1" id="btnUpgrade_p_180" type="button" <?php if ($credits180<=0) echo "disabled"; ?> onclick="confirmUpgradeInsideModal('p','180', this)">Click to Upgrade</button> </td>
        </tr>
       
       
      </tbody>
    </table>
  </div>
  <?php } 
  else if ($_GET['name']=="Adavnced") { ?>
  
  <div class="table-responsive mb-5">
    <table class="table card-table table-vcenter  table-primary mb-0">
     
      <tbody>
        <tr style="font-size:16px">
          <td><strong>90 Days Ad</strong></td>
          <td class="price-display">
          
            <strong>Available: <span id="credits_a_90"><?php echo $credits90_a; ?></span></strong>            
          </td>
          <td class="price-display" style="width:60%"> <button class="btn btn-indigo btn-md mb-1" id="btnUpgrade_a_90" type="button" <?php if ($credits90_a<=0) echo "disabled"; ?> onclick="confirmUpgradeInsideModal('a','90', this)">Click to Upgrade</button> </td>
        </tr>
        
        <tr style="font-size:16px">
          <td><strong>180 Days Ad</strong></td>
          <td class="price-display">
          
            <strong>Available: <span id="credits_a_180"><?php echo $credits180_a; ?></span></strong>            
          </td>
          <td class="price-display"> <button class="btn btn-indigo btn-md mb-1" id="btnUpgrade_a_180" type="button" <?php if ($credits180_a<=0) echo "disabled"; ?> onclick="confirmUpgradeInsideModal('a','180', this)">Click to Upgrade</button> </td>
        </tr>
       
       
      </tbody>
    </table>
  </div>
  
  <?php }
  
  
		}?>
    <div style="height:30px"></div>
    
   <div class="row" style="padding-top:15px;padding-left:7px">
		<div class="col-md-12">
				<a href="?c=b-business&task=upgrade" class="btn btn-orange btn-md mb-1">Buy Ad Credits</a>
		</div>
									
	</div>
                                
     
   
                                
                                    
                                    
   
                            
                         
                                
                                <div style="height:30px"></div>
                    
                 
                  
                    
              
                    
                    
<script>


function confirmUpgradeInsideModal(type, val, btnElement) {
	
    // Optional: Remove previous confirmation boxes
    $('.upgrade-confirm-box').remove();

    var duration = val;
    var $btn = $(btnElement);
    var $parentTd = $btn.closest('td');

    // Inject a temporary confirmation box under the button
   var confirmBox = `
    <div class="upgrade-confirm-box mt-2">
        <div class="d-flex flex-column" style="background:#fff;border:1px solid #FD811E; padding:20px">
            <div class="mb-3">
                By clicking the <strong>'Confirm'</strong> button, you agree to proceed with the upgrade
                and acknowledge that <strong>one credit</strong> will be used to complete the transaction.
                <br><br>Duration: <strong>${duration} days</strong>
            </div>
            <div>
                <button class="btn btn-md btn-success me-1" onclick="proceedWithUpgrade('${type}', '${val}', this)">Confirm</button>
                <button class="btn btn-md btn-danger" onclick="$(this).closest('.upgrade-confirm-box').remove()">Cancel</button>
            </div>
        </div>
    </div>
`;


    $parentTd.append(confirmBox);
}

function proceedWithUpgrade(type, val, btnElement) {
    // Optional: disable the confirm buttons to avoid duplicate clicks
    $(btnElement).closest('.upgrade-confirm-box').find('button').prop('disabled', true);

    // Call your original function
    upgradeAd(type, val);
}


function upgradeAd(type, val) {
    var adId = "<?php echo $encryptedAdId; ?>";
    var $btn = $('#btnUpgrade_' + type + '_' + val);
    var $credits = $('#credits_' + type + '_' + val);

    // Show loader icon in button
    $btn.html('<i class="fe fe-refresh-cw spin"></i> Upgrading...').prop('disabled', true);

    $.ajax({
        url: 'ajax/submitupgrade.php',
        type: 'POST',
        data: {
            type: type,
            val: val,
            adId: adId
        },
        success: function(response) {
            if (response.trim() === "1") {
                // Update button UI to success
                $btn
                    .removeClass('btn-indigo')
                    .addClass('btn-success')
                    .html('<i class="fe fe-check-circle"></i> Upgraded');
					
					$('.upgrade-confirm-box').remove();

                // Deduct 1 credit visually
                var currentCredits = parseInt($credits.text());
                if (!isNaN(currentCredits) && currentCredits > 0) {
                    $credits.text(currentCredits - 1);
                }
				
				
				$('#newModel').on('hidden.bs.modal', function () {
   				 location.reload();
				});
				
				
            } else {
                // Handle unexpected response
                $btn.html('Error').prop('disabled', false);
                console.error("Unexpected response: " + response);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            $btn.html('Retry').prop('disabled', false);
        }
    });
}
</script>
	               
                   
 
   
    <script language="javascript">
					function openDosage_modal(val)
					{
						if (val==1)
						$("#txtDosage_freetext_modal").show();
						else
						$("#txtDosage_freetext_modal").hide();
					}
					function closeModal()
				{
					 $('#newModel').modal('hide');
				
				}
				
				function fnTakeAction(val)
				{
					
					if (val=="Reschedule Follow Up Review")
					$("#id_follow_up_date").show();
					else 
					$("#id_follow_up_date").hide();
					
					
				}
				
					</script>
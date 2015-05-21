<div style="padding-top: 100px;">
<table style="border: 1px solid gray; font-size: 12px;min-height:450px;" cellpadding="2" cellspacing="0" width="100%">
	<tr>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Transection ID</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Payment Date</td> 
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Client Name</td> 
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Invoice ID</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Payment Type</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Amount</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Status</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Ref No.</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">A/C Name</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">A/C No.</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Cheque No</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Bank Name</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Invoice Status</td>
	</tr>
	<?php
	if(!empty($query)){
	foreach($query as $queries){
	?>
		<tr>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo "T.ID-".$queries->payment_id."-JFP".$queries->invoice_id."-".$queries->accept_by;?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo date("d/m/Y",strtotime($queries->payment_date));?></td> 
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo $queries->client_title;?></td> 
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo "JFP ".$queries->invoice_id;?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">
			<?php 
				if($queries->payment_type ==0){
				echo  "Cash";
				}elseif($queries->payment_type ==1){
					echo  "Cheque";
				}elseif($queries->payment_type ==2){
					echo "Payprder";
				}else{
					echo "Not Define";
				}
			?>
			</td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo number_format($queries->amount,2);?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">
			<?php 
				if($queries->status==0){
				echo "Open";
				}elseif($queries->status==1){
					echo  "Clear";
				}elseif($queries->status==2){
					echo  "Bounced";
				}else{
					echo  "Not Define";
				}
			?>
			</td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo $queries->reference_number;?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo $queries->account_name;?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo $queries->account_number;?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo $queries->cheque_po_number;?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo $queries->bank_name;?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">
				<?php 
					if($queries->invoice_status==0){
						echo "Pending";
					}elseif($queries->invoice_status==1){
						echo "Due";
					}elseif($queries->invoice_status==2){
						echo "Partialy Paid";
					}elseif($queries->invoice_status==3){
						echo "Paid";
					}elseif($queries->invoice_status==4){
						echo "Cancel";
					}elseif($queries->invoice_status==5){
						echo "Deleted";
					}else{
						echo "Not Define";
					}
				?>
			</td>
		</tr>
	<?php		
		
		}
	
	}
	?>
		
</table>
</div>
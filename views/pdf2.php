<div style="padding-top: 100px;">
<table style="border: 1px solid gray; font-size: 12px;min-height:450px;" cellpadding="2" cellspacing="0" width="100%">
	<tr>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Invoice No</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Created date</td> 
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Bill period</td> 
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Invoice Status</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Client Title</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Mode</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Cheque No</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Cheque Status</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Ref No</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">VAT</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Amount</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Discount</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Net Total</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">VAT Paid By</td>
		<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">Remark</td>
	</tr>
	<?php
	if(!empty($query)){
	foreach($query as $queries){
	?>
		<tr>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo "JFP- ".$queries->invoice_id;?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo $queries->created_date;?></td> 
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo $queries->bill_period;?></td> 
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">
			<?php 
				if($queries->invoice_status==0){
				
					echo "Pending";
					
				}elseif($queries->invoice_status==1){
				
					echo "Due";
					
				}elseif($queries->invoice_status==2){
				
					echo  "Partialy Paid";
					
				}elseif($queries->invoice_status==3){
				
					echo "Paid";
					
				}elseif($queries->invoice_status==4){
				
					echo "Cancel";
					
				}else{
				
					echo "Not Define";
					
				}
			?>
			</td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">
			<?php 
				echo $queries->client_title;
				
				
				
			?>
			</td>
			<?php
			$paym = $this->db->where('invoice_id',$queries->invoice_id)->get('payment')->result();
			
			if(!empty($paym)){
				$mode = array();
				$ch_number = array();
				$p_status = array();
				$ref_arra = array();
				
				$pay_mode = "";
				$che_po = "";
				$payment_s = "";
				$p_reference = "";
				foreach($paym as $pay_list){
					if($pay_list->payment_type==0){
			
						$mode[] = "Cash";
						
					}elseif($pay_list->payment_type==1){
					
						$mode[] = "Cheque";
						
					}elseif($pay_list->payment_type==2){
					
						$mode[] = "Payorder";
						
					}else{
					
						$mode[] = "Not Define";
						
					}
					
					$pay_mode = implode(",",$mode);
					
					$ch_number[] = $pay_list->cheque_po_number;
					
					$che_po = implode(",",$ch_number);
					
					if($pay_list->status==0){
			
						$p_status[] = "Open";
						
					}elseif($pay_list->status==1){
					
						$p_status[] = "Clear";
						
					}elseif($pay_list->status==2){
					
						$p_status[] = "Bounced";
						
					}else{
					
						$p_status[] = "Not Define";
						
					}
					
					$payment_s = implode(",",$p_status);
					
				}
				$ref_arra[] = $pay_list->reference_number;
				
				$p_reference = implode(",",$ref_arra);
				$p 		= $pay_mode;
				$che 	= $che_po; 
				$pay 	= $payment_s; 
				$p_ref 	= $p_reference; 
				
				}else{
					$p 		= "Not Define";
					$che 	= 0; 
					$pay 	= "Not Define"; 
					$p_ref 	= "Not Define"; 
				
			}
			?>	
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo $p;?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">
			<?php 
				echo $che;
			?>
			</td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo $pay;?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo $p_ref;?></td>
			
			
			<?php
				$details = $this->db->where('invoice_id',$queries->invoice_id)->get('invoice_details')->result();
				
				$amount = 0;
				
				$vat = 0;
				
						
				$without_vat_amount = 0;
				
				foreach($details as $q){
				
					$p_quantity = $q->quantity;
					
					$p_price = $q->price;
					
					$p_price_without_vat = $p_quantity*$p_price;
					
					$p_vat = ($q->vat*.01);
					
					$price_with_vat = ($p_price_without_vat + $p_price_without_vat*$p_vat);
					
					$p_price_vat = $p_price_without_vat*$p_vat;
					
					if($queries->vat_status==1){
					
						$amount  += $price_with_vat;
						
						//$group_share += $p_price_without_vat*$q->group_share*.01;
					
					}else{
					
						$amount  += $p_price_without_vat;
						
						//$group_share += $p_price_without_vat*$q->group_share*.01;
					}
					
					
					
					$vat += $p_price_vat;
					
									
					$without_vat_amount += $p_quantity*$p_price;
					
				}
				
				$tot = $group_share_with_infolink + $group_share_with_jamuna;
				$new_amount_with_discount  = $tot-$queries->discount;
				
				
				
				$amount1 = $amount - $queries->discount - $vat;
			?>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php 
				if($queries->vat_status==1){
					
					echo  $vat; 
					
				}else{
					
					echo 0;
				
				}
			?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php echo $amount;?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center"><?php 
				if($queries->discount)
				{
				
					echo $queries->discount;
					
				}else{
				
					echo 0;
				
				}
			?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">
				<?php 
					echo $amount- $queries->discount;
				?>
			</td>
			
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">
			<?php 
				if($queries->vat_status==1){
					echo "Gbit";
				}elseif($queries->vat_status==2){
					echo "Client";
				}else{
					
				}
			?></td>
			<td style="border-bottom: 1px solid gray;border-right: 1px solid gray;" align="center">
				<?php 
					if($queries->discount){
						
						if($queries->reason_discount){
							echo $queries->reason_discount.": ".$queries->discount;
						}else{
							echo "Discount: ".$queries->discount;
						}
					}else{
						
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
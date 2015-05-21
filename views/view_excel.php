<?php
header("Content-type: text/excel");
header("Content-Disposition: attachment; filename=reports.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<table border="1" width="100%">
		<tr>
			<td>Transection ID</td>
			<td>Client Name</td>
			<td>Invoice ID</td>
			<td>Mode</td>
			<td>Amount</td>
			<td>Status</td>
			<td>Ref No.</td>
			<td>Payment Date</td>
			<td>Clearing Date</td>
			<td>A/C Name</td>
			<td>A/C No.</td>
			<td>Cheque No.</td>
			<td>Bank</td>
			<td>Invoice Status</td>
			<td>Clear with jamuna</td>
		</tr>
		
		<?php
			if(!empty($data)){
				foreach($data as $d){
		?>
			<tr>
				<td><?php echo "TID-".$d->payment_id."-IL".$d->invoice_id."-".$d->admin_id;?></td>
				<td><?php echo $d->client_title;?></td>
				<td><?="IL ".$d->invoice_id;?></td>
				<td><?php
					if($d->payment_type==0){
						echo "Cash";
					}elseif($d->payment_type==1){
						echo "Cheque";
					}elseif($d->payment_type==2){
						echo "Payorder";
					}else{
						echo "Not Define";
					}
				?></td>
				<td><?php echo $d->amount;?></td>
				<td><?php
					if($d->status==0){
						echo "Open";
					}elseif($d->status==1){
						echo "Clear";
					}elseif($d->status==2){
						echo "Bounced";
					}else{
						echo "Not Define";
					}
				?></td>
				<td><?php
					echo $d->reference_number;
				?></td>
				<td><?php echo date("d/m/Y",strtotime($d->payment_date));?></td>
				<td><?php if($d->clearing_date == "" or $d->clearing_date == 0){ echo '0';}else{ echo date("d/m/Y",strtotime($d->clearing_date));};?></td>
				<td><?php echo $d->account_name;?></td>
				<td><?php echo $d->account_number;?></td>
				<td><?php echo $d->cheque_po_number;?></td>
				<td><?php echo $d->bank_name;?></td>
				<td><?php
					if($d->invoice_status==0){
						echo "Pending";
					}elseif($d->invoice_status==1){
						echo "Due";
					}elseif($d->invoice_status==2){
						echo "Partialy Paid";
					}elseif($d->invoice_status==3){
						echo "Paid";
					}elseif($d->invoice_status==4){
						echo "Cancel";
					}else{
						echo "Not Define";
					}
				?></td>
				<td><?php
					if($d->clear_with_jamuna==0){
						echo "No";
					}elseif($d->clear_with_jamuna==1){
						echo "Yes";
					}else{
						echo "Not Define";
					}
				?></td>
			</tr>
		<?php
				}
			}
		?>
	</table>
</body>
</html>
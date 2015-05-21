<?php
	$this->load->view('dashboard/header');
	$this->load->view('dashboard/sidebar');
?>
	<style type="text/css">
	.error{
		border: 1px solid;
		padding: 7px 0px; 
		background-color:#f0f7fa;
		color:#5494AF;
	}
	.pclass{
		
		width:320px !important;
	}
	
</style>
<script type="text/javascript" src="<?=base_url()?>assets/js_calander/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js_calander/jquery-ui.js"></script>
<link href="<?=base_url();?>assets/js_calander/jquery-ui.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript">
	$(function() {
		$( "#datepicker").datepicker({
      changeMonth: true,
      changeYear: true
    });
	$( "#datepicker2").datepicker({
      changeMonth: true,
      changeYear: true
    });
	$( "#datepicker3").datepicker({
      changeMonth: true,
      changeYear: true
    });
	$( "#datepicker4").datepicker({
      changeMonth: true,
      changeYear: true
    });
	});

	/* function advance_search_form()
	{
		$('#advance_se').toggle();
	} */
	$(document).ready(function () {
		$('#ad_serach').click(function (){
			$("#advance_se").toggle();
		});
	})
	
</script>

<script type="text/javascript">
	function submit_check()
	{
		//alert("ok");
		//return false;
		var start_date = $("#datepicker").val();
		var end_date = $("#datepicker2").val();
		var group_id = $("#group_id").val();
		var payment_type = $("#payment_type").val();
		var payment = $("#payment").val();
		
		if(start_date)
		{
			if(end_date)
			{
				
			}else{
				alert("You select start date. So you should be Select End Date");
				return false;
			}
		}
		
		
		
		/* if(start_date < end_date)
		{
			alert("Please Select Perfect Date. Start Date Will be less than or equal to End date. ");
			return false;
		} */
		/* var mystr = start_date;
		var mystr_e = end_date;
		var s = mystr.split('/');
		var e = mystr_e.split('/'); */
		
		
		
		/* window.open("<?=base_url()?>index.php/invoice/invoice_reports/"+s+"/"+e+"/"+group_id+"/"+payment_type+"/"+payment,'','width=800,height=600,scrollbars=yes');
		return false; */
	}


</script>
	<!--<h2><a href="#">Products</a>&nbsp;&raquo;&nbsp;<?php echo anchor('products','Product List',array('class'=>'active'));?></h2>-->
                
		<div id="main">
			 
<h2 style="border-bottom: none;">
			<div style="width:150px;float: left;"><a href="<?=base_url();?>index.php/invoice" style="underline: none;margin-left: 20px;" class="active">Reports</a></div>
			<!--<div style="width:150px;margin-left:170px;float: left;"><a href="<?=base_url();?>index.php/invoice" id="ad_serach"  style="underline: none;margin-left: 20px;" class="active">Advance Search</a></div>-->
			<!--<div style="width:140px;margin-left:180px;float: left;"><input type="button" style="background-color:#ECECEC;border: 1px solid #FFFFFF; color:#646464;padding:0px 7px;cursor:pointer;" id="ad_serach" name="advance_search_button" value="Advance Search"></div>-->
			
</h2>
			<span class="clear"></span>
			
			
			 
			 <div id="advance_ses">
				<fieldset>
				<?php
					$array = array(
							'class' => 'jNice',
							'name'	=> 'update_form',
							'onsubmit'=> 'return submit_check();'
						);
					echo form_open('reports/get_report',$array);
				?>
					<p class="pclass"><label>Start Date</label>
						<input type="text" id="datepicker" name="start_date" style="z-index:1px;" class="text-long" placeholder=" Start Date"  /> 
					</p>
					
					<p class="pclass"><label>End Date</label>
						<input type="text" id="datepicker2" name="end_date" class="text-long" placeholder=" End Date"  /> 
					</p>
					<?php
						$client = $this->db->where('client_status',1)->order_by('client_title','asc')->get('client')->result();
						
					?>
					<p class="pclass"><label>Client</label>
						
						<select name="client_id" id="client_id">
							<option value="">All</option>
							<?php
								if(!empty($client)){
									foreach($client as $clients){
							?>
								<option value="<?php echo $clients->client_id;?>"><?php echo $clients->client_title;?></option>
							<?php
									}
								}
							?>
							
						</select>
						
					</p>
					
					
					
					<p class="pclass"><label>Report Type</label>
						<select name="report_type" id="report_type">
							<option value="1">Transaction Report</option>
							<option value="2">Invoice Report</option>
							</select>
					</p>
					
					<p class="pclass"><label>Report Output Type</label>
						<select name="output_type" id="output_type" >
							<option value="1">CSV</option>
							<option value="2">PDF</option>
							</select>
					</p>
					<?php
						$group_list = $this->db->order_by('group_name','asc')->get('groups')->result();
						
					?>
					<!--<p class="pclass"><label>Group Name</label>
						<select name="group_id" id="group_id">
						
							<?php
								foreach($group_list as $group_lists){
							?>
							<option value="<?=$group_lists->group_id;?>"><?=$group_lists->group_name;?></option>
							<?php
							}
							?>
						</select>
					</p>
					-->
					<input type="hidden" name="group_id" id="group_id" value="2" />
					<!--<p style="width:140px;"><label>Barcode</label>
						<input type="text"  name="barcode" class="text-medium" placeholder=" Barcode"/> 
					</p>-->
					
					<!--
					<p  class="pclass"><label>Payment Status </label>
						<select name="payment_type" id="payment_type">
							<option value="all">ALL</option>
							<option value="3">Cancel</option>
							<option value="5">Clearance</option>
							<option value="0">Due</option>
							<option value="2">Partialy Paid</option>
							<option value="1">Paid</option>
							<option value="4">Pending</option>
						</select>
					</p>
					
					<p  class="pclass"><label>Payment Report </label>
						<select name="payment" id="payment">
							<option value="1">Payment Details</option>
							<option value="2">Payment Summary</option>
							
						</select>
					</p>
					-->
					<!--
					<p class="pclass"><label>Search By User ID / Mobile / Email</label>
						<input type="text" id="username" name="username" class="text-long" placeholder=" Enter Username / Mobile / Email" /> 
					</p>
					-->
					<p>
					<input type="reset" style="margin-left:230px;background-color:#ECECEC;border: 1px solid #FFFFFF; color:#646464;padding:0px 7px;cursor:pointer;" name="reset" value="Reset">
					<input type="submit" style="margin-left:30px;background-color:#ECECEC;border: 1px solid #FFFFFF; color:#646464;padding:0px 7px;cursor:pointer;" name="submit" value="Download">
					</p>
				<?php
					echo form_close();
				?>
				</fieldset>
			</div>
			
			 <div class="clear"></div>
			
			<div style="margin-top:35px;"></div>
				  
			
		</div>
		<!-- // #main -->
<?php
	$this->load->view('dashboard/footer');
?>
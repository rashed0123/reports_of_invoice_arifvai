<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MX_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('user_info');
		if($user =="" or empty($user))
		{
			redirect('login','refresh');
		}
		$this->load->model('reports_model');
		$this->load->model('clients/clients_list_model');
	}
	
	
	function index()
	{
		$data['title'] 		= "Reports";
		$data['current'] 	= "reports";
		
		if($this->input->post('submit')=="Search")
		{
			//$data['list']		= $this->invoice_model->search_of_invoice();
		}else{
			//$data['list']		= $this->invoice_model->list_of_invoice();
		}
		$this->load->view('reports/content',$data);
	}
	
	function get_report()
	{
		$sdate 			= strtotime($this->input->post('start_date'));
		$edate 			= strtotime($this->input->post('end_date'));
		$client_id 		= $this->input->post('client_id');
		$payment_type 	= 3;
		$report_type = $this->input->post('report_type');
		$output_type = $this->input->post('output_type');
		
		if($report_type==1){
		
		
		
		if($client_id == "" and $payment_type == 3 and $sdate =="" and $edate==""){
		
			$query = $this->db->query("select payment.id as payment_id,payment.accept_by,payment.admin_id,payment.payment_type,payment.invoice_id,payment.client_id,payment.payment_date,payment.payment_date,payment.amount,
									  payment.cheque_po_number,payment.bank_name,payment.account_name,payment.account_number,payment.clearing_date,
									  payment.reference_number,payment.status,
									  client.client_title,invoice.clear_with_jamuna,invoice.status as invoice_status from payment inner join invoice inner join client ON 
									  invoice.client_id=client.client_id and payment.invoice_id=invoice.invoice_id order by payment.payment_date DESC")->result();
			
		}elseif($client_id == "" and $payment_type != 3 and $sdate !="" and $edate !=""){
		
			$query = $this->db->query("select payment.id as payment_id,payment.accept_by,payment.admin_id,payment.payment_type,payment.invoice_id,payment.client_id,payment.payment_date,payment.payment_date,payment.amount,
									  payment.cheque_po_number,payment.bank_name,payment.account_name,payment.account_number,payment.clearing_date,
									  payment.reference_number,payment.status,
									  client.client_title,invoice.clear_with_jamuna,invoice.status as invoice_status from payment inner join invoice inner join client ON 
									  payment.client_id=client.client_id and payment.payment_date >='".date('Y-m-d',$sdate)."' and payment.payment_date <='".date('Y-m-d',$edate)."' and payment.invoice_id=invoice.invoice_id and invoice.clear_with_jamuna='".$payment_type."' order by payment.payment_date DESC")->result();
		}elseif($client_id =="" and $payment_type == 3 and $sdate !="" and $edate !=""){
		
			$query = $this->db->query("select payment.id as payment_id,payment.accept_by,payment.admin_id,payment.payment_type,payment.invoice_id,payment.client_id,payment.payment_date,payment.payment_date,payment.amount,
									  payment.cheque_po_number,payment.bank_name,payment.account_name,payment.account_number,payment.clearing_date,
									  payment.reference_number,payment.status,
									  client.client_title,invoice.clear_with_jamuna,invoice.status as invoice_status from payment inner join invoice inner join client ON 
									  payment.client_id=client.client_id and payment.payment_date >='".date('Y-m-d',$sdate)."' and payment.payment_date <='".date('Y-m-d',$edate)."' and payment.invoice_id=invoice.invoice_id  
									  order by payment.payment_date DESC")->result();
									  /* echo $this->db->last_query();
									  exit; */
		}elseif($client_id and $payment_type != 3 and $sdate !="" and $edate !=""){
		
			$query = $this->db->query("select payment.id as payment_id,payment.accept_by,payment.admin_id,payment.payment_type,payment.invoice_id,payment.client_id,payment.payment_date,payment.payment_date,payment.amount,
									  payment.cheque_po_number,payment.bank_name,payment.account_name,payment.account_number,payment.clearing_date,
									  payment.reference_number,payment.status,
									  client.client_title,invoice.clear_with_jamuna,invoice.status as invoice_status from payment inner join invoice inner join client ON 
									  payment.client_id=client.client_id and payment.payment_date >='".date('Y-m-d',$sdate)."' and payment.payment_date <='".date('Y-m-d',$edate)."' and payment.invoice_id=invoice.invoice_id and 
									  invoice.clear_with_jamuna='".$payment_type."' and payment.client_id='".$client_id."' order by payment.payment_date DESC")->result();
		}elseif($client_id and $payment_type != 3 and $sdate =="" and $edate ==""){
		
			$query = $this->db->query("select payment.id as payment_idpayment.accept_by,,payment.admin_id,payment.payment_type,payment.invoice_id,payment.client_id,payment.payment_date,payment.payment_date,payment.amount,
									  payment.cheque_po_number,payment.bank_name,payment.account_name,payment.account_number,payment.clearing_date,
									  payment.reference_number,payment.status,
									  client.client_title,invoice.clear_with_jamuna,invoice.status as invoice_status from payment inner join invoice inner join client ON 
									  payment.client_id=client.client_id and payment.invoice_id=invoice.invoice_id and 
									  invoice.clear_with_jamuna='".$payment_type."' and payment.client_id='".$client_id."' order by payment.payment_date DESC")->result();
		}elseif($client_id =="" and $payment_type != 3 and $sdate =="" and $edate ==""){
		
			$query = $this->db->query("select payment.id as payment_id,payment.accept_by,payment.admin_id,payment.payment_type,payment.invoice_id,payment.client_id,payment.payment_date,payment.payment_date,payment.amount,
									  payment.cheque_po_number,payment.bank_name,payment.account_name,payment.account_number,payment.clearing_date,
									  payment.reference_number,payment.status,
									  client.client_title,invoice.clear_with_jamuna,invoice.status as invoice_status from payment inner join invoice inner join client ON 
									  payment.client_id=client.client_id and payment.invoice_id=invoice.invoice_id and 
									  invoice.clear_with_jamuna='".$payment_type."' order by payment.payment_date DESC")->result();
		}elseif($client_id and $payment_type == 3){
		
			$query = $this->db->query("select payment.id as payment_id,payment.accept_by,payment.admin_id,payment.payment_type,payment.invoice_id,payment.client_id,payment.payment_date,payment.payment_date,payment.amount,
									  payment.cheque_po_number,payment.bank_name,payment.account_name,payment.account_number,payment.clearing_date,
									  payment.reference_number,payment.status,
									  client.client_title,invoice.clear_with_jamuna,invoice.status as invoice_status from payment inner join invoice inner join client ON 
									  payment.client_id=client.client_id and payment.invoice_id=invoice.invoice_id and 
									  payment.client_id='".$client_id."' order by payment.payment_date DESC")->result();
		}else{
		
			$query = $this->db->query("select payment.id as payment_id,payment.accept_by,payment.admin_id,payment.payment_type,payment.invoice_id,payment.client_id,payment.payment_date,payment.payment_date,payment.amount,
									  payment.cheque_po_number,payment.bank_name,payment.account_name,payment.account_number,payment.clearing_date,
									  payment.reference_number,payment.status,
									  client.client_title,invoice.clear_with_jamuna,invoice.status as invoice_status from payment inner join invoice inner join client ON 
									  payment.client_id=client.client_id and payment.invoice_id=invoice.invoice_id and invoice.clear_with_jamuna='".$payment_type."' order by payment.payment_date DESC")->result();
		}
		
		if($output_type ==1){
			
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename=transaction_report.csv");
		header("Pragma: no-cache");
		header("Expires: 0"); 
		$p = array();
		
		$col = array("Transection ID", "Payment Date", "Client Name", "Invoice ID", "Payment Type", "Amount", "Status", "Ref No.", "Clearing Date", "A/C Name", "A/C No.", "Cheque No.", "Bank Name", "Invoice Status");
		
		array_push($p,$col);	
		
		foreach($query as $queries){
		
			$foreach = array();
			
			$foreach[] = "T.ID-".$queries->payment_id."-JFP".$queries->invoice_id."-".$queries->accept_by; 
			
			$foreach[] = date("d/m/Y",strtotime($queries->payment_date));
			
			$foreach[] = $queries->client_title;
			
			$foreach[] = "JFP ".$queries->invoice_id;
			
			if($queries->payment_type ==0){
				$foreach[] = "Cash";
			}elseif($queries->payment_type ==1){
				$foreach[] = "Cheque";
			}elseif($queries->payment_type ==2){
				$foreach[] = "Payprder";
			}else{
				$foreach[] = "Not Define";
			}
			
			$foreach[] = number_format($queries->amount,2);
			
			if($queries->status==0){
				$foreach[] = "Open";
			}elseif($queries->status==1){
				$foreach[] = "Clear";
			}elseif($queries->status==2){
				$foreach[] = "Bounced";
			}else{
				$foreach[] = "Not Define";
			}
			
			$foreach[] = $queries->reference_number;
			
			
			if($queries->clearing_date == "" or $queries->clearing_date == 0){ 
				$foreach[] = '0';
			}else{ 
				$foreach[] = date("d/m/Y",strtotime($queries->clearing_date));
			}
			
			$foreach[] = $queries->account_name;
			
			$foreach[] = $queries->account_number;
			
			$foreach[] = $queries->cheque_po_number;
			
			$foreach[] = $queries->bank_name;
			
			if($queries->invoice_status==0){
				$foreach[] = "Pending";
			}elseif($queries->invoice_status==1){
				$foreach[] = "Due";
			}elseif($queries->invoice_status==2){
				$foreach[] = "Partialy Paid";
			}elseif($queries->invoice_status==3){
				$foreach[] = "Paid";
			}elseif($queries->invoice_status==4){
				$foreach[] = "Cancel";
			}elseif($queries->invoice_status==5){
				$foreach[] = "Deleted";
			}else{
				$foreach[] = "Not Define";
			}
			
			
			
			array_push($p,$foreach);
		}
		$data = $p;
		$this->outputCSV($data);
		exit;
		}
		
		if($output_type ==2)
		{
			$company = $this->db->where('id',1)->get('company_settings')->row();
			$this->load->library('mpdf/mpdf');
			$mpdf = new mPDF();
			
			$data['query'] = $query;
			
			$html = $this->load->view('reports/pdf1', $data, true);
			$mpdf->SetHTMLHeader('<img src="'.base_url().'assets/img/'.$company->logo_name.'">
							<div style="text-indent: -1999px;">Transaction Report</div>
					<h2 style="text-align:center;text-decoration:underline;margin-bottom: 0px;color: #000000;font-size: 15px;">Report</h2>
						
						<div style="clear: both"></div>
					');
			$mpdf->WriteHTML($html);		
			$mpdf->SetHTMLFooter('
					<br/>
					<br/>
					<br/>
						<div style="font-size: 10px;color: gray;">
						<img src="'.base_url().'assets/img/footer.gif" height="2px" width="100%">
						'.$company->address1.', '.$company->address2.', '.$company->mobile_number.', '.$company->email.', '.$company->website.'
					</div>');
					
			$mpdf->Output("Transaction Reports.pdf",'D');
			
			exit;
		}
		/* $data['data'] = $query;
		$this->load->view("reports/view_excel",$data); */
		}
		
		if($report_type==2){
			
			
			if($client_id == "" and $payment_type == 3 and $sdate =="" and $edate==""){
			
				$query= $this->db->query("Select *, invoice.invoice_id as invoice_id, invoice.invoice_created_date AS created_date,
									invoice.bill_period as bill_period, invoice.status as invoice_status,
									client.client_title as client_title from invoice inner join client  
									ON client.client_id = invoice.client_id and invoice.status != 5")->result();
									
			 }elseif($client_id == "" and $payment_type != 3 and $sdate !="" and $edate !=""){
			 
				$query = $this->db->query("Select *, invoice.invoice_id as invoice_id, invoice.invoice_created_date AS created_date,
									invoice.bill_period as bill_period, invoice.status as invoice_status,
									client.client_title as client_title from invoice inner join client ON client.client_id = invoice.client_id and  
									invoice.invoice_created_date >='".date('Y-m-d',$sdate)."' and invoice.invoice_created_date <='".date('Y-m-d',$edate)."' and invoice.clear_with_jamuna='".$payment_type."' and  and invoice.status != 5")->result();
									
			 }elseif($client_id =="" and $payment_type == 3 and $sdate !="" and $edate !=""){
			 
				$query = $this->db->query("Select *, invoice.invoice_id as invoice_id, invoice.invoice_created_date AS created_date,
									invoice.bill_period as bill_period, invoice.status as invoice_status,
									client.client_title as client_title from invoice inner join client ON client.client_id = invoice.client_id and 
									invoice.invoice_created_date >='".date('Y-m-d',$sdate)."' and invoice.invoice_created_date <='".date('Y-m-d',$edate)."'  and invoice.status != 5")->result();
									
			 }elseif($client_id and $payment_type != 3 and $sdate !="" and $edate !=""){
			 
				$query = $this->db->query("Select *, invoice.invoice_id as invoice_id, invoice.invoice_created_date AS created_date,
									invoice.bill_period as bill_period, invoice.status as invoice_status,
									client.client_title as client_title from invoice inner join client ON client.client_id = invoice.client_id and 
									invoice.client_id='".$client_id."' and 
									invoice.invoice_created_date >='".date('Y-m-d',$sdate)."' and invoice.invoice_created_date <='".date('Y-m-d',$edate)."' and invoice.clear_with_jamuna='".$payment_type."' and invoice.status != 5")->result();
									
			 }elseif($client_id and $payment_type == 3){
			 
				$query = $this->db->query("Select *, invoice.invoice_id as invoice_id, invoice.invoice_created_date AS created_date,
									invoice.bill_period as bill_period, invoice.status as invoice_status,
									client.client_title as client_title from invoice inner join client ON client.client_id = invoice.client_id and 
									invoice.client_id='".$client_id."' and invoice.status != 5")->result();
									
			 }else{
			 
				$query = $this->db->query("Select *, invoice.invoice_id as invoice_id, invoice.invoice_created_date AS created_date,
									invoice.bill_period as bill_period, invoice.status as invoice_status,
									client.client_title as client_title from invoice inner join client ON client.client_id = invoice.client_id and invoice.clear_with_jamuna='".$payment_type."' and invoice.status != 5")->result();
									
			} 
		
		if($output_type ==1){
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename=invoice.csv");
			header("Pragma: no-cache");
			header("Expires: 0");
			$p = array();
			
			$col = array("Invoice No", "Created date", "Bill period", "Invoice Status", "Client Title", "Mode", "Cheque No", "Cheque Status", "Ref No", "VAT", "Amount", "Discount", "Net Total","VAT Paid By","Remark");
			
			array_push($p,$col);	
		
			foreach($query as $queries){
			
				$foreach = array();
				
				$foreach[] = "JFP- ".$queries->invoice_id; 
				
				$foreach[] = $queries->created_date;
				
				$foreach[] = $queries->bill_period;
					
				if($queries->invoice_status==0){
				
					$foreach[] = "Pending";
					
				}elseif($queries->invoice_status==1){
				
					$foreach[] = "Due";
					
				}elseif($queries->invoice_status==2){
				
					$foreach[] = "Partialy Paid";
					
				}elseif($queries->invoice_status==3){
				
					$foreach[] = "Paid";
					
				}elseif($queries->invoice_status==4){
				
					$foreach[] = "Cancel";
					
				}else{
				
					$foreach[] = "Not Define";
					
				}
				
				$foreach[] = $queries->client_title;
				
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
					
					
					$foreach[] = $pay_mode;
					$foreach[] = $che_po; 
					$foreach[] = $payment_s; 
					$foreach[] = $p_reference; 
					
					
				}else{
					$foreach[] = "Not Define";
					$foreach[] = 0; 
					$foreach[] = "Not Define"; 
					$foreach[] = "Not Define"; 
				
				}
				
				
				
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
				//$amount = $amount;
				
				
				
				if($queries->vat_status==1){
					
					$foreach[] = $vat; 
					
				}else{
					
					$foreach[] = 0;
				
				}
				
				$foreach[] = $amount;
				
				if($queries->discount)
				{
				
					$foreach[] = $queries->discount;
					
				}else{
				
					$foreach[] = 0;
				
				}
				
				$foreach[] = $amount- $queries->discount;
				
				
				
				if($queries->vat_status==1){
					$foreach[] = "Gbit";
				}elseif($queries->vat_status==2){
					$foreach[] = "Client";
				}else{
					$foreach[] = "";
				}
				
				if($queries->discount){
					if($queries->reason_discount){
						$foreach[] = $queries->reason_discount.": ".$queries->discount;
					}else{
						$foreach[] = "Discount: ".$queries->discount;
					}
				
					
				}else{
					$foreach[] = "";
				}
				
				
				
				//$new = "\n";
				//$foreach .= "),";
				
				array_push($p,$foreach);
				
				//$p[] = $foreach;
			}
			$data = $p;
			/* print_r($data);
			exit; */ 
			
				
			/* echo "<br/><br/>";
			$data1 = array(
				array("name 1", "age 1", "city 1"),
				array("name 2", "age 2", "city 2"),
				array("name 3", "age 3", "city 3")
			); 
			print_r($data1);
			exit; */
			
			$this->outputCSV($data);
		}
		
		if($output_type ==2){
			
			$company = $this->db->where('id',1)->get('company_settings')->row();
			$this->load->library('mpdf/mpdf');
			$mpdf = new mPDF();
			
			$data['query'] = $query;
			
			$html = $this->load->view('reports/pdf2', $data, true);
			$mpdf->SetHTMLHeader('<img src="'.base_url().'assets/img/'.$company->logo_name.'">
							<div style="text-indent: -1999px;">Invoice Report</div>
					<h2 style="text-align:center;text-decoration:underline;margin-bottom: 0px;color: #000000;font-size: 15px;">Invoice Report</h2>
						
						<div style="clear: both"></div>
					');
			$mpdf->WriteHTML($html);		
			$mpdf->SetHTMLFooter('
					<br/>
					<br/>
					<br/>
						<div style="font-size: 10px;color: gray;">
						<img src="'.base_url().'assets/img/footer.gif" height="2px" width="100%">
						'.$company->address1.', '.$company->address2.', '.$company->mobile_number.', '.$company->email.', '.$company->website.'
					</div>');
					
			$mpdf->Output("Invoice Reports.pdf",'D');
			
			exit;
		}
			
		}
	}
	
	function export_csv_php()
	{
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename=file.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		$query= $this->db->query("Select *, invoice.invoice_id as invoice_id, invoice.invoice_created_date AS created_date,
									invoice.bill_period as bill_period, invoice.status as invoice_status,
									client.client_title as client_title,payment.payment_type as mode,
									payment.cheque_po_number as cheque_po_number,
									payment.status as payment_status,
									payment.reference_number as reference_number from invoice inner join client inner join 
									payment ON client.client_id = invoice.client_id and payment.invoice_id = invoice.invoice_id")->result();
		
		$p = array();
		
		$col = array("Invoice No", "Created date", "Bill period", "Invoice Status", "Client Title", "Mode", "Cheque No", "Cheque Status", "Ref No", "VAT", "Amount");
		
		array_push($p,$col);	
		
		foreach($query as $queries){
		
			$foreach = array();
			
			$foreach[] = "JFP- ".$queries->invoice_id; 
			
			$foreach[] = $queries->created_date;
			
			$foreach[] = $queries->bill_period;
				
			if($queries->invoice_status==0){
			
				$foreach[] = "Pending";
				
			}elseif($queries->invoice_status==1){
			
				$foreach[] = "Due";
				
			}elseif($queries->invoice_status==2){
			
				$foreach[] = "Partialy Paid";
				
			}elseif($queries->invoice_status==3){
			
				$foreach[] = "Paid";
				
			}elseif($queries->invoice_status==4){
			
				$foreach[] = "Cancel";
				
			}else{
			
				$foreach[] = "Not Define";
				
			}
			
			$foreach[] = $queries->client_title;
			
			if($queries->mode==0){
			
				$foreach[] = "Cash";
				
			}elseif($queries->mode==1){
			
				$foreach[] = "Cheque";
				
			}elseif($queries->mode==2){
			
				$foreach[] = "Payorder";
				
			}else{
			
				$foreach[] = "Not Define";
				
			}
			
			$foreach[] = $queries->cheque_po_number; 
			
			if($queries->payment_status==0){
			
				$foreach[] = "Open";
				
			}elseif($queries->payment_status==1){
			
				$foreach[] = "Clear";
				
			}elseif($queries->payment_status==2){
			
				$foreach[] = "Bounced";
				
			}else{
			
				$foreach[] = "Not Define";
				
			}
			
			$foreach[] = $queries->reference_number;
			
			$details = $this->db->where('invoice_id',$queries->invoice_id)->get('invoice_details')->result();
			
			$amount = 0;
			
			$vat = 0;
			
			
			
			foreach($details as $q){
			
				$p_quantity = $q->quantity;
				
				$p_price = $q->price;
				
				$p_price_without_vat = $p_quantity*$p_price;
				
				$p_vat = ($q->vat*.01);
				
				$price_with_vat = ($p_price_without_vat + $p_price_without_vat*$p_vat);
				
				$p_price_vat = $p_price_without_vat*$p_vat;
				
				$amount  += $price_with_vat;
				
				$vat += $p_price_vat;
				
				$group_share = $p_price_without_vat*$q->group_share*.01;
				
				$jamuna += $group_share;
				
				$info = $p_price_without_vat-$group_share;
				
				$infolink += $info;
				
			}
			
			
			
			$foreach[] = $vat; 
			
			$foreach[] = $amount;
			
			
			//$new = "\n";
			//$foreach .= "),";
			
			array_push($p,$foreach);
			
			//$p[] = $foreach;
		}
		$data = $p;
		
		
		/* $data1 = array(
			array("name 1", "age 1", "city 1"),
			array("name 2", "age 2", "city 2"),
			array("name 3", "age 3", "city 3")
		);  */
		
		$this->outputCSV($data);

		
	}
	function outputCSV($data) {
		$output = fopen("php://output", "w");
		foreach ($data as $row) {
			fputcsv($output, $row);
		}
		fclose($output);
	}
	
	
}
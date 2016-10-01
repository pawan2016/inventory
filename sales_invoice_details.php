<?php
error_reporting(E_All);
?>
<style type="text/css" media="print">
#reset_button{display:none;}
.my-btn, .action, .dataTables_filter, .dataTables_paginate, .breadcrumb, .breadcrumb-my-toggle, .dataTables_info, .dataTables_length {display : none;}
.showmyprint{width:50%; float:left;}
</style>
<style>
.my_product{font-size:10px;}
.mh3{height:30px !important; max-height:30px !important; font-size:12px; padding:0px !important;}
th { height:30px; padding:0px !important;}
td{height:30px; padding:0px !important;}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td { padding:2px !important; height : 20px !important; }
</style>
<style>
#printby, .printby{display:none;}
</style>
<style type="text/css" media="print">
#reset_button{display:none;}
.btn-primary, .breadcrumb, .breadcrumb-my-toggle, .my-hide-div {display : none;}
.showmyprint{width:50%; float:left;}
.box-header>h2{text-align:center;}
#printby, .printby{display:block !important; font-weight:bold; padding:15px;}
.myheader{width:33%; float:left;}
@page { size: landscape; margin:0;}
* {-webkit-print-color-adjust:exact;}
</style>
<?php

 $check_super_admin=$this->session->all_userdata();
if($check_super_admin["role_id"]==0 && $check_super_admin["office_id"]==0)
{
	$add_value = 1;
    $edit_value = 2;
    $view_value = 3;
    $delete_value = 4;
}else
{

	$page_id = 27;
	$page_permission_array = $this->role_model->get_page_permission($page_id);
	//print_r($page_permission_array);die;
	$add_value = $page_permission_array->add_value;
	$edit_value = $page_permission_array->edit_value;
	$view_value = $page_permission_array->view_value;
	$delete_value = $page_permission_array->delete_value;
}


//print_r($page_permission_array);
?>

<div class="ch-container">
    <div class="row my-container-class">
        <div id="content" class="col-lg-12 col-sm-12">
            <!-- content starts -->
            <div>
				<ul class="breadcrumb col-lg-9 col-sm-9">
					<li>
						<a href="#">Home</a>
					</li>
					<li>
						<a href="#">Invoice</a>
					</li>
					<li>
						<a href="#">Sales Invoice Details</a>
					</li>
				</ul>
				<ul class="breadcrumb-my-toggle text-right  col-lg-3 col-sm-3">
					<li>
					<?php if($add_value == "1"){ ?>
						<a href="<?php echo base_url('invoice/sales_invoice_form'); ?>">Create Invoice</a>
					<?php } ?>
					</li>
				</ul>
			</div>
			<?php if($this->session->flashdata('SuccessMessage')){ ?>
				<span class="alert alert-success col-lg-12">
				 <button type="button" class="close" data-dismiss="alert">x</button>
                    <?php echo $this->session->flashdata('SuccessMessage'); ?>
                </span>
			<?php } 
				$office_id = $this->session->userdata('office_id');
				$office_data = $this->db->get_where('office_master',array('office_id'=>$office_id))->row();

			?>
			<div class="row printby">
				<div class="col-lg-3 col-sm-3 col-xs-3">
					<img src="<?php echo base_url('files/img/index.png'); ?>" />
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<div class="center text-center text-uppercase" style="font-size:18px; font-weight:bold;">MMTC-Indian Gold Coin</div>
					<div class="center text-center" style="font-size:13px; font-weight:bold;"><?php echo strtoupper($office_data->office_name.'-'.$office_data->office_operation_type.', '.getCityName($office_data->city_id).', '.getStateName($office_data->state_id));?></div>
				</div>
				<div class="col-lg-3 col-sm-3 col-xs-3">
					<div class="pull-right">
					<img height="77" width="77" src="<?php echo base_url('files/img/igc10.png'); ?>" />
					</div>
				</div>
			</div>
			<div class="row printby" style="margin-top:-20px;">
				<div class="col-lg-12 col-sm-12">
					<div class="center text-center text-uppercase" style="font-size:16px; font-weight:bold;">Sales Invoice Details Report</div>
				</div>
			</div>
			<div class="row printby" style="margin-top:-20px;">
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<label class="control-label">From Date :&nbsp;</label><?php echo $fromDate; ?>
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<label class="control-label">To Date :&nbsp;</label><?php echo $toDate;?>
				</div>
			</div>
			<div class="row">
				<div class="box col-lg-12 col-md-12 col-xs-12" style="margin-top:-10px !important;">
					<div class="box-inner">
						<div class="box-header well my-hide-div">
							<h2>Sales Invoice Inventory</h2>
						</div>
						<div class="box-content">
							<form method="post" id='form' action="<?php echo base_url('invoice/sales_invoice_details'); ?>" autcomplete="off"/>
								<div class="row my-hide-div">
									<div class="form-group col-lg-2 showmyprint">
										<label class="control-label">From Date</label>
										<input type="text" class="form-control" id="fromDate" name="fromDate" value="<?php echo $fromDate; ?>" />
									</div>
									
									<div class="form-group col-lg-2 showmyprint">
										<label class="control-label">To Date</label>
										<input type="text" class="form-control" id="toDate" name="toDate" value="<?php echo $toDate;?>" />
									</div>
								</div>
								<div class="row my-hide-div">
									<div class="form-group col-lg-6 showmyprint">
										<input type="submit" name="submit" class="btn btn-primary my-btn" value="Submit" style="margin:5px 5px 5px 0px;"/>
									
										<input type="button" name="submit" class="btn btn-primary my-btn" onclick="javascript:window.print();" value="Print" style="margin:5px;"/>
									</div>
								</div>
								
							</form>
							<div id="stockReciptTable">
								<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
									<thead>
										<tr>
											<th class="text-center" style="width:3%;">Sr. No.</th>
											<th class="text-center" style="width:8%;">Invoice Date</th>
											<th class="text-center" style="width:18%;">Invoice Number</th>
											<th class="text-center" style="width:10%;">PAN Number</th>
											<th class="text-center" style="width:15%;">Customer Name</th>
											<th class="text-center" style="width:10%;">Payment Type</th>
											<th class="text-center" style="width:15%;">Products: Qty</th>
											<th class="text-center" style="width:13%;">Total Sales Price with TAX Rs.</th>
											<!--<th class="text-center">Office Name</th>-->
											<th class="text-center action" style="width:7%;">Actions</th>
										</tr>
									</thead>
										<tbody>
									<?php
									/* $total_recived_amount=0;
									foreach($invoice_details as $InvoiceDetails){
										$total_recived_amount+=$InvoiceDetails->amount_received;
									} */
									if(!empty($invoice_details)){ $i=1; foreach($invoice_details as $InvoiceDetails){
										//print_r($InvoiceDetails);die;
										$office_id=$this->session->userdata('office_id');
										$data['paymenttype_details'] = $this->db->get_where('invoice_showroom_payment_mode_'.$office_id,array('invoice_id'=>$InvoiceDetails->invoice_id))->result();
										//print_r($InvoiceDetails->amount_received);die;
										$total_received_till=0;
										foreach($data['paymenttype_details'] as $payment_types) 
	                                    {
	                                      $total_received_till=$total_received_till+$payment_types->payment_amount;
										}
										//print_r($total_received_till);die;
										?>
										<?php 
										$style_deleted='';
										if($InvoiceDetails->is_deleted=='1')
										{
											$style_deleted="background-color:#ff0000 !important;";
										}
										?>
										<tr>
											<td class="text-center mh3" style="<?php echo $style_deleted;?>"><?php echo $i++;?></td>
											<td class="center text-center mh3" style="<?php echo $style_deleted;?>"><?php $arr_date=explode(" ",$InvoiceDetails->invoice_date); echo $arr_date[0];//date('m/d/Y',$arr_date[0]);?></td>
											<td class="center text-center mh3" style="<?php echo $style_deleted;?>"><?php echo $InvoiceDetails->invoice_number;?></td>
											<td class="center text-center mh3" style="<?php echo $style_deleted;?>"><?php if($InvoiceDetails->customer_pan_number !=''){ echo $InvoiceDetails->customer_pan_number;} else if($InvoiceDetails->modal_customer_pan_number!='') { echo $InvoiceDetails->modal_customer_pan_number; } else { echo 'N/A'; } ?></td>
											<td class="center text-left mh3" style="<?php echo $style_deleted;?>"><?php if($InvoiceDetails->customer_name !=''){ echo $InvoiceDetails->customer_name;} else if($InvoiceDetails->modal_customer_name!='') { echo $InvoiceDetails->modal_customer_name; } else { echo 'N/A'; } ?></td>
										
											<td class="center text-center mh3" style="<?php echo $style_deleted;?>"><?php 
											$arr_payment_type=$this->db->get_where('invoice_showroom_payment_mode_'.$this->session->userdata('office_id'),array('invoice_id'=>$InvoiceDetails->invoice_id))->result();
											$arr_details=array();
											foreach($arr_payment_type as $pt)
											{
											$arr_details[]=ucwords($pt->payment_type);
											}
											if(count($arr_details)>0)
											{
											echo implode(", ",$arr_details);
											}
											
												?></td>
											<td class="center text-center my_product mh3" style="<?php echo $style_deleted;?>"><?php 
											$productList=$this->db->get_where('invoice_showroom_product_'.$this->session->userdata('office_id'),array('invoice_id'=>$InvoiceDetails->invoice_id))->result();
											foreach($productList as $product)
											{
												$productName = getProductShortCode($product->product_id);
												echo ucwords($productName).": ".$product->qunatity.'<br/>';
											}
											
												?>
											</td>
											<td class="center text-center mh3" style="<?php echo $style_deleted;?>"><?php echo number_format($InvoiceDetails->total_amount,2,'.',',');?></td>
											<td class="center text-center action mh3" style="<?php echo $style_deleted;?>">
											<?php if($view_value == "3"){ ?>
												<a class="btn btn-info my-btn-class" href="<?php echo base_url('invoice/sales_invoice_receipt?invoice_id='.base64_encode($InvoiceDetails->invoice_id));?>" title="View">
													<i class="glyphicon glyphicon-view icon-white"></i>
													View
												</a>
											<?php } ?>
												<?php 
											//echo $total_received_till.'<br/>';
											$mynewTotal = number_format($InvoiceDetails->total_amount + $InvoiceDetails->adjustment,'2');
											//var_dump($InvoiceDetails->total_amount);var_dump($InvoiceDetails->adjustment); 
											//	echo (($total_received_till<$InvoiceDetails->total_amount) && ($InvoiceDetails->invoice_type=='advance'));
												//echo ($InvoiceDetails->transaction=="incomplete");die;
											if((($total_received_till<$mynewTotal) && ($InvoiceDetails->invoice_type=='advance')) || ($InvoiceDetails->transaction=="incomplete"))
												{ ?>
											<?php if($add_value == "1" && $InvoiceDetails->is_deleted=='0'){ ?>
													<a onclick="pay_more('<?php echo base_url('invoice/sales_invoice_edit?invoice_id='.base64_encode($InvoiceDetails->invoice_id));?>');" class="btn btn-info my-btn-class element_confirm"  href="javascript:;"  title="Pay More">
														<i class="glyphicon glyphicon-view icon-white"></i>
														Complete Transaction
													</a>
											<?php } ?>
													<?php
												}
												$office_id = $this->session->userdata('office_id');
										$flagDelete = '0';
										$back_date_data=$this->base_model->get_all_record_by_condition('back_date_invoice',array('showroom_id'=>$office_id,'invoice_delete'=>'1'));
										foreach($back_date_data as $back_date_data_main)
										{
											$date=strtotime(date('d-m-Y'));
											$to=strtotime($back_date_data_main->to_date);
											$from=strtotime($back_date_data_main->from_date);
											if(( $date >= $from) && ($date<=$to))
											{
												$backDateRangeDatas = $this->db->get_where('back_date_invoice_range',array('back_date_invoice_id'=>$back_date_data_main->id))->result();
												
												foreach($backDateRangeDatas as $backDateRangeData)
												{
													$invoiceDate1 = explode(' ',$InvoiceDetails->invoice_date);
													$invoiceDate2 = explode('/',$invoiceDate1[0]);
													$myInvoiceDate = $invoiceDate2[2].'-'.$invoiceDate2[1].'-'.$invoiceDate2[0];
													if($myInvoiceDate == $backDateRangeData->date_range)
													{
														$flagDelete = '1';
														break;
													}
												}
												
											}
										}
										
										
											
											
												if(($arr_date[0]==date('d/m/Y') || $flagDelete == '1') && $InvoiceDetails->is_deleted=='0')
												{ 
													?>
													<?php if($delete_value == "4"){ ?>
													<a class="btn btn-info my-btn-class" id="del_button"  href="javascript:;" onclick="delete_invoice('<?php echo base64_encode($InvoiceDetails->invoice_id);?>');" title="Delete">
														<i class="glyphicon glyphicon-view icon-white"></i>
														Delete
													</a>
													<?php } ?>
													<!--<a class="btn btn-info"  href="<?php echo base_url('invoice/sales_invoice_edit_form?invoice_id='.base64_encode($InvoiceDetails->invoice_id));?>" title="Edit">
														<i class="glyphicon glyphicon-view icon-white"></i>
														Edit
													</a>-->
													<?php
													
												}
												/*if(date('d/m/Y')==$arr_date[0])
											{ ?>
												<a class="btn btn-info" target="_blank" href="<?php echo base_url('invoice/delete_invoice_receipt?invoice_id='.base64_encode($InvoiceDetails->invoice_id));?>" title="Delete">
													<i class="glyphicon glyphicon-view icon-white"></i>
													Delete
												</a>
												<?php
											}*/
											?>
											</td>
										</tr>
									<?php } } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div><!--/row-->
    <!-- content ends -->
		</div><!--/#content.col-md-0-->
	</div><!--/fluid-row-->
	<script type="text/javascript">
	
	$(function() {
		$( "#fromDate" ).datepicker({
		  dateFormat: "dd/mm/yy",
		  changeMonth: true,
		  numberOfMonths: 1,
		  onClose: function( selectedDate ) {
		  $( "#toDate" ).datepicker( "option", "minDate", selectedDate );
		  }
		});
		$( "#toDate" ).datepicker({
		  dateFormat: "dd/mm/yy",
		  changeMonth: true,
		  numberOfMonths: 1,
		  onClose: function( selectedDate ) {
			$( "#fromDate" ).datepicker( "option", "maxDate", selectedDate );
		  }
		});
		// $('#fromDate').datepicker('setDate', new Date());   // open to show the date
		// $('#toDate').datepicker('setDate', new Date());
		
	});
	
	function delete_invoice(invoice_number) {
   
 bootbox.prompt("Reason For Deleting Invoice!", function (result) {
	 $('#del_button').addClass('disabled');
	 
            if (result===null || result=='') {
                  if(result=='')
                  {
					  $('#del_button').removeClass('disabled');
					  return false;
				  }			
                  else	{			  
                   $(".close").remove();
				  }
			}else{
				
             input_value=result;
				$.ajax({
                   url: "<?php echo base_url('invoice/delete_invoice_data'); ?>",
                   type: "POST",
                   data: {invoice_number:invoice_number,reason:input_value},
                   cache: false,
                   dataType: 'json',
                   success: function (response)
                   {
					 if(response=='2')
					   {
						   bootbox.alert('<?php echo DELETE_MSG_COMMON_PERMISSION_ERROR;?>');
						   window.location.reload();
					   }
					   else if(response=='1')
					   {
						 window.location.reload();
					   }
                   }
               });
           }

       });
}
function pay_more(url){
	bootbox.confirm("Are you sure you want to complete the transaction ?", function(result) {
    if (result===null || result=='') {
                  if(result=='')
                  {
					  $(".close").remove();
				  }			
                  else	{			  
                   $(".close").remove();
				  }
			}else{
				//alert(url);
				window.location.href= url;
             
           }
}); 
}

</script>

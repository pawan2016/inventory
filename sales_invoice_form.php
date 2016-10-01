﻿<style>
.col-lg-2{ width:15% !important;}
.col-lg-1{width: 10% ;}
.my-net-class{width:12% !important;}
.col-lg-1 {
    width: 7%;}
.my-serial-number-class.chosen-container{width:165px !important;}
.col-lg-3
{
	padding-right:0px !important;
}
.col-lg-2
{
	padding-right:0px !important;
}
</style>
<div class="ch-container">
    <div class="row my-container-class">
        <div id="content" class="col-lg-12 col-sm-12">
            <!-- content starts -->
            <div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a>
					</li>
					<li>
						<a href="#">Inventory</a>
					</li>
					<li>
						<a href="#">Sales Invoice</a>
					</li>
				</ul>
			</div>
			
			<div class="row">
				<div class="box col-lg-12 col-md-12 col-xs-12" style="margin-top:-10px;">
					<div class="box-inner">
						<div class="box-header well">
							<h2>Sales Invoice</h2>
						</div>
						<div class="box-content">
							<!--<form method="post" action="<?php //echo base_url('invoice/saveInvoiceData'); ?>" id="form_sales_invoice" onsubmit="return checkInvoiceForm();">-->
							<form method="post" action="<?php echo base_url('invoice/saveInvoiceData'); ?>" id="form_sales_invoice" onsubmit="return checkInvoiceForm();">
							<div class="row" style="width:100%">
								<div class="form-group col-lg-3">
									<label class="control-label">Date</label>
									<input type="text" readonly class="form-control" id="sales_invoice_date" name="invoice_date" value="<?php echo date('d/m/Y H:i:s');?>"/>
								</div>
								<div class="form-group col-lg-3">
									<label class="control-label">Type of Invoice</label>
									<div class="controls">
										<select id="invoice_type"  name="invoice_type" data-rel="chosen">
											<option value="sale">Sale</option>
										<!--	<option value="credit">Credit</option>
											<option value="proforma">Proforma</option>
											<option value="corporate gift">Corporate Gift</option>-->
											<option value="advance">Advance Mode</option>
										</select>
									</div>
								</div>
								
								<div class="form-group col-lg-3">
									<label class="control-label">Narration</label>
									<div class="clear-fix"></div>
									<span id="" class="label label-info"></span>
									<input type="text" class="form-control" id="narrative" name="showrom_invoice_narrative"/>
								</div>
								<div class="form-group col-lg-3">
									<label class="control-label">Transaction Id</label>
									<input type="text" class="form-control" id="customer_transaction_id" name="customer_transaction_id" maxlength="50" style="text-transform:uppercase" onkeyup="transaction_validation(this.value);" />
								</div> 
							</div>
							<input type="hidden" name="entry_tax" id="entry_tax" />
							<div class="row" style="width:100%">
								<div class="form-group col-lg-3">
									<label class="control-label">Phone / Mobile<i class="glyphicon glyphicon-search"></i></label>
									<input type="text" class="form-control" id="customer_phone_number" name="customer_phone_number"/>
								</div>
								<div class="form-group col-lg-3">
									<label class="control-label">Customer Name</label>
									<input type="text" class="form-control" id="customer_name" name="customer_name"/>
								</div>
								<div class="form-group col-lg-3">
									<label class="control-label">Address</label>
									<input type="text" class="form-control" id="customer_address" name="customer_address" />
								</div>
								<div class="form-group col-lg-3">
									<label class="control-label">Email-id</label>
									<input type="text" class="form-control" id="customer_email_id" name="customer_email_id" />
								</div>
							</div>
							<div class="row">
								
								<div class="form-group col-lg-3">
									<label class="control-label">PAN Number</label>
									<input type="text" class="form-control" id="customer_pan_number" name="customer_pan_number" maxlength="10" style="text-transform:uppercase" onkeyup="pan_validate(this.value);" />
								</div>
							<?php /*	<div class="form-group col-lg-3">
									<label class="control-label">Upload Document</label>
									<input type="file"  id="invoice_upload_document" />
								</div> */?>
								<div class="form-group col-lg-3">
									<label class="control-label">ID Proof</label>
									<select id="id_proof" name="id_proof"  class="form-control">
									<option value="">Select ID Proof</option>
									<option value="voter">Voter Id</option>
									<option value="driving">Driving Licence</option>
									<option value="pan">PAN Number</option>
									<option value="passport">Passport Number</option>
									<option value="aadhar">Aadhar Number</option>
									</select>
								</div>
								<div class="form-group col-lg-3">
									<label class="control-label">ID Number</label>
									<input type="text" class="form-control" id="id_proof_number" name="id_proof_number"/>
								</div>
								<div style=" padding: 16px;" class="form-group col-lg-3">
									<label class="control-label">&nbsp;</label>
									<div class="clear-fix"></div>
									<div class="slidingDivTogale clear-fix">
									<a href="javascript:void(0);"  title="Add New"><i class="glyphicon glyphicon-plus"></i></a>
								</div>
								</div>
								
								<!--<div class="form-group col-lg-3">
									<label class="control-label">&nbsp;</label>
									<div class="clear-fix"></div>
									<a href="javascript:void(0);" class="btn btn-success" onclick="addMoreCustomerInfo();">Add More Customer Info.</a>
								</div>-->
								
							</div>
                    <div style="display:block" class="row slidingDiv">
                       
						<div class="form-group col-lg-3">
							<label class="control-label">State</label>
							<div class="controls">
							<input type="text" class="form-control" id="state" name="state" value=""/>
							<?php /*	<select id="state_id" name="state_id" data-rel="chosen" class="form-control" onchange="makeDistrictList();">
								<option value="">Select State</option>
								<?php foreach($state_master as $state) {  ?>
									<option value="<?php echo $state->state_id;?>" <?php echo  set_select('state_id', $state->state_id ); ?> ><?php echo $state->state_name;?></option>
								<?php } ?>
								</select>*/?>
								<span id="state_id_error"></span>
							</div>
						</div>
						<div class="form-group col-lg-3">
							<label class="control-label">District</label>
							
							<div class="controls" id="district_list">
							<input type="text" class="form-control" id="district" name="district" value=""/>
							<?php/*
								<select name="district_id" id="district_id" data-rel="chosen" class="form-control" onchange="makeCityList();">
								<option value="">Select District</option>
								
								</select>*/  ?>
							</div>
							<span id="district_id_error"></span>
						</div>
						<div class="form-group col-lg-3">
							<label class="control-label">City</label>
							<div class="controls" id="city_list">
							<input type="text" class="form-control" id="city" name="city" value=""/>
							<?php /*
								<select name="city_id" id="city_id" data-rel="chosen" class="form-control">
								<option value="">Select City</option>
								
								</select> */?>
							</div>
							<span id="city_id_error"></span>
						</div>
						<div class="form-group col-lg-3">
							<label class="control-label">Pincode</label>
							<input type="text" class="form-control" id="modal_customer_pincode" onkeypress="return isNumeric(event);" name="modal_customer_pincode" value="<?php echo set_value('modal_customer_pincode'); ?>" />
							<span id="modal_customer_pincode_error"></span>
						</div>
                  </div>							
							<hr/>
							<div class="row">
								<div class="form-group col-lg-2">
									<label class="control-label">Product Name</label>
								</div>
								<div class="form-group col-lg-1">
									<label class="control-label">Qty</label>
								</div>
								<div class="form-group col-lg-1">
									<label class="control-label">Weight(in gm)</label>
								</div>
								<div class="form-group col-lg-1">
									<label class="control-label">Total Weight(in gm)</label>
								</div>
								<div class="form-group col-lg-2">
									<label class="control-label">Unit Rate (Rs.)</label>
								</div>
								<div class="form-group col-lg-1">
									<label class="control-label">Discount %</label>
								</div>
								<div class="form-group col-lg-1">
									<label class="control-label">VAT %</label>
								</div>
								<div class="form-group col-lg-2">
									<label class="control-label">Serial#</label>
								</div>
								<div class="form-group col-lg-2">
									<label class="control-label">Net Amount (Rs.)</label>
								</div>
							</div>
							<div class="sales_invoice">
							<div class="row" id="sales_invoice-0">
								<div class="form-group col-lg-2">
									<div class="controls" id="product_div_id_0">
									
										<select id="product_id-0" name="product_id[]" data-rel="chosen" class="form-control" onchange="getPrice(this.id,'0');unselectproduct(this.id,'0')" >
										
										<option value="">Select Product</option>
										<?php foreach($product_master as $product){
											if(in_array($product->product_id,$todaysProducts)){
												$office_id = $this->session->userdata('office_id');
$table_name='product_current_stock_'.$office_id;
$product_current_stock=$this->base_model->get_record_by_id($table_name,array('product_id'=>$product->product_id));
$initialStock = isset($product_current_stock->product_current_stock) ? $product_current_stock->product_current_stock : '0';
						if($initialStock > '0'){
						?>
										
											<option value="<?php echo $product->product_id; ?>" ><?php echo $product->product_name; ?></option>
										<?php }
										} }?>
										</select>
									</div>
								</div>
								<div class="form-group col-lg-1">
									<input type="text" class="form-control" value=""  name="quantity[]" id="qty-0" onblur="getNetAmount(this.id,'0','');" onkeypress="return isNumberKey(event);" />
									<input type="hidden" class="form-control" value="" id="qty_current_stock-0" />
								</div>
								<div class="form-group col-lg-1" >
									<input type="text" class="form-control" name="weight[]" id="weight-0"  readonly="" />
								</div>
								<div class="form-group col-lg-1 ">
									<input type="text" class="form-control" name="total_weight[]" id="total_weight-0" readonly=""/>
								</div>
								<div class="form-group col-lg-2">
									<input type="text" class="form-control" id="price_rate-0"  value="" name="rate_per_quantity[]" readonly />
								</div>
								<div class="form-group col-lg-1">
									<input type="text" class="form-control" name="discount_percent[]" id="discount_percent-0" onblur="getNetAmount(this.id,'0','dis');" readonly="" />
								</div>
								<div class="form-group col-lg-1">
									<input type="text" class="form-control" id="tax-0" name="tax[]" readonly />
								</div>
								<div class="form-group col-lg-2 my-serial-number-class" id="serial_number_div0" >
									<input type="text" class="form-control" name="serial_number[]" id="sr_no-0" />
								</div>
								<div class="form-group col-lg-2">
									<input type="text" class="form-control" name="net_amount[]" readonly id="net_amount-0"/>
								</div>
							</div>
							</div>
							<div class="add_product_in_sales_invoice hide">
							
							</div>
							<div class="row">
								<div class="form-group col-lg-2 col-lg-push-11">
									<a href="javascript:void(0);" onclick="addNewProductSalesInvoice();" title="Add New"><i class="glyphicon glyphicon-plus"></i></a>
								</div>
							</div>
							<hr/>
						<!--	<div class="row">
								<div class="form-group col-lg-6">
									<label class="control-label">Mode of Payment :</label>
									<input type="radio" name="payment" id="optionsRadios3" value="cash" checked />
									Cash
									<input type="radio" name="payment" id="optionsRadios1" value="debit_card" />
									Debit Card
									<input type="radio" name="payment" id="optionsRadios2" value="credit_card" />
									Credit Card
								</div>
							</div> -->
							<div class="form-group col-lg-12">
							<div class="form-group col-lg-7" style="padding:0;">
							<div class="row form-group col-lg-12" style="padding:0;" id="sales_invoice_payment_mode-0">
								<div class="form-group col-lg-2" style="padding:0">
									
									<label class="control-label">Payment Mode</label>
									<div id="payment_div_id_0">
										<select id="payment_mode-0" name="payment_mode[]" data-rel="chosen" class="form-control" onchange="getcheckcard(this.id,'0');unselectpayment_mode(this.id,'0')" >
										<option value="">Select</option>
										<option value="cash">Cash</option>
										<option value="credit card">Credit Card</option>
										<option value="debit card">Debit Card</option>
										<option value="cheque">Cheque</option>
										<option value="neft">NEFT</option>
										</select>
										</div>
									</div>
								
								<div class="form-group col-lg-2" style="">
									<label class="control-label">Amount (Rs.)</label>
									<input type="text" class="form-control"style="" name="payment_mode_amount[]" id="payment_mode_amount_0" onchange="getTotal_received();"  />
								</div>
								<div class="form-group col-lg-3" id="div_card_data_0" style="display:none;">
									<label class="control-label" id="lable_card_0">Cheque No & Date</label>
									<input type="text" class="form-control" name="card_check_number[]" id="card_check_number_0" maxlength="4"  />
								</div>
								<div class="form-group col-lg-3" id="div_card_name_0" style="display:none;">
									<label class="control-label"  id="lable_card_name_0">Name on Card </label>
									<input type="text" class="form-control"   name="card_check_name[]" id="card_check_name_0"  />
								</div>
								<div class="form-group col-lg-2" id="div_issuing_bank_0" style="display:none;">
									<label class="control-label" style="width:73px;" id="lable_issuing_bank_0">Issu. Bank </label>
									<input type="text" class="form-control" name="card_issuing_bank[]" id="card_issuing_bank_0"  />
								</div>
								<!--<div class="form-group col-lg-3" id="div_cheque_relese_0" style="display:none;">
									<label class="control-label" id="lable_cheque_relese_0">Cheque Release</label>
									<input type="checkbox" class="form-control checkbox" value="1" name="cheque_relese[]" id="cheque_relese_0"  />
								</div>-->
								
								
									<div class="form-group col-lg-3" id="div_cheque_relese_0" style="display:none;">
									<label class="control-label">Cheq. Realization (Y/N)</label>
										<select id="cheque_relese_0" name="cheque_relese[]"  class="form-control">
										<option value="select">-Select-</option>
										<option value="0">No</option>
										<option value="1">Yes</option>
										</select>
										</div>
							</div>
							<div class="add_payment_mode hide">
							
							</div>
								<div class="row form-group col-lg-12" style="padding:0;">
								<div class="form-group col-lg-6" style="padding:0;">
								<label class="control-label" style=" margin-top: 10px;">Pending Amount (Rs.) &nbsp;:<span id='Pending'>  0  </span>&nbsp;</label>
									<a title="Add New" onclick="addNewPaymentMode();" href="javascript:void(0);"><i class="glyphicon glyphicon-plus"></i></a>
								</div>
								</div>
							</div>
							<div class="form-group col-lg-5" style="padding:0px;">
								
								<div class="row form-group col-lg-12">
									<div class="form-group col-lg-6">
										<label class="control-label pull-right" style=" margin-top: 10px;">Entry Tax Amount (Rs.)</label>
									</div>
									<div class="form-group col-lg-6">
										<input type="text" class="form-control" name="entry_tax_amount" id="entry_tax_amount" readonly />
									</div>
								</div>
								<div class="row form-group col-lg-12" >
									<div class="form-group col-lg-6">
										<label class="control-label pull-right" style=" margin-top: 10px;">Total Amount (Rs.)</label>
									</div>
									<div class="form-group col-lg-6">
										<input type="text" class="form-control" name="total_amount" id="total_amount" readonly />
									</div>
								</div>
								<div class="row form-group col-lg-12">
									<div class="form-group col-lg-6">
										<label class="control-label pull-right" style=" margin-top: 10px;">TCS Amount (Rs.)</label>
									</div>
									<div class="form-group col-lg-6">
										<input type="text" class="form-control" name="surcharge_on_vat" id="surcharge_on_vat" readonly />
									</div>
								</div>
								<div class="row form-group col-lg-12" >
									<div class="form-group col-lg-6">
										<label class="control-label pull-right" style=" margin-top: 10px;">Total Net Amount (Rs.)</label>
									</div>
									<div class="form-group col-lg-6">
										<input type="text" class="form-control" name="total_net_amount" id="total_net_amount" readonly />
										<input style='display:none;' type="text" class="form-control" name="total_net_amount2" id="total_net_amount2" readonly />
									</div>
								</div>
							</div>
							</div>
							
							<!--
							<div class="row">
								<div class="form-group col-lg-3 col-lg-push-6">
									<label class="control-label pull-right" style=" margin-top: 10px;">Surcharge on VAT</label>
								</div>
								<div class="form-group col-lg-3 col-lg-push-6">
									<input type="text" class="form-control" name="surcharge_on_vat" id="surcharge_on_vat" readonly />
								</div>
							</div>
							-->
							<div class="row">
								
							</div>
							<hr/>
							<div class="row">
								<div class="form-group col-lg-3 col-lg-push-0">
									<label class="control-label">Amount Received (Rs.)</label>
									<input type="text" readonly class="form-control" name="received_amount" id="received_amount" onkeypress="getAmountReceived();" />
								</div>
								<div class="form-group col-lg-2 col-lg-push-1">
									<label class="control-label" id="label_round_off" style="display:none;">Adjustment (Rs.)</label>
									<input type="text" class="form-control"   name="round_off" id="round_off" onblur="round();" style="display:none;" />
								</div>
								
								<div class="form-group col-lg-3 col-lg-push-3">
									<label class="control-label" >Amount Refunded (Rs.)</label>
									<input type="text" class="form-control" name="amount_refunded" id="amount_refunded" readonly />
								</div>
							</div>
							
							<div class="row">
								<div class="form-group col-lg-12 col-lg-push-3" style="width:14% !important;">
									<button type="submit" id="generate_invoice_btn" class="btn btn-primary">Save / Generate Invoice</button>
									<input type="hidden" name="selected_products_val"  id="selected_products_val" value="" />
							<input type="hidden" name="selected_payment_val" id="selected_payment_val" value="" />
							<input type="hidden" name="selected_payment_divs"  id="selected_payment_divs" value="" />
							<input type="hidden" name="selected_products_divs" id="selected_products_divs" value="" />
								</div>
								<div class="form-group col-lg-2 col-lg-push-4" style="width:14% !important;">
									<button type="button" class="btn btn-primary" onclick="javascript:window.location.reload();">Reset</button> 
									
								</div>
								<div class="form-group col-lg-2 col-lg-push-4" style="width:14% !important;">
									<button type="button" class="btn btn-primary" onclick="javascript:window.location.href='<?php echo base_url('invoice/sales_invoice_details');?>';">Cancel</button> 
									
								</div>
								<!--
								<div class="form-group col-lg-2 col-lg-push-6" style="width:11.5% !important;">
									<button type="button" class="btn btn-primary">Cancel Invoice</button>
								</div>
								<div class="form-group col-lg-3 col-lg-push-6">
									<button type="button" class="btn btn-primary">Generate Duplicate Invoice</button>
								</div> -->
							</div>
							
							</form>
						</div>
					</div>
				</div>
			</div><!--/row-->
    <!-- content ends -->
		</div><!--/#content.col-md-0-->
	</div><!--/fluid-row-->

<!--Modal Form For Customer Info---->
<div id="modal-customer-info" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 class="modal-title"><span id="product_text"></span>Customer Information</h3>
			</div>
			<form id="customer_info_form" method="post" onsubmit="return add_customer_info();">
			<div class="modal-body">			
				<div class="box-content">
					<div class="row">
						<div class="form-group col-lg-3">
							<label class="control-label">Name</label>
							<input type="text" class="form-control" id="modal_customer_name" name="modal_customer_name" value="<?php echo set_value('modal_customer_name'); ?>"/>
							<span id="modal_customer_name_error"></span>
						</div>
						<?php /*<div class="form-group col-lg-4">
							<label class="control-label">Customer Code</label>
							<input type="text" class="form-control" id="modal_customer_short_name" name="modal_customer_short_name" value="<?php echo set_value('modal_customer_short_name'); ?>"/>
							<span id="modal_customer_short_name_error"></span>
						</div>*/?>
						<div class="form-group col-lg-3">
							<label class="control-label">Email-id</label>
							<input type="text" class="form-control" id="modal_customer_email_id" name="modal_customer_email_id" value="<?php echo set_value('modal_customer_email_id'); ?>"/>
							<span id="modal_customer_email_id_error"></span>
						</div>
						<div class="form-group col-lg-3">
							<label class="control-label">Phone Number</label>
							<input type="text" class="form-control" id="modal_customer_phone_number" name="modal_customer_phone_number" value="<?php echo set_value('modal_customer_phone_number'); ?>"/>
							<span id="modal_customer_phone_number_error"></span>
						</div>
						<div class="form-group col-lg-3">
							<label class="control-label">Mobile Number</label>
							<input type="text" class="form-control" id="modal_customer_mobile_number" name="modal_customer_mobile_number" value="<?php echo set_value('modal_customer_mobile_number'); ?>"/>
							<span id="modal_customer_mobile_number_error"></span>
						</div>
					</div>
					<div class="row">
					<div class="form-group col-lg-4">
							<label class="control-label">ID Proof</label>
							<select name="proof_data" id="proof_data"  class="form-control" style="width:100%" >
								<option value="">Select ID Proof</option>
								<option value="voter">Voter Id</option>
								<option value="driving">Driving Licence</option>
								<option value="pan">PAN Number</option>
								<option value="passport">Passport Number</option>
								<option value="aadhar">Aadhar Number</option>
							</select> 
							
						</div>
						
						<div class="form-group col-lg-4">
							<label class="control-label">ID Number</label>
							<input type="text" class="form-control" id="id_number"  name="id_number"  />
							<span id="id_number_error"></span>
						</div>
						<div class="form-group col-lg-4">
							<label class="control-label">PAN Number</label>
							<input type="text" class="form-control" id="modal_customer_pan_number" name="modal_customer_pan_number" value="<?php echo set_value('modal_customer_pan_number'); ?>"/>
							<span id="modal_customer_pan_number_error"></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-lg-4">
							<label class="control-label">Address</label>
							<textarea id="modal_customer_address" name="modal_customer_address" rows="4" class="form-control"  style="resize:none;"><?php echo set_value('modal_customer_address');  ?></textarea>
							<span id="modal_customer_address_error"></span>
						</div>
						<div class="form-group col-lg-4">
							<label class="control-label">State</label>
							<div class="controls">
							<input type="text" class="form-control" id="state" name="state" value=""/>
							<?php /*	<select id="state_id" name="state_id" data-rel="chosen" class="form-control" onchange="makeDistrictList();">
								<option value="">Select State</option>
								<?php foreach($state_master as $state) {  ?>
									<option value="<?php echo $state->state_id;?>" <?php echo  set_select('state_id', $state->state_id ); ?> ><?php echo $state->state_name;?></option>
								<?php } ?>
								</select>*/?>
								<span id="state_id_error"></span>
							</div>
						</div>
						<div class="form-group col-lg-4">
							<label class="control-label">District</label>
							
							<div class="controls" id="district_list">
							<input type="text" class="form-control" id="district" name="district" value=""/>
							<?php/*
								<select name="district_id" id="district_id" data-rel="chosen" class="form-control" onchange="makeCityList();">
								<option value="">Select District</option>
								
								</select>*/  ?>
							</div>
							<span id="district_id_error"></span>
						</div>
						<div class="form-group col-lg-4">
							<label class="control-label">City</label>
							<div class="controls" id="city_list">
							<input type="text" class="form-control" id="city" name="city" value=""/>
							<?php /*
								<select name="city_id" id="city_id" data-rel="chosen" class="form-control">
								<option value="">Select City</option>
								
								</select> */?>
							</div>
							<span id="city_id_error"></span>
						</div>
						<div class="form-group col-lg-4">
							<label class="control-label">Pincode</label>
							<input type="text" class="form-control" id="modal_customer_pincode" onkeypress="return isNumeric(event);" name="modal_customer_pincode" value="<?php echo set_value('modal_customer_pincode'); ?>" />
							<span id="modal_customer_pincode_error"></span>
						</div>
						
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-sm btn-primary">Submit</button>
				
			</div>
			</form>
		</div>
	</div>
</div>	

<script type="text/javascript">
function TotalPaymentHidden()
	{
		var divSize = $(".add_payment_mode > div").size();
		var pass_hidden='';
		var counter_pay='0';
		for(var i=0;i<=divSize;i++)
		{
			
		if($("#sales_invoice_payment_mode-"+i).html()!='')
			{
				if(pass_hidden=='')
				{
				pass_hidden=i;
				}
				else
				{
					pass_hidden=pass_hidden+","+counter_pay;
				}
			}
			counter_pay++;
		}
		$("#selected_payment_divs").val(pass_hidden);	
	}
function TotalProductHidden()
	{
		var divSize = $(".add_product_in_sales_invoice > div").size();
		var pass_hidden_data='';
		
		var counter='0';
		for(var i=0;i<=divSize;i++)
		{
			
		if($("#sales_invoice-"+i).html()!='')
			{
			
				if(pass_hidden_data=='')
				{
				pass_hidden_data=counter;
				}
				else
				{
					pass_hidden_data=pass_hidden_data+","+counter;
				}
				
				
			}
			counter++;
		}
		
		$("#selected_products_divs").val(pass_hidden_data);	
	}
	$(document).ready(function(){
				
		
		/* $('#sales_invoice_date').datetimepicker({
			dateFormat: 'dd/mm/yy',
			timeFormat: 'HH:mm:ss',
			minDate:'<?php echo date('d/m/Y H:i:s');?>',
			maxDate:'<?php echo date('d/m/Y H:i:s');?>',
			
		}); */
	//	var offset = (new Date()).getTimezoneOffset();
	//	alert(offset)
			//$('#sales_invoice_date').datepicker('setDate', new Date());
		
		// make autocomplete
		$("#customer_phone_number").autocomplete({
										source: "getCustomerAutoSearch",
										minLength: 9,//search after two characters
										select: function(event,ui){
										//do something
											$(this).val(ui.item.label);
											fillCustomerInfo(ui.item.customer_id);
											//alert(ui.item.customer_id);
										}
		});
		$('#generate_invoice_btn').on('click', function() {});
		// generate invoice number
		/* office_id = "<?php echo $this->session->userdata('office_id'); ?>";
		$.ajax({
				url : "<?php echo base_url(); ?>invoice/getInvoiceNumber",
				type : "POST",
				data : {office_id:office_id},
				success : function(res){ 
						$('#show_invoice_number').html(res);
						$('#invoice_number').val(res);
						
				}
		});
		 */
		// ₹24000 get today price_rate		
	});
	function checkInvoiceForm()
	{
	//alert(formData);
	/*bootbox.confirm("You want to generate invoice? Are you sure?", function(result) {
	if(result==true)
	{*/
		//$('button[type="submit"]').addClass('disabled');	
	//resetErrors();
	var flag_submit=0;
	data_value= parseFloat($('#amount_refunded').val());
	if(data_value>0)
	{
		bootbox.confirm("Extra Recieved Amount is "+data_value +"."+ " Do you want to proceed  ?", function(result){
		if(result == true){
		$.ajax({
	
		dataType: 'json',
		type: 'POST',
		url: url,
		data: saveData,
		async: false,
		success : function (res){
	
			if(res.msg=='success'){
				//$('#customer_info_form').get(0).reset();
				window.location.href='<?php echo base_url('invoice/sales_invoice_receipt');?>?invoice_id='+res.invoice_id;
			}			
			else {
			$.each(res, function(i, v) {
				console.log(i + " => " + v); // view in console for error messages
				var arr_data=v.split("|||");
				
				if(arr_data[0] == 'Exists')
				{
					
					v='Serial number already used. Please select again';
					$('#qty-'+arr_data[1]).focus();
					
				}
					var msg = '<label class="error" for="'+i+'">'+v+'</label>';
					$('input[name="' + i + '"],input[id="' + i + '"],div[id="' + i + '"],select[id="' + i + '"]').addClass('inputTxtError').after(msg);
				});

				//var mydata = JSON.parse(res);
				/*$.each(res, function (k, v) {
					if (v.length > 0) {
						$('#' + k + '_error').html('<label class="error" for="'+k+'">'+v+'</label>');
						 $('input[name="' + k + '"],div[id="'+k+'"],div[id="'+k+'_chosen"], textarea[name="' + k + '"]').addClass('inputTxtError');
					}
					else{
						$('#' + k + '_error').html(v);
						 $('input[name="' + k + '"],div[id="'+k+'"],div[id="'+k+'_chosen"], textarea[name="' + k + '"]').removeClass('inputTxtError');
					}
				});*/
			}
		},
		cache: false, contentType: false, processData: false
		
		});
		
		}
		else{
			flag_submit=0;
		}
	 });
	}
	else{
		flag_submit=1;
	}
	//alert(flag_submit);
	resetErrors();
	var url = $('#form_sales_invoice').attr('action');
	var formData=$('#form_sales_invoice').serialize();
		var saveData = new FormData($('#form_sales_invoice')[0]);
	var amountReceived=0;	
if($('#received_amount').val()!='')
{
	amountReceived = parseFloat($('#received_amount').val());
	
}
var netAmount=0;
if($("#total_net_amount").val()!='')
{
netAmount = parseFloat($("#total_net_amount").val());
}
	
	TotalPaymentHidden();
	TotalProductHidden();
	
		if((amountReceived < netAmount) && $("#invoice_type :selected").val()!='advance'){
			alert("Received amount can't be less than total net amount");
		}
	if(flag_submit==1)
	{
		
	$.ajax({
	
		dataType: 'json',
		type: 'POST',
		url: url,
		data: saveData,
		async: false,
		success : function (res){
	
			if(res.msg=='success'){
				//$('#customer_info_form').get(0).reset();
				window.location.href='<?php echo base_url('invoice/sales_invoice_receipt');?>?invoice_id='+res.invoice_id;
			}			
			else {
			$.each(res, function(i, v) {
				console.log(i + " => " + v); // view in console for error messages
				var arr_data=v.split("|||");
				
				if(arr_data[0] == 'Exists')
				{
					
					v='Serial number already used. Please select again';
					$('#qty-'+arr_data[1]).focus();
					
				}
					var msg = '<label class="error" for="'+i+'">'+v+'</label>';
					$('input[name="' + i + '"],input[id="' + i + '"],div[id="' + i + '"],select[id="' + i + '"]').addClass('inputTxtError').after(msg);
				});

				//var mydata = JSON.parse(res);
				/*$.each(res, function (k, v) {
					if (v.length > 0) {
						$('#' + k + '_error').html('<label class="error" for="'+k+'">'+v+'</label>');
						 $('input[name="' + k + '"],div[id="'+k+'"],div[id="'+k+'_chosen"], textarea[name="' + k + '"]').addClass('inputTxtError');
					}
					else{
						$('#' + k + '_error').html(v);
						 $('input[name="' + k + '"],div[id="'+k+'"],div[id="'+k+'_chosen"], textarea[name="' + k + '"]').removeClass('inputTxtError');
					}
				});*/
			}
		},
		cache: false, contentType: false, processData: false
		
		});
		
			return false;
	}
	/*}
	else
	{
	$('button[type="submit"]').removeClass('disabled');	
	}*/

//}); 
	return false;
	}
	
	function getPrice(id,net_stock_id){
		myid = id.split('-');
		divnumber = (myid[1]) ? '-' + myid[1] : '';
		divnumber = net_stock_id;
		product_id = $('#'+id+' :selected').val();
        $('#qty-' + divnumber).val('');
		$.ajax({
				url : "<?php echo base_url(); ?>invoice/getPriceByProduct",
				type : "post",
				data : {product_id:product_id},
				success : function(res){ 
				mydata = JSON.parse(res);
					$('#price_rate-' + divnumber).val(mydata.price_rate.trim());
					$('#entry_tax').val(mydata.entry_tax.trim());
					if(mydata.tax.trim()!='null' || mydata.tax.trim()!='')
					{
					$('#tax-' + divnumber).val(mydata.tax.trim());	
					}
					else{
						$('#tax-' + divnumber).val('0');	
					}
					
					//$('#surcharge_on_vat').val(mydata.surcharge.trim());
					$('#qty_current_stock-'+net_stock_id).val(mydata.product_current_stock);
					$('#weight-'+net_stock_id).val(mydata.weight);
					
					
					//alert($('#price_rate' + divnumber).val());
				}
		});
		
	}
	function getcheckcard(id,divnumber)
	{
	var payment_mode=$('#'+id+' :selected').val();
          $("#card_check_number_"+divnumber).attr("placeholder", "");  
		  
		  var divSize = $(".add_payment_mode > div").size();
		var pass_hidden='';
		var counter_pay='0';
		var flag_show_rounfoff='0';
		for(var i=0;i<=divSize;i++)
		{
			
		if($("#sales_invoice_payment_mode-"+i).html()!='')
			{
				payment_value_sel = $('#payment_mode-'+i+' :selected').val();
				if(payment_value_sel=='cash')
				{
					flag_show_rounfoff=1;
				}
			}
			
		}
		if(flag_show_rounfoff==1)
		 {
			 $("#round_off").show();
			 $("#label_round_off").show();
		 }
		else
		{
			$("#round_off").val('');
			$("#round_off").hide();
			$("#label_round_off").hide();
		}
		 round();
		 
		if(payment_mode=='credit card' || payment_mode=='debit card')
		{
		$("#div_card_data_"+divnumber).show();
		$("#div_card_name_"+divnumber).show();
		$("#div_issuing_bank_"+divnumber).show();
		$("#div_issuing_bank_"+divnumber).val('');
		$("#div_cheque_relese_"+divnumber).hide();
		$("#lable_card_"+divnumber).html('Card No.');
		$('#card_check_number_'+divnumber).val('');
		$('#cheque_relese_'+divnumber).prop('checked', false);
		$('#card_check_number_'+divnumber).attr('maxlength','4');
		}
		else if(payment_mode=='cheque' || payment_mode=='neft')
		{
		$("#div_card_data_"+divnumber).show();
		$("#div_issuing_bank_"+divnumber).hide();
		$("#div_issuing_bank_"+divnumber).val('');
		$("#div_card_name_"+divnumber).hide();
		$('#card_check_name_'+divnumber).val('');
		if(payment_mode=='cheque')
		{
			$("#div_cheque_relese_"+divnumber).show();
			$("#div_issuing_bank_"+divnumber).show();
			$("#lable_card_"+divnumber).html('Cheque No. & Date');
			$("#card_check_number_"+divnumber).attr("placeholder", "123456/MM-DD-YYYY");
			
		}else{
		$("#lable_card_"+divnumber).html('NEFT Details');
		$("#div_cheque_relese_"+divnumber).hide();
		$('#cheque_relese_'+divnumber).prop('checked', false);
		}
		$('#card_check_number_'+divnumber).val('');
		
		$('#card_check_number_'+divnumber).attr('maxlength','');
		
		}
		else
		{
		$("#div_cheque_relese_"+divnumber).hide();
		$("#div_issuing_bank_"+divnumber).hide();
		$("#div_card_name_"+divnumber).hide();
		$("#div_cheque_relese_"+divnumber).hide();
		$('#card_check_name_'+divnumber).val('');
		$('#cheque_relese_'+divnumber).prop('checked', false);
		$('#card_check_number_'+divnumber).val('');
		$("#div_card_data_"+divnumber).hide();
		}
		if(payment_mode=='neft'){
		 $("#div_issuing_bank_"+divnumber).val('');
		 $("#div_issuing_bank_"+divnumber).show();
		}
		
		
	}
	function fillCustomerInfo(customerId){
		$.ajax({
				url : "<?php echo base_url(); ?>invoice/getCustomerInfo",
				type : "POST",
				data : {customer_id:customerId},
				success : function(res){
					mydata = JSON.parse(res);
						$('#customer_name').val(mydata.modal_customer_name);
						$('#customer_address').val(mydata.modal_customer_address);
						//$('#customer_phone_number').val(mydata.modal_customer_phone_number);
						$('#customer_email_id').val(mydata.modal_customer_email_id);
						$('#customer_pan_number').val(mydata.modal_customer_pan_number);
						$('#customer_transaction_id').val(mydata.customer_transaction_id);
						//$('#id_proof').val(mydata.id_proof);
						//$('#id_proof :selected').val(mydata.id_proof);
						//$("#id_proof option[value="+mydata.id_proof+"]").attr("selected", "selected");
						$("#id_proof > [value=" + mydata.id_proof + "]").attr("selected", "true");
						$('#id_proof_number').val(mydata.id_proof_number);
				}
		});
		
	}
	
	function addNewProductSalesInvoice()
	{
		var my_div = '';
		$('.add_product_in_sales_invoice').removeClass('hide').css('display','block');	
		var divSize = $(".add_product_in_sales_invoice > div").size();
        var already_products=$("#selected_products_val").val();
		$.ajax({
				url : "<?php echo base_url();?>invoice/AjaxAddNewDivCommon",
				type: "POST",
				data: {divSize:divSize,already_products:already_products,pageName:"sales_invoice_form"},
				success: function(res){
					if(divSize=='0'){
						$('.add_product_in_sales_invoice').html(res);
					}
					else{
						$('.add_product_in_sales_invoice').append(res);
					}
					myTotalValue();
				}
		});
	}
	function addNewPaymentMode()
	{
		var my_div = '';
		$('.add_payment_mode').removeClass('hide').css('display','block');	
		var divSize = $(".add_payment_mode > div").size();
var already_products=$("#selected_payment_val").val();
		$.ajax({
				url : "<?php echo base_url();?>invoice/AjaxAddNewDivCommon",
				type: "POST",
				data: {divSize:divSize,already_products:already_products,pageName:"sales_invoice_payment_mode_form"},
				success: function(res){
					if(divSize=='0'){
						$('.add_payment_mode').html(res);
					}
					else{
						$('.add_payment_mode').append(res);
					}
					myTotalValue();
					updateSelectedPaymentHidden();
				}
		});
	}
	function getTotal_received()
	{
	var total_amount_received=0;
	var divSize = $(".add_payment_mode > div").size();

		for(var i=0;i<=divSize;i++)
		{
			//if($("#payment_mode_amount_"+i).val()!='')
			
			if($("#sales_invoice_payment_mode-"+i).html()!='' && ($("#payment_mode_amount_"+i).val())!='')
			{
			total_amount_received=total_amount_received+parseFloat($("#payment_mode_amount_"+i).val());
			}
		}
		$("#received_amount").val(total_amount_received);
	
		if(($("#total_net_amount").val())!='0' && ($("#total_net_amount").val())!='')
		{
			var refunded=parseFloat($("#received_amount").val())-parseFloat($("#total_net_amount").val());
			refunded=parseFloat(refunded).toFixed(2);
			$("#amount_refunded").val(refunded);
		}
		else
		{
			$("#amount_refunded").val('0');
		}
		getAmountReceived();
		updateSelectedPaymentHidden();
	}
	
</script>
<script type="text/javascript">
function addMoreCustomerInfo()
{

	$('#modal-customer-info').modal('show');
	$('#state_id_chosen, #district_id_chosen, #city_id_chosen').css('width','80%');
}

function makeDistrictList(districtId,cityId)
{
	var stateId = $('#state_id :selected').val();
	$.ajax({
			url : "<?php echo base_url('masterForm/makeDistrictList');?>",
			type: "POST",
			data: {state_id:stateId,district_id:districtId},
			dataType: 'json',
			success:function(res){
				$('#district_list').html(res.district);
				if(cityId>0){
					makeCityList(cityId);
				}
			}
	});
}

function makeCityList(cityId)
{
	var districtId = $('#district_id :selected').val();
	$.ajax({
			url : "<?php echo base_url('masterForm/makeCityList');?>",
			type: "POST",
			data: {district_id:districtId,city_id:cityId},
			dataType: 'json',
			success:function(res){
				$('#city_list').html(res.city);
			}
	});
}

function add_customer_info()
{
//	var saveData =  $('#customer_info_form').serialize();

	resetErrors();
	var saveData = new FormData($('#customer_info_form')[0]);
	
	$.ajax({
		
		url : "<?php echo base_url('invoice/add_customer_info'); ?>",
		data : saveData,
		async : false,
		type: "post",
		success : function (res){
		var arr_data=res.split("|||");
			if(arr_data[1]=='1'){
				$('#customer_info_form').get(0).reset();
				window.location.reload();
			}			
			else {
			
				var mydata = JSON.parse(arr_data[1]);
				$.each(mydata['Error'], function (k, v) {
					if (v.length > 0) {
						$('#' + k + '_error').html('<label class="error" for="'+k+'">'+v+'</label>');
						 $('input[name="' + k + '"],div[id="'+k+'"],div[id="'+k+'_chosen"], textarea[name="' + k + '"]').addClass('inputTxtError');
					}
					else{
						$('#' + k + '_error').html(v);
						 $('input[name="' + k + '"],div[id="'+k+'"],div[id="'+k+'_chosen"], textarea[name="' + k + '"]').removeClass('inputTxtError');
					}
				});
			}
		},
		cache: false, contentType: false, processData: false
	});
	return false;
}

function getNetAmount(id,net_stock_id,dis){
	myid = id.split('-');
	divnumber = (myid[1]) ? '-' + myid[1] : '';
	divnumber = net_stock_id;
	net_stock=$('#qty_current_stock-' + net_stock_id).val();
	if(net_stock>='0'){
	if((parseFloat($('#qty-' + divnumber).val())>parseFloat(net_stock)) || net_stock=='0'){
		/* alert('Qty should not be greater than Net Current Stock Ordered['+net_stock+']!');
		$('#qty' + divnumber).val('');
		$('#net_amount' + divnumber).val('');
		$("#total_net_amount").val('');
        $("#total_amount").val('');		
		$('#qty' + divnumber).focus(); */
		
	      $('#qty-' + divnumber).removeClass('inputTxtError');
          $('label[for="qty-'+divnumber+'"]').remove();
		  var msg = '<label class="error" for="qty-'+divnumber+'">Qty should not be greater than Net Current Stock Ordered!</label>';
       $('input[id="qty-'+divnumber+'"]').addClass('inputTxtError').after(msg);
	}else{
	resetErrors();
	// entryTaxValue = parseFloat($("#entry_tax").val());
	taxValue = parseFloat($('#tax-' + divnumber).val());
	priceRate = (parseFloat($('#price_rate-' + divnumber).val())) ? parseFloat($('#price_rate-' + divnumber).val()) : '0' ;
	quantity = (parseFloat($('#qty-' + divnumber).val())) ? parseFloat($('#qty-' + divnumber).val()) : '0' ;
	discountValue = (parseFloat($('#discount_percent-' + divnumber).val())) ? parseFloat($('#discount_percent-' + divnumber).val()) : '0' ;
	if($('#weight-'+divnumber).val()!='')
	{
	$('#total_weight-'+divnumber).val(quantity*parseFloat($('#weight-'+divnumber).val()));
	}
	surcharge = (parseFloat($('#surcharge_on_vat').val())) ? parseFloat($('#surcharge_on_vat').val()) : '0' ;
	$('.calculateButtonDiv').removeClass('hide');
	amount = (quantity * priceRate);
	totalTax = (amount * taxValue)/100;
	// totalEntryTax = (amount * entryTaxValue)/100;
	discountAmount = (amount * discountValue)/100;
	totalAmount = (amount + totalTax - discountAmount);
	if(dis!='dis')
	{
	fillserial_number_invoice_form(net_stock_id,quantity);
	}
	totalAmount= Math.round(totalAmount);
	totalAmount=parseFloat(totalAmount).toFixed(2);
	
	$('#net_amount-' + divnumber).val(totalAmount);
	
	myTotalValue();	
	getTotal_received();
		
	}
  }else{
	// entryTaxValue = parseFloat($("#entry_tax").val());
	 taxValue = parseFloat($('#tax-' + divnumber).val());
	priceRate = (parseFloat($('#price_rate-' + divnumber).val())) ? parseFloat($('#price_rate-' + divnumber).val()) : '0' ;
	quantity = (parseFloat($('#qty-' + divnumber).val())) ? parseFloat($('#qty-' + divnumber).val()) : '0' ;
	discountValue = (parseFloat($('#discount_percent-' + divnumber).val())) ? parseFloat($('#discount_percent-' + divnumber).val()) : '0' ;
	if($('#weight-'+divnumber).val()!='')
	{
	$('#total_weight-'+divnumber).val(quantity*parseFloat($('#weight-'+divnumber).val()));
	}
	surcharge = (parseFloat($('#surcharge_on_vat').val())) ? parseFloat($('#surcharge_on_vat').val()) : '0' ;
	$('.calculateButtonDiv').removeClass('hide');
	amount = (quantity * priceRate);
	totalTax = (amount * taxValue)/100;
	//  totalEntryTax = (amount * entryTaxValue)/100;
	discountAmount = (amount * discountValue)/100;
	totalAmount = (amount + totalTax - discountAmount);
	totalAmount= Math.round(totalAmount);
	totalAmount=parseFloat(totalAmount).toFixed(2);
	
	$('#net_amount-' + divnumber).val(totalAmount);	
	if(dis!='dis')
	{
	fillserial_number_invoice_form(net_stock_id,quantity);
	}
	
	myTotalValue(); 
	//getTotal_received();
	  getTotal_received();
	  
  }
}

function myTotalValue()
{
	AmountValue='0';
	totalAmountValues = '0';
	totalUnitValues = '0';
	//firstNetValue = $('#net_amount-0').val();
	AmountValue = '0';
	var divSize = $(".add_product_in_sales_invoice > div").size();
	for(i=0;i<=divSize;i++){
			if($("#sales_invoice-"+i).html()!='')
			{
				unitValue = (parseFloat($('#price_rate-' + i).val())) ? parseFloat($('#price_rate-' + i).val()) * parseFloat($("#qty-" + i).val()) : '0' ;
				myValue = (parseFloat($('#net_amount-' + i).val())) ? parseFloat($('#net_amount-' + i).val()) : '0' ;
				totalAmountValues = parseFloat(totalAmountValues) + parseFloat(myValue);
				totalUnitValues = parseFloat(totalUnitValues) + parseFloat(unitValue);
			}
	}
	
	entryTaxValue = $("#entry_tax").val();
	totalEntryTax = Math.round((totalUnitValues*entryTaxValue)/100);

	AmountValue = parseFloat(AmountValue) + parseFloat(totalAmountValues) + totalEntryTax;
	surcharge = (parseFloat($('#surcharge_on_vat').val())) ? parseFloat($('#surcharge_on_vat').val()) : '0' ;
	AmountValue=parseFloat(AmountValue).toFixed(2);
	$("#total_amount").val(AmountValue);
	$("#entry_tax_amount").val(parseFloat(totalEntryTax).toFixed(2));
	var surcharge='0';
	if(AmountValue>=200000)
	{
	
		var sel_payments=$("#selected_payment_val").val();
	
		if(sel_payments.indexOf("cash")>=0)
		{
			surcharge=AmountValue/100;
		}
		else{
			surcharge='0';
		}
	}
	surcharge=Math.ceil(surcharge);
	surcharge=parseFloat(surcharge).toFixed(2);
	$('#surcharge_on_vat').val(surcharge);
	netAmountValue = AmountValue + parseFloat(surcharge) + totalEntryTax;
	netAmountValue=parseFloat(netAmountValue).toFixed(2);
	$("#total_net_amount2").val(netAmountValue);
	$("#total_net_amount").val(netAmountValue);
}

function totalCalculation()
{
	myTotalValue();
}

function getAmountReceived()
{
var amountReceived = '0';
var netAmount = '0';
if($('#received_amount').val()!='')
{
	amountReceived = parseFloat($('#received_amount').val());
	
}
if($("#total_net_amount").val()!='')
{
netAmount = parseFloat($("#total_net_amount").val());
}


	
	var refundAmount = '0';
	$('#amount_refunded').val('0');
	if(amountReceived < netAmount){
		//alert("Received amount can't be less than total net amount");
		//$('#generate_invoice_btn').addClass('disabled');
	}
	else{
          refundAmount = parseFloat(amountReceived) - parseFloat(netAmount); //change
		//refundAmount = amountReceived - netAmount;
	if(refundAmount>=0)
	{
	$('#generate_invoice_btn').removeClass('disabled');
	}
	
	}
	$('#amount_refunded').val(parseFloat(refundAmount).toFixed(2)); // change
	panddingAmount = (parseFloat($("#total_net_amount").val()) - (amountReceived));
	//alert(panddingAmount);
	if(panddingAmount>0)
	{
	panddingAmount=parseFloat(panddingAmount).toFixed(2);
      $("#Pending").text(panddingAmount);
	}else{
		$("#Pending").text(0);
	}
}

	function fillserial_number_invoice_form(net_stock_id,quantity)
	{
		var product_id=$('#product_id-'+net_stock_id).val();
		//product_current_stock_serial_number_2
		var tableName = "product_current_stock_serial_number_<?php echo $this->session->userdata('office_id');?>";
		$.ajax({
				url : "<?php echo base_url();?>invoice/getSerialNumberSeries",
				type: "POST",
				data: {product_id:product_id,table_name:tableName,net_stock_id:net_stock_id,quantity:quantity,pageName:"sales_invoice_form",fieldName:"product_serial_number"},
				success: function(resp){
					$('#serial_number_div'+net_stock_id).html(resp);
				//	$('#stock_serial_list'+net_stock_id).html(resp);
				}
		});
	}
	function unselectproduct(id,cur_div)
	{
	updateSelectedProductHidden();
		var divSize = $(".add_product_in_sales_invoice > div").size();
		var already_products = $("#selected_products_val").val();
		product_id = $('#'+id+' :selected').val();
		for(var k=0;k<=divSize;k++)
		{
			if(k!=cur_div && $("#sales_invoice-"+i).html()!='')
			{
			others_product_val = $('#product_id-'+k+' :selected').val();
			$('#qty-'+cur_div).val('');
			$('#weight-'+cur_div).val('');				
			$('#total_weight-'+cur_div).val('');	
			$('#price_rate-'+cur_div).val('');	
			$('#discount_percent-'+cur_div).val('');	
			$('#tax-'+cur_div).val('');	
//$('#serial_number_'+cur_div+'_chosen').html('serial number');	
			
					$.ajax({
					url : "<?php echo base_url();?>invoice/AjaxAddNewDivCommon",
					type: "POST",
					data: {divSize:k,select_product:others_product_val,already_products:already_products,pageName:"sales_invoice_change_products"},
					success: function(res){
					var arr_res=res.split('|||');
							
							$('#product_div_id_'+arr_res[1]).html(arr_res[2]);
							
					}
					});
				
			}
		}
		
	}
	function updateSelectedProductHidden()
	{
	var divSize = $(".add_product_in_sales_invoice > div").size();
	var h_data='';
		for(var i=0;i<=divSize;i++)
		{
			if($("#sales_invoice-"+i).html()!='')
			{
				others_product_val = $('#product_id-'+i+' :selected').val();
					if(others_product_val!='')
					{
					
						if(h_data=='')
						{
							h_data=others_product_val;
						}
						else
						{
							h_data=h_data+","+others_product_val;
						}
					}
			}
		}
		
		$("#selected_products_val").val(h_data);	
		
	}
	
	function unselectpayment_mode(id,cur_div)
	{
	updateSelectedPaymentHidden();
		var divSize = $(".add_payment_mode > div").size();
		var already_products = $("#selected_payment_val").val();
		payment_id = $('#'+id+' :selected').val();
		for(var k=0;k<=divSize;k++)
		{
			if(k!=cur_div && $("#sales_invoice_payment_mode-"+k).html()!='')
			{
			others_product_val = $('#payment_mode-'+k+' :selected').val();
				
					$.ajax({
					url : "<?php echo base_url();?>invoice/AjaxAddNewDivCommon",
					type: "POST",
					data: {divSize:k,select_product:others_product_val,already_products:already_products,pageName:"sales_invoice_change_payment_type"},
					success: function(res){
					var arr_res=res.split('|||');
					$('#payment_div_id_'+arr_res[1]).html(arr_res[2]);		
					}
					});
				
			}
		}
		
	}
	function unselectpayment_mode_remove()
	{
	updateSelectedPaymentHidden();
		var divSize = $(".add_payment_mode > div").size();
		var already_products = $("#selected_payment_val").val();
		
		for(var k=0;k<=divSize;k++)
		{
			if($("#sales_invoice_payment_mode-"+k).html()!='')
			{
			others_product_val = $('#payment_mode-'+k+' :selected').val();
				
					$.ajax({
					url : "<?php echo base_url();?>invoice/AjaxAddNewDivCommon",
					type: "POST",
					data: {divSize:k,select_product:others_product_val,already_products:already_products,pageName:"sales_invoice_change_payment_type"},
					success: function(res){
					var arr_res=res.split('|||');
					$('#payment_div_id_'+arr_res[1]).html(arr_res[2]);		
					}
					});
				
			}
		}
		
	}
	function updateSelectedPaymentHidden()
	{
	var divSize = $(".add_payment_mode > div").size();
	var h_data='';
		for(var i=0;i<=divSize;i++)
		{
			if($("#sales_invoice_payment_mode-"+i).html()!='')
			{
				var others_payment_val = $('#payment_mode-'+i+' :selected').val();
					if(others_payment_val!='')
					{
					
						if(h_data=='')
						{
							h_data=others_payment_val;
						}
						else
						{
							h_data=h_data+","+others_payment_val;
						}
					}
			}
		}
		
		$("#selected_payment_val").val(h_data);	
		AmountValue=$("#total_amount").val();
		var surcharge='0';
		if(parseFloat(AmountValue)>=200000)
		{
			
			var sel_payments=$("#selected_payment_val").val();
			
			if(sel_payments.indexOf("cash")>=0)
			{
				surcharge=AmountValue/100;
			}
			else
			{
				surcharge='0';
			}
		}
		surcharge=Math.ceil(surcharge);
		surcharge=parseFloat(surcharge).toFixed(2);
		$("#surcharge_on_vat").val(surcharge);
		netAmountValue = parseFloat(AmountValue) + parseFloat(surcharge);
		total_amount_hidden_value=netAmountValue;
		total_amount_hidden_value=parseFloat(total_amount_hidden_value).toFixed(2);
		round_off=$('#round_off').val();
		//alert(round_off);
		if(round_off!=null && round_off!='')
		{
			if(round_off>=-10 && round_off<=10)
			{
				
				net_amount=netAmountValue;
				if(round_off<0)
				{
				  recive=net_amount-round_off;
				  recive=recive.toFixed(2);
				}
				if(round_off=>0)
				{
				  recive=parseFloat(net_amount)+parseFloat(round_off);
				  recive=recive.toFixed(2);
				}
				if(recive)
				{
					netAmountValue=recive;
					//$('#received_amount').val(recive);
					//$('#total_net_amount').val(recive);
				}
				
			}
		}
		netAmountValue=parseFloat(netAmountValue).toFixed(2);
		$("#total_net_amount2").val(total_amount_hidden_value);
		$("#total_net_amount").val(netAmountValue);
	}

	
function resetErrors() {
    $('form input,#initial_stock_starting_store_date,div.chosen-container,form select').removeClass('inputTxtError');
    $('label.error').remove();
}
function round()
{
	if($('#round_off').val()!='')
	{
	 round_off=$('#round_off').val();
	}else{
		round_off=0;

	}
	if(round_off>=-10 && round_off<=10)
	{
		
		net_amount=$('#total_net_amount2').val();
		if(round_off<0)
		{
		  recive=net_amount-round_off;
		  recive=recive.toFixed(2);
		}
		if(round_off=>0)
		{
		  recive=parseFloat(net_amount)+parseFloat(round_off);
		  recive=recive.toFixed(2);
		}
		if(recive)
		{
			amountReceived =0;
			if($('#received_amount').val()!='')
			{
				amountReceived = parseFloat($('#received_amount').val());
				
			}
			if($("#total_net_amount").val()!='')
			{
			   
			   panddingAmount = (parseFloat(recive) - (amountReceived));
			   panddingAmount=parseFloat(panddingAmount).toFixed(2);
			   if(panddingAmount>=0)
			   {
                 $("#Pending").text(panddingAmount);
			   }else{
				   $("#Pending").text(0);
			   }
			}
			//$('#received_amount').val(recive);
			$('#total_net_amount').val(recive);
			rec_value = $('#received_amount').val();
			if(rec_value =="" || rec_value=="null")
			{
				rec_value=0;
			}
			total_net_amount = $('#total_net_amount').val();
			balanceRefund = parseFloat(rec_value) - parseFloat(total_net_amount);
			if(balanceRefund>=0)
			{
			  $('#amount_refunded').val(parseFloat(balanceRefund).toFixed(2));
			}
			else{
				   $("#amount_refunded").val('0.00');
			   }
		}
		
	}
	else{
		alert("Please enter value from -10 to +10");
		return false;
	}
	
}

function newCheck()
{
	data_value= parseFloat($('#amount_refunded').val());
	if(data_value>0)
	{
		bootbox.confirm("Refunded Amount is "+data_value, function(result){
		if(result == true){
			checkInvoiceForm();
			return false;
		}
		else{
			
		}
	 });
	}else{
		checkInvoiceForm();
		return false;
	}
	 
}
$(document).ready(function(){

$(".slidingDiv").hide();
	$('.slidingDivTogale').click(function(){
	$(".slidingDiv").slideToggle();
	});

});

function pan_validate(pan)
{
	$("#pan_error").remove();
	var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
	if(regpan.test(pan) == false)
	{
		$("#customer_pan_number").after("<span class='error' id='pan_error'>Please enter valid PAN number.</span>");
		$("#generate_invoice_btn").addClass("disabled");
	}
	else{
		$("#generate_invoice_btn").removeClass("disabled");
	}
	if(pan == '')
	{
		$("#generate_invoice_btn").removeClass("disabled");
		$("#pan_error").remove();
	}
}

function transaction_validation(tras_id)
{
	$("#tras_id").remove();
	var regtransaction = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
	if(regtransaction.test(tras_id) == false)
	{
		$("#customer_transaction_id").after("<span class='error' id='tras_id'>Please enter alphanumeric number.</span>");
		$("#generate_invoice_btn").addClass("disabled");
	}
	else{
		$("#generate_invoice_btn").removeClass("disabled");
	}
	if(tras_id == '')
	{
		$("#generate_invoice_btn").removeClass("disabled");
		$("#tras_id").remove();
	}
}
</script>

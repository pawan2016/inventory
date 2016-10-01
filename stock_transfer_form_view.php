<style type="text/css" media="print">
	.navbar, .nav-canvas, .breadcrumb, .breadcrumb-my-toggle, .no_print, .viewPage
        {
		display:none;
	}
	
	.view_scroll
	{
		height:100% !important;
		overflow:unset !important;
	}
	/*
	.col-lg-4
	{
		width:190px !important;
	}
	*/
	#product_id0_chosen
	{
		width:200px !important;
		margin-right:0px;
	}
	
	#vendor_id_chosen
	{
		width:200px !important;
	}
	#stock_transfer_mode_chosen
	{
		width:100px !important;
	}
	.col-lg-1
	{
		width:80px !important;
	}
	/*
	.col-lg-2
	{
		width:200px !important;
	}
	*/
	.col-lg-3
	{
		width:200px !important;
	}
	.print_chosen
	{
		width:200px !important;
	}
	.show_print, .myprintPage
	{
		display:block !important;
	}
.col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 {
    float: left !important;
}
	
</style>
<style type="text/css">
.view_scroll
	{
		
		height:100px;overflow:hidden;overflow-y: scroll;
	}
	.show_print, .myprintPage
	{
		display:none;
	}
</style>
<style>
#printby, .printby{display:none;}
</style>
<style type="text/css" media="print">
#reset_button{display:none;}
.btn-primary, .dataTables_filter, .dataTables_paginate, .dataTables_info, .breadcrumb, .breadcrumb-my-toggle, .dataTables_length {display : none;}
.showmyprint{width:50%; float:left;}
.box-header>h2{text-align:center;}
#printby, .printby{display:block !important; font-weight:bold; padding:15px;}
.myheader{width:33%; float:left;}
.box, .box-content, .well{padding:0px !important;}
.my-heading-class{padding:0px !important; margin:0px !important;}
.my-heading-class h2 {font-size:15px; font-weight:bold;}
@page { size: landscape; }
</style>
<?php /*height:100px;overflow:hidden;overflow-y: scroll;*/?>
<?php
if($view_page=='1')
{

	$view_transfer_detail=$view_data['stock_transfer_detail'];
	$stock_transfer_number_view=$view_transfer_detail->stock_transfer_number;
	$stock_transfer_date_view=$view_transfer_detail->stock_transfer_date;
	//$transfer_office_data=$this->db->get_where('office_master',array('office_id'=>$view_transfer_detail->office_id))->row();
	$this->db->where('office_id',$view_transfer_detail->stock_transfer_to_office_id);
	$this->db->select('office_master.*,regional_store_master.regional_store_type')->from('office_master,regional_store_master');
	$transfer_office_data=$this->db->get()->row();

	$this->db->join('regional_store_master','office_master.regional_store_id = regional_store_master.regional_store_id');
	$transfer_to_view=$transfer_office_data->office_name.'-'.$transfer_office_data->office_operation_type.'('.$transfer_office_data->regional_store_type.')';
	$stock_transfer_mode_view=$view_transfer_detail->stock_transfer_mode;
	$stock_transfer_mode_number_view=$view_transfer_detail->stock_transfer_mode_number;
	$stock_transfer_narration_view=$view_transfer_detail->stock_transfer_narration;

	$view_transfer_product=$view_data['stock_transfer_product_detail'];
	$access_level_status = $view_transfer_detail->access_level_status;
}

 ?>
<div class="ch-container">
    <div class="row my-container-class viewPage">
        <div id="content" class="col-lg-12 col-sm-12">
            <!-- content starts -->
            <div>
				<ul class="breadcrumb col-lg-9 col-sm-9">
					<li>
						<a href="#">Home</a>
					</li>
					<li>
						<a href="#">Inventory</a>
					</li>
					<li>
						<a href="#">Stock Transfer</a>
					</li>
				</ul>
				<ul class="breadcrumb-my-toggle text-right  col-lg-3 col-sm-3">
					<li>
					<?php if($access_level_status == '1'){ ?>
					<a href="javascript:void();" onClick="javascript:window.print();">Print</a>&nbsp;|&nbsp;<?php } ?><a href="<?php echo base_url('inventory/stock_transfer_inventory'); ?>">Stock Transfer Table</a>
					</li>
				</ul>
			</div>
			<?php if($this->session->flashdata('SuccessMessage')){ ?>
				<span class="alert alert-success col-lg-12">
				 <button type="button" class="close" data-dismiss="alert">x</button>
                    <?php echo $this->session->flashdata('SuccessMessage'); ?>
                </span>
			<?php } ?>
			<div class="row">
			<div class="col-md-10 col-md-push-1 half-md-div">
				<div class="box col-lg-12 col-md-12 col-xs-12" style=" margin-top: -10px;">
					<div class="box-inner">
						<div class="box-header well">
							<h2>Stock Transfer Form</h2>
						</div>
						<?php
						
						 $attributes = array('class' => '', 'id' => 'stock_transfer_form');
					         echo form_open('inventory/stock_transfer_form', $attributes);?>
						<div class="box-content">
							<div class="row">
								<div class="form-group col-lg-4">
									<label class="control-label">Date of Transfer</label>
									<input type="text" class="form-control" id="stock_transfer_date" name="stock_transfer_date" readonly value="<?php echo $stock_transfer_date_view;?>" />
								</div>
								<div class="form-group col-lg-4">
									<label class="control-label">Stock Transfer Number</label>
									<input type="text" class="form-control" id="stock_transfer_number" name="stock_transfer_number" value="<?php echo $stock_transfer_number_view;?>" readonly  />
								</div>
							<!--<div class="form-group col-lg-3">
									<label class="control-label">Click To Change</label>
									<input type="button" class="btn btn-success" id="generateRandomNumber" onclick="generateRandomNumber();" value="Transfer Number" />
								</div>  -->
								<div class="form-group col-lg-4">
									<label class="control-label">Transfer To</label>
									<div class="controls">
										<select name="stock_transfer_to_office_id" id="stock_transfer_to_office_id" data-rel="chosen" class="form-control disabled" onchange="generateStockTransferNo(this.value);" >
										<?php if($transfer_to_view!='')
										{
										?>
										<option value=""><?php echo $transfer_to_view;?></option>
										<?php
										}
										else
										{
										?>
										<option value="">Select Transfer To</option>
										<?php foreach($transfer_to as $Transfer_to){?>
											<option value="<?php echo $Transfer_to->office_id;?>"><?php echo $Transfer_to->office_name;?>-<?php echo $Transfer_to->office_operation_type;?>(<?php echo $Transfer_to->regional_store_type;?>)</option>
										<?php } ?>
										<?php
										}
										?>
										</select>
										<input type="hidden" class="form-control" id="office_operation_type_hidden" disabled />
										<input type="hidden" class="form-control" id="stock_transfer_to_office_id_hidden" disabled />
									</div>
								</div>
							</div>
							<div class="row">
							    <!--<div class="form-group col-lg-4">
									<label class="control-label">Status</label>
									<div class="controls">
										<select name="stock_transferStatus" id="stock_transferStatus" data-rel="chosen" class="form-control" onchange="return false;">
										<option value="">Select Status</option>
										<option value="In-Transit">In-Transit</option>
										<option value="Received">Received</option>
										</select>
									</div>
								</div>-->
								<div class="form-group col-lg-4">
									<label class="control-label">Mode</label>
									<select name="stock_transfer_mode" id="stock_transfer_mode" data-rel="chosen" class="form-control" disabled >
									<option value="">Select Mode</option>
									<option value="Air" <?php if(strtolower($stock_transfer_mode_view)=='air') { echo "selected";} ?>>Air</option>
									<option value="By Road" <?php if(strtolower($stock_transfer_mode_view)=='by road') { echo "selected";} ?>>By Road</option>
									<option value="By Own Vehicle" <?php if(strtolower($stock_transfer_mode_view)=='by own vehicle') { echo "selected";} ?>>By Own Vehicle</option>
									<option value="Courier" <?php if(strtolower($stock_transfer_mode_view)=='courier') { echo "selected";} ?>>Courier</option>
									<option value="Train" <?php if(strtolower($stock_transfer_mode_view)=='train') { echo "selected";} ?>>Train</option>
									
									</select>
							<?php /*		<input type="text" class="form-control" id="stock_transfer_mode" name="stock_transfer_mode" value="<?php echo $stock_transfer_mode_view;?>" />*/?>
								</div>
								<div class="form-group col-lg-4">
									<label class="control-label">Mode Reference Number</label>
									<input type="text" class="form-control" disabled id="stock_transfer_mode_number" name="stock_transfer_mode_number" value="<?php echo $stock_transfer_mode_number_view;?>"/>
							<?php /*		<input type="text" class="form-control" id="stock_transfer_mode" name="stock_transfer_mode" value="<?php echo $stock_transfer_mode_view;?>" />*/?>
								</div>
								<div class="form-group col-lg-4">
									<label class="control-label">Narration</label>
									<input type="text" class="form-control" disabled id="stock_transfer_narration" name="stock_transfer_narration" value="<?php echo $stock_transfer_narration_view;?>"/>
								</div>
							</div>
							<hr/>
							<div class="row">
								<div class="form-group col-lg-3">
									<label class="control-label">Product Name</label>
								</div>
								<div class="form-group col-lg-1">
									<label class="control-label">Quantity</label>
								</div>
								<div class="form-group col-lg-4 no_print">
									<label class="control-label">Serial No.</label>
								</div>
								<div class="form-group col-lg-1">
									<label class="control-label">Weight(in gm)</label>
								</div>
								<div class="form-group col-lg-1">
								<label class="control-label">Total Weight(in gm)</label>
								</div><!--
								<div class="form-group col-lg-1">
									<label class="control-label">Net Stock</label>
								</div>-->
								<div class="form-group col-lg-2">
									<label class="control-label">Remarks</label>
								</div>
							</div>
							<?php
							$arr_sel_serial_numer=array();
							if(!empty($view_transfer_product))
							{
							foreach($view_transfer_product as $product_transferred)
							{
							?>
							<div class="row">
								<div class="form-group col-lg-3">
									<div class="controls">
										<select data-rel="chosen" class="form-control print_chosen" id="product_id0" name="product_id[]" onChange="getInitialStock(this.value,'0');"  disabled="disabled" >
										    <option value=""><?php echo $product_transferred->product_name;?></option>
											
										</select>
									</div>
								</div>
								<div class="form-group col-lg-1">
									<input type="text" class="form-control" id="stock_transfer_product_quantity0" name="stock_transfer_product_quantity[]" readonly="" value="<?php echo $product_transferred->stock_transfer_product_quantity;?>" />
									
								</div>
								<div  id="stock_serial_list0" style="" class="form-group col-lg-4 view_scroll no_print">
								<?php $transferred_serial_numbers=$view_data['stock_transfer_product_serials_detail'][$product_transferred->stock_transfer_product_id];?>
									<select data-rel="chosen" class="form-control" id="stock_transfer_product_serial_number_view<?php echo $val_serials->stock_transfer_product_serial_number_id;?>" name="stock_transfer_product_serial_number_view[]" multiple  disabled="disabled" >
									<?php
									foreach($transferred_serial_numbers as $val_serials)
									{
										$arr_sel_serial_numer[]=$val_serials->stock_transfer_product_serial_number;
									?>
									<option selected="selected"><?php echo $val_serials->stock_transfer_product_serial_number;?></option>
									<?php
									}
									?>
									</select>
											
								</div>
								<div class="form-group col-lg-1">
									<input type="text" class="form-control" id="stock_transfer_product_weight0" name="stock_transfer_product_weight[]" readonly="" value="<?php echo $product_transferred->stock_transfer_product_weight;?>" />
								</div>
								<?php
								$ofiice_id=$this->session->userdata('office_id');
								
							$net_stock_his=$this->db->query('select * from inventory_office_history_'.$ofiice_id." where createdOn='".$product_transferred->createdOn."'")->row();
								?>
								<!--
								<div class="form-group col-lg-1">
									<input type="text" class="form-control" id="stock_product_net_initial0" disabled value="<?php //echo $net_stock_his->current_stock;?>" />
								</div> -->
								<div class="form-group col-lg-1">
								<input type="text" class="form-control" id="stock_transfer_product_total0" name="stock_transfer_product_total[]" readonly="" value="<?php echo $product_transferred->stock_transfer_product_weight*$product_transferred->stock_transfer_product_quantity;?>" />
								</div>
								<div class="form-group col-lg-2">
									<input type="text" class="form-control" id="stock_transfer_product_remarks0" name="stock_transfer_product_remarks[]" readonly="" value="<?php echo $product_transferred->stock_transfer_product_remarks;?>" />
								</div>
							</div>
							<div class="row show_print" >
								<div class="form-group col-lg-12">
									<div class="controls">
										<?php echo implode(", ",$arr_sel_serial_numer); ?>
									</div>
								</div>
							</div>
							<?php
							}
						
							}
							else
							{
							?>
							<div class="row">
								<div class="form-group col-lg-3">
									<div class="controls">
										<select data-rel="chosen" class="form-control" id="product_id0" name="product_id[]" onChange="getInitialStock(this.value,'0');">
										    <option value="">Select Product</option>
											<?php foreach($product_master as $Product_master){?>
												<option value="<?php echo $Product_master->product_id;?>"><?php echo $Product_master->product_name;?> (<?php echo $Product_master->product_short_code;?>)</option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group col-lg-2">
									<input type="text" class="form-control" id="stock_transfer_product_quantity0" name="stock_transfer_product_quantity[]" onblur="getQUANTITYStockcHECKS(this.value,'0');" onkeypress="return isNumberKey(event);"/>
									
								</div>
								<div class="form-group col-lg-2" id="stock_serial_list0">
									<select data-rel="chosen" class="form-control" id="stock_transfer_product_serial_number0" name="stock_transfer_product_serial_number[]">
									</select>
								</div>
								<div class="form-group col-lg-1">
									<input type="text" class="form-control" id="stock_transfer_product_weight0" name="stock_transfer_product_weight[]" readonly="" />
								</div>
								<!--
								<div class="form-group col-lg-1">
									<input type="text" class="form-control" id="stock_product_net_initial0" disabled />
								</div> -->
								<div class="form-group col-lg-2">
									<input type="text" class="form-control" id="stock_transfer_product_remarks0" name="stock_transfer_product_remarks[]" />
								</div>
							</div>
							<?php
							}
							?>
							
						</div>
					    <?php 
						echo form_close();
						?>
					</div>
				</div>
			<?php //if($view_page=='')
			//{
			?>
			<div class="box col-lg-12 col-md-12 col-xs-12">
					<div class="box-inner">
						<div class="box-header well">
							<h2>Summary of Order Transferred</h2>
						</div>
						<div class="box-content">
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
								<thead>
									<tr>
										<th class="text-center">Sr. No.</th>
										<th class="text-center">Product Name</th>
										<th class="text-center">Net Weight (in gm)</th>
										<th class="text-center">Net Quantity</th>
									</tr>
								</thead>
								<tbody>
							<?php $i=1;
								 if(!empty($view_transfer_product)){
								 foreach($view_transfer_product as $view_transfer_products){?>
									<tr>
										<td class="text-center"><?php echo $i++;?></td>
										<td class="center text-center"><?php echo $view_transfer_products->product_name;?></td>
										<td class="center text-center"><?php echo $view_transfer_products->stock_transfer_product_weight*$view_transfer_products->stock_transfer_product_quantity;?></td>
										<td class="center text-center"><?php echo $view_transfer_products->stock_transfer_product_quantity;?></td>
									</tr>
								  <?php }}?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<?php
				//}
				?>
			
			</div><!--/row-->
		</div>
    <!-- content ends -->
		</div><!--/#content.col-md-0-->
	</div><!--/fluid-row-->
	<div class="row my-container-class printby myprintPage">
			<?php
				$office_id = $this->session->userdata('office_id');
				$office_data = $this->db->get_where('office_master',array('office_id'=>$office_id))->row();

			?>
        <div id="content" class="col-lg-12 col-sm-12">
           <div class="row printby">
				<div class="col-lg-3 col-sm-3 col-xs-3">
					<img src="<?php echo base_url('files/img/index.png'); ?>" />
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<div class="center text-center text-uppercase" style="font-size:16px; font-weight:bold;">MMTC-Indian Gold Coin</div>
					<div class="center text-center" style="font-size:13px; font-weight:bold;"><?php echo strtoupper($office_data->office_name.'-'.$office_data->office_operation_type.', '.getCityName($office_data->city_id).', '.getStateName($office_data->state_id));?></div>
				</div>
				<div class="col-lg-3 col-sm-3 col-xs-3">
					<div class="pull-right">
					<img height="77" width="77" src="<?php echo base_url('files/img/igc10.png'); ?>" />
					</div>
				</div>
			</div>
			<div class="row printby" style="margin-top:-20px;">
				<div class="col-lg-12 col-sm-12 col-xs-12">
					<div class="center text-center text-uppercase" style="font-size:14px; font-weight:bold;">Stock Transfer Memo</div>
				</div>
			</div>
			<div class="row">
				<div class="box col-lg-12 col-md-12 col-xs-12">
					<div class="box-content">
					<div class="row">
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Transfer From&nbsp;:&nbsp;</label><?php echo getOfficeLocation($office_id); ?>
							</div>
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Transfer To&nbsp;&nbsp;&nbsp;:&nbsp;</label><?php echo $transfer_to_view; ?>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Receipt No.&nbsp;:&nbsp;</label><?php echo $stock_transfer_number_view; ?>
							</div>
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Date & Time&nbsp;:&nbsp;</label><?php echo $stock_transfer_date_view; ?>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Remarks&nbsp;:&nbsp;</label>
							</div>
						</div>
					</div>
				</div>
				<div class="box col-lg-12 col-md-12 col-xs-12" style="min-height:300px !important;">
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
								<tr>
									<th class="text-center">Sr. No.</th>
									<th class="text-center">Product Name.</th>
									<th class="text-center">Net Weight (in gm)</th>
									<th class="text-center">Net Quantity Received</th>
								</tr>
							</thead>
							<tbody>
							<?php $i=1;
								 if(!empty($view_transfer_product)){
								 foreach($view_transfer_product as $view_transfer_productp){?>
									<tr>
										<td class="text-center"><?php echo $i++;?></td>
										<td class="center text-center"><?php echo $view_transfer_productp->product_name;?></td>
										<td class="center text-center"><?php echo $view_transfer_productp->stock_transfer_product_weight*$view_transfer_productp->stock_transfer_product_quantity;?></td>
										<td class="center text-center"><?php echo $view_transfer_productp->stock_transfer_product_quantity;?></td>
									</tr>
								  <?php }}?>
								</tbody>
						</table>
					</div>
				</div>
				<div class="box col-lg-12 col-md-12 col-xs-12">
					<div class="box-header well">
						<h2>For MMTC LTD.</h2>
					</div>
					<br/>
					<div class="box-content">
						<div class="row">
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Received By<?php echo str_repeat('&nbsp;',15) ?>:&nbsp;</label>.................................
							</div>
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Checked By<?php echo str_repeat('&nbsp;',16) ?>:&nbsp;</label>.................................
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Name & Designation&nbsp;:&nbsp;</label>.................................
							</div>
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Name & Designation&nbsp;:&nbsp;</label>.................................
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Signature<?php echo str_repeat('&nbsp;',20) ?>:&nbsp;</label>.................................
							</div>
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Signature<?php echo str_repeat('&nbsp;',20) ?>:&nbsp;</label>.................................
							</div>
						</div>
					</div>
				</div>
				<div class="box col-lg-12 col-md-12 col-xs-12" style="margin-top:10px !important;">
					<div class="col-lg-6 col-md-6 col-xs-6 my-heading-class"><h2 style="font-size:15px !important;">PACKING LIST </h2></div><div class="col-lg-6 col-md-6 col-xs-6 my-heading-class"><h2 style="font-size:15px !important;">Receipt No.:<?php echo $stock_transfer_number_view; ?> </h2></div>
					<div class="box-content">
						<?php echo implode(", ",$arr_sel_serial_numer); ?>
					</div>
				</div>
				
			</div><!--/row-->
    <!-- content ends -->
		</div><!--/#content.col-md-0-->
	</div><!--/fluid-row-->
	<div id="printby">
		Printed By :  <?php echo ucwords($this->session->userdata('user_username')); ?>&nbsp;,&nbsp;Date :   <?php echo date('d-m-Y H:i:s',strtotime('now')).'<br/>'.str_repeat('*',185); ?>
	</div>
<script type="text/javascript">
$(document).ready(function(){
	// $('#stock_transfer_date').datepicker({
	// minDate:0,
    // maxDate:0	
		
	// });
	//generateRandomNumber();
	$('button[type="submit"]').on('click', function() {
	$('button[type="submit"]').addClass('disabled');	
	resetErrors();
	var url = $('#stock_transfer_form').attr('action');
	var formData=$('#stock_transfer_form').serialize();
	//alert(formData);
	$.ajax({
		dataType: 'json',
		type: 'POST',
		url: url,
		data: formData,
		success: function(resp) {
			//console.log(resp);
			if(resp.done==='success'){
				$('button[type="submit"]').addClass('disabled');
				//popUpMessage(resp.MSG);
				//setTimeout(function () {
				  window.location.href='<?php echo base_url();?>inventory/stock_transfer_form';  //will redirect to your stock transfer form (an ex: stock_transfer_form.php)
				//}, 1000); //will call the function after 1 secs.	
			}else{
			if (resp === true) {
					//successful validation
					$('button[type="submit"]').removeClass('disabled');
					$('#stock_transfer_form').submit();
					
			} else {
				$('button[type="submit"]').removeClass('disabled');
				$.each(resp, function(i, v) {
				console.log(i + " => " + v); // view in console for error messages
					var msg = '<label class="error" for="'+i+'">'+v+'</label>';
					$('input[name="' + i + '"],input[id="' + i + '"],div[id="' + i + '"]').addClass('inputTxtError').after(msg);
				});
				var keys = Object.keys(resp);
				$('[name="'+keys[0]+'"]').focus();
			}
		}
			
		},
		error: function() {
			console.log('there was a problem checking the fields');
		}
		});
			return false;
		});
	});
	
function resetErrors() {
	$('form input,#stock_transfer_to_office_id_chosen,div.chosen-container,#stock_transferStatus_chosen').removeClass('inputTxtError');
	$('label.error').remove();
}

function generateRandomNumber()
{
	randomValue = getRandomInt(1,999999999);
	$("#stock_transfer_auto_gen_number").val(randomValue);
}

function getRandomInt(min, max) {
	return Math.floor(Math.random() * (max - min + 1)) + min;
}

function addNewProductStockTransfer()
{
	var my_div = '';
	$('.add_product_in_stock_transfer').removeClass('hide').css('display','block');	
	var divSize = $(".add_product_in_stock_transfer > div").size();
	$.ajax({
			url : "<?php echo base_url();?>inventory/AjaxAddNewDivCommon",
			type: "POST",
			data: {divSize:divSize,pageName:"stock_transfer_form"},
			success: function(res){
				if(divSize=='0'){
					$('.add_product_in_stock_transfer').html(res);
				}
				else{
					$('.add_product_in_stock_transfer').append(res);
				}
				 office_operation_type=$('#office_operation_type_hidden').val();
				 stock_transfer_to_office_id=$('#stock_transfer_to_office_id_hidden').val();
				_getProductBYofficeId(stock_transfer_to_office_id,office_operation_type,divSize+1);
			}
	});
}


function _getProductBYofficeId(stock_transfer_to_office_id,office_operation_type,selected_id){
	$.ajax({
			url : "<?php echo base_url();?>inventory/ajaxGetProductBYofficeId",
			dataType: 'json',
			type: "POST",
			data: {id:stock_transfer_to_office_id,office_operation_type:office_operation_type,pageName:"stock_transfer_form_product",},
			success: function(resp){
				console.log(resp);
				var options = [];
				options.push('<option value="">Select Product</option>');
				$.each(resp.product_master, function () {
				options.push('<option value="' +this.product_id + '">'+this.product_name+'('+this.product_short_code+')'+'</option>');
				});
				$("#product_id"+selected_id).html(options.join("")).trigger("chosen:updated");
				//console.log(resp);
			}
	});
	
}

function generateStockTransferNo(stock_transfer_to_office_id){
	$.ajax({
			url : "<?php echo base_url();?>inventory/ajaxGenerateStockTransferNo",
			dataType: 'json',
			type: "POST",
			data: {id:stock_transfer_to_office_id,pageName:"stock_transfer_form"},
			success: function(resp){
				var currentYear = (new Date).getFullYear();
				var nextYear = (new Date).getFullYear()+1;
			    //pull the last two digits of the year
                currentYear = currentYear.toString().substr(2,2);
				nextYear=nextYear.toString().substr(2,2);
				//console.log(resp);
				stock_number_generate=getUppercase(resp.office_short_code)+'/STI'+'/'+resp.auto_id+'/'+currentYear+'-'+nextYear;
				$('#stock_transfer_number').val(stock_number_generate);
				$('#office_operation_type_hidden').val(resp.office_operation_type);
				$('#stock_transfer_to_office_id_hidden').val(stock_transfer_to_office_id);
				_getProductBYofficeId(stock_transfer_to_office_id,resp.office_operation_type,0);
			}
	});

}

function getInitialStock(product_id,net_stock_id){
		// var divSize = $(".add_product_in_stock_transfer > div").size();
		// productId = [];
		// for(k=0;k<=divSize;k++){
		   	// pId = $('#product_id'+k).val();
			// productId.push(pId);
		// }
		// alert(productId); return false;
		$.ajax({
				url : "<?php echo base_url();?>inventory/AjaxStockInitial",
				type: "POST",
				dataType: 'json',
				data: {product_id:product_id,pageName:"product_stock_receipt_initial_form"},
				success: function(res){
					/* var tooltips = $( "[title]" ).tooltip({
					  position: {
						my: "left top",
						at: "right+5 top-5"
					  }
					}); */
					$('#stock_product_net_initial'+net_stock_id).val(res.initial_stock_quantity);
					$('#stock_transfer_product_weight'+net_stock_id).val(res.weightPerItem);
					
					if($('#stock_transfer_product_quantity'+net_stock_id).val()!='')
					{
					 var total_weight=($('#stock_transfer_product_weight'+net_stock_id).val())*parseInt($('#stock_transfer_product_quantity'+net_stock_id).val());
					$('#stock_transfer_product_total_weight'+net_stock_id).val(total_weight);
					}
					//$('#stock_transfer_product_quantity'+net_stock_id).attr('title','Your home or work address.');
					
					/* $('#stock_product_net'+net_stock_id).val(res.initial_stock_quantity); */
				}
		});
	
}
function fillserial_number(net_stock_id,current_value)
{
		var product_id=$('#product_id'+net_stock_id).val();
		var tableName = "product_current_stock_serial_number_<?php echo $this->session->userdata('office_id');?>";
		$.ajax({
				url : "<?php echo base_url();?>inventory/getSerialNumberSeries",
				type: "POST",
				data: {product_id:product_id,table_name:tableName,fieldName:"product_serial_number",net_stock_id:net_stock_id,quantity:current_value,pageName:"stock_transfer_form"},
				success: function(resp){
				//	$('#stock_transfer_product_serial_number'+net_stock_id).html(resp);
					$('#stock_serial_list'+net_stock_id).html(resp);
				}
		});
}
function getQUANTITYStockcHECKS(current_value,net_stock_id){
	if(current_value!=''){
		var stock_product_net_initial=$('#stock_product_net_initial'+net_stock_id).val();
		if(parseInt(current_value)>parseInt(stock_product_net_initial)){
		   $('#stock_transfer_product_quantity'+net_stock_id).removeClass('inputTxtError');
           $('label[for="stock_transfer_product_quantity'+net_stock_id+'"]').remove();
		  var msg = '<label class="error" for="stock_transfer_product_quantity'+net_stock_id+'">Quantity should not be greater than Net Stock('+stock_product_net_initial+')!</label>';
       $('input[id="stock_transfer_product_quantity'+net_stock_id+'"]').addClass('inputTxtError').after(msg);
	   $('#stock_transfer_product_quantity'+net_stock_id).val('');
	  $('#stock_serial_list'+net_stock_id).html('');
		}else{
			 fillserial_number(net_stock_id,current_value);
		resetErrors();
		 /* var net_stock_value=$('#stock_product_net_initial'+net_stock_id).val();
		 net_stock_value_sum=parseInt(net_stock_value)+parseInt(current_value);
		 $('#stock_product_net'+net_stock_id).val(net_stock_value_sum);	 */
		}
	}else{
		
		
	}
	
	
	
}


</script>

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
<div class="ch-container">
<?php

	$view_receipt_detail=$view_data['product_receipt_detail'];

	$stock_transfer_number_view  =$view_receipt_detail->stock_transfer_number;
	$stock_receipt_date_view     =$view_receipt_detail->product_stock_receipt_date;
	$product_stock_receipt_number_view=$view_receipt_detail->product_stock_receipt_number;
	$product_stock_receipt_work_order_no_view=$view_receipt_detail->product_stock_receipt_work_order_no;
	//$transfer_office_data=$this->db->get_where('office_master',array('office_id'=>$view_receipt_detail->office_id))->row();
	$this->db->where('vendor_id',$view_receipt_detail->vendor_id);
	$this->db->select('vendor_master.*')->from('vendor_master');
	$transfer_vendor_data=$this->db->get()->row();
	
	$this->db->join('regional_store_master','office_master.regional_store_id = regional_store_master.regional_store_id');
	$received_from_view=$transfer_office_data->office_name.'-'.$transfer_office_data->office_operation_type.'('.$transfer_office_data->regional_store_type.')';
	
	$stock_transfer_date_view=$view_receipt_detail->stock_transfer_date;
	
	$view_receipt_product=$view_data['product_receipt_product_detail'];
	$access_level_status = $view_receipt_detail->access_level_status;

?>
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
						<a href="#">Product Stock Receipt Form</a>
					</li>
				</ul>
				<ul class="breadcrumb-my-toggle text-right  col-lg-3 col-sm-3">
					<li>
						<?php if($access_level_status == '1'){ ?>
					<a href="javascript:void();" onClick="javascript:window.print();">Print</a>&nbsp;|&nbsp;<?php } ?><a href="<?php echo base_url('inventory/product_stock_receipt_inventory'); ?>">Product Stock Receipt Table</a>
					</li>
				</ul>
			</div>
			<?php if($this->session->flashdata('SuccessMessage')){ ?>
				<span class="alert alert-success col-lg-12">
				 <button type="button" class="close" data-dismiss="alert">x</button>
                    <?php echo $this->session->flashdata('SuccessMessage'); ?>
                </span>
			<?php }	?>
			<div class="row">
				<div class="box col-lg-12 col-md-12 col-xs-12">
					<div class="box-inner">
						<div class="box-header well">
							<h2>Product Stock Receipt Form</h2>
						</div>
						<div class="box-content">
						<?php 
						$attributes = array('class' => '', 'id' => 'product_stock_receipt_form');
					         echo form_open('inventory/product_stock_receipt_form', $attributes);?>
							<div class="row">
								<div class="form-group col-lg-3">
									<label class="control-label">Date and time of Receipt</label>
									<input type="text" class="form-control" name="product_stock_receipt_date" id="product_stock_receipt_date" value="<?php echo $stock_receipt_date_view;?>" readonly="" />
								</div>
								<div class="form-group col-lg-3">
									<label class="control-label">Receipt #</label>
									<input type="text" class="form-control" name="product_stock_receipt_number" id="product_stock_receipt_number" value="<?php echo $product_stock_receipt_number_view;?>" readonly=""/>
								</div>
								<div class="form-group col-lg-3">
									<label class="control-label">Work order #</label>
									<input type="text" class="form-control" name="product_stock_receipt_work_order_no" id="product_stock_receipt_work_order_no" value="<?php echo $product_stock_receipt_work_order_no_view;?>" readonly=""/>
								</div>
								<div class="form-group col-lg-2">
									<label class="control-label">Name of Vendor</label>
									<div class="controls">
									<select name="vendor_id" id="vendor_id" data-rel="chosen" class="form-control" onChange="getProductByVendor();"  disabled="disabled" >
										<?php
										if(!empty($transfer_vendor_data))
										{
										?>
										<option value=""><?php echo $transfer_vendor_data->vendor_name;?></option>
										<?php
										}
										else
										{
										?>
										<option value="">Select Name of Vendor</option>
									<?php foreach($vendor_master as $Vendor_master){?>
											<option value="<?php echo $Vendor_master->vendor_id;?>"><?php echo $Vendor_master->vendor_name;?></option>
									<?php } ?>
									<?php
									}
									?>
										</select>
									</div>
								</div>
							</div>
							<hr/>
							
							<?php
										if(!empty($view_receipt_product))
										{
										?>
										<div class="row">
								<div class="form-group col-lg-2">
									<label class="control-label">Product Name</label>
								</div>
								<div class="form-group col-lg-1">
									<label class="control-label">Quantity Ordered</label>
								</div>
								<div class="form-group col-lg-1">
									<label class="control-label">Qty Received</label>
								</div>
								<div class="form-group col-lg-2 no_print">
									<label class="control-label">Serial Number</label>
								</div>
								<div class="form-group col-lg-1">
									<label class="control-label">Weight(in gm)</label>
								</div>
								<div class="form-group col-lg-1">
									<label class="control-label">Total Weight(in gm)</label>
								</div>
								<!--
								<div class="form-group col-lg-2">
									<label class="control-label">Serial No.</label>
								</div>
								-->
								<div class="form-group col-lg-1" style="display:none">
									<label class="control-label" >Net stock</label>
								</div>
								<div class="form-group col-lg-2 no_print">
									<label class="control-label">Remarks</label>
								</div>
							</div>
							<?php
							$arr_serial_number_view=array();
										foreach($view_receipt_product as $product_receipt)
										{
										?><div class="row" id="product_stock_receipt_0">
								<div class="form-group col-lg-2">
									<div class="controls" id="product_stock_receipt_form-productList">
										<select data-rel="chosen" class="form-control" id="product_id0" name="product_id[]" onChange="getInitialStock(this.value,'0');" disabled="disabled">
										  <option value=""><?php echo $product_receipt->product_name;?></option>
									</select>
									</div>
								</div>
								<div class="form-group col-lg-1">
									<input type="text" class="form-control" value="<?php echo $product_receipt->stock_product_quantity;?>"  name="stock_product_quantity[]" id="stock_product_quantity0" readonly="" />
								</div>
								<div class="form-group col-lg-1">
									<input type="text" class="form-control" name="stock_product_qty_received[]" id="stock_product_qty_received0" value="<?php echo $product_receipt->stock_product_qty_received;?>" readonly=""/>
								</div>
								<div id="serial_number_div0" class="form-group col-lg-2 no_print" style="height:150px;overflow:hidden;overflow-y: scroll;"><?php 
										
										$stock_receipt_product_serials_detail=$view_data['stock_receipt_product_serials_detail'][$product_receipt->stock_product_id];
										//print_r($stock_receipt_product_serials_detail);
										?>
									<select data-rel="chosen" class="form-control" id="stock_transfer_product_serial_number_view0" name="stock_transfer_product_serial_number_view[]" multiple disabled="disabled">
									<?php
									
									foreach($stock_receipt_product_serials_detail as $val_serials)
									{
										$arr_serial_number_view[]=$val_serials->stock_product_serial_number;
									?>
									<option selected="selected"><?php echo $val_serials->stock_product_serial_number;?></option>
									<?php
									}
									?>
									</select></div>
								<div class="form-group col-lg-1">
									<input type="text" class="form-control" name="stock_product_weight[]" id="stock_product_weight0" readonly="" value="<?php echo $product_receipt->stock_product_weight;?>"/>
								</div>
								<div class="form-group col-lg-1">
									<input type="text" class="form-control" name="stock_product_total_weight[]" id="stock_product_total_weight0" readonly="" value="<?php echo ($product_receipt->stock_product_weight*$product_receipt->stock_product_qty_received);?>"/>
								</div>
								<!--
								<div class="form-group col-lg-2">
									<input type="text" class="form-control" name="stock_product_serial_number[]" id="stock_product_serial_number0" />
									
								</div>
								-->
<!--
								<div class="form-group col-lg-1">
									<input style="dispaly:none" type="text" class="form-control" name="stock_product_net[]" id="stock_product_net0" readonly value="<?php //echo $product_receipt->stock_product_net;?>" />
									<input type="hidden" class="form-control" id="stock_product_net_initial0" readonly />
								</div>
-->
								<div class="form-group col-lg-2 no_print">
									<input type="text" class="form-control" name="stock_product_remarks[]" id="stock_product_remarks0" value="<?php echo $product_receipt->	stock_product_remarks;?>" readonly="" />
								</div>
							</div>
							<div class="row show_print" >
								<div class="form-group col-lg-12">
									<div class="controls">
										<?php echo implode(", ",$arr_serial_number_view); ?>
									</div>
								</div>
							</div>
										<?php
										}
										}
										
							?>
							
						
						</div>
					</div>
				</div>
			</div><!--/row-->
    <!-- content ends -->
		</div><!--/#content.col-md-0-->
	</div><!--/fluid-row-->
	<div class="row viewPage">
	<div class="box col-lg-12 col-md-12 col-xs-12" >
					<div class="box-inner">
						<div class="box-header well">
							<h2>Summary of Product Stock Received</h2>
						</div>
						<div class="box-content">
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
								<thead>
									<tr>
										<th class="text-center">Sr. No.<span><img src="<?php echo base_url(); ?>/files/img/sorting_image.png" height="10px" width="10px"></span></th>
										<th class="text-center">Product Name.<span><img src="<?php echo base_url(); ?>/files/img/sorting_image.png" height="10px" width="10px"></span></th>
										<th class="text-center">Net Weight (in gm).<span><img src="<?php echo base_url(); ?>/files/img/sorting_image.png" height="10px" width="10px"></span></th>
										<th class="text-center">Net Quantity Received.<span><img src="<?php echo base_url(); ?>/files/img/sorting_image.png" height="10px" width="10px"></span></th>
									</tr>
								</thead>
								<tbody>
								<?php if(!empty($view_receipt_product)){
										  $i=1;
										  foreach ($view_receipt_product as $view_receipt_products ){?>
									<tr>
										<td class="text-center"><?php echo $i++;?></td>
										<td class="center text-center"><?php echo $view_receipt_products->product_name;?></td>
										<td class="center text-center"><?php echo $view_receipt_products->stock_product_weight*$view_receipt_products->stock_product_qty_received;?></td>
										<td class="center text-center"><?php echo $view_receipt_products->stock_product_qty_received;?></td>
									</tr>
									  <?php }}?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				</div>

<?php //echo $this->load->view('includes/_test',$printData); ?>
	<div class="row my-container-class printby myprintPage">
		<?php
				$office_id = $this->session->userdata('office_id');
				$office_data = $this->db->get_where('office_master',array('office_id'=>$office_id))->row();

			?>
        <div id="content" class="col-lg-12 col-sm-12 col-xs-12">
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
			<div class="row printby"  style="margin-top:-20px;">
				<div class="col-lg-12 col-sm-12 col-xs-12">
					<div class="center text-center" style="font-size:15px; font-weight:bold;">Store Receipt From Vendor</div>
				</div>
			</div>
			<div class="row">
				<div class="box col-lg-12 col-md-12 col-xs-12">
					<div class="box-content">
						<div class="row">
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Receipt No.&nbsp;:&nbsp;</label><?php echo $product_stock_receipt_number_view; ?>
							</div>
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Vendor Name&nbsp;:&nbsp;</label><?php echo $transfer_vendor_data->vendor_name; ?>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Date & Time&nbsp;:&nbsp;</label><?php echo $stock_receipt_date_view; ?>
							</div>
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Work Order No.&nbsp;:&nbsp;</label><?php echo $product_stock_receipt_work_order_no_view; ?>
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
									<th class="text-center">Net Quantity Received.</th>
								</tr>
							</thead>
							<tbody>
							<?php if(!empty($view_receipt_product)){
									  $i=1;
									  foreach ($view_receipt_product as $view_receipt_products ){?>
								<tr>
									<td class="text-center"><?php echo $i++;?></td>
									<td class="center text-center"><?php echo $view_receipt_products->product_name;?></td>
									<td class="center text-center"><?php echo $view_receipt_products->stock_product_weight*$view_receipt_products->stock_product_qty_received;?></td>
									<td class="center text-center"><?php echo $view_receipt_products->stock_product_qty_received;?></td>
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
				<div class="box col-lg-12 col-md-12 col-xs-12"  style="margin-top:10px !important;">
					<div class="col-lg-6 col-md-6 col-xs-6 my-heading-class"><h2 style="font-size:15px !important;">PACKING LIST </h2></div><div class="col-lg-6 col-md-6 col-xs-6 my-heading-class"><h2 style="font-size:15px !important;">Receipt No.:<?php echo $product_stock_receipt_number_view; ?> </h2></div>
					<div class="box-content">
						<?php echo implode(", ",$arr_serial_number_view); ?>
					</div>
				</div>
				
			</div><!--/row-->
    <!-- content ends -->
		</div><!--/#content.col-md-0-->
	</div><!--/fluid-row-->
	<div id="printby">
		Printed By :  <?php echo ucwords($this->session->userdata('user_username')); ?>&nbsp;,&nbsp;Date :   <?php echo date('d-m-Y H:i:s',strtotime('now')).'<br/>'.str_repeat('*',185); ?>
	</div>
				
<!--Modal Form For Serial Number---->
<div id="modal-serial-number-0" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
		<form id="my-serial-number">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">\D7</button>
				<h3 class="modal-title"><span id="product_text"></span>Serial Number#</h3>
			</div>
			<div class="modal-body">
				<div class="box-content">
				
				    <div class="row">
						<div class="form-group col-lg-4">
							<label class="radio-inline">
								<input name="radion1" onClick="getChange(this.value);" value="Manual" type="radio" checked /> Manual
							</label>
						</div>
						<div class="form-group col-lg-4">
							<label class="radio-inline">
								<input name="radion1" onClick="getChange(this.value);" value="Automatic" type="radio"/> Auto-Generated
							</label>
						</div>
					</div>
					<div class="clear-fix"></div>
					<div class="row">
						<div class="form-group col-lg-4">
							<label class="control-label">Starting Serial No.#</label>
							<input type="text" class="form-control starting_serial_number" name="initial_stock_serial_no0" id="initial_stock_starting_serial_popup0" onChange="addNewMultipleSrNo(this.value);" readonly  />
						</div>
						<div class="form-group col-lg-4">
							<label class="control-label">Quantity</label>
							<input type="text" class="form-control" name="initial_stock_quantity" id="initial_stock_quantity_popup" onChange="addNewMultipleSrNo($('#initial_stock_starting_serial_popup0').val());reverseChangeQuantity(this.value);" onKeyPress="return isNumberKey(event);" readonly />
						</div>
					</div>
					<hr/>
					<div class="initial_stock_update hide" style="height:200px;overflow:hidden;overflow-y: scroll;">
					</div>
					<div class="add_serial_number hide" style="height:350px;overflow:hidden;overflow-y: scroll;">
							
					</div>
				
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-sm btn-primary" onClick="getSerialNumberValues();">Save changes</button>
			</div>
		</form>
		</div>
	</div>
</div>
<!--END Modal Form For Serial Number---->
<script type="text/javascript">
$(document).ready(function(){
	iOSCheckbox.defaults.checkedLabel='Open';
    iOSCheckbox.defaults.uncheckedLabel='Close';
	iOSCheckbox.defaults.onChange=function(elem, data) {
	   id_checked=elem.attr('id');
	   if(id_checked=='product_stock_receipt_work_order_status_checked'){
		   
		 if(data==true){
			 
			$('#product_stock_receipt_work_order_status').val('open');
            $('#show_closing').removeAttr('style').css('visibility','hidden');			
			 
		 }
		 
		if(data==false){
			
			$('#product_stock_receipt_work_order_status').val('close');
            $('#show_closing').removeAttr('style').css('visibility','visible');			
			
		}			 
		   
	   }
	 
	 }
	generateRandomNumber();
	
	$('button[type="submit"]').on('click', function() {
		$('button[type="submit"]').addClass('disabled');
        resetErrors();
        var url = $('#product_stock_receipt_form').attr('action');
        var formData=$('#product_stock_receipt_form').serialize();
		//alert(formData);
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: url,
            data: formData,
            success: function(resp) {
				//console.log(resp);
				if(resp.done==='success'){
					$('button[type="submit"]').removeClass('disabled');
                    //popUpMessage(resp.MSG);
					setTimeout(function () {
					  window.location.href='<?php echo base_url();?>inventory/product_stock_receipt_form';  //will redirect to your product stock receipt form (an ex: product_stock_receipt_form.php)
					}, 1000); //will call the function after 1 secs.	
				}else{
                if (resp === true) {
                    	//successful validation
						$('button[type="submit"]').removeClass('disabled');
                        $('#product_stock_receipt_form').submit();
                    	
                } else {
					$('button[type="submit"]').removeClass('disabled');
                    $.each(resp, function(i, v) {
		            console.log(i + " => " + v); // view in console for error messages
                        var msg = '<label class="error" for="'+i+'">'+v+'</label>';
                        $('input[name="' + i + '"],input[id="' + i + '"],div[id="' + i + '"],textarea[name="' + i + '"]').addClass('inputTxtError').after(msg);
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
			
			
			
		office_id = "<?php echo $this->session->userdata('office_id'); ?>";
        $.ajax({
                url : "<?php echo base_url('inventory/getProductStockReceiptNumber'); ?>",
                type: "POST",
                data:{office_id:office_id},
                success : function(res){
                
                   // $('#product_stock_receipt_number').val(res.trim());
                }
                
        });
	
	});
	
	function resetErrors() {
		$('form input,#vendor_id_chosen,form textarea,div.chosen-container').removeClass('inputTxtError');
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
	
	function addNewProductStockReceipt()
	{
		var my_div = '';
		$('.add_product_stock_receipt').removeClass('hide').css('display','block');	
		var divSize = $(".add_product_stock_receipt > div").size();
		var vendorId = $('#vendor_id :selected').val();
		if(vendorId == ''){
			alert("Please select vendor.");
		}
		else{
			$.ajax({
					url : "<?php echo base_url();?>inventory/AjaxAddNewDivCommon",
					type: "POST",
					data: {divSize:divSize,pageName:"product_stock_receipt_form",vendorId:vendorId},
					success: function(res){
						if(divSize=='0'){
							$('.add_product_stock_receipt').html(res);
						}
						else{
							$('.add_product_stock_receipt').append(res);
						}
					}
			});
		}
	}
	
	function getInitialStock(product_id,net_stock_id){
		
		$.ajax({
				url : "<?php echo base_url();?>inventory/AjaxStockInitial",
				type: "POST",
				dataType: 'json',
				data: {product_id:product_id,pageName:"product_stock_receipt_initial_form"},
				success: function(res){
					initialStock = (res.initial_stock_quantity=='') ? '0' : res.initial_stock_quantity;
					//$('#stock_product_net_initial'+net_stock_id).val(res.initial_stock_quantity);
					$('#stock_product_net_initial'+net_stock_id).val(initialStock);
					$('#stock_product_net'+net_stock_id).val(res.initial_stock_quantity);
					$('#stock_product_weight'+net_stock_id).val(res.weightPerItem);
					if($('#stock_product_qty_received'+net_stock_id).val()!='')
					{
					$('#stock_product_total_weight'+net_stock_id).val(res.weightPerItem*parseInt($('#stock_product_qty_received'+net_stock_id).val()));
					}
					if(product_id=='')
					{
					$('#stock_product_quantity'+net_stock_id).val('');
					$('#stock_product_qty_received'+net_stock_id).val('');
					}
				}
		});
	
	}
	
	function getInitialStockReceivedCalculated(current_value,net_stock_id){
		if(current_value!=''){
		var stock_product_quantity=$('#stock_product_quantity'+net_stock_id).val();
	
		if(parseInt(current_value)>parseInt(stock_product_quantity)){
		   //$('#stock_product_qty_received'+net_stock_id).val('');
		   $('#stock_product_net'+net_stock_id).val('');
		   $('#stock_product_qty_received'+net_stock_id).removeClass('inputTxtError');
           $('label[for="stock_product_qty_received'+net_stock_id+'"]').remove();
		  var msg = '<label class="error" for="stock_product_qty_received'+net_stock_id+'">Qty Received should not be greater than Qty Ordered!</label>';
       $('input[id="stock_product_qty_received'+net_stock_id+'"]').addClass('inputTxtError').after(msg);
	   
		}else{
		resetErrors();
		 var net_stock_value=$('#stock_product_net_initial'+net_stock_id).val();
		 net_stock_value_sum=parseInt(net_stock_value)+parseInt(current_value);
		
		 var total_wieght=$('#stock_product_weight'+net_stock_id).val()*parseInt($('#stock_product_qty_received'+net_stock_id).val());
		 $('#stock_product_total_weight'+net_stock_id).val(total_wieght);
		 
		 $('#stock_product_net'+net_stock_id).val(net_stock_value_sum);
		 $('.modal').attr('id','modal-serial-number-'+net_stock_id);
		 productId = $('#product_id'+net_stock_id+' :selected').val();
		 productText = $('#product_id'+net_stock_id+' :selected').text();
		 $('#modal-serial-number-0').attr('id','modal-serial-number-'+net_stock_id);
	   $('#modal-serial-number-'+net_stock_id).modal('show');
	   addNewSerialNumber(productId,productText,net_stock_id);
	   $('#latestSelectId').val(net_stock_id);
		}
	}else{
		
	  $('#stock_product_net'+net_stock_id).val('');	
		
	}
	}
	
	
	
	var counter = 1;
    window.updateIds = function() {
    $.each($("[row-number]"), function(index, item){
        $(this).attr("row-number",(index+1));
    });
   }
   
   // 12-9-2015
   
   function getProductByVendor()
   {
	   vendorId = $('#vendor_id :selected').val();
	   //alert(vendorId);
	   $.ajax({
				url : "<?php echo base_url('inventory/getProductByVendor');?>",
				type: "POST",
				data: {vendorId:vendorId},
				success:function(res){
					$('#product_stock_receipt_form-productList').html(res);
					getInitialStock('','0');
					$('.add_product_stock_receipt').html('');
				}
	   });
   }


function resetErrors() {
    $('form input,#initial_stock_starting_store_date').removeClass('inputTxtError');
    $('label.error').remove();
}
function addNewSerialNumber(product_id,product_name,net_stock_id){ //alert(product_id); alert(product_name);
	resetErrors();
	if($('#stock_product_qty_received'+net_stock_id).val()==''){
		$('#modal-serial-number-'+net_stock_id).modal('hide');
		
	}else{
		inputQuantity = $('#stock_product_qty_received'+net_stock_id).val();
		$('#initial_stock_quantity_popup').val(inputQuantity);
		$('.add_serial_number').addClass('show');
		$('.add_serial_number').empty();
		$('.initial_stock_update').empty(); 
	//	$('form#initial_stock_product_serial_form').get(0).reset();
		$('#product_text').text('['+product_name.toUpperCase()+'] ');
		//$('#product_id_popup').val(product_id);
		$('#initial_stock_starting_serial_popup0').attr('readonly',true);
		$('#initial_stock_quantity_popup').attr('readonly',true);
		initial_stock_starting_serial_popup_v=$('#initial_stock_starting_serial_popup0').val();
		$('#initial_stock_id_popup').val('0');
		//$('#initial_stock_starting_serial_popup0').attr('readonly',false);
		$('#initial_stock_starting_serial_popup0').attr('onchange',"addNewMultipleSrNo(this.value);");
		$('#initial_stock_quantity_popup').attr('onchange',"addNewMultipleSrNo("+initial_stock_starting_serial_popup_v+");");
	//	$('#initial_stock_quantity_popup').val($('#initial_stock_quantitys_'+product_id).val());
		$('#initial_stock_quantity_popup').val(inputQuantity);
		$('#modal-serial-number').modal('show');
		getChange('Manual');
	}
	
	
}  


function getChange(current_values,type){
	if(current_values=='Manual'){
		resetErrors();
		//$('#initial_stock_starting_serial_popup0').val('');
		$('#initial_stock_starting_serial_popup0').removeAttr('onchange').attr('readonly',false);
		$('#initial_stock_quantity_popup').attr('onchange',"addNewMultipleSrNo('');reverseChangeQuantity(this.value);").attr('readonly',false);
		//$('#initial_stock_quantity_popup').removeAttr('onchange').attr('readonly',false);
		if(type!='edit'){
		addNewMultipleSrNo();
		}
	}
	
	if(current_values=='Automatic'){
		resetErrors();
		//$('#initial_stock_starting_serial_popup0').val('');
		$('#initial_stock_starting_serial_popup0').attr('onchange',"addNewMultipleSrNo(this.value);").attr('readonly',false);
		initial_stock_starting_serial_popup_v=$('#initial_stock_starting_serial_popup0').val();
		$('#initial_stock_quantity_popup').attr('onchange',"addNewMultipleSrNo('"+initial_stock_starting_serial_popup_v+"');reverseChangeQuantity(this.value);").attr('readonly',false);
		if(type!='edit'){
		addNewMultipleSrNo($('#initial_stock_starting_serial_popup0').val());
		}
	}
	
	
}

function addNewMultipleSrNo(current_value){
	var current_value = $.trim(current_value);
	if(current_value!=''){
	var regx = /^[0-9a-zA-Z\-\/\#]+$/;
    if (!regx.test(current_value)) {
		$('#initial_stock_starting_serial_popup0').removeClass('inputTxtError');
        $('label[for="initial_stock_starting_serial_popup0"]').remove();
		var msg = '<label class="error" for="initial_stock_starting_serial_popup0">Initial Stock Starting Serial No. accept only combination of (letter or number)</label>';
       $('input[id="initial_stock_starting_serial_popup0"]').addClass('inputTxtError').after(msg);
        //$("#infoUser").html("Alphanumeric only allowed !");
    }else{
	$('.add_serial_number').addClass('show');
	var iteration_create=$('input[name="initial_stock_quantity"]').val()-1;
	$('.add_serial_number').empty();
	$('.initial_stock_update').empty();
	var divsToAppend = "";
	    var num = parseInt(current_value.match(/\d+$/));
        //alert(num);
		var pos = current_value.indexOf(num);
		var str = current_value.slice(0,pos);
		var current_values=str;
		divNumber = $('#latestSelectId').val();
		
		myserials = $('#serial_number'+divNumber).val();
		serialNumber = (myserials) ? myserials.split(',') : '';
		
		for(i = 1; i <= iteration_create; i++) {
			if(serialNumber !=''){
				current_value = serialNumber[i];
				$('#initial_stock_starting_serial_popup0').val(serialNumber[0]);
			}
			else
			{
			if(num=="" || $.isNumeric(num)){
			 num++;
			}
			else{
			 num='';	
			}
			current_value = current_values+num;
			}
			divsToAppend += '<div class="row" id="rowsrno_'+(i)+'"><div class="form-group col-lg-4"><input type="text" class="form-control" id="initial_stock_starting_serial_popup'+(i)+'" name="initial_stock_serial_no'+(i)+'" value="'+current_value+'" /><input type="hidden" name="initial_product_serial_id'+(i)+'" value="" /></div><div class="form-group col-lg-1" onclick="removeNewSrNo(' + (i) + ')"><a href="javascript:void(0);" class="btn btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a></div></div>';        
		}

    $('.add_serial_number').append(divsToAppend);
	$('#initial_stock_quantity_popup').attr('onchange',"addNewMultipleSrNo('"+current_value+"');reverseChangeQuantity(this.value);");
	}}else{
	$('.add_serial_number').addClass('show');
	$('.add_serial_number').empty();
	$('.initial_stock_update').empty();
    var iteration_create=$('input[name="initial_stock_quantity"]').val()-1;
	$('.add_serial_number').empty();
	var divsToAppend = "";
	    var num = parseInt(current_value.match(/\d+$/));
        //alert(num);
		var pos = current_value.indexOf(num);
		var str = current_value.slice(0,pos);
		var current_values=str;
		
		for(i = 1; i <= iteration_create; i++) {
			divsToAppend += '<div class="row" id="rowsrno_'+(i)+'"><div class="form-group col-lg-4"><input type="text" class="form-control" id="initial_stock_starting_serial_popup'+(i)+'" name="initial_stock_serial_no[]" value="" /><input type="hidden" name="initial_product_serial_id[]" value="" /></div><div class="form-group col-lg-1" onclick="removeNewSrNo(' + (i) + ')"><a href="javascript:void(0);" class="btn btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a></div></div>';        
		}
    $('.add_serial_number').append(divsToAppend);
	}	
}


function removeNewSrNo(remove_id){
	var s=$('#initial_stock_quantity_popup').val();
	if(s!=1){
	product_id=$('#product_id_popup').val();
	$('#initial_stock_quantitys_'+product_id).val($('#initial_stock_quantity_popup').val()-1);
	$('#initial_stock_quantity_popup').val(s-1);
	}
	$("#rowsrno_"+remove_id).fadeOut('fast');
	$("#rowsrno_"+remove_id+" input:first").attr('disabled',true);		
}

function reverseChangeQuantity(current_value,product_id){
 product_id=$('#product_id_popup').val();
 $('#initial_stock_quantitys_'+product_id).val($('#initial_stock_quantity_popup').val());	
}

function getSerialNumberValues()
{
	var divNumber = $('#latestSelectId').val();
//	alert(divNumber);
	var serialNumber = [];
	var total_qty=$('#stock_product_qty_received'+divNumber).val();
	for(i=0;i<total_qty;i++){
		myValue = $('#initial_stock_starting_serial_popup'+i).val();
		serialNumber.push(myValue);
	}
	$('#serial_number'+divNumber).val(serialNumber);
	$('#modal-serial-number-'+divNumber+' form')[0].reset();
	$('#modal-serial-number-'+divNumber).modal('hide');
}

function myPrintFunction()
{
	var divContents = $(".myprintPage").html();
	var printWindow = window.open();
	printWindow.document.write(divContents);
	printWindow.document.close();
	printWindow.print();
}

</script>

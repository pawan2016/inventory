<?php
$stock_receipt_id = ($this->input->get('stock_receipt_id')) ? base64_decode($this->input->get('stock_receipt_id')) : '';

$office_operation_type = $this->session->userdata('office_operation_type');
$office_id = $this->session->userdata('office_id');
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
						<a href="#">Inventory</a>
					</li>
					<li>
						<a href="#">Stock Reciept</a>
					</li>
				</ul>
				<ul class="breadcrumb-my-toggle text-right  col-lg-3 col-sm-3">
					<li>
						<a href="<?php echo base_url('inventory/stock_receipt_inventory'); ?>">Stock Receipt Table</a>
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
					<div class="box-inner" id="accordion">
						<div class="box-header well" >
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#stockRecieptForm">
								    Stock Reciept View
								</a>
						</div>
						<?php
						if($view_page=='1')
						{
						
			
						$view_receipt_detail=$view_data['stock_receipt_detail'];
					
						$stock_transfer_number_view=$view_receipt_detail->stock_transfer_number;
						$stock_receipt_date_view=$view_receipt_detail->stock_receipt_date;
						//$transfer_office_data=$this->db->get_where('office_master',array('office_id'=>$view_receipt_detail->office_id))->row();
						$this->db->where('office_id',$view_receipt_detail->stock_receipt_from);
						$this->db->select('office_master.*,regional_store_master.regional_store_type')->from('office_master,regional_store_master');
						$transfer_office_data=$this->db->get()->row();
						
						//$this->db->join('regional_store_master','office_master.regional_store_id = regional_store_master.regional_store_id');
						$received_from_view=$transfer_office_data->office_name.'-'.$transfer_office_data->office_operation_type.'('.$transfer_office_data->regional_store_type.')';
						
						$stock_transfer_date_view=$view_receipt_detail->stock_transfer_date;
						$stock_receipt_number_view=$view_receipt_detail->stock_receipt_number;
						
						$view_receipt_product=$view_data['stock_receipt_product_detail'];
						}
						?>
						<div class="box-content">
							<div id="stockRecieptForm" class="panel-collapse collapse in">
								<div class="panel-body">
								<?php $attributes = array('class' => '', 'id' => 'stock_receipt_form');
					                   echo form_open('inventory/stock_receipt_form', $attributes);?>
									<div class="box-content">
										<div class="row">
											<div class="form-group col-lg-2">
												<label class="control-label">Date of Reciept</label>
												<input type="text" readonly="" class="form-control" name="stock_receipt_date" id="stock_receipt_date" value="<?php echo $stock_receipt_date_view;?>" readonly="" />
												<input type="hidden" name="stock_transfer_id" id="stock_transfer_id" />
												<input type="hidden" name="stock_transferId" id="stock_transferId" value="<?php echo $view_receipt_detail->stock_transfer_id; ?>" />
											</div>
											<div class="form-group col-lg-3">
												<label class="control-label">Reference Number</label>
												<input type="text" class="form-control" name="stock_receipt_number" id="stock_receipt_number" readonly value="<?php echo $stock_receipt_number_view;?>" />
												<input type="hidden" name="stock_receiptNumber" value="<?php echo $stock_receipt_number_view;?>" />
											</div>
											<div class="form-group col-lg-3">
												<label class="control-label">Stock Transfer Number</label>
												<?php /*<input type="text" class="form-control" name="stock_transfer_number" id="stock_transfer_number" onblur="getStockReceivedProduct(this.value);"/>*/ ?>
												<select data-rel="chosen" class="form-control"  id="stock_transfer_number" name="stock_transfer_number" onChange="getStockReceivedProduct(this.value);"  >
												<?php
												if($stock_transfer_number_view!='')
												{
												?>
												<option value=""><?php echo $stock_transfer_number_view;?></option>
												<?php
												}
												else
												{
												?>
													<option value="">Select Transfer Number</option>
													<?php foreach($stockTranferNumber as $transfer_number){?>
														<option value="<?php echo $transfer_number->stock_transfer_number;?>"><?php echo $transfer_number->stock_transfer_number;?></option>
													<?php } /*onchange="updateSerialCurrentStatus('<?php echo $product_id; ?>')" */ ?>
													<?php
													}
												?>
												</select>
											</div>
											<div class="form-group col-lg-2">
												<label class="control-label">Stock Received From</label>
												<input type="text" class="form-control" name="stock_receipt_from" id="stock_receipt_from" readonly value="<?php echo $received_from_view;?>" />
												<input type="hidden" name="stock_transferFrom" value="<?php echo $view_receipt_detail->stock_receipt_from; ?>"/>
											</div>
											<div class="form-group col-lg-2">
												<label class="control-label">Date of Transfer</label>
												<input type="text" class="form-control" name="stock_transfer_date" id="stock_transfer_date" readonly value="<?php echo $stock_transfer_date_view;?>" />
											</div>
										</div>
										<hr/>
										<div class="row">
											<div class="form-group col-lg-3">
												<label class="control-label">Product Name</label>
											</div>
											<div class="form-group col-lg-1">
												<label class="control-label">Weight(in gm)</label>
											</div>
											<div class="form-group col-lg-1">
												<label class="control-label">Stock Transferred</label>
											</div>
											<div class="form-group col-lg-2">
												<label class="control-label">Total Received Stock</label>
											</div>
											<div class="form-group col-lg-1">
												<label class="control-label">Received Stock</label>
											</div>
											<div class="form-group col-lg-1">
												<label class="control-label">Pending Stock</label>
											</div>
											<?php
											if($view_page=='')
											{
											?>
											<div class="form-group col-lg-2">
												<label class="control-label">Receiving Stock</label>
											</div>
											<?php
											}
											?>
											<div class="form-group col-lg-2">
												<label class="control-label">Serial No.</label>
											</div>
											
										</div>
										<?php
										if(!empty($view_receipt_product))
										{
											$i = 0;
											$table_authorized_stock_receipt='inventory_'.$office_operation_type.'_stock_receipt_product_serial_number_'.$office_id;
										foreach($view_receipt_product as $product_receipt)
										{
											$total_received_authorized = $this->db->get_where($table_authorized_stock_receipt,array('stock_receipt_product_id'=>$product_receipt->stock_receipt_product_id,'stock_receipt_product_serial_number_status'=>'1'))->result();
											$total_authorized=0;
											$total_authorized=$product_receipt->total_stock_received;
											
											
										?>
										<div class="row">
										<div class="form-group col-lg-3"><select data-rel="chosen" class="form-control" id="product_id0" name="product_id[]" onChange="getInitialStock(this.value,'0');">
										    <option value=""><?php echo $product_receipt->product_name;?></option>
											
										</select></div>
										<div class="form-group col-lg-1"><input type="text" readonly="" value="<?php echo $product_receipt->weight;?>" name="weight[]" id="weight0" class="form-control"></div>
										<div class="form-group col-lg-1"><input type="text" readonly="" name="stock_transferred[]" value="<?php echo $product_receipt->stock_transferred;?>" id="stock_transferred0" class="form-control">
										<input type="hidden" value="<?php echo $total_authorized;?>" id="total_authorized<?php echo $i; ?>" />
										</div>
										<div class="form-group col-lg-2"><input type="text" readonly="" value="<?php echo $total_authorized;?>" class="form-control"></div>
										<div class="form-group col-lg-1"><input type="text" readonly="" name="stock_received[]" value="<?php echo ($product_receipt->stock_received) ? $product_receipt->stock_received : '0';?>" id="stock_received0" class="form-control"></div>
										<div class="form-group col-lg-1"><input type="text" readonly="" value="<?php echo $product_receipt->stock_pending;?>" name="stock_pending[]" id="stock_pending0" class="form-control"></div>
										
										<div id="serial_number_div0" class="form-group col-lg-3" style="max-height:305px !important; overflow-y:scroll; overflow-x:hidden;"><?php 
										
										$stock_receipt_product_serials_detail=$view_data['stock_receipt_product_serials_detail'][$product_receipt->stock_receipt_product_id];
										// echo '<pre>';
										// print_r($stock_receipt_product_serials_detail);
										?>
									<select data-rel="chosen" class="form-control" id="stock_transfer_product_serial_number_view<?php echo $val_serials->stock_receipt_serial_number_id;?>" name="stock_transfer_product_serial_number_view[]" multiple="multiple" disabled="disabled">
									<?php
									foreach($stock_receipt_product_serials_detail as $val_serials)
									{
										if($val_serials->stock_receipt_product_serial_number_status == '2'){
									?>
									<option selected="selected"><?php echo $val_serials->serial_number;?></option>
									<?php
									}}
									?>
									</select></div><input type="hidden" name="stock_receipt_product_id[]" value="<?php echo $product_receipt->stock_receipt_product_id; ?>" id="stock_receipt_product_id0"></div>
										<?php
									}
										}
										else
										{
										?>
										
										<div class="add_product_stock_receipt_received">
							
							            </div>
										<div id="show_hide">
										<div class="row">
											<div class="form-group col-lg-6">
												<label class="control-label">Is the transfer complete? </label>
												<input data-no-uniform="true" id="stock_transferStatus_checked" type="checkbox" class="iphone-toggle">
												<input type="hidden" name="stock_transferStatus" id="stock_transferStatus" value="No">
											</div>
										</div>
									</div>
									
									<input type="hidden" name="is_submit" id="is_submit" value='' />
										</div>
										<?php
										}
										?>
										<div class="row">
											<div class="form-group col-lg-6">
												<label class="checkbox-inline">
													<input type="checkbox" id="access_level" name="access_level" value="1"> I Agree
												</label>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-lg-4">
												<button id="authorize_user" type="submit" class="btn btn-success form-control">Authorize</button>
											</div>
											<div class="form-group col-lg-6">
											</div>
										</div>
									</div>
									<input type="hidden" id="stock_receipt_id" name="stock_receipt_id" />
									<input type="hidden" id="stock_receiptId" name="stock_receiptId" value="<?php echo $stock_receipt_id; ?>"/>
									<input type="hidden" name="is_submit" id="is_submit" value='' />
									<input type="hidden" name="my_page_type" id="my_page_type" value="authorizeData" />
									 <?php 
									echo form_close();
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php //if($view_page=='0')
			//{
			?>
			<div class="box col-lg-12 col-md-12 col-xs-12" >
					<div class="box-inner">
						<div class="box-header well">
							<h2>Summary of Order Received</h2>
						</div>
						<div class="box-content">
						<?php 
						/*
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
								<thead>
									<tr>
										<th class="text-center">Sr. No.</th>
										<th class="text-center">Product Name</th>
										<th class="text-center">Net Weight (in gm)</th>
										<th class="text-center">Transfer Stock</th>
										<th class="text-center">Net Quantity / Received Stock</th>
										<th class="text-center">Pending Stock</th>
									</tr>
								</thead>
								<tbody>
								<?php if(!empty($summary_of_order_received)){$i=1; foreach($summary_of_order_received as $Summary_of_order_received){?>
									<tr>
										<td class="text-center"><?php echo $i++;?></td>
										<td class="center text-center"><?php echo $Summary_of_order_received->product_name;?></td>
										<td class="center text-center"><?php echo $Summary_of_order_received->NET_WEIGHT;?></td>
										<td class="center text-center"><?php echo $Summary_of_order_received->TRANSFER_STOCK;?></td>
										<td class="center text-center"><?php echo $Summary_of_order_received->NET_QUANTITY;?></td>
										<td class="center text-center"><?php echo $Summary_of_order_received->PENDING_STOCK;?></td>
									</tr>
								<?php } } ?>
								</tbody>
							</table> 
							*/
							?>
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
								<thead>
									<tr>
										<th class="text-center">Sr. No.</th>
										<th class="text-center">Product Name</th>
										<th class="text-center">Total Net Weight (in gm)</th>
										<th class="text-center">Transfer Stock</th>
										<th class="text-center">Net Quantity / Received Stock</th>
										<th class="text-center">Pending Stock</th>
									</tr>
								</thead>
								<tbody>
							<?php 
								// print_r($view_receipt_product);
								if(!empty($view_receipt_product)){$i=1; foreach($view_receipt_product as $Summary_of_order_received){?>
									<tr>
										<td class="text-center"><?php echo $i++;?></td>
										<td class="center text-center"><?php echo $Summary_of_order_received->product_name;?></td>
										<td class="center text-center"><?php echo $Summary_of_order_received->product_weight*$Summary_of_order_received->total_stock_received;?></td>
										<td class="center text-center"><?php echo $Summary_of_order_received->stock_transferred;?></td>
										<td class="center text-center"><?php echo (!empty($Summary_of_order_received->total_stock_received) ? $Summary_of_order_received->total_stock_received : '0').'/'.(!empty($Summary_of_order_received->stock_received) ? $Summary_of_order_received->stock_received : '0');?></td>
										<td class="center text-center"><?php echo $Summary_of_order_received->stock_pending;?></td>
									</tr>
								<?php } } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<?php
			// }
			?>
			</div>
			</div><!--/row-->
    <!-- content ends -->
		</div><!--/#content.col-md-0-->
	
<script type="text/javascript">
	$(document).ready(function(){
		
		var $submit = $("#authorize_user").hide(),
		  $cbs = $('input[name="access_level"]').click(function() {
		  $submit.toggle( $cbs.is(":checked") );
		  });
		  
		iOSCheckbox.defaults.checkedLabel='Yes';
		iOSCheckbox.defaults.uncheckedLabel='No';
		iOSCheckbox.defaults.onChange=function(elem, data) {
		   id_checked=elem.attr('id');
		   if(id_checked=='stock_transferStatus_checked'){
			   
			 if(data==true){
				 
				$('#stock_transferStatus').val('Yes'); 
				 
			 }
			 
			if(data==false){
				
				$('#stock_transferStatus').val('No'); 
				
			}			 
			   
		   }
		 
		 }
		// $('#stock_receipt_date').datepicker({
			// minDate:0,
			// maxDate:0
		// });
		// $('#stock_receipt_date_s').datepicker();
		// $('#stock_receipt_date_s').datepicker('setDate', new Date());
		$('button[type="submit"]').on('click', function() {
		$('button[type="submit"]').addClass('disabled');	
		resetErrors();
		var url = $('#stock_receipt_form').attr('action');
		var formData=$('#stock_receipt_form').serialize();
		//alert(formData);
		$.ajax({
			dataType: 'json',
			type: 'POST',
			url: url,
			data: formData,
			beforeSend:function(){
						$('#pageloaddiv').show();
			},
			success: function(resp) {
				//console.log(resp);
				if(resp.done==='success'){
					$('button[type="submit"]').addClass('disabled');
					//popUpMessage(resp.MSG);
					//setTimeout(function () {
					 // window.location.href='<?php echo base_url();?>inventory/stock_receipt_form';  //will redirect to your stock transfer form (an ex: stock_transfer_form.php)
					//}, 1000); //will call the function after 1 secs.	
					if(resp.set_submit=='1')
					{
						$("#is_submit").val('1');
						$('#stock_receipt_form').submit();
						return true;
					}
				}else{
				if (resp === true) {
						//successful validation
						$('button[type="submit"]').removeClass('disabled');
						$('#stock_receipt_form').submit();
						
				} else {
					$('#pageloaddiv').hide();
					$('button[type="submit"]').removeClass('disabled');
					$.each(resp, function(i, v) {
					console.log(i + " => " + v); // view in console for error messages
						var msg = '<label class="error" for="'+i+'">'+v+'</label>';
						$('input[name="' + i + '"],input[id="' + i + '"]').addClass('inputTxtError').after(msg);
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
	
	function resetErrors(){
	$('form input').removeClass('inputTxtError');
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
	
	function getStockReceivedProduct(search_value){
	 $('.add_product_stock_receipt_received').empty();
	 var url = '<?php echo base_url();?>inventory/ajaxStockTranferProductReceived';
	 $.ajax({
            dataType: 'json',
            type: 'POST',
            url: url,
            data:{search_value:search_value},
            success: function(resp) {
			 if(resp.length != 0 ){
			//console.log(resp);
			//if(trim().resp!=1){
			//	alert(resp.office_name);
			var divsToAppend = "";
			j=1;
			$('#stock_receipt_from').val(resp.office_name);
			$('#stock_receipt_id').val(resp.stock_receipt_id);
			$('#stock_transfer_id').val(resp.inventory_stock_transfer.stock_transfer_id);
			$('#stock_transfer_date').val(resp.inventory_stock_transfer.stock_transfer_date);
			  $('.add_product_stock_receipt_received').html('');
			$.each(resp.inventory_stock_transfer_product, function(i, v) {
				/*divsToAppend += '<div class="row"><div class="form-group col-lg-2"><input type="text" class="form-control" id="product_name'+i+'" value="'+this.product_name+'" disabled /><input type="hidden" value="'+this.product_id+'" name="product_id[]" id="product_id'+i+'" /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="weight'+i+'" name="weight[]" value="'+this.NET_WEIGHT+'" readonly /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_transferred'+i+'" value="'+this.NET_QUANTITY+'" name="stock_transferred[]" readonly /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_received'+i+'" name="stock_received[]"onblur="getInitialStockReceivedCalculated(this.value,'+i+');" onkeypress="return isNumberKey(event);" /></div><div class="form-group col-lg-2" id="serial_number_div'+i+'"><input type="text" class="form-control" id="serial_number'+i+'" value="" name="serial_number[]" readonly /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_pending'+i+'" name="stock_pending[]" readonly /></div><input type="hidden" id="stock_receipt_product_id'+i+'" value="'+this.stock_receipt_product_id+'" name="stock_receipt_product_id[]"/></div>';*/
				if(this.stock_pending=='')
				{
				this.stock_pending=this.NET_QUANTITY;
				}
				if(this.stock_received=='')
				{
				this.stock_received='0';
				}
				divsToAppend += '<div class="row"><div class="form-group col-lg-2"><input type="text" class="form-control" id="product_name'+i+'" value="'+this.product_name+'" disabled /><input type="hidden" value="'+this.product_id+'" name="product_id[]" id="product_id'+i+'" /></div><div class="form-group col-lg-1"><input type="text" class="form-control" id="weight'+i+'" name="weight[]" value="'+this.NET_WEIGHT+'" readonly /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_transferred'+i+'" value="'+this.NET_QUANTITY+'" name="stock_transferred[]" readonly /></div><div class="form-group col-lg-1"><input type="text" class="form-control" id="stock_received_till'+i+'" value="'+this.stock_received+'" name="stock_received_till[]" readonly /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_pending'+i+'" name="stock_pending[]" value="'+this.stock_pending+'" readonly /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_received'+i+'" name="stock_received[]"onblur="getInitialStockReceivedCalculated(this.value,'+i+');" onkeypress="return isNumberKey(event);" /></div><div class="form-group col-lg-2" id="serial_number_div'+i+'"><input type="text" class="form-control" id="serial_number'+i+'" value="" name="serial_number[]" readonly /></div><input type="hidden" id="stock_receipt_product_id'+i+'" value="'+this.stock_receipt_product_id+'" name="stock_receipt_product_id[]"/></div>';
				});
			   $('.add_product_stock_receipt_received').append(divsToAppend);
			   $('#show_hide').attr('style').css('visibility','visible');
	/* }else{
		alert('cool');
		
		$('#show_hide').attr('style').css('visibility','hidden');
		
			 } */}else{
				 
			//	alert('cool'); 
				 
			 }}});
	}
	
	function getInitialStockReceivedCalculated(current_value,stock_pending_id){
	var stock_product_quantity=parseInt($('#stock_transferred'+stock_pending_id).val())-parseInt($('#stock_received_till'+stock_pending_id).val());
		if(current_value!=''){
		//var stock_product_quantity=$('#stock_transferred'+stock_pending_id).val();
		
		if(parseInt(current_value)>parseInt(stock_product_quantity)){
			//$('#stock_pending'+stock_pending_id).val('');
		   $('#stock_received'+stock_pending_id).removeClass('inputTxtError');
		   $('label[for="stock_received'+stock_pending_id+'"]').remove();
		  var msg = '<label class="error" for="stock_received'+stock_pending_id+'">Stock Received should not be greater than Pending Stock!</label>';
	   $('input[id="stock_received'+stock_pending_id+'"]').addClass('inputTxtError').after(msg);
	    $('#stock_pending'+stock_pending_id).val(stock_product_quantity);		 
		}else{
		resetErrors();
		
		fillserial_number_receipt_form(stock_pending_id,current_value);
		
		 var net_stock_value=$('#stock_transferred'+stock_pending_id).val();
		 // var net_stock_value=$('#stock_pending'+stock_pending_id).val();
		 net_stock_value_sum=parseInt(net_stock_value)-parseInt(current_value);
		 $('#stock_pending'+stock_pending_id).val(net_stock_value_sum);		 
		}
	}else{
		
	  $('#stock_pending'+stock_pending_id).val('');	
		
	}
	}
	
	
	function fillserial_number_receipt_form(stock_pending_id,current_value)
	{
		var product_id=$('#product_id'+stock_pending_id).val();
		var stock_receipt_product_id = $('#stock_receipt_product_id'+stock_pending_id).val();
		var tableName = "inventory_<?php echo $this->session->userdata('office_operation_type');?>_stock_receipt_product_serial_number_<?php echo $this->session->userdata('office_id');?>";
		$.ajax({
				url : "<?php echo base_url();?>inventory/getSerialNumberSeries",
				type: "POST",
				data: {product_id:product_id,table_name:tableName,fieldName:"serial_number",net_stock_id:stock_pending_id,quantity:current_value,pageName:"stock_receipt_form",stock_receipt_product_id:stock_receipt_product_id},
				success: function(resp){
					$('#serial_number_div'+stock_pending_id).html(resp);
				//	$('#stock_serial_list'+net_stock_id).html(resp);
				}
		});
	}
	
</script>

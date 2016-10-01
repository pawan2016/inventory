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
if($view_page=='1')
{

	$view_receipt_detail=$view_data['stock_receipt_detail'];
        // echo "<pre>";
 // print_r($view_receipt_detail);die;
	$stock_transfer_number_view=$view_receipt_detail->stock_transfer_number;
	$stock_receipt_date_view=$view_receipt_detail->stock_receipt_date;
	//$transfer_office_data=$this->db->get_where('office_master',array('office_id'=>$view_receipt_detail->office_id))->row();
	
	$this->db->select('office_master.*,regional_store_master.regional_store_type')->from('office_master');
	$this->db->join('regional_store_master','office_master.regional_store_id = regional_store_master.regional_store_id');
	$this->db->where('office_id',$view_receipt_detail->stock_receipt_from);
	
	$transfer_office_data=$this->db->get()->row();

	
	$received_from_view = $transfer_office_data->office_name.'-'.$transfer_office_data->office_operation_type.'('.$transfer_office_data->regional_store_type.')';
	$stock_transfer_date_view=$view_receipt_detail->stock_transfer_date;
	$stock_receipt_number_view=$view_receipt_detail->stock_receipt_number;
	$narration=$view_receipt_detail->narration;

	$view_receipt_product=$view_data['stock_receipt_product_detail'];
	$access_level_status = $view_receipt_detail->access_level_status;
	if($access_level_status=='1'){
		$invoice_authorized ='Yes';
		
		}else{
			
		$invoice_authorized ='No';	
	}
	
}
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
						<a href="#">Stock Reciept</a>
					</li>
				</ul>
				<ul class="breadcrumb-my-toggle text-right  col-lg-3 col-sm-3">
					<li>
						<?php if($access_level_status == '1'){ ?>
						<a href="javascript:void();" onClick="javascript:window.print();">Print</a>&nbsp;|&nbsp;<?php } ?><a href="<?php echo base_url('inventory/stock_receipt_inventory'); ?>">Stock Receipt Table</a>
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
						
						<div class="box-content">
							<div id="stockRecieptForm" class="panel-collapse collapse in">
								<div class="panel-body">
								<?php $attributes = array('class' => '', 'id' => 'stock_receipt_form');
					                   echo form_open('inventory/stock_receipt_form', $attributes);?>
									<div class="box-content">
										<div class="row">
											<div class="form-group col-lg-2">
												<label class="control-label">Date of Reciept</label>
												<input type="text" readonly="" class="form-control" name="stock_receipt_date" id="stock_receipt_date" value="<?php echo $stock_receipt_date_view;?>" />
												<input type="hidden" name="stock_transfer_id" id="stock_transfer_id" />
											</div>
											<div class="form-group col-lg-3">
												<label class="control-label">Reference Number</label>
												<input type="text" class="form-control" name="stock_receipt_number" id="stock_receipt_number" readonly value="<?php echo $stock_receipt_number_view;?>" />
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
											<div class="form-group col-lg-2 small_print">
												<label class="control-label">Stock Transferred</label>
											</div>
											<div class="form-group col-lg-1">
												<label class="control-label">Received Stock</label>
											</div>
											<div class="form-group col-lg-2 small_print">
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
											<div class="form-group col-lg-2 no_print">
												<label class="control-label">Serial No.</label>
											</div>
											
										</div>
										<?php $arr_serial_number_view=array();
										if(!empty($view_receipt_product))
										{
										foreach($view_receipt_product as $product_receipt)
										{
										?>
										<div class="row">
										<div class="form-group col-lg-3"><select data-rel="chosen" class="form-control" id="product_id0" name="product_id[]" onChange="getInitialStock(this.value,'0');">
										    <option value=""><?php echo $product_receipt->product_name;?></option>
											
										</select></div>
										<div class="form-group col-lg-1"><input type="text" readonly="" value="<?php echo $product_receipt->product_weight;?>" name="weight[]" id="weight0" class="form-control"></div>
										<div class="form-group col-lg-2 small_print"><input type="text" readonly="" name="stock_transferred[]" value="<?php echo $product_receipt->stock_transferred;?>" id="stock_transferred0" class="form-control"></div>
										<div class="form-group col-lg-1"><input type="text" readonly="" name="stock_received_till[]" value="<?php echo $product_receipt->stock_received;?>" id="stock_received_till0" class="form-control"></div>
										<div class="form-group col-lg-2 small_print"><input type="text" readonly="" value="<?php echo $product_receipt->stock_pending;?>" name="stock_pending[]" id="stock_pending0" class="form-control"></div>
										
										<div id="serial_number_div0" class="form-group col-lg-3 no_print" style="height:100px;overflow:hidden;overflow-y: scroll;" ><?php 
										
										$stock_receipt_product_serials_detail=$view_data['stock_receipt_product_serials_detail'][$product_receipt->stock_receipt_product_id];?>
									<select data-rel="chosen" class="form-control" id="stock_transfer_product_serial_number_view<?php echo $val_serials->stock_receipt_serial_number_id;?>" name="stock_transfer_product_serial_number_view[]" multiple="multiple" disabled="disabled">
									<?php
									
									foreach($stock_receipt_product_serials_detail as $val_serials)
									{
										$arr_serial_number_view[] = $val_serials->serial_number;
									?>
									<option selected="selected"><?php echo $val_serials->serial_number;?></option>
									<?php
									}
									?>
									</select></div><input type="hidden" name="stock_receipt_product_id[]" value="1" id="stock_receipt_product_id0"></div>
									<div class="row show_print" >
										<div class="form-group col-lg-12">
											<div class="controls">
												<?php echo implode(", ",$arr_serial_number_view); ?>
											</div>
										</div>
									</div>
										<?php
									}?>
									
									<div class="row">
										<div class="form-group col-lg-6">
												<label class="control-label">Is the transfer complete?</label>
												<input data-no-uniform="true" id="stock_transferStatus_checked" type="checkbox" class="iphone-toggle">
												<?php if($view_receipt_detail->stock_transfer_status == '1'){ ?>
													<input type="hidden" name="stock_transferStatus" id="stock_transferStatus" value="Yes"  checked>
												<?php } else{ ?>
													<input type="hidden" name="stock_transferStatus" id="stock_transferStatus" value="No"  checked>
												<?php }?>
												
											  </div>
										  </div>
										   <div class="row">
											<div class="form-group col-lg-8" style="visibility:visible;" id="show_closing">
											<label class="control-label required">Narration</label>
											<textarea class="form-control" readonly="" id="narration_recipt" name="narration_recipt" style="resize:none; width:500px" ><?php echo $view_receipt_detail->narration; ?></textarea>
											</div>
									   </div>
										<?php }
										else
										{
										?>
										
										<div class="add_product_stock_receipt_received">
							            </div>
										<div id="show_hide">
										<!--<div class="row">
											<div class="form-group col-lg-6">
												<label class="control-label">Is the transfer complete? </label>
												<input data-no-uniform="true" id="stock_transferStatus_checked" type="checkbox" class="iphone-toggle">
												<input type="hidden" name="stock_transferStatus" id="stock_transferStatus" value="No">
											</div>
										</div>-->
										<div class="row">
											<div class="form-group col-lg-6">
												<button type="submit" class="btn btn-primary">Submit</button>
											</div>
											<div class="form-group col-lg-6">
											</div>
										</div>
										</div>
										<?php
										}
										?>
									</div>
									<input type="hidden" id="stock_receipt_id" name="stock_receipt_id" />
									 <?php 
									echo form_close();
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php //if($view_page=='')
			//{
			?>
			<div class="box col-lg-12 col-md-12 col-xs-12" >
					<div class="box-inner">
						<div class="box-header well">
							<h2>Summary of Order Received</h2>
						</div>
						<div class="box-content">
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
								if(!empty($view_receipt_product)){$i=1; 
									foreach($view_receipt_product as $Summary_of_order_received){?>
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
			//}
			?>
			</div>
			</div><!--/row-->
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
					<div class="center text-center text-uppercase" style="font-size:15px; font-weight:bold;">Stock Receipt</div>
				</div>
			</div>
			<div class="row">
				<div class="box col-lg-12 col-md-12 col-xs-12">
					<div class="box-content">
					<div class="row">
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Received From&nbsp;:&nbsp;</label><?php echo $received_from_view; ?>
							</div>
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Received At&nbsp;:&nbsp;</label><?php 
									$this->db->select('office_master.*,regional_store_master.regional_store_type')->from('office_master');
										$this->db->join('regional_store_master','office_master.regional_store_id = regional_store_master.regional_store_id');
										$this->db->where('office_id',$office_id);
										
										$received_at_office_data=$this->db->get()->row();
										echo getOfficeLocation($office_id).'('.$received_at_office_data->regional_store_type.')'; ?>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Receipt No.&nbsp;:&nbsp;</label><?php echo $stock_receipt_number_view; ?>
							</div>
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Date & Time&nbsp;:&nbsp;</label><?php echo $stock_receipt_date_view; ?>
							</div>
						</div>
						<div class="row">
							<!--<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Remarks&nbsp;:&nbsp;</label>
							</div>-->
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Authorized&nbsp;:&nbsp;</label><?php echo $invoice_authorized; ?>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Narration&nbsp;:&nbsp;</label><?php echo $narration;  ?>
							</div>
						</div>
					</div>
				</div>
				<div class="box col-lg-12 col-md-12 col-xs-12" style="min-height:300px !important;">
					<div class="box-content">
						<table class="table  table-bordered">
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
								if(!empty($view_receipt_product)){$i=1;
									$grand_total=0;
									 $weight_total=0;
									 $grand_total_transfer=0;
									 $grand_total_stock_received=0;
									 $grand_stock_received=0;
									
									 foreach($view_receipt_product as $Summary_of_order_received){
										 $grand_total += $Summary_of_order_received->stock_pending;
										 $grand_total_transfer += $Summary_of_order_received->stock_transferred;
										 
										 if(!empty($Summary_of_order_received->total_stock_received))
										 {
											   $grand_total_stock_received += $Summary_of_order_received->total_stock_received;
										 }
										if(!empty($Summary_of_order_received->stock_received))
										{
											   $grand_stock_received += $Summary_of_order_received->stock_received;
										}
										 
										 
										$grand_total_weight += $Summary_of_order_received->product_weight*$Summary_of_order_received->total_stock_received;
										 
										 ?>
									<tr>
										<td class="text-center"><?php echo $i++;?></td>
										<td class="center text-center"><?php echo $Summary_of_order_received->product_name;?></td>
										<td class="center text-center"><?php echo $Summary_of_order_received->product_weight*$Summary_of_order_received->total_stock_received;?></td>
										<td class="center text-center"><?php echo $Summary_of_order_received->stock_transferred;?></td>
										<td class="center text-center"><?php echo (!empty($Summary_of_order_received->total_stock_received) ? $Summary_of_order_received->total_stock_received : '0').'/'.(!empty($Summary_of_order_received->stock_received) ? $Summary_of_order_received->stock_received : '0');?></td>
										<td class="center text-center"><?php echo $Summary_of_order_received->stock_pending;?></td>
									</tr>
							<?php }  ?>
							 <tr><td></td><td class="center text-center">Grand Total</td><td class="center text-center"><?php echo $grand_total_weight;?></td><td class="center text-center"><?php echo $grand_total_transfer;?></td><td class="center text-center"><?php echo $grand_total_stock_received.'/'.$grand_stock_received;?></td><td class="center text-center"><?php echo $grand_total; ?></td></tr>
							 <?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="box col-lg-12 col-md-12 col-xs-12">
					<div class="box col-lg-6 col-md-6 col-xs-6">
					<div class="box-header well">
					
					</div>
					</div>
					
					<div class="box col-lg-6 col-md-6 col-xs-6">
					<div class="box-header well">
						<h2>For MMTC LTD.</h2>
					</div>
					<br/>
					</div>
					
					<div class="box-content">
						<div class="row">
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Signature<?php echo str_repeat('&nbsp;',20) ?>:&nbsp;</label>.................................
							</div>
							<div class="form-group col-lg-2 showmyprint">
								<label class="control-label">Signature<?php echo str_repeat('&nbsp;',20) ?>:&nbsp;</label>.................................
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
				</div>
				<div class="box col-lg-12 col-md-12 col-xs-12" style="margin-top:10px;">
					    <?php
							
							if(!empty($view_receipt_product))
							{
							foreach($view_receipt_product as $product_receipt)
							{
							?>				
							    <?php 	
							    $stock_receipt_product_serials_detail=$view_data['stock_receipt_product_serials_detail'][$product_receipt->stock_receipt_product_id];?>
								<?php
									$arr_serial_number_view=array();
									foreach($stock_receipt_product_serials_detail as $val_serials)
									{
										$arr_serial_number_view[] = $val_serials->serial_number;
								    
								    }
									?>
								  <div class="box col-lg-12 col-md-12 col-xs-12" style="margin-top:10px !important;">
					               <div class="col-lg-6 col-md-6 col-xs-6 my-heading-class"><h2 style="font-size:15px !important;">PACKING LIST:&nbsp;&nbsp;<?php echo $product_receipt->product_name;?> </h2></div><div class="col-lg-6 col-md-6 col-xs-6 my-heading-class"><h2 style="font-size:15px !important;">Receipt No:<?php echo $stock_receipt_number_view; ?> </h2></div>
					                <div class="box-content">
					               <?php echo implode(", ",$arr_serial_number_view); ?>
									 </div>
				                    </div>
								   <?php	
								    }
						         }
						      ?>
				
			</div><!--/row-->
    <!-- content ends -->
		</div><!--/#content.col-md-0-->
	</div><!--/fluid-row-->
	<div id="printby">
		Printed By :  <?php echo ucwords($this->session->userdata('user_username')); ?>&nbsp;,&nbsp;Date :   <?php echo date('d-m-Y H:i:s',strtotime('now')).'<br/>'.str_repeat('*',185); ?>
	</div>
	
<script type="text/javascript">
	$(document).ready(function(){
		iOSCheckbox.defaults.checkedLabel='Yes';
		iOSCheckbox.defaults.uncheckedLabel='No';
		iOSCheckbox.defaults.onChange=function(elem, data) {
		   id_checked=elem.attr('id');
		   if(id_checked=='stock_transferStatus_checked'){
			   
			 if(data==true){
				 
			  $('#stock_transferStatus').val('Yes'); 
              $('#show_closing').removeAttr('style').css('visibility','hidden');		 
				 
			 }
			 
			if(data==false){
				
				$('#stock_transferStatus').val('No'); 
                $('#show_closing').removeAttr('style').css('visibility','visible');	
			}			 
			   
		   }
		 
		 }

		 var check_show_hide = '<?php echo $view_receipt_detail->stock_transfer_status; ?>';
		 if(check_show_hide=='1'){
			 $('#stock_transferStatus').val('Yes'); 
			 $('#stock_transferStatus_checked').attr("checked",true);
             $('#show_closing').removeAttr('style').css('visibility','hidden');	 
			 
		 }else{
			$('#stock_transferStatus').val('No'); 
            $('#show_closing').removeAttr('style').css('visibility','visible');	  
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
			success: function(resp) {
				//console.log(resp);
				if(resp.done==='success'){
					$('button[type="submit"]').addClass('disabled');
					//popUpMessage(resp.MSG);
					//setTimeout(function () {
					  window.location.href='<?php echo base_url();?>inventory/stock_receipt_form';  //will redirect to your stock transfer form (an ex: stock_transfer_form.php)
					//}, 1000); //will call the function after 1 secs.	
				}else{
				if (resp === true) {
						//successful validation
						$('button[type="submit"]').removeClass('disabled');
						$('#stock_receipt_form').submit();
						
				} else {
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

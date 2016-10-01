<style>
.ui-widget-content{
	max-height: 200px;
	overflow-y:scroll;
}

.my-btn-round{
	float: right;
    position: absolute;
    right: 20px;
    z-index: 101;
    top: 4px;
	}
.dataTables_paginate { display :none;}
</style>
<?php
$stock_receipt_id = ($this->input->get('stock_receipt_id')) ? base64_decode($this->input->get('stock_receipt_id')) : '';
$office_operation_type = $this->session->userdata('office_operation_type');
$office_id = $this->session->userdata('office_id');
$tableStockName = 'inventory_'.$office_operation_type.'_stock_receipt_'.$office_id;
$tableStockProductName = 'inventory_'.$office_operation_type.'_stock_receipt_product_'.$office_id;
$dataStock = $this->db->get_where($tableStockName,array('stock_receipt_id'=>$stock_receipt_id))->row();

// if($dataStock->access_level_status == '1'){
	// redirect(base_url('user/dashboard'));
// }

$stockTranferId = $dataStock->stock_transfer_id;

if($dataStock->stock_receipt_number == ''){
$maxid='1';
$financialFirstYear = (date('m')<'04') ? date('y',strtotime('-1 year')) : date('y');
            
$financialSecondYear = $financialFirstYear+1;
$financialYear = $financialFirstYear.'-'.$financialSecondYear;

// $row=$this->db->query("SELECT COUNT(stock_receipt_number) AS maxid FROM inventory_".$office_operation_type."_stock_receipt_".$office_id." where stock_receipt_number!=''")->row();


$row=$this->db->query("SELECT COUNT(stock_receipt_number) AS maxid FROM inventory_".$office_operation_type."_stock_receipt_".$office_id." where stock_receipt_number!='' and stock_receipt_number like '%".$financialYear."' ")->row();

if(count($row->maxid) > 0){
$maxid=$row->maxid+1; 
}	
//	$office_master=$this->base_model->get_record_by_id('office_master',array('office_id'=>$id));
$autoId = str_pad($maxid,6,"0", STR_PAD_LEFT);
$office_master=$this->base_model->get_record_by_id('office_master',array('office_id'=>$office_id));
/* $financialFirstYear = (date('m')<'04') ? date('y',strtotime('-1 year')) : date('y');
            
$financialSecondYear = $financialFirstYear+1;
$financialYear = $financialFirstYear.'-'.$financialSecondYear;
 */
$jsonArray=array('auto_id'=>$autoId,'office_short_code'=>$office_master->office_short_code,'office_operation_type'=>$office_master->office_operation_type);
$stock_number_generate= strtoupper($office_master->office_short_code).'/SR'.'/'.$autoId.'/'.$financialYear;
$buttonName = "Select Serial Number";
}
else{
	$stock_number_generate = $dataStock->stock_receipt_number;
	$buttonName = "Edit Serial Number";
}

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
                    <?php echo $this->session->flashdata('SuccessMessage');
						redirect(base_url('inventory/stock_receipt_inventory'));
					?>
                </span>
			<?php } ?>
			<div class="row">
			 <div class="col-md-10 col-md-push-1 half-md-div">
				<div class="box col-lg-12 col-md-12 col-xs-12" style=" margin-top: -10px;">
					<div class="box-inner" id="accordion">
						<div class="box-header well" >
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#stockRecieptForm">
								    Stock Reciept Form
								</a>
						</div>
						<?php
						if($view_page=='1')
						{
						
			
						$view_receipt_detail=$view_data['stock_receipt_detail'];
					
				//	print_r($view_receipt_detail);
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
						$stock_receipt_number_view= ($stock_receipt_number_view) ? $stock_receipt_number_view : $stock_number_generate;
						
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
												<input type="text" class="form-control" name="stock_receipt_date" id="stock_receipt_date" style="width:164px" value="<?php echo date('d/m/Y H:i:s'); //$stock_receipt_date_view;?>" readonly="" />
												<input type="hidden" name="stock_transfer_id" id="stock_transfer_id" />
												<input type="hidden" name="stock_transferId" id="stock_transferId" value="<?php echo $view_receipt_detail->stock_transfer_id; ?>" />
											</div>
											<div class="form-group col-lg-3">
												<label class="control-label">Reference Number</label>
												<input type="text" class="form-control" name="stock_receipt_number" id="stock_receipt_number" readonly value="<?php echo $stock_receipt_number_view;?>" />
												<input type="hidden" name="stock_receiptNumber" value="<?php echo $stock_receipt_number_view;?>" />
											</div>
											<div class="form-group col-lg-3">
												<label class="control-label required">Stock Transfer Number</label>
												<?php /*<input type="text" class="form-control" name="stock_transfer_number" id="stock_transfer_number" onblur="getStockReceivedProduct(this.value);"/>*/ ?>
												<select data-rel="chosen" class="form-control"  id="stock_transfer_number" name="stock_transfer_number" onChange="getStockReceivedProduct(this.value);"  >
												<?php
												if($stock_transfer_number_view!='')
												{
												?>
												<option value="<?php echo $stock_transfer_number_view;?>"><?php echo $stock_transfer_number_view;?></option>
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
											<div class="form-group col-lg-2">
												<label class="control-label">Product Name</label>
											</div>
											<div class="form-group col-lg-1">
												<label class="control-label">Current Stock</label>
											</div>
											<div class="form-group col-lg-1">
												<label class="control-label">Weight</label>
											</div>
											<div class="form-group col-lg-2">
												<label class="control-label">Stock Transferred</label>
											</div>
											<div class="form-group col-lg-1">
												<label class="control-label">Received Stock</label>
											</div>
											<div class="form-group col-lg-1">
												<label class="control-label">Pending Stock</label>
											</div>
											<div class="form-group col-lg-2">
												<label class="control-label required">Receiving Stock</label>
											</div>
											<div class="form-group col-lg-2">
												<label class="control-label">Serial No.</label>
											</div>
											
										</div>
										<?php
										if(!empty($view_receipt_product))
										{
											$my_page_type = "editData";
											$i=0;
											$table_authorized_stock_receipt='inventory_'.$office_operation_type.'_stock_receipt_product_serial_number_'.$office_id;
											
										foreach($view_receipt_product as $product_receipt)
										{
											$total_received_authorized = $this->db->get_where($table_authorized_stock_receipt,array('stock_receipt_product_id'=>$product_receipt->stock_receipt_product_id,'stock_receipt_product_serial_number_status'=>'1'))->result();
											$total_authorized=0;
											$total_authorized=$product_receipt->total_stock_received;
$table_name='product_current_stock_'.$office_id;
$product_current_stock=$this->base_model->get_record_by_id($table_name,array('product_id'=>$product_receipt->product_id));
$initialStock = isset($product_current_stock->product_current_stock) ? $product_current_stock->product_current_stock : '0';
										?>
										<div id="stockReceived_div">
										<div id="stockReceived_div_child">
										<div class="row">
										<div class="form-group col-lg-2"><select data-rel="chosen" class="form-control" id="product_id<?php echo $i; ?>" name="product_id[]" onChange="getInitialStock(this.value,'<?php echo $i; ?>');">
										    <option value="<?php echo $product_receipt->product_id; ?>"><?php echo $product_receipt->product_name;?></option>
											
										</select></div>
										<div class="form-group col-lg-1"><input type="text" readonly value="<?php echo $initialStock;?>" id="current_stock<?php echo $i; ?>" class="form-control"/></div>
										<div class="form-group col-lg-1"><input type="text" readonly="" value="<?php echo $product_receipt->weight;?>" name="weight[]" id="weight<?php echo $i; ?>" class="form-control" /></div>
										<div class="form-group col-lg-2"><input type="text" readonly="" name="stock_transferred[]" value="<?php echo $product_receipt->stock_transferred;?>" id="stock_transferred<?php echo $i; ?>" class="form-control" />
										<input type="hidden" value="<?php echo $total_authorized;?>" id="total_authorized<?php echo $i; ?>" />
										</div>
										<div class="form-group col-lg-1"><input type="text" readonly name="stock_received_old[]" value="<?php echo $product_receipt->total_stock_received;?>" id="stock_received_old<?php echo $i; ?>" class="form-control"/></div>
										<div class="form-group col-lg-1"><input type="text" readonly="" value="<?php echo $product_receipt->stock_pending;?>" name="stock_pending[]" id="stock_pending<?php echo $i; ?>" class="form-control"/>
										<input type="hidden" id="stock_pending_old<?php echo $i; ?>" value="<?php echo $product_receipt->stock_pending;?>"  />
										</div>
										<div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_received<?php echo $i; ?>" name="stock_received[]" value="<?php echo $product_receipt->stock_received;?>" readonly />
										
										</div>
										
										<div id="serial_number_div<?php echo $i; ?>" class="form-group col-lg-2">
											<div role="tab" id="heading<?php echo $i; ?>">
												<button class="btn btn-success" type="button" role="button" data-toggle="collapse" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i;?>" onclick="updateMakeAutoComplete('<?php echo $i; ?>','<?php echo $product_receipt->stock_receipt_product_id; ?>');" >
												<?php echo $buttonName; ?>
												</button>
											</div>
										</div>
										<input type="hidden" name="stock_receipt_product_id[]" value="<?php echo $product_receipt->stock_receipt_product_id; ?>" id="stock_receipt_product_id<?php echo $i; ?>"></div>
<?php 
		
		
		$serials = array();
		$product_Id = $product_receipt->stock_receipt_product_id;
		$office_id = $this->session->userdata('office_id');
		$office_operation_type= $this->session->userdata('office_operation_type');
		$table_inventory_stock_receipt_product_serial='inventory_'.$office_operation_type.'_stock_receipt_product_serial_number_'.$office_id; // logged-in-user
		$serials = $this->db->select('serial_number')->get_where($table_inventory_stock_receipt_product_serial,array('stock_receipt_product_id'=>$product_Id,'stock_receipt_product_serial_number_status'=>'2'))->result();

		$serialData = array();
		foreach($serials as $serialNum){
			array_push($serialData,$serialNum->serial_number);
		}
		
		//print_r($serialData);
		$stock_receipt_product_serials_detail=$view_data['stock_receipt_product_serials_detail'][$product_receipt->stock_receipt_product_id];
		$transferSerialNumber = array();
		foreach($stock_receipt_product_serials_detail as $val_serials){
			array_push($transferSerialNumber,$val_serials->serial_number);
		}
		
		$totalValue = count($serialData);
		$firstValue = $serialData[0];
		$lastValue = $serialData[$totalValue-1];
		//print_r($serialData);
		
		$where_status = '(stock_receipt_product_serial_number_status = 3 or stock_receipt_product_serial_number_status = 2)';
		$this->db->where($where_status);
		
        //$receiptSerialMaster = $this->db->get_where($table_inventory_stock_receipt_product_serial,array('stock_receipt_product_id'=>$product_Id))->result();
        $receiptSerialMaster = $this->db->select('serial_number')->from($table_inventory_stock_receipt_product_serial)->where(array('stock_receipt_product_id'=>$product_Id))->order_by('stock_receipt_serial_number_id')->get()->result();
		// echo $this->db->last_query();
		$totalSerial = count($receiptSerialMaster);
		$firstSerial = $receiptSerialMaster[0]->serial_number;
		$lastSerial = $receiptSerialMaster[$totalSerial-1]->serial_number;
?>
										<div class="row">
											<div id="collapse<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
												<div class="panel-body col-lg-12">
													<div class="row">
														<div class="form-group col-lg-4">
															<label class="control-label">Starting Serial No.</label>
														</div>
														<div class="form-group col-lg-4">
															<label class="control-label">End Serial No.</label>
														</div>
													</div>
													<div class="range<?php echo $i; ?>">
														<div class="row range-list<?php echo $i; ?>-0" id="range-list<?php echo $i; ?>-0">
															<div class="form-group col-lg-4">
																<input type="text" readonly="readonly" class="form-control"  name="starting_serial_number<?php echo $i; ?>-0" id="starting_serial_number<?php echo $i; ?>-0" value="<?php echo $firstValue; ?>" />
															</div>
															<div class="form-group col-lg-4">
																<input type="text" readonly="readonly" class="form-control" name="limit<?php echo $i; ?>-0" id="limit<?php echo $i; ?>-0" value="<?php echo $lastValue; ?>" />
																<?php 
																/*
																<input type="text" class="form-control" name="limit<?php echo $i; ?>-0" id="limit<?php echo $i; ?>-0" onblur="updateMakeSerialNumbersReceiptForm('<?php echo $i; ?>','0','<?php echo $product_Id; ?>');" value="<?php echo $lastValue; ?>" />
																*/
																?>
															</div>
															<div class="form-group col-lg-4">
																<button class="btn btn-success" onclick="selectAllSerials('<?php echo $firstSerial; ?>','<?php echo $lastSerial; ?>','<?php echo $i; ?>','0','<?php echo $product_Id; ?>');" type="button">Select All</button>
																<?php 
							//selectAllSerials(firstSerial,lastSerialdivNumber,rangeDivNumber,stock_receipt_product_id)
																?>
															</div>
														</div>
													</div>
													<hr/>
													<div class="rangeSerialNumber<?php echo $i; ?>">
														<div class="add_serial_number_in_div<?php echo $i; ?>-0 row">
															<?php
															$j=0;
															foreach($serialData as $serialNumber)
															{
																if(in_array($serialNumber,$transferSerialNumber)){
															?>
															<div class="my_id-<?php echo $j; ?>">
																<div class="form-group col-lg-3">
																	<input type="text" class="form-control" id="initial_stock_starting_serial_popup<?php echo $j; ?>" readonly name="serial_number_<?php echo $i; ?>[]" value="<?php echo $serialNumber;?>" />
																<a onclick="removeAddSrNoReceiptFormEdit('<?php echo $i; ?>','0','<?php echo $j; ?>')" href="javascript:void(0);" class="btn btn-round btn-default my-btn-round">
																<i class="glyphicon glyphicon-remove"></i></a>
																</div>
															</div>
															<?php
																}
															$j++;
															}
															?>
														</div>
													</div>
												</div>
											</div>
										</div>
										</div>
										</div>
										<?php
										$i++;
										}
										}
										else
										{
										?>
										<div class="add_product_stock_receipt_received">
							
							            </div>
									
										<div id="show_hide">
										
										</div>
										<?php
										}
										?>
										<div class="row">
										<div class="form-group col-lg-6">
												<label class="control-label">Is the transfer complete? </label>
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
											<textarea class="form-control" id="narration_recipt" name="narration_recipt" style="resize:none; width:500px" ><?php echo $view_receipt_detail->narration; ?></textarea>
											</div>
									   </div>
										<?php if($this->session->userdata('user_access_type') == "Authorizer") { ?>
										<div class="row">
											<div class="form-group col-lg-6">
												<label class="checkbox-inline">
													<input type="checkbox" id="access_level" name="access_level" value="1"> Authorize
												</label>
											</div>
										</div>
										<?php } ?>
										<div class="row">
											<div class="form-group col-lg-6">
												<button type="submit" class="btn btn-primary">Submit</button>
												<a href="<?php echo base_url('inventory/stock_receipt_inventory'); ?>" class="btn btn-primary">Cancel</a>
											</div>
											<div class="form-group col-lg-6">
											</div>
										</div>
									</div>
									<input type="hidden" id="stock_receipt_id" name="stock_receipt_id" value="<?php if($stockReceiptId) { echo $stockReceiptId ; } else { } ?>"/>
									<input type="hidden" id="stock_receiptId" name="stock_receiptId" value="<?php echo $stock_receipt_id; ?>"/>
									<input type="hidden" name="is_submit" id="is_submit" value='' />
									<input type="hidden" name="my_page_type" id="my_page_type" value='<?php echo $my_page_type; ?>' />
									 <?php
									echo form_close();
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php 
			$summaryData = $this->db->select('*')->from($tableStockName)->where(array('stock_transfer_id'=>$stockTranferId))->order_by('stock_receipt_id')->get()->result();
			if($summaryData[0]->stock_receipt_number !='' && $summaryData[0]->access_level_status == '1'){
			?>
			<div class="box col-lg-12 col-md-12 col-xs-12" >
					<div class="box-inner">
						<div class="box-header well">
							<h2>Summary of Order Received</h2>
						</div>
						<div class="box-content">
						<?php foreach($summaryData as $summary){ 
						if($summary->stock_receipt_number !='' && $summary->access_level_status == '1'){
							$summary_of_order_received = $this->db->select('sr_p.*,pm.product_name,pm.product_weight')->from($tableStockProductName.' as sr_p')->join('product_master as pm','pm.product_id=sr_p.product_id','left')->where(array('sr_p.stock_receipt_id'=>$summary->stock_receipt_id))->get()->result();
							
						?>
							<div class="box-inner" style="margin-bottom:5px; margin-top:5px;">
								<div class="box-header well">
									<h2>STOCK REFERENCE NUMBER : <?php echo $summary->stock_receipt_number; ?></h2>
								</div>
								<div class="box-content">
									<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
										<thead>
											<tr>
												<th class="text-center">Sr. No.<span><img src="<?php echo base_url(); ?>/files/img/sorting_image.png" height="10px" width="10px"></span></th>
												<th class="text-center">Product Name.<span><img src="<?php echo base_url(); ?>/files/img/sorting_image.png" height="10px" width="10px"></span></th>
												<th class="text-center">Total Net Weight (in gm).<span><img src="<?php echo base_url(); ?>/files/img/sorting_image.png" height="10px" width="10px"></span></th>
												<th class="text-center">Transfer Stock.<span><img src="<?php echo base_url(); ?>/files/img/sorting_image.png" height="10px" width="10px"></span></th>
												<th class="text-center">Net Quantity / Received Stock.<span><img src="<?php echo base_url(); ?>/files/img/sorting_image.png" height="10px" width="10px"></span></th>
												<th class="text-center">Pending Stock.<span><img src="<?php echo base_url(); ?>/files/img/sorting_image.png" height="10px" width="10px"></span></th>
											</tr>
										</thead>
										<tbody>
										<?php 
										if(!empty($summary_of_order_received)){$i=1; foreach($summary_of_order_received as $Summary_of_order_received){?>
											<tr>
												<td class="text-center"><?php echo $i++;?></td>
												<td class="center text-center"><?php echo $Summary_of_order_received->product_name;?></td>
												<td class="center text-center"><?php echo $Summary_of_order_received->product_weight*$Summary_of_order_received->total_stock_received;?></td>
												<td class="center text-center"><?php echo $Summary_of_order_received->stock_transferred;?></td>
												<td class="center text-center"><?php echo $Summary_of_order_received->stock_received;?></td>
												<td class="center text-center"><?php echo $Summary_of_order_received->stock_pending;?></td>
											</tr>
										<?php } } ?>
										</tbody>
									</table>
								</div>
							</div>
						<?php } } ?>
						</div>
					</div>
				</div>
			<?php
			}
			?>
			</div>
			</div><!--/row-->
    <!-- content ends -->
		</div><!--/#content.col-md-0-->
	</div><!--/fluid-row-->
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
// $('#stock_receipt_date').datetimepicker({
			// dateFormat: 'dd/mm/yy',
			// timeFormat: 'HH:mm:ss',
			// minDate:'<?php echo date('d/m/Y H:i:s');?>',
			// maxDate:'<?php echo date('d/m/Y H:i:s');?>',
			
		// });
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
		// $('#stock_receipt_date').datepicker({
			// minDate:0,
			// maxDate:0
		// });
		// $('#stock_receipt_date_s').datepicker();
		// $('#stock_receipt_date_s').datepicker('setDate', new Date());
		
		getAllProductListData();
		
		
		$('button[type="submit"]').on('click', function() {
			
		resetErrors();
		var url = $('#stock_receipt_form').attr('action');
		var formData=$('#stock_receipt_form').serialize();
		divCount = $("#stockReceived_div > div").size();
		
		var check_flag_status ='<?php echo $dataStock->stock_receipt_number; ?>';
		if(check_flag_status !=''){
			var flag_submit='1';
			
		}else{
			var flag_submit=0;
			
		}
		
			for(var i=0;i<divCount;i++)
			{
				if($("#stock_received_old"+i).val()!='0')
				{
					flag_submit=1;
				}
			}
			
		if(flag_submit==0)
		{
			alert("Please select serial no. of atleast one product");
			return false;
		}
		if($('#stock_transferStatus').val()!='Yes')
			{
				
				if($("#narration_recipt").val()=='')
				{
					alert("Please enter narration");
					return false;
				}
			}
	$('button[type="submit"]').addClass('disabled');
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
						$('input[name="' + i + '"],input[id="' + i + '"],div[id="' + i + '"],textarea[id="' + i + '"]').addClass('inputTxtError').after(msg);
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
			<?php if($view_page!=1)
			{
			?>
			generateStockReceiptReferenceNo();
			<?php 
			}
			?>
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
				/*divsToAppend += '<div class="row"><div class="form-group col-lg-2"><input type="text" class="form-control" id="product_name'+i+'" value="'+this.product_name+'" disabled /><input type="hidden" value="'+this.product_id+'" name="product_id[]" id="product_id'+i+'" /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="weight'+i+'" name="weight[]" value="'+this.NET_WEIGHT+'" readonly /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_transferred'+i+'" value="'+this.NET_QUANTITY+'" name="stock_transferred[]" readonly /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_received'+i+'" name="stock_received[]"onblur="getInitialStockReceivedCalculated(this.value,'+i+','');" onkeypress="return isNumberKey(event);" /></div><div class="form-group col-lg-2" id="serial_number_div'+i+'"><input type="text" class="form-control" id="serial_number'+i+'" value="" name="serial_number[]" readonly /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_pending'+i+'" name="stock_pending[]" readonly /></div><input type="hidden" id="stock_receipt_product_id'+i+'" value="'+this.stock_receipt_product_id+'" name="stock_receipt_product_id[]"/></div>';*/
				if(this.stock_pending=='')
				{
				this.stock_pending=this.NET_QUANTITY;
				}
				if(this.stock_received=='')
				{
				this.stock_received='0';
				}
			/*	divsToAppend += '<div class="row"><div class="form-group col-lg-2"><input type="text" class="form-control" id="product_name'+i+'" value="'+this.product_name+'" disabled /><input type="hidden" value="'+this.product_id+'" name="product_id[]" id="product_id'+i+'" /></div><div class="form-group col-lg-1"><input type="text" class="form-control" id="weight'+i+'" name="weight[]" value="'+this.NET_WEIGHT+'" readonly /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_transferred'+i+'" value="'+this.NET_QUANTITY+'" name="stock_transferred[]" readonly /></div><div class="form-group col-lg-1"><input type="text" class="form-control" id="stock_received_till'+i+'" value="'+this.stock_received+'" name="stock_received_till[]" readonly /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_pending'+i+'" name="stock_pending[]" value="'+this.stock_pending+'" readonly /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_received'+i+'" name="stock_received[]"onblur="getInitialStockReceivedCalculated(this.value,'+i+',0);" onkeypress="return isNumberKey(event);" /></div><div class="form-group col-lg-2" id="serial_number_div'+i+'"><input type="text" class="form-control" id="serial_number'+i+'" value="" name="serial_number[]" readonly /></div><input type="hidden" id="stock_receipt_product_id'+i+'" value="'+this.stock_receipt_product_id+'" name="stock_receipt_product_id[]"/></div>';
				*/
				divsToAppend += '<div id="stock_receipt_div'+i+'" ><div class="row"><div class="form-group col-lg-2"><input type="text" class="form-control" id="product_name'+i+'" value="'+this.product_name+'" disabled /><input type="hidden" value="'+this.product_id+'" name="product_id[]" id="product_id'+i+'" /></div><div class="form-group col-lg-1"><input type="text" class="form-control" id="weight'+i+'" name="weight[]" value="'+this.NET_WEIGHT+'" readonly /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_transferred'+i+'" value="'+this.NET_QUANTITY+'" name="stock_transferred[]" readonly /></div><div class="form-group col-lg-1"><input type="text" class="form-control" id="stock_received_till'+i+'" value="'+this.total_stock_received+'" name="stock_received_till[]" readonly /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_pending'+i+'" name="stock_pending[]" value="'+this.stock_pending+'" readonly /><input type="hidden" id="stock_pending_old'+i+'" value="'+this.stock_pending+'"  /></div><div class="form-group col-lg-2"><input type="text" class="form-control" id="stock_received'+i+'" name="stock_received[]" value="0" readonly /></div><div class="form-group col-lg-2" id="serial_number_div'+i+'"><div role="tab" id="heading0"><button type="button" class="btn btn-success" role="button" data-toggle="collapse" href="#collapse'+i+'" aria-expanded="true" aria-controls="collapseOne" onclick="makeAutoCompleteAndGetSerialNumber('+i+','+this.stock_receipt_product_id+');">Serial Number</button></div></div><input type="hidden" id="stock_receipt_product_id'+i+'" value="'+this.stock_receipt_product_id+'" name="stock_receipt_product_id[]"/></div><div class="row"><div id="collapse'+i+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading0"><div class="panel-body col-lg-12"><div class="row"><div class="form-group col-lg-4"><label class="control-label">Starting Serial No.</label></div><div class="form-group col-lg-4"><label class="control-label">End Serial No.</label></div></div><div class="range'+i+'"><div class="row range-list'+i+'-0" id="range-list'+i+'-0"><div class="form-group col-lg-4"><input type="text"  class="form-control"  name="starting_serial_number'+i+'-0" id="starting_serial_number'+i+'-0"/></div><div class="form-group col-lg-4"><input type="text" class="form-control" name="limit'+i+'-0" id="limit'+i+'-0" onblur="makeSerialNumbersReceiptForm('+i+','+0+','+this.stock_receipt_product_id+');" /></div></div></div><hr/><div class="rangeSerialNumber'+i+'"><div class="add_serial_number_in_div'+i+'-0 hide row"></div></div></div></div></div></div>';
				});
			   $('.add_product_stock_receipt_received').append(divsToAppend);
			   $('#show_hide').css('visibility','visible');
	/* }else{
		alert('cool');
		
		$('#show_hide').attr('style').css('visibility','hidden');
		
			 } */}else{
				 
			//	alert('cool'); 
				 
			 }}});
	}
	
	function getInitialStockReceivedCalculated(current_value,stock_pending_id,formType){
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
		
		fillserial_number_receipt_form(stock_pending_id,current_value,formType);
		
		 var net_stock_value=$('#stock_transferred'+stock_pending_id).val();
		 // var net_stock_value=$('#stock_pending'+stock_pending_id).val();
		 
		 net_stock_value_sum=parseInt(net_stock_value)-parseInt(current_value);
		 $('#stock_pending'+stock_pending_id).val(net_stock_value_sum);		 
		}
	}else{
		
	  $('#stock_pending'+stock_pending_id).val('');	
		
	}
	}
	
	
	function fillserial_number_receipt_form(stock_pending_id,current_value,formType)
	{
		var product_id=$('#product_id'+stock_pending_id).val();
		var stock_receipt_product_id = $('#stock_receipt_product_id'+stock_pending_id).val();
		var tableName = "inventory_<?php echo $this->session->userdata('office_operation_type');?>_stock_receipt_product_serial_number_<?php echo $this->session->userdata('office_id');?>";
		$.ajax({
				url : "<?php echo base_url();?>inventory/getSerialNumberSeries",
				type: "POST",
				data: {product_id:product_id,table_name:tableName,fieldName:"serial_number",net_stock_id:stock_pending_id,quantity:current_value,pageName:"stock_receipt_form",stock_receipt_product_id:stock_receipt_product_id,formType:formType},
				success: function(resp){
					$('#serial_number_div'+stock_pending_id).html(resp);
				//	$('#stock_serial_list'+net_stock_id).html(resp);
				}
		});
	}
	
	function generateStockReceiptReferenceNo(){
	$.ajax({
			url : "<?php echo base_url();?>inventory/ajaxGenerateStockTransferNo",
			dataType: 'json',
			type: "POST",
			data: {pageName:"stock_receipt_form"},
			success: function(resp){
				var currentYear = (new Date).getFullYear();
				var nextYear = (new Date).getFullYear()+1;
			    //pull the last two digits of the year
                
				var currentYear = ((new Date).getMonth() < '04') ? (new Date).getFullYear() - 1 : (new Date).getFullYear() ;
				var nextYear = currentYear + 1;
				currentYear = currentYear.toString().substr(2,2);
				nextYear=nextYear.toString().substr(2,2);
				
				//console.log(resp);
				stock_number_generate=getUppercase(resp.office_short_code)+'/SR'+'/'+resp.auto_id+'/'+currentYear+'-'+nextYear;
				
				$('#stock_receipt_number').val(stock_number_generate);
				
			}
	});
	}
	
	function makeAutoCompleteAndGetSerialNumber(divNumber,stock_receipt_product_id){
//		alert(divNumber+' and '+stock_receipt_product_id);
		// rangeDivNumber = '0';
		// $.ajax({
				// url : "<?php echo base_url(); ?>inventory/getReceiptSerialNumber",
				// type : "post",
				// data : {stock_receipt_product_id:stock_receipt_product_id,divNumber:divNumber,rangeDivNumber:rangeDivNumber},
				// success : function(res){
					// mydata = JSON.parse(res.trim());
					// $('.add_serial_number_in_div'+divNumber+'-'+rangeDivNumber).removeClass('hide').html(mydata.msg);
					// $('#starting_serial_number'+divNumber+'-'+rangeDivNumber).val(mydata.firstSerialNumber);
					// $('#limit'+divNumber+'-'+rangeDivNumber).val(mydata.lastSerialNumber);
				// }
		// });
		product_id = stock_receipt_product_id;
		$("#starting_serial_number"+divNumber+"-0").autocomplete({
														source:"getSerialNumberAutoCompleteListReceipt/"+product_id,
														autoFocus: true,
														select: function(event,ui){
															 $(this).val(ui.item.label);
														}
		});
		$("#limit"+divNumber+"-0").autocomplete({
														source:"getSerialNumberAutoCompleteListReceipt/"+product_id,
														autoFocus: true,
														select: function(event,ui){
															 $(this).val(ui.item.label);
														}
		});
		
		
	}
	
	function removeAddSrNoReceiptForm(divNumber,rangeDivNumber,number)
	{
		var s = $('#stock_received'+divNumber).val();
		var stockPendingValue = $("#stock_pending"+divNumber).val();
		if(s > 0 ){

			$('.add_serial_number_in_div'+divNumber+'-'+rangeDivNumber+' .my_id-'+number).remove();
			
			s = parseInt(s) - 1 ;
			stockPendingValue = parseInt(stockPendingValue) + 1;
			
			$('#stock_received'+divNumber).val(s);
			$("#stock_pending"+divNumber).val(stockPendingValue);
			getAllProductListData();
			
		}
		else{
			alert("You can't remove many more.");
		}
	}

	function makeSerialNumbersReceiptForm(divNumber,rangeDivNumber,stock_receipt_product_id)
	{
		var firstSerialNumber = $('#starting_serial_number'+divNumber+'-'+rangeDivNumber).val();
		var limit = $('#limit'+divNumber+'-'+rangeDivNumber).val();
		var search_value = $('#stock_transfer_number').val();
		$.ajax({
				url : "<?php echo base_url('inventory/makeSerialNumbersReceiptForm'); ?>",
				type : "POST",
				data : {firstSerialNumber:firstSerialNumber,limit:limit,stock_receipt_product_id:stock_receipt_product_id,divNumber:divNumber,rangeDivNumber:rangeDivNumber},
				success : function(res){ 
					mydata = JSON.parse(res.trim());
					if(mydata.msgType == 'error'){
						alert(mydata.msg);
						getStockReceivedProduct(search_value);
					}
					else if(mydata.msgType == 'success'){
						var pendingValue = $('#stock_pending_old'+divNumber).val();
						$('.add_serial_number_in_div'+divNumber+'-'+rangeDivNumber).removeClass('hide').html(mydata.msg);
						$('.add-new-row').removeClass('hide');
						$('#stock_received'+divNumber).val(mydata.quantity);
						var pendingValue = parseInt(pendingValue) - parseInt(mydata.quantity);
						$('#stock_pending'+divNumber).val(pendingValue);
					}
				}
		});
	}
	
	function updateMakeSerialNumbersReceiptForm(divNumber,rangeDivNumber,stock_receipt_product_id)
	{
		var firstSerialNumber = $('#starting_serial_number'+divNumber+'-'+rangeDivNumber).val();
		var limit = $('#limit'+divNumber+'-'+rangeDivNumber).val();
		var search_value = $('#stock_transfer_number').val();
		$.ajax({
				url : "<?php echo base_url('inventory/updateMakeSerialNumbersReceiptForm'); ?>",
				type : "POST",
				data : {firstSerialNumber:firstSerialNumber,limit:limit,stock_receipt_product_id:stock_receipt_product_id,divNumber:divNumber,rangeDivNumber:rangeDivNumber},
				success : function(res){ 
					mydata = JSON.parse(res.trim());
					if(mydata.msgType == 'error'){
						alert(mydata.msg);
						getStockReceivedProduct(search_value);
					}
					else if(mydata.msgType == 'success'){
						var stockTransferred = $("#stock_transferred"+divNumber).val();
						var total_authorized = $('#total_authorized'+divNumber).val();
						$('.add_serial_number_in_div'+divNumber+'-'+rangeDivNumber).removeClass('hide').html(mydata.msg);
						$('.add-new-row').removeClass('hide');
						$('#stock_received'+divNumber).val(mydata.quantity);
						totalReceived = parseInt(mydata.quantity) + parseInt(total_authorized)
						$('#stock_received_old'+divNumber).val(totalReceived);
						var pendingValue = parseInt(stockTransferred) - parseInt(mydata.quantity) - parseInt(total_authorized);
						$('#stock_pending'+divNumber).val(pendingValue);
						getAllProductListData();
					}
				}
		});
	}
	
	function updateMakeAutoComplete(divNumber,stock_receipt_product_id){
		product_id = stock_receipt_product_id;
		$("#starting_serial_number"+divNumber+"-0").autocomplete({
														source:"getUpdateSerialNumberAutoCompleteListReceipt/"+product_id,
														autoFocus: true,
														select: function(event,ui){
															 $(this).val(ui.item.label);
														}
		});
		$("#limit"+divNumber+"-0").autocomplete({
														source:"getUpdateSerialNumberAutoCompleteListReceipt/"+product_id,
														autoFocus: true,
														select: function(event,ui){
															 $(this).val(ui.item.label);
														}
		});
	}
	
	function removeAddSrNoReceiptFormEdit(divNumber,rangeDivNumber,number)
	{
//		alert(divNumber);
		var s = $('#stock_received'+divNumber).val();
		//alert(s); return false;
		var stockPendingValue = $("#stock_pending"+divNumber).val();
		if(s > 0 ){

			$('.add_serial_number_in_div'+divNumber+'-'+rangeDivNumber+' .my_id-'+number).remove();
			
			s = parseInt(s) - 1 ;
			stockPendingValue = parseInt(stockPendingValue) + 1;
			
			$('#stock_received'+divNumber).val(s);
			$("#stock_pending"+divNumber).val(stockPendingValue);
			getAllProductListData();
		}
		else{
			alert("You can't remove many more.");
		}
	}
	
	function selectAllSerials(firstSerial,lastSerial,divNumber,rangeDivNumber,stock_receipt_product_id)
	{
		$('#starting_serial_number'+divNumber+'-'+rangeDivNumber).val(firstSerial);
		$('#limit'+divNumber+'-'+rangeDivNumber).val(lastSerial);
		updateMakeSerialNumbersReceiptForm(divNumber,rangeDivNumber,stock_receipt_product_id);
	}
	
	function getAllProductListData()
	{
		divCount = $("#stockReceived_div > div").size();
		var totalPendingStock = 0;
		for(i=0;i<divCount;i++){
			totalPendingStock = totalPendingStock + parseInt($('#stock_pending'+i).val());
		}
		// alert(totalPendingStock);
		if(totalPendingStock == '0'){
			$('#stock_transferStatus').val('Yes');
			$('#show_closing').css('visibility','hidden');
			$('.iPhoneCheckHandle').animate({left:'46px'}, 500);
			$('.iPhoneCheckLabelOn').css('width','50px');
			$('.iPhoneCheckLabelOn span').css('margin-left','0px');
			$('.iPhoneCheckLabelOff span').css('margin-right','-46px');
			$('#stock_transferStatus_checked').attr("checked",true);
		}
		else{
			$('#stock_transferStatus').val('no');
			$('#show_closing').css('visibility','visible');
			$('.iPhoneCheckHandle').animate({left:'0px'}, 500);
			$('.iPhoneCheckLabelOn').css('width','4px');
			$('.iPhoneCheckLabelOn span').css('margin-left','46px');
			$('.iPhoneCheckLabelOff span').css('margin-right','0px');
			$('#stock_transferStatus_checked').attr("checked",false);
		}
	}
	function check_received()
	{
		
			
	}
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MMTC - Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php echo base_url();?>files/img/favicon.ico">
<?php
$imgUrl = ''; 
if($invoiceDetails->is_deleted == '1'){ 
$imgUrl = base_url("files/img/deleted.png");
}
else{
	$imgUrl = '';
}
?>
  <style>
.class_table {
    border-collapse: collapse;
    border-style: hidden;
    }

 .class_table th {
    border: 1px solid black;
	border-right:1px solid #ffffff;
	border-left:1px solid #ffffff;
	text-align:left;
	font-size:14px;
}
 .class_table td {
 font-size:14px;
 }
.class_table1 {
	
    border-collapse: collapse;
}

.class_table1, .class_table1 td, .class_table1 th {
    border: 1px solid black;
	border-right:1px solid #ffffff;
	border-left:1px solid #ffffff;
	font-size:14px;
	
}
.class_table1 th {
  
	text-align:left;
	font-size:14px;
}
.class_table2 td
{
border: 1px solid #fffff;
border: none;

}
.bgClass{
	 background: url(<?php echo $imgUrl;?>);
		background-repeat: no-repeat;
		 background-position: center; 
	}
}
</style> 
<style type="text/css" media="print">
	.noprint
        {
		display:none;
	}
	.print_page
	{
		margin-top:270px;
		
	}
	.bgClass{
	 background: url(<?php echo $imgUrl;?>);
		background-repeat: no-repeat;
		 background-position: center; 
	}
}
</style>

</head>

<body>
<div class="bgClass">
<?php /*<tr>
	<td colspan="2" valign="top"> <a class="navbar-brand" > <img alt="MMTC Logo" style="height:70px !important; width:150px !important;" src="<?php echo base_url('files/img/index.png');?>"/></a><center style="float:right;"><h2 >MMTC Limited</h2></center></td>
	
	</tr>
	
	*/
	
	function convert_number_to_words($number) {
   
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
   
    if (!is_numeric($number)) {
        return false;
    }
   
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
   
    $string = $fraction = null;
   
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
   
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
   
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
   
    return $string;
}
	
	function no_to_words($no)
{   
 $words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred &','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
    if($no == 0)
        return ' ';
    else {
	$novalue='';
	$highno=$no;
	$remainno=0;
	$value=100;
	$value1=1000;       
            while($no>=100)    {
                if(($value <= $no) &&($no  < $value1))    {
                $novalue=$words["$value"];
                $highno = (int)($no/$value);
                $remainno = $no % $value;
                break;
                }
                $value= $value1;
                $value1 = $value * 100;
            }       
          if(array_key_exists("$highno",$words))
              return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
          else {
             $unit=$highno%10;
             $ten =(int)($highno/10)*10;            
             return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
           }
    }
}

$customerName = "";
$customerAddress = "";
$customerPhoneNo = "";
$id_Number = ""; 

if($invoiceDetails->customer_pan_number != '' )
{
	$id_Number = $invoiceDetails->customer_pan_number;
}
else if($invoiceDetails->customer_id_proof_number !='')
{
	$id_Number = $invoiceDetails->customer_id_proof_number;
}
else if($customerDetails->modal_customer_pan_number !='')
{
	$id_Number = $customerDetails->modal_customer_pan_number;
}
else{
	$id_Number = $customerDetails->id_proof_number;
}

if($invoiceDetails->customer_name != '' )
{
	$customerName = $invoiceDetails->customer_name;
}
else if($customerDetails->modal_customer_name !='')
{
	$customerName = $customerDetails->modal_customer_name;
}
else{
	$customerName = "N/A";
}

if($invoiceDetails->customer_address != '' )
{
	$customerAddress = $invoiceDetails->customer_address;
}
else if($customerDetails->modal_customer_address !='')
{
	$customerAddress = $customerDetails->modal_customer_address;
}
else{
	$customerAddress = "N/A";
}

if($invoiceDetails->customer_phone_number != '' )
{
	$customerPhoneNo = $invoiceDetails->customer_phone_number;
}
else if($customerDetails->modal_customer_phone_number !='')
{
	$customerPhoneNo = $customerDetails->modal_customer_phone_number;
}
else{
	$customerPhoneNo = "N/A";
}
	?>
   
	<table align="center" width="100%"  class="print_page bgClass"><tr><td>
	<table align="center" cellpadding="2" cellspacing="2" style="width:850px!important;border-collapse:1px;border: 1px solid black;border-right: 1px solid black;">
	
	<tr><td colspan="2" class="noprint">&nbsp;</td></tr>
	<?php if($this->input->get('backdate')==1){ ?>
	<tr><td colspan="4" style="text-align:right" class="noprint">&nbsp;<input type="button" class="noprint" value="Print" onClick="javascript:window.print();">&nbsp;<a type="button" class="noprint btn" href="<?php echo base_url('BackDateInvoice/back_date_sales_invoice_form');?>"><button type="button">Back</button></a>&nbsp;<a type="button" class="noprint btn" href="<?php echo base_url('BackDateInvoice/back_date_sales_invoice_details');?>"><button type="button">Show Invoices Detail</button></a></td></tr>
	<?php } else { ?>
	<tr><td colspan="4" style="text-align:right" class="noprint">&nbsp;<input type="button" class="noprint" value="Print" onClick="javascript:window.print();">&nbsp;<a type="button" class="noprint btn" href="<?php echo base_url('invoice/sales_invoice_form');?>"><button type="button">Back</button></a>&nbsp;<a type="button" class="noprint btn" href="<?php echo base_url('invoice/sales_invoice_details');?>"><button type="button">Show Invoices Detail</button></a></td></tr>
	<?php } ?>
	<tr><td colspan="2"><table width="100%" class="class_table1">
	

	<?php //echo $office_location->office_address; after office name; ?>
	<tr><td width="50%" style="text-align:left;"><strong>मैं / M/s</strong> <?php echo ucwords($office_location->office_name.",<br/>".getCityName($office_location->city_id).", ".getDistrictName($office_location->district_id).", ".getStateName($office_location->state_id)); ?>
	<br /><strong>टिन / Tin Number: </strong><?php echo $office_location->office_tin_number;?></td><td valign="top" width="50%" style="text-align:left;"><strong>बीजक सं / Invoice No.: </strong><span><?php echo ucwords($invoiceDetails->invoice_number); ?></span><br/><?php if($this->input->get('backdate')==1){ echo "<strong>दिनांक / Manual Invoice Date: </strong>";echo ucwords($invoiceDetails->invoice_date); }else{ echo "<strong>दिनांक /Invoice Date: </strong>"; /* $datatime = $invoiceDetails->invoice_date;$datetime = new DateTime($curr_date); $date = $datetime->format('d/m/Y'); echo $date; */ echo date('d/m/Y',strtotime($invoiceDetails->createdOn));} ?> <br></span><span><?php if($this->input->get('backdate')==1){ echo " <strong>दिनांक / Created Invoice Date: </strong>"; /*$curr_date = $invoiceDetails->createdOn; $datetime = new DateTime($curr_date); $date = $datetime->format('d/m/Y');*/ echo date('d/m/Y',strtotime($invoiceDetails->createdOn)); }else{ echo " "; }  ?> </span></td></tr>
	<tr><td><span><strong>सेवा में / To</strong> <?php echo ucwords($customerName.",<br/>".$customerAddress.", ".getCityName($customerDetails->city_id).", ".getDistrictName($customerDetails->district_id).", ".getStateName($customerDetails->state_id)); echo "<br/>Phone No. ".$customerPhoneNo; ?></span></td><td valign="top" style="text-align:left;"><strong>ग्राहक का पैन/आई॰डी॰ सं <br/>Purchaser's PAN/ID No.: </strong><span><?php echo ucwords($id_Number); ?></span></td></tr>

	</table></td></tr>
	
	
	<tr><td colspan="2">
	<table width="100%" cellpadding="2" cellspacing="2" class="class_table">
	
	<tr><th>क्र. <br>S. No.</th>
	<th>बार कोड विवरण <br>Bar Code Description</th>
	<th> मात्रा(सं) <br>Quantity (in Nos.)</th>
	<th>भार(ग्रा)<br>Weight (in Gms)</th>
	<th>दर  <br>Rate (Rs.)</th>
	<th>योग  <br>Amount</th>
	<th>वेट  % <br>VAT%</th>
	<th>छूट  % <br>Discount%</th>
	<th>वेट योग<br> VAT AMT</th>
	<th>कुल योग ( रू )<BR> Total (Rs.)</th>
	</tr>
	
	<?php $i=1; $totalQuantity=0;
								$totalWeight=0;
								$totalAmount = 0;
								$totalVAT = 0;
								$totalnetAmount = 0;
								$totalEntryTax = 0;
								$entryTax = 0;
						foreach($productDetails as $product){
							//echo "<pre>";
							//print_r($product);die;
							$totalQuantity = $totalQuantity + $product->qunatity;
							$totalWeight = $totalWeight + ($product->qunatity * $product->weight);
							$amount = $product->qunatity * $product->rate;
							$vat = $product->tax;
							$entryTax = $product->entry_tax;
							$totalVAT = $totalVAT + ($product->qunatity *(($product->tax * $product->rate)/100));
							$totalEntryTax = $totalEntryTax + ($product->qunatity *(($entryTax * $product->rate)/100));
							$totalAmount = $totalAmount + $amount;
							$netAmount = $product->net_amount;
							$totalnetAmount = $totalnetAmount + $netAmount;
							$office_id = $this->session->userdata('office_id');
							$table_serials='invoice_showroom_product_serial_number_'.$office_id;
							$arr_serials=$this->db->get_where($table_serials,array('invoice_id'=>$invoiceDetails->invoice_id,'invoice_product_id'=>$product->invoice_product_id))->result();
							$exist_serials=array();
							foreach($arr_serials as $serials_disp)
							{
								$exist_serials[]=$serials_disp->serial_number;
							}
							$str_serials='';
							if(count($exist_serials)>0)
							{
								$str_serials=implode(", ",$exist_serials);
							}
							?>
							<tr><td valign="top"><?php echo $i; ?></td>
							<td valign="top"><?php if($str_serials){echo "(".$str_serials.")<br>";} echo  ucwords($product->product_name)."<br>"."(".$product->product_purity." "."Purity)"; ?></td>
							<td valign="top"><?php echo ucwords($product->qunatity); ?></td>
							<td valign="top"><?php echo number_format($product->weight,2,'.',','); ?></td>
							<td valign="top"><?php echo number_format($product->rate,2,'.',','); ?></td>
							<td valign="top"><?php echo number_format($amount,2,'.',','); ?></td>
							<td valign="top"><?php echo number_format($vat,2,'.',','); ?></td>
							<td valign="top"><?php echo number_format($product->discount,2,'.',','); ?></td>
							<td valign="top"><?php echo number_format(($product->qunatity * ($product->tax * $product->rate)/100),2,'.',','); ?></td>
							<td valign="top"><?php echo number_format($netAmount,2,'.',','); ?></td>
							</tr>
							<?php $i++; } ?>
							
							
							<tr><td colspan="10" height="100">&nbsp;</td></tr>
							
							<tr><th colspan="2"><strong> कुल योग / Total</strong></th>
							<th><?php echo $totalQuantity; ?></th>
							<th><?php echo number_format($totalWeight,2,'.',','); ?></th>
							<th>&nbsp;</th>
							<th><?php echo number_format($totalAmount,2,'.',','); ?></th>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<th><?php echo number_format($totalVAT,2,'.',','); ?></th>
							<th><?php echo number_format($totalnetAmount,2,'.',','); ?></th>
							</tr>
							
							<tr><th colspan="10" style="text-align:left;"><?php echo "शब्दों में योग / Amounts in Words :"." ".'Rupees '.ucwords(no_to_words($totalnetAmount)).' Only';?></th></tr>
							
							</table></td></tr>
							
	<tr><td colspan="2"><table width="100%" class="class_table" >
	<tr><th width="23%" style="text-align:left;">भुगतान का प्रकार <br>Payment Type</th>
	<th width="22%" style="text-align:left;"> योग <br>Amount (Rs.)</th>
	<th width="22%" style="text-align:left;">कार्ड धारक नाम <br>Name on Card</th>
	<th width="55%" style="text-align:left;">विवरण <br>Payment Details</th>
	</tr>
	<?php $total_received_till=0;
	foreach($paymenttype_details as $payment_types) 
	{
	 $total_received_till=$total_received_till+$payment_types->payment_amount;?>
	<tr><td><?php echo ucwords($payment_types->payment_type);?></td>
	<td>Rs. <?php echo number_format($payment_types->payment_amount,2,'.',',');?></td>
	<td> <?php echo ucwords($payment_types->bank_name);?></td>
	<td> <?php echo $payment_types->card_cheque_number;?></td>
	</tr>
	<?php 
	}
	?>
	<tr><td colspan="4"><table width="100%" class="class_table1 class_table2" ><tr><td ><strong>भुगतान प्राप्त / Amount Received:</strong> &nbsp;&nbsp;Rs.&nbsp;<?php echo number_format($total_received_till,2,'.',','); ?></td><td></td></tr>
	<?php if($invoiceDetails->invoice_type=='advance' || $invoiceDetails->invoice_type=='backdateadvance') {?>
	<tr><td ><strong>बकाया राशि / Amount Pending:</strong> &nbsp;&nbsp;Rs.&nbsp;<?php $pending=$totalnetAmount+$invoiceDetails->surcharge_on_vat+$invoiceDetails->adjustment-$total_received_till; if($pending>=0) echo number_format($pending,2,'.',','); else{ echo "0.00";} ?></td><td></td></tr>
	<?php } ?>
	<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td style="font-weight:bold;text-align:right;"> प्रविष्टि कर 
प्रतिशत / Entry Tax (%):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<?php echo number_format(($entryTax),2,'.',','); ?></td></tr><tr><td>&nbsp;</td><td style="font-weight:bold;text-align:right;"> प्रविष्टि कर / Entry Tax:&nbsp;&nbsp;&nbsp; Rs.&nbsp;&nbsp;&nbsp;<?php echo number_format(($totalEntryTax),2,'.',','); ?></td></tr><tr><td style="font-weight:bold;text-align:left">Amount Refunded:&nbsp;&nbsp;&nbsp;  Rs.&nbsp;&nbsp;&nbsp;<?php echo number_format(($invoiceDetails->amount_refunded),2,'.',','); ?></td><td style="font-weight:bold;text-align:right">टीसीएस भुगतान / TCS Amount&nbsp;&nbsp;&nbsp;  Rs.&nbsp;&nbsp;&nbsp;<?php echo number_format($invoiceDetails->surcharge_on_vat,2,'.',','); ?></td></tr>
	<tr><td style="font-weight:bold;text-align:left">Adjustment:&nbsp;&nbsp;&nbsp;  Rs.&nbsp;&nbsp;&nbsp;<?php echo number_format(($invoiceDetails->adjustment),2,'.',','); ?></td><td style="font-weight:bold;text-align:right">कुल बिक्री मूल्य वेट के साथ / Total Sales Price with VAT:&nbsp;&nbsp;&nbsp;  Rs.&nbsp;&nbsp;&nbsp;<?php echo number_format(($totalnetAmount + $totalEntryTax+$invoiceDetails->surcharge_on_vat+$invoiceDetails->adjustment),2,'.',','); ?></td></tr></table></td></tr>
	
	</table></td></tr>	
	
	
	<?php if($this->input->get('backdate')==1){ ?>
	<tr><td colspan="4" style="text-align:right" class="noprint">&nbsp;<input type="button" class="noprint" value="Print" onClick="javascript:window.print();">&nbsp;<a type="button" class="noprint btn" href="<?php echo base_url('BackDateInvoice/back_date_sales_invoice_form');?>"><button type="button">Back</button></a>&nbsp;<a type="button" class="noprint btn" href="<?php echo base_url('BackDateInvoice/back_date_sales_invoice_details');?>"><button type="button">Show Invoices Detail</button></a></td></tr>
	<?php } else { ?>
	<tr><td colspan="4" style="text-align:right" class="noprint">&nbsp;<input type="button" class="noprint" value="Print" onClick="javascript:window.print();">&nbsp;<a type="button" class="noprint btn" href="<?php echo base_url('invoice/sales_invoice_form');?>"><button type="button">Back</button></a>&nbsp;<a type="button" class="noprint btn" href="<?php echo base_url('invoice/sales_invoice_details');?>"><button type="button">Show Invoices Detail</button></a></td></tr>
	<?php } ?>
	<tr><td style="text-align:left" >&nbsp;<lable>Printed By :   <?php  $user=$this->db->get_where('users_master',array('user_id'=>$product->creator_id))->row();	echo (ucwords($user->user_name)); ?></lable>&nbsp;&nbsp;, <lable>Date :   <?php echo date('d-m-Y H:i:s',strtotime($product->createdOn)); ?></lable>&nbsp;</td><td style="text-align:right" >&nbsp;<lable><?php if($invoiceDetails->is_deleted == '1'){ echo "Deleted"; } else{ echo ''; } ?></lable>&nbsp;</td></tr>
	</table>
	
	</td></tr>

	</table>
	
	</td></tr></table>
	<!--/.fluid-container-->


<!-- chart libraries start -->
</div>
</body>
</html>

<!DOCTYPE html>
<html>

<head>
	<title>Invoice</title>
	<style type="text/css">
		.ordertable {
			border-collapse: collapse;
			width: 300px;
			text-align: center;
			padding-left: 1%;

		}

		h2 {
			text-align: center;
		}

		.headtable {
			width: 300px;
			padding: 0 0px;

		}

		.ordertable td {
			border-bottom: 1px solid #c3c9c6;
			padding-top: 2px;
			padding-bottom: 8px;
			background-color: #fff;
		}

		p {
			color: #000;
		}

		.row {
			max-width: 300px;
		}

		.div {
			max-width: 150px;
			display: inline;
		}

		.second {
			text-align: right;
			float: right;
			padding-top: 15px;
		}

		#contentss {
			margin-top: -10px;
		}
	</style>


</head>

<body id="contentss">
	<div class="row">
		<div class="div">
			<img src="{{asset('public/logo/avatar.jpg')}}" style="height: 120px;">
		</div>
		<div class="div second">
			<img src="{{asset('public/logo/amrutasqr.png')}}" style="height: 80px;margin-right:10px">
			<p style="font-size:10px;margin-top:-5px;text-align:left">Download the app</p>
		</div>
	</div>
	<p><b> Hi {{$shoporder->custname}},</b></p>
	<p>Thanks for chosing Amruta's Chicken! <br>Looking forward to serving you again. </p>
	<table class="headtable" style="margin-top: 20px;">
		<tr style="width: 300px;">
			<th style="width: 100px;text-align: left;">Order No:</th>
			<td>{{$shoporder->orderno}}</td>
		</tr>
		<tr>
			<th style="width: 100px;text-align: left;">Date:</th>
			<td>{{$shoporder->orderdate}} </td>
		</tr>
		<!-- <tr>
			<th style="width: 100px;text-align: left;">Shop From:</th>
			<td>{{$shoporder->shopname}}</td>
		</tr> -->
	</table>
	<table class="ordertable" style="margin-top: 10px;font-size:15px;">
		<tr style="height: 30px; width:600px;text-align: left;">
			<th style="width:120px;text-align: left; height: 40px;">Item</th>
			<th style="width:60px;text-align: left;height: 40px;">Rate</th>
			<th style="width:60px;text-align: left;height: 40px;">Weight</th>
			<th style="width:60px;text-align: left;height: 40px;">Price</th>
		</tr>
		@php
		$total_amount=0;
		@endphp
		@foreach($itemlist as $i)
		<tr style="height: 40px; border-bottom: 1px solid black;text-align: left;">
			<td style="width:120px;height: 40px;">{{$i->itemname}}</td>
			<td style="width:60px;">{{number_format((float)$i->rate/$i->weight, 0, '.', '')}} </td>
			<td style="width:60px;">{{$i->weight}}</td>
			<td style="width:60px;"> {{$i->rate}}</td>
			@php
			$total_amount=$total_amount+$i->rate;
			@endphp
		</tr>
		@endforeach
	</table>
	<table style="width: 300px;margin-top: 10px;">
	<tr style="border-bottom: 1px solid #cfcbc8;">
			<td style="width:120px;margin-left:-30px;">Delivery Charge: &#8377; {{$shoporder->delivery_charge}} </td>
		</tr>
		@if(isset($credit_used))
		@if ($credit_used->used_credit>0)
			
		
		<tr style="border-bottom: 1px solid #cfcbc8;">
			<td style="width:120px;margin-left:-30px;">Credit Used: &#8377; {{$credit_used->used_credit ?? 0}} </td>
		</tr>
		@endif
		@endif
		<tr style="border-bottom: 1px solid #cfcbc8;">
			<td style="width:120px;margin-left:-30px;line-height:2em"><b>Total Amount: &nbsp;<span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>
					{{$total_amount+$shoporder->delivery_charge-($credit_used->used_credit ?? 0)}}</b></td>
		</tr>
		
	</table>
</body>
<script type="text/javascript" src="{{asset('public/js/plugins/jquery/jquery.min.js')}}"></script>

<script>
	$(document).ready(function() {
		var printContents = document.getElementById('contentss').innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
	});
</script>

</html>
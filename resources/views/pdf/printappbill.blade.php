<!DOCTYPE html>
<html>
<head>
	<title>Delivery Receipt</title>
	<style type="text/css">
		body
		{
			font-size: 12px;
		}
		.ordertable {
			border-collapse: collapse;
			width: 1024px;
			text-align: center;
			background-color: #c3f7d8;
		}
		h2{
			text-align: center;
		}


		.ordertable td
		{
			background-color: #fff;
			border-bottom: 1px solid #c3c9c6;
			padding-top: 2px;
			padding-bottom: 10px;
		}
		p{
			color: #454443;
		}
		.headertable
		{
			border-collapse: collapse;
			width: 1024px;
		}
		.headertable td
		{
			background-color: #fff;
			border: 1px solid #c3c9c6;
			padding-left: 10px;
		}
	</style>


</head>
<body id="contentss">
<h2 ><img src="{{asset('public/logo/avatar.jpg')}}" style="height: 120px;width: 120px;"></h2>
<p>Delivery Receipt : {{date('d-m-Y')}}</p>

<table class="ordertable" style="margin-top: 20px;">
	<tr style="height: 40px;text-align: left">
		<th style="width:50px;text-align: left; padding-left: 10px;height: 40px;">Order NO</th>
		<th style="width:50px;text-align: left;padding-left:10px;height: 40px;">Name</th>
		<th style="width:50px;text-align: left;padding-left:10px;height: 40px;">Item</th>
		<th style="width:40px;text-align: left;padding-left:10px;height: 40px;">Weight</th>
		<th style="width:40px;text-align: left;padding-left:10px;height: 40px;">Rate</th>
		<th style="width:100px;text-align: left;height: 40px;">Address</th>
		<th style="width:20px;text-align: left;height: 40px;">Mob</th>
		<th style="width:20px;text-align: left;height: 40px;">MOP</th>
		<th style="width:10px;text-align: left;height: 40px;">Amount</th>
		<th style="width:20px;text-align: left;height: 40px;">Delivered</th>
	</tr>
	<?php 	
	$i=0;
	
	 ?>
	@foreach($app_order ?? '' as $s)
	<tr style="height: 40px; border-bottom: 1px solid black;text-align: left" >
		<td style="width:50px;padding-left:10px;height: 40px;">{{$s['orderno']}}</td>
		<td style="width:50px;padding-left:10px;">{{$s['custname']}}</td>
		<td style="width:50px;padding-left:10px;">
			@foreach($app_ordelist as $o)

			<?php 
			if($o['orderid']==$s['id'])
			{

				?>
				{{$o['itemname']}}
				<br>
				<?php 
			} ?>
			@endforeach
		</td>
		<td style="width:30px;padding-left:20px;">
			@foreach($app_ordelist as $o)

			<?php 
			if($o['orderid']==$s['id'])
			{

				?>
				
				{{$o['weight']}}
				<br>
				<?php 
			} ?>
			@endforeach
		</td>
		<td style="width:30px;padding-left:10px;">
			@foreach($app_ordelist as $o)

			<?php 
			if($o['orderid']==$s['id'])
			{

				?>
				{{number_format((float)$o['rate'], 2, '.', '')}}
				<br>
				<?php 
			} ?>
			@endforeach
		</td>
		<td style="width:100px;padding-left:1px;"> {{$s['address']}}</td>
		<td style="width:20px;padding-left:1px;"> {{$s['mobile']}}</td>
		<td style="width:20px;padding-left:1px;"> {{$s['mop']}}</td>
		<td style="width:10px;padding-left:10px;"> {{$s['amount']}}</td>
		<td style="width:20px;padding-left:15px;"> <input type="checkbox">
</td>
	</tr>
	<?php 	
	$i++; 
	?>
	@endforeach
	</table>
	<script type="text/javascript" src="{{asset('public/js/plugins/jquery/jquery.min.js')}}"></script>

<script>

		$(document).ready( function () {
			 var printContents = document.getElementById('contentss').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
 });
</script>
</body>
</html>
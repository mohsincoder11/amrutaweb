 @extends('layout')
 @section('content')
     <div class="page-content-wrap">

         <div class="row">
             <div class="col-md-12">
                 <div class="panel panel-default">
                     <div class="panel-body">
                         <div class="form-group">
                             <div class="col-md-12" align="center" style="margin-top:0px;">
                                 <h5 style="color:#000; background-color:#FFCC00; width:20%; min-height:25px; padding-top:5px;"
                                     align="center"><span class="fa fa-rocket"></span> <strong>Fresh Chicken Admin
                                         Webpanel</strong></h5>
                             </div>





                         </div>
                     </div>
                 </div>



             </div>
         </div>










         <div class="row">
             <div class="col-md-12">

                 <!-- START DEFAULT DATATABLE -->
                 <div class="panel panel-default" style="margin-bottom:7px; padding-bottom:7px;">


                     <div class="panel-body" style=" margin-bottom:15px;">

                         <div class="row">

                             <div class="col-md-2 ">
                                 <a class="tile tile-valign hdfc_card homepage_card">
                                     <i class="fa fa-phone dashboard_icon"></i>
                                     <span id="hdfc" class="project_count">{{ $totalteleorder }}</span>
                                     <span class="category_name">Telecaller Order</span>
                                 </a>
                             </div>

                             <div class="col-md-2 ">
                                 <a class="tile tile-valign  app_card homepage_card">
                                     <i class="fa fa-mobile dashboard_icon"></i>
                                     <span id="mobile" class="project_count">{{ $apporder }}</span>
                                     <span class="category_name">App Order</span>
                                 </a>
                             </div>

                             <div class="col-md-2 ">
                                 <a class="tile tile-valign benefitiary_card homepage_card">
                                     <i class="fa fa-shopping-cart dashboard_icon"></i>
                                     <span id="benefitiary" class="project_count">{{ $totalshoporder }}</span>
                                     <span class="category_name">Shop Order</span>
                                 </a>
                             </div>

                             <div class="col-md-2 ">
                                 <a class="tile tile-valign  dairy_card homepage_card">
                                     <i class="fa fa-check-square-o dashboard_icon"></i>
                                     <span id="agri" class="project_count">{{ $totalordercomplete }}</span>
                                     <span class="category_name">Order Completed</span>
                                 </a>
                             </div>

                             <div class="col-md-2 ">
                                 <a class="tile tile-valign  agri_card homepage_card">
                                     <i class="fa fa-remove dashboard_icon"></i>
                                     <span id="marketting" class="project_count">{{ $totalcancelorder }}</span>
                                     <span class="category_name">Canceled Order</span>
                                 </a>
                             </div>

                             <div class="col-md-2 ">
                                 <a class="tile tile-valign  marketting_card homepage_card">
                                     <i class="fa fa-percent dashboard_icon"></i>
                                     <span id="dairy" class="project_count">{{ $discount }}</span>
                                     <span class="category_name">Discount Offered</span>
                                 </a>
                             </div>

                             <div class="col-md-2 ">
                                 <a class="tile tile-valign poultry_card homepage_card">
                                     <i class="fa fa-clock-o dashboard_icon "></i>
                                     <span id="poultry" class="project_count">{{ $totalaveragetime }}</span>
                                     <span class="category_name">Average Delivery Time</span>
                                 </a>
                             </div>

                             <div class="col-md-12">
                                 <div class="col-md-6">


                                     <div class="accordion" id="accordionExample">
                                         <br>
                                         <h3>Last Five Days Shops Sales   </h3>

                                         <div class="card">
                                             <div class="card-header" id="headingOne">
                                                 <h5 class="mb-0">
                                                     <button class="btn btn-block " type="button" data-toggle="collapse"
                                                         data-target="#collapseOne" aria-expanded="true"
                                                         aria-controls="collapseOne">
                                                         <b>{{ date('d-m-Y', strtotime(\Carbon\Carbon::today()->subDays(0))) }} <i class="fa fa-chevron-down dashboard_icon"></i> 
                                                         </b>
                                                     </button>
                                                 </h5>
                                             </div>
                                             <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                                 data-parent="#accordionExample">
                                                 <div class="card-body">
                                                     <table class="table">
                                                         <thead>
                                                             <tr>
                                                                 <th scope="col">Shop Name</th>
                                                                 <th scope="col">Total Weight</th>
                                                                 <th scope="col">Total Amount</th>
                                                             </tr>

                                                         </thead>
                                                         <tbody>
                                                             @php
                                                                 $date = \Carbon\Carbon::today()->subDays(-1);
                                                                 $date2 = \Carbon\Carbon::today()->subDays(0);
                                                                 
                                                                 $firstday = DB::select("select s.masterid,sum(amount) as totalamount,shopname,sum(shoporderlists.weight) as totalweight from shopbookorders as s left join shops on shops.userid=s.masterid left join shoporderlists on shoporderlists.orderid=s.orderid where s.created_at <= '$date' AND s.created_at> '$date2' group by s.masterid");
                                                                 
                                                             @endphp
                                                             @foreach ($firstday as $d)
                                                                 <tr>
                                                                     <th scope="row">{{ $d->shopname }}</th>
                                                                     <td>{{ $d->totalweight }} kg</td>
                                                                     <td>{{ $d->totalamount }} Rs</td>
                                                                 </tr>
                                                             @endforeach

                                                         </tbody>

                                                     </table>
                                                 </div>
                                             </div>
                                         </div>

                                         <div class="card">
                                             <div class="card-header" id="headingTwo">
                                                 <h5 class="mb-0">
                                                     <button class="btn btn-block " type="button" data-toggle="collapse"
                                                         data-target="#collapseTwo" aria-expanded="false"
                                                         aria-controls="collapseTwo">
                                                         <b>{{ date('d-m-Y', strtotime(\Carbon\Carbon::today()->subDays(1))) }}</b>
                                                     </button>
                                                 </h5>
                                             </div>
                                             <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                 data-parent="#accordionExample">
                                                 <div class="card-body">
                                                     <table class="table">
                                                         <thead>
                                                             <tr>
                                                                 <th scope="col">Shop Name</th>
                                                                 <th scope="col">Total Weight</th>
                                                                 <th scope="col">Total Amount</th>
                                                             </tr>
                                                         </thead>
                                                         <tbody>
                                                             @php
                                                                 $date = \Carbon\Carbon::today()->subDays(0);
                                                                 $date2 = \Carbon\Carbon::today()->subDays(1);
                                                                 
                                                                 $firstday = DB::select("select s.masterid,sum(amount) as totalamount,shopname,sum(shoporderlists.weight) as totalweight from shopbookorders as s left join shops on shops.userid=s.masterid left join shoporderlists on shoporderlists.orderid=s.orderid where s.created_at <= '$date' AND s.created_at> '$date2' group by s.masterid");
                                                                 
                                                             @endphp
                                                             @foreach ($firstday as $d)
                                                                 <tr>
                                                                     <th scope="row">{{ $d->shopname }}</th>
                                                                     <td>{{ $d->totalweight }} kg</td>
                                                                     <td>{{ $d->totalamount }} Rs</td>
                                                                 </tr>
                                                             @endforeach

                                                         </tbody>

                                                     </table>
                                                 </div>
                                             </div>
                                         </div>

                                         <div class="card">
                                             <div class="card-header" id="headingThree">
                                                 <h5 class="mb-0">
                                                     <button class="btn btn-block " type="button" data-toggle="collapse"
                                                         data-target="#collapseThree" aria-expanded="false"
                                                         aria-controls="collapseThree">
                                                         <b>{{ date('d-m-Y', strtotime(\Carbon\Carbon::today()->subDays(2))) }}</b>
                                                     </button>
                                                 </h5>
                                             </div>
                                             <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                                 data-parent="#accordionExample">
                                                 <div class="card-body">
                                                     <table class="table">
                                                         <thead>
                                                             <tr>
                                                                 <th scope="col">Shop Name</th>
                                                                 <th scope="col">Total Weight</th>
                                                                 <th scope="col">Total Amount</th>
                                                             </tr>
                                                         </thead>
                                                         <tbody>
                                                             @php
                                                                 $date = \Carbon\Carbon::today()->subDays(1);
                                                                 $date2 = \Carbon\Carbon::today()->subDays(2);
                                                                 
                                                                 $firstday = DB::select("select s.masterid,sum(amount) as totalamount,shopname,sum(shoporderlists.weight) as totalweight from shopbookorders as s left join shops on shops.userid=s.masterid left join shoporderlists on shoporderlists.orderid=s.orderid where s.created_at <= '$date' AND s.created_at> '$date2' group by s.masterid");
                                                                 
                                                             @endphp
                                                             @foreach ($firstday as $d)
                                                                 <tr>
                                                                     <th scope="row">{{ $d->shopname }}</th>
                                                                     <td>{{ $d->totalweight }} kg</td>
                                                                     <td>{{ $d->totalamount }} Rs</td>
                                                                 </tr>
                                                             @endforeach

                                                         </tbody>

                                                     </table>
                                                 </div>
                                             </div>
                                         </div>

                                         <div class="card">
                                             <div class="card-header" id="headingFour">
                                                 <h5 class="mb-0">
                                                     <button class="btn btn-block " type="button" data-toggle="collapse"
                                                         data-target="#collapseFour" aria-expanded="false"
                                                         aria-controls="collapseFour">
                                                         <b>{{ date('d-m-Y', strtotime(\Carbon\Carbon::today()->subDays(3))) }} </b>
                                                     </button>
                                                 </h5>
                                             </div>
                                             <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                                 data-parent="#accordionExample">
                                                 <div class="card-body">
                                                     <table class="table">
                                                         <thead>
                                                             <tr>
                                                                 <th scope="col">Shop Name</th>
                                                                 <th scope="col">Total Weight</th>
                                                                 <th scope="col">Total Amount</th>
                                                             </tr>
                                                         </thead>
                                                         <tbody>
                                                             @php
                                                                 $date = \Carbon\Carbon::today()->subDays(2);
                                                                 $date2 = \Carbon\Carbon::today()->subDays(3);
                                                                 
                                                                 $firstday = DB::select("select s.masterid,sum(amount) as totalamount,shopname,sum(shoporderlists.weight) as totalweight from shopbookorders as s left join shops on shops.userid=s.masterid left join shoporderlists on shoporderlists.orderid=s.orderid where s.created_at <= '$date' AND s.created_at> '$date2' group by s.masterid");
                                                                 
                                                             @endphp
                                                             @foreach ($firstday as $d)
                                                                 <tr>
                                                                     <th scope="row">{{ $d->shopname }}</th>
                                                                     <td>{{ $d->totalweight }} kg</td>
                                                                     <td>{{ $d->totalamount }} Rs</td>
                                                                 </tr>
                                                             @endforeach

                                                         </tbody>

                                                     </table>
                                                 </div>
                                             </div>
                                         </div>

                                         <div class="card">
                                             <div class="card-header" id="headingFive">
                                                 <h5 class="mb-0">
                                                     <button class="btn btn-block " type="button" data-toggle="collapse"
                                                         data-target="#collapseFive" aria-expanded="false"
                                                         aria-controls="collapseFive">
                                                         <b>{{ date('d-m-Y', strtotime(\Carbon\Carbon::today()->subDays(4))) }}</b>
                                                     </button>
                                                 </h5>
                                             </div>
                                             <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                                 data-parent="#accordionExample">
                                                 <div class="card-body">
                                                     <table class="table">
                                                         <thead>
                                                             <tr>
                                                                 <th scope="col">Shop Name</th>
                                                                 <th scope="col">Total Weight</th>
                                                                 <th scope="col">Total Amount</th>
                                                             </tr>
                                                         </thead>
                                                         <tbody>
                                                             @php
                                                                 $date = \Carbon\Carbon::today()->subDays(3);
                                                                 $date2 = \Carbon\Carbon::today()->subDays(4);
                                                                 
                                                                 $firstday = DB::select("select s.masterid,sum(amount) as totalamount,shopname,sum(shoporderlists.weight) as totalweight from shopbookorders as s left join shops on shops.userid=s.masterid left join shoporderlists on shoporderlists.orderid=s.orderid where s.created_at <= '$date' AND s.created_at> '$date2' group by s.masterid");
                                                                 
                                                             @endphp
                                                             @foreach ($firstday as $d)
                                                                 <tr>
                                                                     <th scope="row">{{ $d->shopname }}</th>
                                                                     <td>{{ $d->totalweight }} kg</td>
                                                                     <td>{{ $d->totalamount }} Rs</td>
                                                                 </tr>
                                                             @endforeach

                                                         </tbody>

                                                     </table>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>


                             </div>



                         </div>

                     </div>
                 </div>
                 <div class="panel panel-default" style="margin-bottom:7px; padding-bottom:7px;">


                     <div class="panel-body" style=" margin-bottom:0px;">



                         <div class="row" style="padding-top: 5px;">

                             <div class="col-md-3" style="border-right: 3px solid #555;">
                                 <h2>Total Order</h2>
                                 <div id="totalorderchart">

                                 </div>
                             </div>
                             <div class="col-md-3" style="border-right: 3px solid #555;">
                                 <h2>Items </h2>
                                 <div id="itemchart">

                                 </div>
                             </div>
                             <div class="col-md-3" style="border-right:3px solid #555;">
                                 <h2>Total Collection</h2>
                                 <div id="collectionchart">

                                 </div>
                             </div>
                             <div class="col-md-3">
                                 <h2>Total
                                     Discount</h2>
                                 <div id="discountchart">

                                 </div>
                             </div>

                         </div>




                     </div>
                 </div>
             </div>
             <!-- END DEFAULT DATATABLE -->


         </div>
     </div>
     <div class="loaderpage" id="loader">
         <div class="loader">
             <img src="{{ asset('public/logo/cloader3.gif') }}" alt="">
         </div>
         <p class="loaderp">
             Loading........
         </p>
     </div>

 @stop
 @section('js')

     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

     <script type="text/javascript">
         $(document).ready(function() {
             $('#collapseOne').collapse('show');

             // Load google charts
             google.charts.load('current', {
                 'packages': ['corechart']
             });

             // Draw the chart and set the chart values
             function drawChart1() {
                 var data = google.visualization.arrayToDataTable([
                     ['Type', 'Total'],
                     ['Telecaller', parseInt('{{ $totalteleorder }}')],
                     ['App', parseInt('{{ $apporder }}')],
                     ['Shop', parseInt('{{ $totalshoporder }}')]
                 ]);

                 // Optional; add a title and set the width and height of the chart
                 var options = {
                     'title': 'Total Orders',
                     'width': 400,
                     'height': 350
                 };

                 // Display the chart inside the <div> element with id="piechart"
                 var chart = new google.visualization.PieChart(document.getElementById('totalorderchart'));
                 chart.draw(data, options);
             }
             google.charts.setOnLoadCallback(drawChart1);
             //----------------------------------------------------------------------------
             function drawChart2() {
                 // Define the chart to be drawn.
                 var data = google.visualization.arrayToDataTable([
                     ['Collection', 'Collection'],
                     ['Telecaller', parseInt('{{ $teletotalcollection }}')],
                     ['Shop', parseInt('{{ $shoptotalcollection }}')]
                 ]);

                 var options = {
                     title: 'Collection (in rupees)',
                     'width': 400,
                     'height': 350
                 };

                 // Instantiate and draw the chart.
                 var chart = new google.visualization.BarChart(document.getElementById('collectionchart'));
                 chart.draw(data, options);
             }
             google.charts.setOnLoadCallback(drawChart2);
             //---------------------------------------------------------------------------------

             function drawChart3() {
                 // Define the chart to be drawn.
                 var data = google.visualization.arrayToDataTable([
                     ['Collection', 'Amount'],
                     ['Telecaller', parseInt('{{ $telediscount }}')],
                     ['Shop', parseInt('{{ $shopdiscount }}')]
                 ]);

                 var options = {
                     title: 'Discount (in rupees)',
                     'width': 400,
                     'height': 350,
                     is3D: true
                 };

                 // Instantiate and draw the chart.
                 var chart = new google.visualization.PieChart(document.getElementById('discountchart'));
                 chart.draw(data, options);
             }
             google.charts.setOnLoadCallback(drawChart3);
             //--------------------------------------------------------------------------
             var itemarray = new Array();
             $.ajax({
                 type: "GET",
                 dataType: "json",
                 url: 'getitemarray',
                 success: function(data) {
                     //console.log(data);
                     var arrValues = [
                         ['Item', 'Rate']
                     ]; // DEFINE AN ARRAY.
                     var i = 0;
                     //alert(data.length);
                     for (i = 0; i < data.length; i++) {
                         // POPULATE ARRAY WITH THE EXTRACTED DATA.
                         arrValues.push([data[i].itemname, data[i].weight]);

                     }

                     function drawChart4() {

                         var data = google.visualization.arrayToDataTable(arrValues);

                         // Optional; add a title and set the width and height of the chart
                         var options = {
                             'title': 'Items Sold In Kg',
                             'width': 400,
                             'height': 350
                         };

                         // Display the chart inside the <div> element with id="piechart"
                         var chart = new google.visualization.PieChart(document.getElementById(
                             'itemchart'));
                         chart.draw(data, options);
                     }
                     google.charts.setOnLoadCallback(drawChart4);
                 }
             });

             $("#loader").hide();



         });
     </script>

 @stop

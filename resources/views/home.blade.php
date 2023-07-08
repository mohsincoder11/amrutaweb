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
                                     align="center"><span class="fa fa-rocket"></span> <strong>Amruta's Chicken Admin
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
                                         <h3>Last Five Days Shops Sales </h3>

                                         <div id="five_days_sale"></div>


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

            $("#five_days_sale").append(' <div class="loader2">        <div class="loader-wheel"></div>        <div class="loader-text"></div>      </div>');
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

             $.ajax({
      type: "get",
      data:{
        days:2
      },
      url: "{{url('get_shop_dashboard_data')}}",
      datatype: "application/json",
      success:function(data) {
        $("#five_days_sale").html(data);
        $("#five_days_sale").append(' <div class="loader2">        <div class="loader-wheel"></div>        <div class="loader-text"></div>      </div>');
        get_shop_days3();

      }
    });

function get_shop_days3(){
    $.ajax({
      type: "get",
      data:{
        days:3
      },
      url: "{{url('get_shop_dashboard_data')}}",
      datatype: "application/json",
      success:function(data) {
        $("#five_days_sale").append(data);
        $(".loader2").hide();
      
      }
    });
}



         });
     </script>

 @stop

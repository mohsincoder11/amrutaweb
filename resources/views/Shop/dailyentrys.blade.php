@extends('layout')
@section('content')
<?php $successcode = Session::get('successcode') ?>
<input type="hidden" value="{{$successcode}}" id="successcode">
<div id="snackbarsuccess">
    <div class="row">
        <div class="col-md-12"><label for=""><strong>Success!</strong> Record Created Successfully.</label></div>

    </div>

</div>
<div id="snackbarupdate">
    <div class="row">
        <div class="col-md-12"><label for=""><strong>Success!</strong> Record Updated Successfully.</label></div>

    </div>

</div>
<div class="page-content-wrap">

    @include('Shop/shoplayout')



    <div class="row">
        <div class="col-md-12" style="margin-top:-15px;">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">

                <h5 class="panel-title" style="color:#FFFFFF; background-color:#2fa890; width:100%; font-size:14px;" align="center"><i class="fa fa-home"></i> &nbsp;Daily Entry for Shop</h5>

                <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
                    <div class="form-group">



                        <form role="form" method="post" action="{{url('insertdailyentry')}}">
                            @csrf
                            <input type="hidden" name="inputmode" id="inputmode" value="insert">
                            <input type="hidden" name="updateid" id="updateid">
                            <input type="hidden" name="shop_id" id="shop_id">
                            <input type="hidden" name="user_id" id="user_id">

                            <div class="col-md-12">
                                <div class="form-group" style="margin-top:-10px;">
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Select Shop<font color="#FF0000"></font></label>
                                        <select name="" id="shopmodel_select" class="form-control select">
                                            <option value="">Select shop</option>
                                            @foreach($shops as $g)
                                            <option value="{{$g->id}}" birds_weights="{{$g->birds_weights}}" shop_user_id="{{$g->userid}}" opening_birds="{{$g->opening_birds}}">{{$g->shopname}}
                        
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Date<font color="#FF0000"></font></label>
                                        <input type="date" name="date" id="date" value="{{date('Y-m-d')}}" placeholder="" class="form-control" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Time<font color="#FF0000"></font></label>
                                        <input type="time" name="time" id="time" placeholder="" class="form-control" required />
                                    </div>

                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Opening Amount<font color="#FF0000"></font></label>
                                        <input type="text" name="opening_amount" id="opening_amount" placeholder="Opening Amount" class="form-control closing_amount_cal" readonly="" value="0" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Opening Birds<font color="#FF0000"></font></label>
                                        <input type="text" name="openingbirds" id="openingbirds" placeholder="Opening Birds" class="form-control" readonly="" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Avg Body Wt<font color="#FF0000"></font></label>
                                        <input type="number" name="avg_body_wt" id="avg_body_wt" placeholder="Average Body Weight" class="form-control callculate_closing" readonly="" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Sale Birds<font color="#FF0000"></font></label>
                                        <input type="number" name="salegbird" id="salegbird" placeholder="Sale Birds" class="form-control callculate_closing" required />
                                    </div>

                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Bill Qty. Wt.<font color="#FF0000"></font></label>
                                        <input type="number" value="0" readonly step="0.01" name="billqtywt" id="billqtywt" placeholder="Bill Qty" class="form-control" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Stock Chicken Sale<font color="#FF0000"></font></label>
                                        <input type="number" value="0" step="0.1" name="stock_chick_sale" id="stock_chick_sale" placeholder="Stock Chicken Sale" class="form-control calculate_sale_wt" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Stock Gurda-Kaleji Sale<font color="#FF0000"></font></label>
                                        <input type="number" value="0" step="0.1" name="stock_g_k_sale" id="stock_g_k_sale" placeholder="Stock Gurda-Kaleji Sale" class="form-control calculate_sale_wt" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Sale Wt.(Meat)<font color="#FF0000"></font></label>
                                        <input type="number" readonly="readonly" step="0.01" name="salegwt" id="salegwt" placeholder="Sale Weight" class="form-control" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Today Total Meat<font color="#FF0000"></font></label>
                                        <input type="number" readonly="readonly" step="0.01" name="today_total_meat" id="today_total_meat" placeholder="Today total meat" class="form-control" required />
                                    </div>

                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Mortality<font color="#FF0000"></font></label>
                                        <input type="number" name="mortality" id="mortality" value="0" placeholder="Mortality" class="form-control callculate_closing" required />
                                    </div>


                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Weight<font color="#FF0000"></font></label>
                                        <input type="number" step="0.01" name="wt" id="wt" placeholder="Weight" class="form-control" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Closing Birds<font color="#FF0000"></font></label>
                                        <input type="number" name="closingbird" id="closingbird" placeholder="Closing Birds" class="form-control" readonly="" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Total Sale Amt.<font color="#FF0000"></font></label>
                                        <input type="number" name="tsaleamt" id="tsaleamt" placeholder="Total Sale Amount" class="form-control closing_amount_cal" value="0" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Dis. Amount<font color="#FF0000"></font></label>
                                        <input type="number" name="disamt" id="disamt" value="0" placeholder="Discount Amount" class="form-control" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Deposit Amount Bank<font color="#FF0000"></font></label>
                                        <input type="number" name="deposit_amount_bank" id="deposit_amount_bank" value="0" placeholder="Dscount Amount Bank" class="form-control closing_amount_cal" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Deposit Amount Office<font color="#FF0000"></font></label>
                                        <input type="number" name="deposit_amount_office" id="deposit_amount_office" value="0" placeholder="Dscount Amount Office" class="form-control closing_amount_cal" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Deposit Amount PhonePay<font color="#FF0000"></font></label>
                                        <input type="number" name="deposit_amount_phonepay" id="deposit_amount_phonepay" value="0" placeholder="Dscount Amount phonepay" class="form-control closing_amount_cal" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Expenses<font color="#FF0000"></font></label>
                                        <input type="number" name="expenses" id="expenses" value="0" placeholder="Daily Expense" class="form-control closing_amount_cal" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Closing Amount<font color="#FF0000"></font></label>
                                        <input type="number" name="closing_amount" id="closing_amount" value="0" placeholder="Closing Amount " class="form-control" required />
                                    </div>

                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Meat Percentage<font color="#FF0000"></font></label>
                                        <input type="number" step="0.01" name="meat_percent" id="meat_percent" value="0" placeholder="Meat Percentage" class="form-control" readonly="" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="margin-top:15px;">
                                        <button type="submit" class="btn btn-info "><span class="fa fa-plus"> </span> Add</button>
                                    </div>

                                </div>



                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <div>
            <div>
                <!-- END DEFAULT DATATABLE -->
                <div class="col-md-12">
                    <div class="panel panel-default" style="margin-top:-15px;">



                        <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
                            <table border="0" cellspacing="5" cellpadding="5">
                                <tbody>
                                    <tr>
                                        <td>Start date:</td>
                                        <td><input class="form-control pt-4" type="text"  id="min" name="min"></td>
                                    </tr>
                                    <tr>
                                        <td>End date:</td>
                                        <td><input class="form-control" type="text"  id="max" name="max"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table" id="dailyentrytable">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th width="5%">Date</th>
                                        <th width="7%">Shop Name</th>
                                        <th width="6%">Time</th>
                                        <th width="7%">Opening Birds</th>
                                        <th width="7%">Sale Birds</th>
                                        <th width="7%">Sale Wt.(Meat)</th>
                                        <th width="5%">Bill</th>
                                        <th width="5%">Mortality</th>
                                        <th width="5%">Wt.</th>
                                        <th width="7%">Closing Birds</th>
                                        <th width="7%">Total sale Amt.</th>
                                        <th width="5%">Dis Amount</th>
                                        <th width="5%">Meat Percentage</th>
                                        <th width="5%">Closing Balance</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dailyentryrow">

                                </tbody>
                            </table>

                            <!-- END DEFAULT DATATABLE -->


                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
<!-- END PAGE CONTENT -->
</div>
</div>
<div class="loaderpage" id="loader">
    <div class="loader">
        <img src="{{asset('public/logo/cloader3.gif')}}" alt="">
    </div>
    <p class="loaderp">
        Loading........
    </p>
</div>

@stop
@section('js')
@include('Shop/count_script')
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.js"></script>

<script>
    $(document).ready(function() {
        var dt = new Date();
        var shop_user_id;
        var time = String(dt.getHours()).padStart(2, "0") + ":" + String(dt.getMinutes()).padStart(2, "0");
        $('#time').val(time);
        $('#notification').hide();
        var today_sale_Chicken = 0;
        var today_sale_gurda_kaleji = 0;
        var avg_body_wt_of_meat_bird;

        $("#shopmodel_select").on('change', function() {
            var opening_birds = $("#shopmodel_select option:selected").attr('opening_birds');
            var bird_weights = $("#shopmodel_select option:selected").attr('birds_weights');
            $("#shop_id").val($("#shopmodel_select").val());
            $("#openingbirds").val(opening_birds);
            let avg_wt = bird_weights / opening_birds;
            $("#avg_body_wt").val(parseFloat(avg_wt).toFixed(3));

            shop_user_id = $("#shopmodel_select option:selected").attr('shop_user_id');
            $("#user_id").val(shop_user_id);
            get_total_weight($("#date").val());
        })


        $("#date").on('change', function() {
            get_total_weight($(this).val());
        })

        function get_total_weight(date) {
            $.ajax({
                type: "get",
                url: "{{Route('get_total_weight_shop')}}",
                data: {
                    _token: CSRF_TOKEN,
                    shop_id: shop_user_id,
                    date: date
                },
                dataType: 'json',
                success: function(data) {
                 //   console.log(data);
                 $("#billqtywt").val(data['weight'].toFixed(4));
                 $("#opening_amount").val(data['opening_amount'].toFixed(2));
                    today_sale_Chicken = data['salable_chicken'];
                    today_sale_gurda_kaleji = data['salable_kaleji'];
                    $("#loader").hide();
                }
            });
        }
        
        $.ajax({
            type: "get",
            url: "{{Route('get_shop_opening_birds')}}",
            data: {
                _token: CSRF_TOKEN
            },
            dataType: 'json',
            success: function(data) {

                console.log(data);
                $("#user_id").val(data['user_id']);
                if (data['response'] == 1) {
                    $("#select_shop").show({
                        height: 'toggle'
                    });

                } else {
                    $("#shop_id").val(data['id']);
                    $("#openingbirds").val(data['opening_birds']);
                    let avg_wt = data['birds_weights'] / data['opening_birds'];
                    $("#avg_body_wt").val(parseFloat(avg_wt).toFixed(3));
                    $("#user_id").val(data['userid']);
                    $("#loader").show();

                    shop_user_id = data['userid'];
                    get_total_weight($("#date").val());


                }
            }
        });
        $(".closemodel").click(function() {
            $("#select_shop").hide();
        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        if ($("#successcode").val() == 1) {
            $("#select_shop").hide();

            var x = document.getElementById("snackbarsuccess");
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }
        if ($("#successcode").val() == 2) {
            $("#select_shop").hide();

            var x = document.getElementById("snackbarupdate");
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }
        showdailyentry();

        function showdailyentry() {
            $.ajax({
                type: "get",
                url: "{{Route('getdailyentry')}}",
                dataType: 'json',
                success: function(data) {
                    $('#dailyentrytable').DataTable().clear().destroy();
                    $.each(data, function(a, b) {
                        var shopname;
                        if (b.shopname == null) {
                            shopname = 'Admin'
                        } else {
                            shopname = b.shopname;
                        }
                        let salegwt=parseFloat(b.salegwt).toFixed(3);
                        let wt=parseFloat(b.wt).toFixed(3);
                        $("#dailyentryrow").append(
                            '<tr><td>' + b.id + '</td><td>' + b.date + '</td><td>' + shopname + '</td><td>' + b.time + '</td><td>' + b.openingbirds + '</td><td>' + b.salegbird + '</td><td>' +salegwt + '</td><td>100</td><td>' + b.mortality + '</td><td>' + wt + '</td><td>' + b.closingbird + '</td><td>' + b.tsaleamt + '</td><td>' + b.disamt + '</td><td>' + b.meat_percent + '</td><td>' + b.closing_amount + '</td><td><a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id=' + b.id + ' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a></td></tr>'
                        );
                        //alert(data[j].fullname);
                    });
                    createtable();


                }
            });


        }
        $('#dailyentrytable tbody').on('click', '.delete', function() {
            var id = $(this).attr('id');
            //alert(id);
            $.ajax({
                type: "get",
                url: "{{Route('deletedailyentry')}}",
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    swal("Deleted!", "Your record has been deleted!", "success");
                    setTimeout(function() {
                        location.reload();
                    }, 1800)
                }
            });
        });

        $('#dailyentrytable tbody').on('click', '.editrecord', function() {
            var id = $(this).attr('id');
            //alert(id);
            $.ajax({
                type: "get",
                url: "{{Route('editdailyentry')}}",
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    $("#inputmode").val('update');
                    $("#updateid").val(data.id);
                    $("#date").val(data.date);
                    $("#time").val(data.time);
                    $("#openingbirds").val(data.openingbirds);
                    $("#salegbird").val(data.salegbird);
                    $("#salegwt").val(data.salegwt);
                    $("#billqtywt").val(data.billqtywt);
                    $("#mortality").val(data.mortality);
                    $("#wt").val(data.wt);
                    $("#closingbird").val(data.closingbird);
                    $("#disamt").val(data.disamt);
                    $("#salablechick").val(data.salablechick);
                    $("#gurda_kaleji").val(data.gurda_kaleji);
                    $("#dispose").val(data.dispose);
                    $("#meat_percent").val(data.meat_percent);
                    $("#tsaleamt").val(data.tsaleamt);
                    




                    $("#deposit_amount_phonepay").val(data.deposit_amount_phonepay);
                    $("#deposit_amount_bank").val(data.deposit_amount_bank);
                    $("#deposit_amount_office").val(data.deposit_amount_office);
                    $("#expenses").val(data.expenses);
                    $("#closing_amount").val(data.closing_amount);
                    $("#opening_amount").val(data.opening_amount);


                }
            });
        });

     
 
    // DataTables initialisation
    var table = $('#dailyentrytable').DataTable();
    var minDate, maxDate;

    minDate = new DateTime($('#min'), {
    format: 'YYYY-MM-DD'
});
maxDate = new DateTime($('#max'), {
    format: 'YYYY-MM-DD'
});
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[1]);

        if (
            (min == null && max == null) ||
            (min == null && date <= max) ||
            (min <= date && max == null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    }
);


    // Refilter the table
    $('#min, #max').on('change', function() {
            $("#dailyentrytable").DataTable().draw();
        });


        function createtable() {
            table= $("#dailyentrytable").dataTable({
                dom: 'Bfrtip',

                buttons: {
                buttons: [
                 'excel', 'pdf', 

                ]
            },
                "info": true,
                "autoWidth": false,
                responsive: true,
                "order": [
                    [0, "desc"]
                ],
                "columnDefs": [{
                    "targets": [0],
                    "visible": false,
                }],

            "pageLength": 10,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                }

            });
        }
        $("#loader").hide();



        $(".callculate_closing").on('keyup',function() {
            var openingbirds = $("#openingbirds").val();
            var salegbird = $("#salegbird").val();
            var mortality = $("#mortality").val();
            var closingbird = openingbirds - salegbird - mortality;
            $("#closingbird").val(closingbird);
        });

        $(".closing_amount_cal").on('keyup',function() {
            var closing_amount = (parseFloat($("#opening_amount").val())+parseFloat($("#tsaleamt").val()))-
            (parseFloat($("#deposit_amount_bank").val())+ parseFloat($("#deposit_amount_office").val())+parseFloat($("#expenses").val())+parseFloat($("#deposit_amount_phonepay").val()));    

            $("#closing_amount").val(closing_amount.toFixed(2));
        });

        $(".calculate_sale_wt").on('keyup',function() {
            var billqtywt = $("#billqtywt").val();
            var stock_chick_sale = $("#stock_chick_sale").val();
            var stock_g_k_sale = $("#stock_g_k_sale").val();
            var salegwt = parseFloat(billqtywt) - parseFloat(stock_chick_sale) - parseFloat(stock_g_k_sale);
            $("#salegwt").val(salegwt.toFixed(4));

            let today_total_meat = parseFloat(salegwt) + parseFloat(today_sale_Chicken) + parseFloat(today_sale_gurda_kaleji);
            $("#today_total_meat").val(today_total_meat);
            avg_body_wt_of_meat_bird = parseFloat(today_total_meat) / parseFloat($("#salegbird").val());
            let meat_percent = (avg_body_wt_of_meat_bird * 100) / $("#avg_body_wt").val();
            $("#meat_percent").val(meat_percent.toFixed(2));
        });


    });
</script>
@stop
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

                <h5 class="panel-title" style="color:#FFFFFF; background-color:#4e79f3; width:100%; font-size:14px;" align="center"><i class="fa fa-home"></i> &nbsp;Stock and Dispose Entry</h5>

                <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
                    <div class="form-group">



                        <form role="form" method="post" action="{{url('insert_s_d_entry')}}">
                            @csrf
                            <input type="hidden" id="shop_id" name="shop_id">
                            <div class="col-md-12">
                                <div class="form-group" style="margin-top:-10px;">

                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Date<font color="#FF0000"></font></label>
                                        <input type="date" name="date" id="date" value="{{date('Y-m-d')}}" placeholder="" class="form-control"  required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Time<font color="#FF0000"></font></label>
                                        <input type="time" name="time" id="time" placeholder="" class="form-control" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Salable Chicken<font color="#FF0000"></font></label>
                                        <input type="number" step="0.01" name="salable_chicken" id="salable_chicken" placeholder="Salable Chicken" class="form-control" required />
                                    </div>


                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Salable Gurda, Kaleji<font color="#FF0000"></font></label>
                                        <input type="number" step="0.01" name="salable_g_k" id="salable_g_k" placeholder="Gurda, Kaleji" class="form-control" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Chicken Dispose<font color="#FF0000"></font></label>
                                        <input type="number" step="0.01" name="dispose_chicken" id="dispose_chicken" placeholder="Disposable" class="form-control" required />
                                    </div>
                                    <div class="col-md-2" style="margin-top:15px;">
                                        <label>Gurda Kaleji Dispose<font color="#FF0000"></font></label>
                                        <input type="number" step="0.01" name="dispose_g_k" id="dispose_g_k" placeholder="Disposable" class="form-control" required />
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
                            <table class="table" id="dailyentrytable">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th width="5%">Date</th>
                                        <th width="6%">Time</th>
                                        <th width="7%">Shop Name</th>
                                        <th width="7%">Salable Chicken</th>
                                        <th width="7%">Salable Gurda,Kaleji</th>
                                        <th width="7%">Chicken Dispose</th>
                                        <th width="5%">Gurda,Kaleji Dispose</th>
                                        <th width="5%">Total Salable Chicken</th>
                                        <th width="5%">Total Gurda Kaleji</th>
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
<div class="col-md-12 cancelmodel" id="select_shop">
    <div class="col-md-offset-4 col-md-4 modalbody">

        <div class="modal-content">
            <div class="row">
                <h3 style="color: #000;text-align: center"> Select Shop <span class="close closemodel" style="float: right;color:red">&times;</span></h3>
            </div>
            <div class="form-group">
                <select name="" id="shopmodel_select" class="form-control select">
                    <option value="">Select shop</option>
                    @foreach($shops as $g)
                    <option value="{{$g->id}}">{{$g->shopname}}

                    </option>
                    @endforeach
                </select>
                <button class="btn btn-primary closemodel" style="float: right;margin:0.8vh 0;">Close</button>

            </div>

        </div>

    </div>

</div>

@stop
@section('js')
@include('Shop/count_script')

<script>
    $(document).ready(function() {
        var dt = new Date();
        var time = String(dt.getHours()).padStart(2, "0") + ":" + String(dt.getMinutes()).padStart(2, "0");
        $('#time').val(time);
        $('#notification').hide();
        var role = '{{$role}}';
        if (role == 'admin') {
            $("#select_shop").show({
                height: 'toggle'
            });

        } else {
            $("#shop_id").val('{{$shop_id}}');

        }
        $(".closemodel").click(function() {
            $("#select_shop").hide();
        });
        $("#shopmodel_select").on('change', function() {
            $("#shop_id").val($("#shopmodel_select").val());

        })

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
                url: "{{Route('stock_and_dispose')}}",
                dataType: 'json',
                success: function(data) {

                    $('#dailyentrytable').DataTable().clear().destroy();
                    $.each(data, function(a, b) {
                        $("#dailyentryrow").append(
                            '<tr><td>' + b.id + '</td><td>' + b.date + '</td><td>' + b.time + '</td><td>' + b.shopname + '</td><td>' + b.salable_chicken + '</td><td>' + b.salable_g_k + '</td><td>' + b.dispose_chicken + '</td><td>' + b.dispose_g_k + '</td><td>' + b.total_salable_chicken + '</td><td>' + b.total_salable_g_k + '</td></tr>'
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

                }
            });
        });

        function createtable() {
            $("#dailyentrytable").dataTable({
                "info": true,
                "autoWidth": false,
                "pageLength": 10,

                responsive: true,
                "order": [
                    [0, "desc"]
                ],
                "columnDefs": [{
                    "targets": [0],
                    "visible": false,
                }],
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                }

            });
        }
        $("#loader").hide();

        $("#salegbird").keyup(function() {
            var openingbirds = $("#openingbirds").val();
            var salegbird = $("#salegbird").val();
            var mortality = $("#mortality").val();
            var closingbird = openingbirds - salegbird - mortality;
            $("#closingbird").val(closingbird);
        });

        $("#mortality").keyup(function() {
            var openingbirds = $("#openingbirds").val();
            var salegbird = $("#salegbird").val();
            var mortality = $("#mortality").val();
            var closingbird = openingbirds - salegbird - mortality;
            $("#closingbird").val(closingbird);
        });

    });
</script>
@stop
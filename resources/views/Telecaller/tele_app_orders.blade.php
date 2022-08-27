@extends('layout')
@section('content')

    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-12" align="center" style="margin-top:-12px;">
                                <h5 style="color:#000; background-color:#FFCC00; width:15%; min-height:25px; padding-top:5px;"
                                    align="center"><span class="fa fa-user"></span> <strong>Telecaller Dashboard</strong>
                                </h5>
                            </div>


                            <div class="col-md-12" style="margin-bottom:-5px;" align="center">
                                <a href="{{ route('bookorder') }}"><button type="button" class="btn btn-danger active"><i
                                            class="fa fa-list"></i>Book Orders</button></a> &nbsp;
                                <a href="{{ route('teleorder') }}"> <button type="button" class="btn active"
                                        style="background-color:#006699; color:#FFFFFF"><i
                                            class="fa fa-phone"></i>Telecaller Orders</button></a>
                                &nbsp;
                                <a href="{{ route('tele_app_orders') }}" style="padding-right: 5px"><button type="button"
                                        class="btn active" style="background-color:#521a43; color:#FFFFFF"><i
                                            class="fa fa-mobile" aria-hidden="true"></i>App Orders</button></a>






                            </div>



                        </div>
                    </div>
                </div>



            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-top:-15px;">


                <div class="panel panel-default">


                    <h5 class="panel-title" style="color:#FFFFFF; background-color:#521a43; width:100%; font-size:14px;"
                        align="center"><i class="fa fa-mobile"></i> App Orders


                    </h5>
                    <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
                        <table class="table" id="shopteletable">
                            <thead>

                                <tr width="100%">
                                    <th style="display: none;"></th>

                                    <!--               <th width="4%">#</th>
         -->
                                    <th width="7%">Order No.</th>
                                    <th width="9%">Customer Name</th>
                                    <th width="6%">Mobile</th>
                                    <th width="10%">Address</th>
                                    <th width="13%">Item [ Weight-KG ]</th>
                                    <th width="5%">MOP</th>
                                    <th width="7%">Time Slot</th>
                                    <th width="6%">Total[Credit Used]</th>
                                    <th width="6%">Status</th>
                                    <!--<th width="8%">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apporder as $ap)
                                    <tr>
                                        <td style="display: none"> {{ $ap->id }}</td>
                                        <!-- <td>
                        <input type="checkbox">
                      </td> -->
                                        <td>
                                            {{ $ap->orderno }}
                                        </td>
                                        <td>
                                            {{ $ap->custname }}
                                        </td>
                                        <td>
                                            {{ $ap->mobile }}
                                        </td>
                                        <td>
                                            {{ $ap->address }}
                                            <br>
                                        </td>
                                        <td>

                                            @php
                                                $itemname = App\Teleorderlist::select('id','itemname', 'weight', 'rate')
                                                    ->where('orderid', $ap->id)
                                                    ->where('orderfrom', 'app')
                                                    ->get();
                                                $total_amount = 0;
                                            @endphp
                                            @foreach ($itemname as $i)
                                                {{ $i->itemname }} [{{ $i->weight }}]
                                                @php
                                                    $total_amount = $total_amount + $i->rate;
                                                @endphp

                                                <br>
                                            @endforeach

                                        </td>
                                        <td>
                                            <b>{{ strtoupper($ap['mop']) }}</b>
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-success btn-sm timeslotlable">{{ $ap->time_slot }}</button>
                                        </td>
                                        </td>

                                        <td>
                                            <b> {{ $total_amount + $delivery_charge - ($total_amount + $delivery_charge - $ap->amount) }}
                                                @if ($ap->paidstatus == -1)
                                                    [0]
                                                @else
                                                @php
                                                   $credit_price = App\Wallet::select('used_credit')
                                                    ->where('order_id', $ap->id)
                                                    ->where('user_id', $ap->user_id)
                                                    ->orderby('id','desc')
                                                    ->first();
                                                @endphp
                                                    [{{ $credit_price->used_credit ?? 0 }}]
                                                @endif
                                            </b>
                                        </td>
                                        <td>
                                            <?php
                                            if ($ap->paidstatus == 0 && $ap->status == 0) {
                                                echo '<label style="color:#bec41b">Processing...<label>';
                                            }
                                            if ($ap->paidstatus ==1 && $ap->status==0 && $ap->assignto=='null') {
                    echo '<label style="color:#bec41b">Processing...<label>';
                  }
                                            if ($ap->paidstatus == 0 && $ap->status == 1) {
                                                echo '<label style="color:#4d4acf">Assigned to ' . $ap->assignto . '<label>';
                                            }
                                            if ($ap->paidstatus == 0 && $ap->assignto != 'null' && $ap->assignto != 'null' && $ap->status == 2) {
                                                echo '<label style="color:#4d4acf">Collected by ' . $ap->assignto . '<label>';
                                            }
                                            if ($ap->paidstatus == 1 && $ap->assignto != 'null') {
                                                echo '<label style="color:#229e1b">Delivered by ' . $ap->assignto . '<label>';
                                            }
                                            if ($ap->paidstatus == -1) {
                                                echo '<label style="color:#fc0f0f">Order Cancelled<label>';
                                            }
                                            ?>


                                        </td>
                                        <!--  <td>
                      <button class="btn btn-danger btn-xs"><i class="fa fa-remove"></i>
                      </button>
                      <button class="btn btn-warning btn-xs"><i class="fa fa-print"></i>
                      </button>

                    </td> -->

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
    <!-- PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->
    <div class="col-md-12 cancelmodel" id="cancelmodeldiv">
        <div class="col-md-offset-4 col-md-4 modalbody">

            <div class="modal-content">
                <div class="row">
                    <h3 style="color: #000;text-align: center"> Reason For Cancel Order <span class="close closemodel"
                            style="float: right">&times;</span></h3>


                </div>
                <form action="{{ url('cancelorder') }}" method="post">
                    @csrf
                    <input type="hidden" id="canceltimetaken" name="canceltimetaken">
                    <input type="hidden" id="cancelid" value="" name="cancelid">
                    <div class="row" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="form-group">
                            <input type="text" class="form-control" name="reason" placeholder="Enter Cancel Reason"
                                required autocomplete="off">
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px;">
                        <button type="submit" class="btn btn-danger col-md-12">Cancel Order</button>
                    </div>
                </form>

            </div>

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
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {

            $("#cancelmodeldiv").hide();
            $('#notification').hide();

            setTimeout(function() {
                window.location.reload(1);
            }, 180000);
            var deliverycount = 0;
            $('#assignto').on('change', function() {
                deliverycount = 1;
                $('#assignno').val(deliverycount);

            });
            $('#shopteletable').DataTable({
                "order": [
                    [0, "desc"]
                ],
            "pageLength": 10,

            });
            var j = 0;
            var i = 0;
            var checkboxid = [];
            var k = 0;

            $('#shopteletable tbody').on('click', '.checkbox', function() {
                // Holds the product ID of the clicked element
                var id = $(this).attr('id');
                //alert(id);

                if ($.inArray(id, checkboxid) > -1) {
                    checkboxid = jQuery.grep(checkboxid, function(value) {
                        return value != id;
                    });
                } else {

                    checkboxid[j] = id;
                    //alert(checkboxid);

                }

                j++;
            });
            $.ajax({
                type: "GET",
                dataType: "json",
                url: 'getalldeliveryboy',
                success: function(data) {

                    $.each(data, function(a, b) {
                        //alert(address);                  
                        $("#assignto").append(
                            '<option value="' + b.id + '  "data-subtext="' + b.mobile +
                            '">' + b.name + '</option>'
                        );
                        //alert(data[j].fullname);
                    });
                    $("#assignto").selectpicker("refresh");



                }
            });

            $('#shopteletable tbody').on('click', '.cancelbutton', function() {
                var id = $(this).attr('id');
                var time = $('#time' + id).val();


                $('#canceltimetaken').val(time);
                $('#cancelid').val(id);
                $("#cancelmodeldiv").show({
                    height: 'toggle'
                });
            });
            $(".closemodel").click(function() {
                $("#cancelmodeldiv").hide();
            });
            var modal = document.getElementById("cancelmodeldiv");
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }


            $(".printdel").click(function() {
                if ($('.checkbox').is(":checked")) {

                    for (i = 0; i < checkboxid.length; ++i) {
                        var checkboxread = $("#checkboxids").val();
                        if (checkboxread.length == 0) {
                            $("#checkboxids").val(checkboxid);

                        } else {
                            $("#checkboxids").val(checkboxid);

                        }



                    }
                } else {
                    alert('Select at least 1 Checkbox');
                }
                if (deliverycount == 0) {
                    alert('Select Delivery Boy');

                }
                if (deliverycount == 1) {
                    //alert(deliverycount);
                    window.setTimeout(function() {
                        //        $.ajax({
                        //     type:"GET",
                        //     dataType: "json",
                        //     url: '{{ url('sendmsg') }}',
                        //     success : function(data) {
                        //       location.reload();
                        //   }
                        // });
                        location.reload();
                    }, 2000)


                } else {
                    window.setTimeout(function() {
                        location.reload()
                    }, 1500)
                }
            });
            $("#loader").hide();

        });
    </script>

@stop

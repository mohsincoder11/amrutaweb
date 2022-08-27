@extends('layout')
@section('content')

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-12" align="center" style="margin-top:-12px;">
                            <h5 style="color:#000; background-color:#FFCC00; width:15%; min-height:25px; padding-top:5px;" align="center"><span class="fa fa-user"></span> <strong>Telecaller Dashboard</strong></h5>
                        </div>


                        <div class="col-md-12" style="margin-bottom:-5px;" align="center">
                            <a href="{{route('bookorder')}}"><button type="button" class="btn btn-danger active"><i class="fa fa-list"></i>Book Orders</button></a> &nbsp;
                            <a href="{{route('teleorder')}}"> <button type="button" class="btn active" style="background-color:#006699; color:#FFFFFF"><i class="fa fa-phone"></i>Telecaller Orders</button></a>
                            &nbsp;
                            <a href="{{route('tele_app_orders')}}" style="padding-right: 5px"><button type="button" class="btn active" style="background-color:#521a43; color:#FFFFFF"><i class="fa fa-mobile" aria-hidden="true"></i>App Orders</button></a>



                        </div>



                    </div>
                </div>
            </div>



        </div>
    </div>





    <div class="row">
        <div class="col-md-12" style="margin-top:-15px;">


            <div class="panel panel-default">


                <h5 class="panel-title" style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;" align="center"><i class="fa fa-phone"></i> Telecaller Orders


                </h5>

                <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
                    <table class="table" id="teleordertable">
                        <thead>
                            <tr width="100%">
                                <th style="display: none;"></th>

                                <th width="8%">Order No.</th>
                                <th width="10%">Customer Name</th>
                                <th width="8%">Mobile</th>
                                <th width="12%">Address</th>
                                <th width="13%">Item [ Weight ]</th>
                                <th width="8%">Order Details</th>
                                <th width="8%">Shop</th>
                                <th width="6%">MOP</th>
                                <th width="8%">Timetaken</th>
                                <th width="6%">Total</th>
                                <th width="10%">Order Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($teleorder as $t)
                            <tr>
                                <td style="display: none">{{$t->id}}</td>

                                <td>{{$t->orderno}}</td>
                                <td>{{$t->custname}}</td>
                                <td>{{$t->mobile}}</td>
                                <td>{{$t->address}}</td>
                                <td>
                                    @foreach($teleorderlist as $tl)


                                    @if($t->orderid==$tl->orderid)

                                    {{$tl->itemname}} [<strong>{{$tl->weight}} kg</strong>] <br>


                                    @endif


                                    @endforeach


                                </td>
                                <td><strong>{{$t->details}}</strong></td>
                                <td>{{$t->shopname}}</td>
                                <td>{{$t->mop}}</td>
                                <td>
                                    <?php if ($t->timestatus == 1) {
                                    ?>
                                        <button class="btn btn-success">
                                            {{$t->timetaken}}
                                        </button>
                                    <?php
                                    } else {
                                    ?><button class="btn btn-warning btn-sm">
                                            <span class="count_hr">{{$ordertime_hr[$i] ?? ''}}</span>:<span class="count_min">{{$ordertime_min[$i] ?? ''}}</span>:<span class="count_sec">{{$ordertime_sec[$i] ?? ''}}</span>

                                        </button>
                                    <?php
                                    }
                                    ?>

                                </td>
                                <td><strong>
                                        <label for="" style="color:#FF0000">
                                            <i class="fa fa-inr"></i> {{$t->amount}}</label>
                                        <?php
                                        if ($t->collectedcash > 0) {
                                            echo '<label style="color:#229e1b">/' . $t->collectedcash . '<label>';
                                        }
                                        ?>
                                    </strong></td>
                                <td>
                                    <strong style="color:#FF0000">
                                        <?php
                                        if ($t->assignto == 'null' && $t->paidstatus != -1) {
                                            echo '<label style="color:#bec41b">Processing...<label>';
                                        }
                                        if ($t->paidstatus == 0 && $t->status ==1) {
                                            echo '<label style="color:#4d4acf">Assigned to ' . $t->assignto . '<label>';
                                        }
                                        if ($t->paidstatus == 0 && $t->assignto != 'null' && $t->status == 2) {
                                            echo '<label style="color:#4d4acf">Collected by ' . $t->assignto . '<label>';
                                        }
                                        if ($t->paidstatus == 1) {
                                            echo
                                            '<label style="color:#229e1b">Delivered by ' . $t->assignto . '<label>';
                                        }
                                        if ($t->paidstatus == -1) {
                                            echo
                                            '<label style="color:#fc0f0f">Order Cancelled<label>';
                                        }
                                        ?>
                                        </strong>
                                </td>
                            </tr>
                            <?php $i++; ?>
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

<script>
    $(document).ready(function() {
        // var sec=1;
        // var min=0;
        // setInterval ( function(){
        //     if(sec==59)
        //     {
        //         sec=0;
        //         min++;
        //                         $(".count_min").text(min);

        //     }
        //     $(".count_sec").text(sec);
        //     sec++;

        // }, 1000 );
        setTimeout(function() {
            window.location.reload(1);
        }, 180000);
        $('#teleordertable').DataTable({
            "order": [
                [0, "desc"]
            ],
            "pageLength": 10


        });
        $("#loader").hide();

    });
</script>

@stop
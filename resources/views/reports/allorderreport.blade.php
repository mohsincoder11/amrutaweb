@extends('layout')
@section('content')
    <div class="page-content-wrap">

        @include('reports/reportlayout')

        <div class="row">
            <div class="col-md-12" style="margin-top:-15px;">
                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">

                    <h5 class="panel-title" style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;"
                        align="center"><i class="fa fa-users"></i> &nbsp;All Order Report</h5>
                    <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
                        <div class="form-group">


                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-7">
                                    <form method="post" action="{{ url('allorderreports') }}" class="form-horizontal"
                                        name="form" id="form" enctype="multipart/form-data">
@csrf
                                        <div class="col-md-12">
                                            <div class="form-group" style="margin-top:-10px;">

                                                <div class="col-md-3"></div>
                                                <div class="col-md-3"
                                                    style="margin-top:15px; padding-left:5px; padding-right:2px;">
                                                    <label>Start Date<font color="#FF0000"></font></label>
                                                    <div class="input-group">
                                                        <input type="text" value="{{ $fromdatepage ?? ('' ?? '') }}"
                                                            name="fromdate" id="fromdate"
                                                            class="form-control "data-date-format="dd-mm-yyyy"
                                                            data-date-viewmode="years" />
                                                        <span class="input-group-addon"><span
                                                                class="glyphicon glyphicon-calendar"></span></span>
                                                    </div>

                                                </div>
                                                <div class="col-md-3"
                                                    style="margin-top:15px; padding-left:5px; padding-right:2px;">
                                                    <label>To Date<font color="#FF0000"></font></label>
                                                    <div class="input-group">
                                                        <input type="text" value="{{ $todatepage ?? ('' ?? '') }}"
                                                            name="todate" id="todate"
                                                            class="form-control "data-date-format="dd-mm-yyyy"
                                                            data-date-viewmode="years" />
                                                        <span class="input-group-addon"><span
                                                                class="glyphicon glyphicon-calendar"></span></span>
                                                    </div>

                                                </div>




                                                <div class="col-md-3" style="margin-top:3.2rem;" align="center">

                                                    <div class="input-group col-md-12" style=" margin-bottom:15px;">

                                                        <button type="submit" class="btn btn-primary col-md-12"><span
                                                                class="fa fa-search"></span> Search</button>
                                                    </div>
                                                </div>





                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3">
                                    <form method="Post" action="{{ url('printallorder') }}" class="form-horizontal"
                                        name="printform" id="printform" enctype="multipart/form-data" target="_blank">
                                        @csrf

                                        <div class="input-group col-md-12" style=" margin-bottom:15px;margin-top:2.4rem;">
                                            <input type="hidden" name="printfromdate" id="printfromdate"
                                                value="<?php if ($fromdatepage ?? '' ?? '' ?? ''!=null): ?>
										{{ $fromdatepage ?? ('' ?? ('' ?? '')) }}
										<?php endif ?>">
                                            <input type="hidden" name="printtodate" id="printtodate"
                                                value="<?php if ($todatepage ?? '' ?? ''!=null): ?>
										{{ $todatepage ?? ('' ?? '') }}
										<?php endif ?>">
                                            <input type="hidden" name="allordercount" id="allordercount"
                                                value="{{ $allordercount }}">
                                            <input type="hidden" name="totalweight"
                                                value="{{ number_format((float) $totalweight, 2, '.', '') }}">
                                                <input type="hidden" name="totalAmount"
                                                value="{{ $totalAmount ?? 0 }}">
                                            <button type="submit" class="btn btn-warning col-md-6 printallorder"><span
                                                    class="fa fa-print"></span> Print</button>
                                        </div>

                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>


                </div>

            </div>


        </div>
        <div class="row">
            <div class="col-md-12" style="margin-top:-15px;">


                <div class="panel panel-default">






                    <h5 class="panel-title" style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;"
                        align="center"><i class="fa fa-users"></i> All Orders</h5>
                    <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
                        <div class="row">
                            <h3 style="margin-top: 10px;text-align: center">From :{{ $fromdatepage ?? '' }} &nbsp; To
                                :{{ $todatepage ?? '' }} </h3>
                            <h3 style="margin-top: 10px;text-align: center;color: black;">Total Order :{{ $allordercount }}
                                &nbsp;Total Weight :{{ number_format((float) $totalweight, 2, '.', '') }} KG &nbsp;Total Amount :{{ isset($totalAmount) ? number_format($totalAmount, 2, '.', '') : 0 }} </h3>
                        </div>

                        <table class="table" id="allorder">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Order No</th>

                                    <th>Order Date</th>
                                    <th>Item Name</th>
                                    <th>Weight</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								if($teleorder!=null || $shoporder!=null) 
								{
									?>

                                @foreach ($teleorder as $a)
                                    <tr>
                                        <td>{{ $a->id }}</td>
                                        <td>{{ $a->orderno }}</td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($a->created_at)) }}
                                        </td>

                                        <td>
                                            {{ $a->items }}

                                        </td>
                                        <td>
                                            {{ $a->weights }} KG



                                        </td>
                                        <td>{{ $a->amount }}</td>
                                    </tr>
                                @endforeach
                                @foreach ($apporder as $a)
                                    <tr>
                                        <td>{{ $a->id }}</td>
                                        <td>{{ $a->orderno }}</td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($a->created_at)) }}
                                        </td>

                                        <td>
                                         @if(isset($a->teleorderlists))

                                            @foreach ($a->teleorderlists as $teleorderlist1)
                                            {{ $teleorderlist1->items }}
                                        @endforeach
                                        @endif

                                        </td>
                                        <td>
                                            @if(isset($a->teleorderlists))

                                        @foreach ($a->teleorderlists as $teleorderlist1)
                                        {{ $teleorderlist1->weights }}KG
                                    @endforeach
                                    @endif



                                        </td>
                                        <td>{{ $a->amount }}</td>
                                    </tr>
                                @endforeach
                                @foreach ($shoporder as $a)
                                    <tr>
                                        <td>{{ $a->id }}</td>
                                        <td>{{ $a->orderno }}</td>
                                        <td>{{ date('m-d-Y', strtotime($a->created_at)) }}</td>

                                        <td>
                                            @if(isset($a->shopOrderLists))

                                            @foreach ($a->shopOrderLists as $teleorderlist1)
                                            {{ $teleorderlist1->items }}
                                        @endforeach
                                        @endif

                                        </td>
                                        <td>
                                            @if(isset($a->shopOrderLists))

                                            @foreach ($a->shopOrderLists as $teleorderlist1)
                                            {{ $teleorderlist1->weights }}KG 
                                        @endforeach
                                        @endif


                                        </td>
                                        <td>{{ $a->amount }}</td>
                                    </tr>
                                @endforeach
                                <?php 
								}
								?>


                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- END PAGE CONTAINER -->


@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#allorder').DataTable({
                "order": [
                    [0, "desc"]
                ],
				"pageLength": 10,

                "columnDefs": [{
                    "targets": [0],
                    "visible": false,
                }],

            });

            var allordercount = $('#allordercount').val();
            //alert(allordercount);
            $(".printallorder").click(function() {
                if (allordercount == 0) {
                    alert('0 Record found');
                }
            });



            $("#fromdate").datepicker({
                dateFormat: "dd-mm-yyyy"
            }).datepicker("setDate", new Date());
            $("#todate").datepicker({
                dateFormat: "dd-mm-yyyy"
            }).datepicker("setDate", new Date());

        });
    </script>

@stop

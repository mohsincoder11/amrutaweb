@extends('layout')
@section('content')

    <div class="page-content-wrap">

        @include('reports/reportlayout')


        <div class="row">
            <div class="col-md-12" style="margin-top:-15px;">
                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">

                    <h5 class="panel-title" style="color:#FFFFFF; background-color:#3c734a; width:100%; font-size:14px;"
                        align="center"><i class="fa fa-phone"></i> &nbsp;Telecaller Order Report</h5>
                    <div class="panel-body" style="margin-top:-10px; margin-bottom:-5px;">
                        <div class="form-group">


                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="{{ url('telecallerorderreports') }}"
                                        class="form-horizontal" name="form" id="form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="form-group" style="margin-top:-10px;">

                                                <div class="col-md-2"
                                                    style="margin-top:15px; padding-left:5px; padding-right:2px;">
                                                    <label>Start Date<font color="#FF0000"></font></label>
                                                    <div class="input-group">
                                                        <input type="text" value="{{ $fromdatepage ?? ('' ?? ('' ?? '')) }}"
                                                            name="fromdate" id="fromdate"
                                                            class="form-control "data-date-format="dd-mm-yyyy"
                                                            data-date-viewmode="years" />
                                                        <span class="input-group-addon"><span
                                                                class="glyphicon glyphicon-calendar"></span></span>
                                                    </div>

                                                </div>

                                                <div class="col-md-2"
                                                    style="margin-top:15px; padding-left:5px; padding-right:2px;">
                                                    <label>To Date<font color="#FF0000"></font></label>
                                                    <div class="input-group">
                                                        <input type="text" value="{{ $todatepage ?? ('' ?? ('' ?? '')) }}"
                                                            name="todate" id="todate"
                                                            class="form-control "data-date-format="dd-mm-yyyy"
                                                            data-date-viewmode="years" />
                                                        <span class="input-group-addon"><span
                                                                class="glyphicon glyphicon-calendar"></span></span>
                                                    </div>

                                                </div>

                                                <div class="col-md-2"
                                                    style="margin-top:15px; padding-left:5px; padding-right:2px;">
                                                    <label>Select Telecaller<font color="#FF0000"></font></label>
                                                    <div class="input-group">
                                                        <select name="telecallerid" data-live-search="true" id="assignto"
                                                            class="select">
                                                            <option value="all">All</option>

                                                            @foreach ($telecaller as $d)
                                                                <option  @if(isset($telecallerid) && $telecallerid==$d->id) selected @endif value="{{ $d->id }}">{{ $d->username }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col-md-2"
                                                style="margin-top:15px; padding-left:5px; padding-right:2px;">
                                                <label>Select Shop<font color="#FF0000"></font></label>
                                                <div class="input-group">
                                                    <select name="shopname" data-live-search="true" id="assignto"
                                                        class="select">
                                                        <option value="all">All</option>

                                                        @foreach ($shops as $shop)
                                                            <option @if(isset($shopname) && $shopname==$shop->id) selected @endif value="{{ $shop->id }}">{{ $shop->shopname }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>




                                                <div class="col-md-2" style="margin-top:3.2rem;" align="center">

                                                    <div class="input-group col-md-12" style=" margin-bottom:15px;">

                                                        <button type="submit" class="btn btn-primary col-md-12"><span
                                                                class="fa fa-search"></span> Search</button>
                                                    </div>
                                                </div>





                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-md-2">
                                        <form method="POST" action="{{ url('printtelecallerorder') }}" class="form-horizontal"
                                            name="printform" id="printform" enctype="multipart/form-data" target="_blank">
                                            @csrf
    
                                            <div class="input-group col-md-12" style=" margin-bottom:15px;margin-top:2.4rem;">
                                                <input type="hidden" name="printfromdate" id="printfromdate"
                                                    value="{{ $fromdatepage ?? '' }}">
                                                <input type="hidden" name="teleorderweight" id="teleorderweight"
                                                    value="{{ number_format((float) $teleorderweight, 2, '.', '') ?? '' }}">
                                                <input type="hidden" name="printtodate" id="printtodate"
                                                    value="{{ $todatepage ?? '' }}">
                                                    <input type="hidden" name="telecallerid" id="teleid"
                                                    value="{{ $telecallerid }}"> 
                                                    <input type="hidden" name="shopname" id="teleid"
                                                    value="{{ $shopname }}">
                                                <input type="hidden" name="teleordercount" id="teleordercount"
                                                    value="{{ $teleordercount }}">
                                                    <input name="totalAmount" type="hidden" value="{{$totalAmount ?? 0}}">
    
    
                                                <button type="submit"
                                                    class="btn btn-warning col-md-6 printtelecallerorder"><span
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


        </div>
        <div class="row">
            <div class="col-md-12" style="margin-top:-15px;">


                <div class="panel panel-default">






                    <h5 class="panel-title" style="color:#FFFFFF; background-color:#3c734a; width:100%; font-size:14px;"
                        align="center"><i class="fa fa-phone"></i> Telecaller Orders</h5>
                    <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
                        <div class="row">
                            <h3 style="margin-top: 10px;text-align: center">From :{{ $fromdatepage ?? ('' ?? '') }} &nbsp;
                                To :{{ $todatepage ?? ('' ?? '') }} </h3>
                            <h3 style="margin-top: 10px;text-align: center;color: black;">Telecaller
                                :{{ ucfirst($telecallername) ?? '' }} &nbsp;Shop
                                :{{ ucfirst($shopnametitle) ?? '' }} &nbsp; Total Order :{{ $teleordercount }} &nbsp;
                                Total Weight :{{ number_format((float) $teleorderweight, 2, '.', '') }} KG &nbsp;Total Amount :{{isset($totalAmount) ? number_format(round($totalAmount)) : 0}} </h3>
                        </div>

                        <table class="table" id="telecallerorder">
                            <thead>
                                <tr>

                                    <th width="10%">id</th>
                                    <th width="10%">Order No</th>
                                    <th width="10%">Order Date</th>
                                    <th width="10%">Shop Name</th>
                                    <th width="10%">Customer Name</th>
                                    <th width="30%">Item Name</th>
                                    <th width="10%">Weight </th>
                                    <th width="10%">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
								@if($teleorder!=null) 
								

                                @foreach ($teleorder as $a)
                                    <tr>
                                        <td>{{ $a->id }}</td>
                                        <td>{{ $a->orderno }}</td>
                                        <td> {{ date('m-d-Y', strtotime($a->created_at)) }}
                                        </td>
                                        <td>{{$a->shopname}}</td>

                                        <td>
                                            {{ $a->custname }}


                                        </td>
                                        <td>
                                            {{ $a->items }}


                                        </td>
                                        <td>
                                            {{ $a->weights }} Kg

                                        </td>
                                        <td>{{ $a->amount }}</td>
                                    </tr>
                                @endforeach

                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- END PAGE CONTAINER -->
    <div id="contentss">

    </div>

@stop

@section('js')
    <script>
        $(document).ready(function() {

            $('#telecallerorder').DataTable({
                "order": [
                    [0, "desc"]
                ],
                "columnDefs": [{
                    "targets": [0],
                    "visible": false,
                }],
                "pageLength": 10,


            });
            var teleordercount = $('#teleordercount').val();
            $(".printtelecallerorder").click(function() {


                if (teleordercount == 0) {
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

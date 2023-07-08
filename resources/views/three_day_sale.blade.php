<div class="card">
    <div class="card-header" id="headingThree">
        <h5 class="mb-0">
            <button class="btn btn-block " type="button" data-toggle="collapse"
                data-target="#collapseThree" aria-expanded="false"
                aria-controls="collapseThree">
                <b>{{ date('d-m-Y', strtotime(\Carbon\Carbon::today()->subDays(2))) }}
                    <i class="fa fa-chevron-down dashboard_icon"></i>
                </b>
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
                        $firstday = get_five_days_record(-2,-1);
                        
                    @endphp
                     @foreach ($firstday as $d)
                     <tr>
                         <th scope="row">{{ $d->shop_name_only }}</th>
                         <td>{{ $d->shop_third_weight }} kg</td>
                         <td>{{ $d->shop_third_amount }} Rs</td>
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
                <b>{{ date('d-m-Y', strtotime(\Carbon\Carbon::today()->subDays(3))) }}
                    <i class="fa fa-chevron-down dashboard_icon"></i>

                </b>
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
                        $firstday = get_five_days_record(-3,-2);
                        
                    @endphp
                     @foreach ($firstday as $d)
                     <tr>
                         <th scope="row">{{ $d->shop_name_only }}</th>
                         <td>{{ $d->shop_forth_weight }} kg</td>
                         <td>{{ $d->shop_forth_amount }} Rs</td>
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
                <b>{{ date('d-m-Y', strtotime(\Carbon\Carbon::today()->subDays(4))) }}
                    <i class="fa fa-chevron-down dashboard_icon"></i>
                </b>
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
                        $firstday = get_five_days_record(-4,-3);
                        
                    @endphp
                     @foreach ($firstday as $d)
                     <tr>
                         <th scope="row">{{ $d->shop_name_only }}</th>
                         <td>{{ $d->shop_fifth_weight }} kg</td>
                         <td>{{ $d->shop_fifth_amount }} Rs</td>
                     </tr>
                 @endforeach

                </tbody>

            </table>
        </div>
    </div>
</div>  
<div class="card">
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button class="btn btn-block " type="button" data-toggle="collapse"
                data-target="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne">
                <b>{{ date('d-m-Y', strtotime(\Carbon\Carbon::today()->subDays(0))) }}
                    <i class="fa fa-chevron-down dashboard_icon"></i>
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
                        
                        $firstday = get_five_days_record(0,1);
                        
                    @endphp
                    @foreach ($firstday as $d)
                        <tr>
                            <th scope="row">{{ $d->shop_name_only }}</th>
                            <td>{{ $d->shop_first_weight }} kg</td>
                            <td>{{ $d->shop_first_amount }} Rs</td>
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
                <b>{{ date('d-m-Y', strtotime(\Carbon\Carbon::today()->subDays(1))) }}
                    <i class="fa fa-chevron-down dashboard_icon"></i>
                </b>
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
                           
                           $second = get_five_days_record(-1,0);
                           
                       @endphp
                        @foreach ($second as $d)
                        <tr>
                            <th scope="row">{{ $d->shop_name_only }}</th>
                            <td>{{ $d->shop_second_weight }} kg</td>
                            <td>{{ $d->shop_second_amount }} Rs</td>
                        </tr>
                    @endforeach

                   </tbody>
            </table>
        </div>
    </div>
</div>


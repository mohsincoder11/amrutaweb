<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="form-group">
          <div class="col-md-12" align="center" style="margin-top:-12px;">
            <h5 style="color:#000; background-color:#FFCC00; width:15%; min-height:25px; padding-top:5px;" align="center"><span class="fa fa-user"></span> <strong>Shop Dashboard</strong></h5>
          </div>


          <div class="col-md-12" style="margin-bottom:-5px;padding-top: 5px" align="center">
            <a href="{{route('shopteleorder')}}" style="padding-right: 5px"> <button type="button" class="btn active" style="background-color:#006699;text-align: left; color:#FFFFFF"><i class="fa fa-phone"></i>Telecaller Orders<span style="margin-top: -20px;margin-left: 110px;" id="notification_shop" class="notification"></span>
              </button></a>
            <a href="{{route('apporders')}}" style="padding-right: 5px"><button type="button" class="btn active" style="background-color:#521a43; color:#FFFFFF"><i class="fa fa-mobile" aria-hidden="true"></i>App Orders<span style="margin-top: -20px;margin-left: 110px;" id="notification_apporder" class="notification"></span></button></a>
            <a href="{{route('shoporder')}}" style="padding-right: 5px"><button type="button" class="btn active" style="background-color:#ff0066; color:#FFFFFF"><i class="fa fa-bank"></i>Shop Orders</button></a>
            @if(Session::get('userdata')->role==1 || Session::get('userdata')->role==2)

            <a href="{{route('generateorder')}}" style="padding-right: 5px"><button type="button" class="btn btn-danger active"><i class="fa fa-list"></i>Generate Orders</button></a>
            <a href="{{route('printreceipt')}}" style="padding-right: 5px"><button type="button" class="btn btn-primary active"><i class="fa fa-print"></i>Print Receipt</button></a>



            <a href="{{route('dailyentrys')}}" style="padding-right: 5px"> <button type="button" class="btn active" style="background-color:#35826b; color:#FFFFFF"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                Daily Entry for Shop</button></a>
            <a href="{{route('stock_and_dispose')}}" style="padding-right: 5px"> <button type="button" class="btn active" style="background-color:#4e79f3; color:#FFFFFF"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                Stock and Dispose</button></a>
            <a href="{{route('stoss')}}" style="padding-right: 5px"> <button type="button" class="btn active" style="background-color:#996633; color:#FFFFFF"><i class="fa fa-truck" aria-hidden="true"></i>
                Shop to Shop transfer</button></a>
            <a href="{{route('shoptogodown')}}"><button type="button" class="btn " style="background-color: #1b611f;color: #fff"><i class="fa fa-truck" aria-hidden="true"></i>
                Shop to Godawn Transfer</button></a>
@endif

          </div>



        </div>
      </div>
    </div>



  </div>
</div>
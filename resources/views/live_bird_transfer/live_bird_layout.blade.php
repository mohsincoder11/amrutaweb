<div class="col-md-12" style="margin-bottom:-5px;" align="center">  
@php  $userdata2=Session::get('userdata');
@endphp

@if($userdata2['role']==5)
@php $get=App\Godawn_user::where('user_id',$userdata2->id)->first();
@endphp
    @if($get['gtog']==1)
                    <a href="{{route('gtognew')}}"><button type="button" class="btn active" style="background-color:#ff0066; color:#FFFFFF"><i class="fa fa-building-o" aria-hidden="true"></i>
                  Godawn to Godawn Transfer</button></a>

    @endif
    @if($get['stos']==1)
                  <a href="{{route('stosnew')}}"><button type="button" class="btn btn-danger active"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                  Shop to Shop Transfer</button></a>
                 @endif


                 
    @if($get['stog']==1)

                  <a href="{{route('stognew')}}"><button type="button" class="btn btn-primary active"><i class="fa fa-truck" aria-hidden="true"></i>
                  Shop to Godawn Transfer</button></a>
                  
                 @endif 
             @elseif($userdata2['role']==1)

              <a href="{{route('gtognew')}}"><button type="button" class="btn active" style="background-color:#ff0066; color:#FFFFFF"><i class="fa fa-building-o" aria-hidden="true"></i>
                  Godawn to Godawn Transfer</button></a>
<a href="{{route('stosnew')}}"><button type="button" class="btn btn-danger active"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                  Shop to Shop Transfer</button></a>
<a href="{{route('stognew')}}"><button type="button" class="btn btn-primary active"><i class="fa fa-truck" aria-hidden="true"></i>
                  Shop to Godawn Transfer</button></a>
                  @endif


            
              
             

                                             
            </div>
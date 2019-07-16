@extends('layout.navbar')
    @section('content')
    	<div class="page-titles-img title-space-lg parallax-overlay bg-parallax" data-jarallax='{"speed": 0.4}' style='background-image: url("/images/bg13.jpg");background-position:top center;'>
            <div class="container">
                <div class="row">
                    <div class=" col-md-12">
                        <h1 class="text-uppercase">Transaction History</h1>

                    </div>
                </div>
            </div>
        </div><!--page title end-->

        <div class="container pt90 pb50">
            @if($trans->count() == 0)
                <h2>No Transaction made yet</h2> 
            @else 
                <h2>{{$trans->total()}} Transaction(s)</h2>  
            @endif 
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Type</th>
                    <th>Amount(btc)</th>
                    <th>Transaction Hash</th>
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1
                    ?>
                    @foreach($trans as $tran)
                        <?php
                          if($tran->status == true) {
                            $status = 'confirmed';
                          }
                          else {
                            $status = 'unconfirmed';
                          }
                        ?>
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$tran->type}}</td>
                        <td>{{$tran->amount}}</td>
                        <td>{{$tran->transaction_hash}}</td>
                        <td>{{$status}}</td>
                        <td>{{$tran->created_at->diffForHumans()}}</}}</td>
                      </tr>
                    @endforeach

                </tbody>
              </table>
              {{$trans->links()}}
        </div>    	
    @endsection
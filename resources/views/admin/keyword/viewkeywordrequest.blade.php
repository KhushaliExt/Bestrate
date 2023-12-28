@extends('layouts.adminheader')

@section('content')

   <div class="container-xxl"> 
        <div class="row">
            <div class="col-sm-12">
                @include('layouts.msg')
            </div>
        </div>  

        <div class="row align-items-center"> 

                        <div class="border-0 mb-4"> 

                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">View Request Received</h3>
                            </div>

                        </div>

                    </div> <!-- Row end  -->





                    <div class="row g-3 mb-3"> 

                        <div class="col-md-12">

                            <div class="card"> 

                                <div class="card-body"> 

                                    <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">  

                                        <thead>

                                            <tr>

                                                <th>Sr No.</th>

                                                <th>Product Request</th>

                                                <th>Request by</th>

                                                <th>Creation Date</th>

                                                <th>Status</th>

                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                             <?php

                                                $i=1;

                                            ?>

                                            @foreach($keyword as $keywords)

                                            <tr>

                                            	<td>{{$i}}</td>

                                            	<td>{{$keywords->name}}</td>



                                                @if($keywords->type == "seller")

                                            	<td>

                                                    @if($keywords->seller !== null)

                                                    {{$keywords->seller->first_name}} {{$keywords->seller->last_name}}

                                                    @else

                                                    NA

                                                    @endif

                                                </td>

                                                @else

                                                <td>{{$keywords->created_by}}</td>

                                                @endif

                                                <td>{{$keywords->created_at->format('d/m/Y')}}</td>

                                            	<td>

                                                    @if($keywords->status == 0)

                                                    <span class="badge bg-warning">Pending</span>@else<span>NA</span>

                                                    @endif

                                                </td>

                                            	<td> 

                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">

                                                        <a href="{{ route('requestkeywordstatus', ['id' => $keywords->id, 'status' => '1']) }}" class="btn btn-outline-secondary" title="Accepted"><i class="icofont-ui-check text-success" ></i></a>

                                                        <a href="{{ route('requestkeywordstatus', ['id' => $keywords->id, 'status' => '2']) }}" class="btn btn-outline-secondary"  title="Rejected"><i class="icofont-ui-close text-danger"></i></a>

                                                    </div> 

                                                </td>

                                            </tr>

                                            <?php 

                                                $i++;

                                            ?>

                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div> <!-- Row end  -->

                </div>

@endsection
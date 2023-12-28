@extends('layouts.adminheader')

@section('content')

      <div class="body d-flex py-3"> 

       <div class="row">

                <div class="col-sm-12">

                    @if (session('successmsg'))

                        <div class="toast d-flex align-items-center text-white bg-success border-0" role="alert" style="float:right;" id="myToast">

                            <div class="toast-body">

                                {{ session('successmsg') }}

                            </div>

                            <button type="button" class="btn-close btn-close-white ms-auto me-2" data-bs-dismiss="toast" aria-label="Close"></button>

                        </div>



                        @section('javascript')

                        <script>

                            $(document).ready(function () {

                                $("#myToast").fadeOut(5000).attr('style','display: none !important');

                            });

                        </script>

                        @endsection

                    @endif



                    @if (session('warningsmsg'))

                        <div class="toast d-flex align-items-center text-white bg-danger border-0" role="alert" style="float:right;" id="myToastwarning">

                            <div class="toast-body">

                                {{ session('warningsmsg') }}

                            </div>

                            <button type="button" class="btn-close btn-close-white ms-auto me-2" data-bs-dismiss="toast" aria-label="Close"></button>

                        </div>



                        @section('javascript')

                        <script>

                            $(document).ready(function () {

                                $("#myToastwarning").fadeOut(5000).attr('style','display: none !important');

                            });

                        </script>

                        @endsection

                    @endif



                </div>

                </div>   

                <div class="container-xxl"> 

                    <div class="row align-items-center"> 

                        <div class="border-0 mb-4"> 

                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">

                                <h3 class="fw-bold mb-0">Inquiries</h3>

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

                                                <th>Seller Name</th>

                                                <th>Keywords</th>

                                                <th>Quantity</th>

                                                <th>Budget</th>

                                                <th>Description</th>

                                                <th>Inquiry Status</th>

                                            </tr>

                                        </thead>

                                        <tbody>
                                             <?php
                                                $i=1;
                                            ?>
                                            @foreach($sellerquery as $inquery)
                                            <tr>
                                              <td>{{$i}}</td>
                                              <?php $i++;?>
                                              <td>
                                                @if($inquery->seller != null)
                                                {{$inquery->seller->first_name}}  {{$inquery->seller->last_name}}
                                                @endif
                                              </td>
                                              <td>
                                                @if($inquery->keyword != null)
                                                {{$inquery->keyword->name}}
                                                @endif
                                              </td>

                                              <td>
                                                @if($inquery->inquery != null)
                                                {{$inquery->inquery->quantity}}
                                                @endif
                                              </td>
                                              <td>{{$inquery->amount}}</td>
                                              <td>{{$inquery->details}}</td>

                                                <td>
                                                @if($inquery->inquirystatus != null)
                                                {{$inquery->inquirystatus->name}}
                                                @endif
                                              </td>

                                            </tr>

                                            
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div> <!-- Row end  -->

                </div>

            </div>



@endsection
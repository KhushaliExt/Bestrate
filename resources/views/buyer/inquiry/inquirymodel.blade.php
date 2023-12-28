   <div class="row g-3 mb-3">

                        <div class="col-md-6">

                            <div class="card">

                                <div class="card-body">

                                    <div class="col-sm-6 g-3 mb-3">

                                        <label><b>Product:</b> {{$inquery->keyword->name}}</label>

                                    </div>

                                    <div class="col-sm-6 g-3 mb-3">

                                        <label><b>Qty:</b> {{$inquery->quantity}}</label>

                                    </div>

                                    <div class="col-sm-6 g-3 mb-3">

                                        <label><b>Budget:</b> {{$inquery->budget_start}} - {{$inquery->budget_end}}</label>

                                    </div>

                                    <div class="col-sm-6 g-3 mb-3">

                                        <label><b>Description:</b> {{$inquery->description}}</label>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class="col-md-6">

                            @if(count($inquiryfile)>0)
                            <div class="card">

                                <div class="card-body">

                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

                                      <div class="carousel-inner">

                                        @if(count($inquiryfile)>0)
                                        @foreach($inquiryfile as $key => $file)

                                            <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">

                                                <img src="{{ asset('uploads/' . $file->file) }}" class="d-block w-100" alt="...">

                                            </div>
                                        @endforeach
                                        @endif



                                      </div>

                                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">

                                        <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color:black;"></span>

                                        <span class="visually-hidden">Previous</span>

                                      </button>

                                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">

                                        <span class="carousel-control-next-icon" aria-hidden="true" style="background-color:black;"></span>

                                        <span class="visually-hidden">Next</span>

                                      </button>

                                    </div>

                                </div>

                            </div>
                            @endif

                        </div>

                    </div>



                    <div class="row g-3 mb-3">

                        <div class="col-md-12">

                            <div class="card">

                                <div class="card-body">

                                    <ul class="nav nav-tabs tab-body-header rounded  d-inline-flex" role="tablist">

                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#review" role="tab">All</a></li>

                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#descriptions" role="tab">Accepted</a></li>

                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#about" role="tab">Rejected</a></li>

                                    </ul>

                                </div>

                                <div class="tab-content">

                                    <div class="tab-pane fade show active" id="review">

                                        <div class="card-body">

                                            <div class="row clearfix g-3">

                                            

                                                @foreach($sellerquery as $query)

                                                   <div class="card">

                                                    <div class="card-body">

                                                        <div class="row">

                                                        <div class="col-md-6">

                                                           <div>

                                                                <h6><b>Quoted Price:</b>{{$query->amount}}</h6>

                                                            </div>



                                                            <div>

                                                                <h5>Seller Details</h5>

                                                            </div>



                                                            <div>

                                                                <p><b>Seller Name :</b>{{$query->seller->first_name}} {{$query->seller->last_name}}</p>

                                                                <p><b>Business Name : </b>{{$query->seller->business_name}}</p>

                                                                <p id="sellermobile"><b>Mobile Number :</b>{{$query->seller->mobile}}</p>

                                                                <p id="seller"><b>Email:</b>{{$query->seller->email}}</p>

                                                            </div>

                                                            <div>

                                                                <button type="button" class="btn btn-light contactdetails">Contact Details</button>

                                                            </div>

                                                        </div>



                                                          <div class="col-md-6">

                                                           <h6><b>Details</b></h6>

                                                            <p>{{$query->details}}</p>



                                                            <table class="table table-bordered">

                                                              <thead>

                                                                <tr>

                                                                  <th scope="col">#</th>

                                                                  <th scope="col">Date</th>

                                                                  <th scope="col">Download</th>

                                                                </tr>

                                                              </thead>

                                                              <tbody>

                                                                <?php

                                                                $i=1;

                                                                ?>

                                                                @foreach($sellerinquiryfile as $file)

                                                                @if($file->sellerquerys_id == $query->id)

                                                                <tr>

                                                                  <th scope="row">{{$i}}</th>

                                                                   <?php $i++; ?>

                                                                  <td>{{$file->created_at->format('d-

                                                                  m-Y')}}</td>

                                                                  <td><a href="{{asset('public/uploads/'.$file->file)}}" download>Download</a></td>

                                                                </tr>

                                                                @endif
                                                                @endforeach

                                                               

                                                              </tbody>

                                                            </table>

                                                            

                                                            <div>

                                                                <a href="{{route('sellerquotationaccept',$query->id)}}" class="btn btn-success text-white">Accept</a>

                                                                <a href="{{route('sellerquotationreject',$query->id)}}" class="btn btn-danger text-white ">Reject</a>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    </div>

                                                   </div>

                                               @endforeach

                                            </div><!-- Row End -->

                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="descriptions">

                                        <div class="card-body">

                                           <div class="row clearfix g-3">

                                             

                                             @foreach($sellerqueryaccepted as $queryaccepted)

                                                   <div class="card">

                                                    <div class="card-body">

                                                        <div class="row">

                                                        <div class="col-md-6">

                                                           <div>

                                                                <h6><b>Quoted Price:</b>{{$queryaccepted->amount}}</h6>

                                                            </div>



                                                            <div>

                                                                <h5>Seller Details</h5>

                                                            </div>



                                                            <div>

                                                                <p><b>Seller Name :</b>{{$queryaccepted->seller->first_name}} {{$queryaccepted->seller->last_name}}</p>

                                                                <p><b>Business Name : </b>{{$queryaccepted->seller->business_name}}</p>

                                                                <p id="sellermobile"><b>Mobile Number :</b>{{$queryaccepted->seller->mobile}}</p>

                                                                <p id="seller"><b>Email:</b>{{$queryaccepted->seller->email}}</p>

                                                            </div>

                                                            <!-- <div>

                                                                <button type="button" class="btn btn-light contactdetails">Contact Details</button>

                                                            </div> -->

                                                        </div>



                                                          <div class="col-md-6">

                                                           <h6><b>Details</b></h6>

                                                            <p>{{$queryaccepted->details}}</p>



                                                        <table class="table table-bordered">

                                                              <thead>

                                                                <tr>

                                                                  <th scope="col">#</th>

                                                                  <th scope="col">Date</th>

                                                                  <th scope="col">Download</th>

                                                                </tr>

                                                              </thead>

                                                              <tbody>

                                                                <?php

                                                                $i=1;

                                                                ?>

                                                                @foreach($sellerinquiryfile as $file)

                                                                @if($file->sellerquerys_id == $queryaccepted->id)

                                                                <tr>

                                                                  <th scope="row">{{$i}}</th>

                                                                   <?php $i++; ?>

                                                                  <td>{{$file->created_at->format('d-

                                                                  m-Y')}}</td>

                                                                  <td><a href="{{asset('public/uploads/'.$file->file)}}" download>Download</a></td>

                                                                </tr>

                                                                @endif

                                                                @endforeach

                                                               

                                                              </tbody>

                                                            </table>

                                                            

                                                        </div>

                                                    </div>

                                                    </div>

                                                   </div>

                                            @endforeach



                                            </div><!-- Row End -->

                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="about">

                                        <div class="card-body">

                                             <div class="row clearfix g-3">

                                            @foreach($sellerqueryrejected as $queryrejected)

                                                   <div class="card">

                                                    <div class="card-body">

                                                        <div class="row">

                                                        <div class="col-md-6">

                                                           <div>

                                                                <h6><b>Quoted Price:</b>{{$queryaccepted->amount}}</h6>

                                                            </div>



                                                            <div>

                                                                <h5>Seller Details</h5>

                                                            </div>



                                                            <div>

                                                                <p><b>Seller Name :</b>{{$queryrejected->seller->first_name}} {{$queryrejected->seller->last_name}}</p>

                                                                <p><b>Business Name : </b>{{$queryrejected->seller->business_name}}</p>

                                                                <p id="sellermobile"><b>Mobile Number :</b>{{$queryrejected->seller->mobile}}</p>

                                                                <p id="seller"><b>Email:</b>{{$queryrejected->seller->email}}</p>

                                                            </div>

                                                           <!--  <div>

                                                                <button type="button" class="btn btn-light contactdetails">Contact Details</button>

                                                            </div> -->

                                                        </div>



                                                          <div class="col-md-6">

                                                           <h6><b>Details</b></h6>

                                                            <p>{{$queryrejected->details}}</p>



                                                            <table class="table table-bordered">

                                                              <thead>

                                                                <tr>

                                                                  <th scope="col">#</th>

                                                                  <th scope="col">Date</th>

                                                                  <th scope="col">Download</th>

                                                                </tr>

                                                              </thead>

                                                              <tbody>

                                                                <?php

                                                                $i=1;

                                                                ?>

                                                                @foreach($sellerinquiryfile as $file)

                                                                @if($file->sellerquerys_id == $queryrejected->id)

                                                                <tr>

                                                                  <th scope="row">{{$i}}</th>

                                                                   <?php $i++; ?>

                                                                  <td>{{$file->created_at->format('d-

                                                                  m-Y')}}</td>

                                                                  <td><a href="{{asset('public/uploads/'.$file->file)}}" download>Download</a></td>

                                                                </tr>

                                                                @endif

                                                                @endforeach

                                                               

                                                              </tbody>

                                                            </table>

                                                            

                                                        </div>

                                                    </div>

                                                    </div>

                                                   </div>

                                            @endforeach

                                            </div><!-- Row End -->

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

@section('javascript')

<script type="text/javascript">

         $(document).ready(function(){

        $('.contactdetails').click(function(){

            $('#sellermobile').toggle();

            $('#selleremail').toggle();

        });

    });

</script>

@endsection
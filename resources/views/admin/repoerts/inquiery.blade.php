@extends('layouts.adminheader')
@section('content')
      <div class="body d-flex py-3">  
                <div class="container-xxl"> 
                    <div class="row align-items-center"> 
                        <div class="border-0 mb-4"> 
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Inquiry</h3>
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
                                                <th>Buyer Name</th>
                                                <th>Keywords</th>
                                                <th>Quantity</th>
                                                <th>Budget</th>
                                                <th>Description</th>
                                                <th>Inquiry Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td>5</td>
                                                <td>6</td>
                                                <td>7</td>
                                                <td>8</td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                </div>
            </div>

@endsection
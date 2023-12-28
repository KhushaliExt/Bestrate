    <form method="post" action="{{route('updatequotation')}}" enctype="multipart/form-data">

        @csrf

   <div class="deadline-form">

                          <input type="hidden" name="id" value="{{$sellerquery->id}}">

                                <div class="row g-3 mb-3">

                                    <div class="col-md-12">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Date</span>

                                            </div>

                                            <input type="date" class="form-control" id="dataScaleY" placeholder="Quotation Date" name="response_date">

                                        </div>

                                    </div>



                                        <div class="col-md-6">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Budget</span>

                                            </div>

                                            <input type="number" class="form-control" id="dataScaleY" placeholder="Budget" value="{{ isset($sellerquery->amount) ? $sellerquery->amount : '' }}" min="0" name="amount" required step="1" onkeypress="return event.keyCode === 8 || event.charCode >= 48 && event.charCode <= 57">


    
                                        </div>

                                    </div>

                                   

                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Quantity</span>

                                            </div>

                                            <input type="text" class="form-control" id="dataScaleY" placeholder="Quantity" value="{{ isset($sellerquery->inquery->quantity) ? $sellerquery->inquery->quantity : '' }}" readonly>



                                        </div>

                                    </div>

                                </div>



                                <div class="row g-3 mb-3">

                                    <div class="col-md-12">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text">Description</span>

                                            </div>

                                            <textarea class="form-control" placeholder="Enter Description" name="details"></textarea>

                                        </div>

                                    </div>

                                </div>



                                <div class="row g-3 mb-3">

                                    <div class="col-md-12">

                                        <div class="input-group">

                                            <input type="file" class="form-control" name="file[]" multiple>

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="col-sm-12">

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

                                            <tr>

                                              <td>{{$i}}</td>

                                              <?php $i++;?>

                                              <td>{{$file->created_at->format('d-m-Y')}}</td>

                                              <td><a href="{{asset('uploads/'.$file->file)}}" download>Download</a></td>

                                            </tr>

                                            @endforeach

                                            

                                          </tbody>

                                        </table>

                                    </div>

                                </div>



                               <div class="row g-3 mb-3">

                                   

                                        <h5>Buyer Information</h5>

                                        <div class="col-md-6">

                                           <div>

                                                <h6><b>Name: </b>{{ isset($sellerquery->buyer->first_name) ? $sellerquery->buyer->first_name : '' }}</h6>

                                                <h6><b>Email: </b>{{ isset($sellerquery->buyer->email) ? $sellerquery->buyer->email : '' }}</h6>

                                            </div>

                                        </div>



                                        <div class="col-md-6">

                                       

                                        </div>

                                    

                                </div>

                                

                        </div>



                        <div class="modal-footer">

                        

                        @if($sellerquery->inquery_status == 2)

                        <button type="submit" class="btn btn-primary">Add</button>

                        @endif

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    

                        </div>



                            </form>
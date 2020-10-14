@extends('backend.master')

@section('content')
    <div class="container" style="background: #e3e4e8">
        <div class="row mt-5">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header d-flex justify-content-between" style="box-shadow: -2px -2px 3px #bcc5e8">
                        <h5>All Shipping Methods</h5>
                        <div class="card-tools f-right">
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">Add Shipping Method</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped text-center tabel-hover">
                            <thead>
                              <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Title</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Price</th>
                                <th scope="col">Data</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $index=>$item)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->duration}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->date}}</td>
                                     <td>
                                     <a href="{{url('/edit_shipping')}}/{{$item->id}}" class="bt btn-info btn-sm" ><i class="fas fa-edit"></i></a>
                                     <a href="{{url('/delete_shipping')}}/{{$item->id}}" class="bt btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                     </td>

                                  </tr>



                                @endforeach


                            </tbody>
                          </table>
                    </div>

                    {{-- modal --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Add Shipping Method</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                        <form action="{{url('/save_shipping_method')}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Duration</label>
                                    <input type="text" class="form-control" name="duration" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter duration">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="text" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Date</label>
                                    <input type="date" class="form-control" name="date" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter date">

                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save </button>
                              </div>
                           </form>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

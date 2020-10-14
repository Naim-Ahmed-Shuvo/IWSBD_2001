@extends('backend.master')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="background: #54ebca">
                        All Users
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover text-center">
                            <thead>
                              <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item=>$user)

                                @endforeach
                              <tr>
                                <th scope="row">{{$item+1}}</th>
                                <td>{{$user->image}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td>
                                <a class="btn btn-info text-white btn-sm btn-round" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-user-plus"></i></a>
                                <a href="{{url('/update_user')}}" class="btn btn-info btn-sm btn-round"> <i class="far fa-edit"></i></a>
                                <a href="{{url('/delete_user')}}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                    </td>

                              </tr>

                            </tbody>
                          </table>

                          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" enctype="multipart/form-data" action="{{url('/add_users')}}">
                                        @csrf
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Name</label>
                                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">

                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Email</label>
                                          <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Role</label>
                                            <select class="form-control" name="role">
                                                <option>Admin</option>
                                                <option>Stuff</option>
                                                <option>Customer</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="image" onchange="document.getElementById('bah').src = window.URL.createObjectURL(this.files[0])" required="required" class="form-control">

                                            <img id="bah" height="100" width="100" class="img-fluid mt-1">
                                        </div>

                                        {{-- <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Add</button>
                                        </div> --}}

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>


                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

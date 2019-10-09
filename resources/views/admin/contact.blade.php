

@extends('layouts.admin')

@section('content')
    <div class="container" id="view">
            <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))
                
                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                      @endif
                    @endforeach
                  </div>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
            <div class="container">
                    <div class="row tbl-bg">
                        
                        
                        <div class="col-md-12">
                        <legend class="tbl-title">Messages</legend>

                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Contact No.</th>
                                       <th>Subject</th>
                                       <th>Message</th>
                                       <th>Date Created</th>
                                       <th>Delete</th>
                                       
                                   </thead>
                    <tbody>
                    
                          @foreach($contacts as $row)
                            <tr>
                              
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->contact}}</td>
                                <td>{{$row->subject}}</td>
                                <td>{{$row->message}}</td>
                                <td>{{$row->created_at}}</td>
                                <form action="{{route('destroy_contact',[$row->id])}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="far fa-trash-alt"></i></button></p></td>
                                    </form>

                            </tr>
                              @endforeach  
      
                   
                    </div>
                   
                    
                    </tbody>
                        
                </table>
                <div class="text-center">
                        {{ $contacts->links() }}
                       
                        </div>
    </div>
    @endsection
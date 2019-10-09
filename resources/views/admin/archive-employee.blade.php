


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
                        <legend class="tbl-title">Employees</legend>
                        
                            <div class="tbl-widg">
                                <div>
                                    <a href="{{url('admin/archive/employees/export/excel')}}"class="btn btn-primary btn-xs"><i class="far fa-file-excel"></i> Export to Excel</a>
                                </div>

                                <div class="form-group">
                                    <form action = "{{route('search_archive_employee')}}" role="search" method="get"enctype="multipart/form-data">
                                        <input type="text" class="form-control" name="search" id="search" placeholder="Search">
                                    </form>
                                </div>
                            </div>
                            
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Employee Name</th>
                                        <th>Picture</th>
                                        <th>Email</th>
                                        <th>Contact No.</th>
                                       <th>Address</th>
                                       <th>Position</th>
                                       <th>Date Employed</th>
                                       <th>Status</th>
                                      
                                   
                                   </thead>
                    <tbody>
                    
                          @foreach($employees as $row)
                            <tr>
                              
                                <td>{{$row->name}}</td>
                                <td><img src="/storage/images/{{$row->pic}}"  width="50" height="50"></td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->contact}}</td>
                                <td>{{$row->address}}</td>
                                <td>{{$row->position}}</td>
                                <td>{{$row->date_employed}}</td>
                                <td>{{$row->status}}</td>
                                
                            </tr>
                              @endforeach  
      
                   
                    </div>
                   
                    
                    </tbody>
                        
                </table>
                <div class="text-center">
                        {{ $employees->links() }}
                       
                        </div>
    </div>
    
    </div>




@endsection




            

    
                
  
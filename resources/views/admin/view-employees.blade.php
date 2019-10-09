


@extends('layouts.admin')

@section('content')
<style>
.modal-content .modal-body .form-group{
   margin:0 !important;
}
</style>
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
                                <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-xs">Add Employee </a>
                                <a href="{{url('admin/employees/export/excel')}}"class="btn btn-xs"><i class="far fa-file-excel"></i> Export to Excel</a>
                            </div>
                            <div class="form-group">
                              <form action = "{{route('search_employee')}}" role="search" method="get"enctype="multipart/form-data">
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
                                       <th colspan="2" style="text-align:center">Action</th>
                                   </thead>
                    <tbody>
                    
                          @foreach($employees as $row)
                            <tr>
                              
                                <td>{{$row->name}}</td>
                                <td><img src="/storage/images/{{$row->pic}}"  ></td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->contact}}</td>
                                <td>{{$row->address}}</td>
                                <td>{{$row->position}}</td>
                                <td>{{$row->date_employed}}</td>
                                <td>{{$row->status}}</td>
                                <td><p data-placement="top" data-toggle="tooltip"  title="Edit"><button class="btn btn-warning btn-xs" data-title="Edit" data-toggle="modal" data-id="{!! $row->id !!}" data-target="#edit-{{$row->id}}" ><i class="fas fa-edit"></i></button></p></td>
                                <form action = "{{route('remove_employee', $row->id)}}" method="post" enctype="multipart/form-data">
            
                                    {{csrf_field() }}
                                    <input name="_method" type="hidden" value="PUT">
                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="far fa-trash-alt"></i></button></p></td>
                                </form>
                              </tr>
                              @endforeach  
      
                   
                    </div>
                   
                    
                    </tbody>
                        
                </table>
                <div class="text-center">
                        {{ $employees->links() }}
                       
                        </div>
    </div>










    <form action = "{{route('add_employee')}}" method="post"  enctype="multipart/form-data">
            {{csrf_field() }}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    
                  <div class="form-group">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label for="pic">Picture:</label>
                            <input class="mdl-textfield__input form-control" type="file" name="pic" id="pic" >
                        </div>
                        <label for="name">Employee Name:</label>
                        <input type="text" name="name" id="name" class="form-control"> 
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control"> 
                        <label for="contact">Contact Number:</label>
                        <input type="number" name="contact" id="contact" class="form-control"> 
                        <label for="address"> Address:</label>
                        <input type="text" name="address" id="address" class="form-control">
                        <label for="position"> Position:</label>
                        <input type="text" name="position" title="position" class="form-control">
                        <label for="date_employed"> Date Employed:</label>
                        <div class="input-group date">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" name="date_employed" id="date_employed" class="form-control pull-right" >
                              </div>
                              <label for="status"> Status:</label>
                              <select class="form-control" name="status" id="status">
                                    <option value="permanent">Permanent</option>
                                    <option value="casual">Casual</option>
                                    <option value="trainee">Trainee</option>
                                    <option value="contractor">Contractor</option>
                             </select>
                    </div> 
           
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Submit Information">
              </div>
            </div>
          </div>
        </div>
        </form>





        
        @foreach($employees as $row)
        <form action = "{{route('edit_employee', $row->id)}}" method="post" enctype="multipart/form-data">
            
            {{csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <div class="modal fade" id="edit-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editLabel">Edit Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    
                  <div class="form-group">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label for="pic">Picture:</label>
                            <input class="mdl-textfield__input form-control" type="file" name="pic" id="pic" >
                        </div>
                        <label for="name">Employee Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$row->name}}"> 
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control"value="{{$row->email}}"> 
                        <label for="contact">Contact Number:</label>
                        <input type="number" name="contact" id="contact" class="form-control"value="{{$row->contact}}"> 
                        <label for="address"> Address:</label>
                        <input type="text" name="address" id="address" class="form-control"value="{{$row->address}}">
                        <label for="position"> Position:</label>
                        <input type="text" name="position" title="position" class="form-control" value="{{$row->position}}">
                        <label for="date_employed"> Date Employed:</label>
                        <div class="input-group date">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" name="date_employed" id="date_employed" class="form-control pull-right" value="{{$row->date_employed}}" >
                              </div>
                              <label for="status"> Status:</label>
                              <select class="form-control" name="status" id="status">
                                    <option value="permanent">Permanent</option>
                                    <option value="casual">Casual</option>
                                    <option value="trainee">Trainee</option>
                                    <option value="contractor">Contractor</option>
                             </select>
                    </div> 
           
              </div>
        
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Submit Information">
            </div>
            </div>
            </div>
            </div>
        </form>
        @endforeach     
    </div>




@endsection




            

    
                
  
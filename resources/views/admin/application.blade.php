


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
                        <legend class="tbl-title">Job Title: {{$jobs->get(0)->title}}</legend>
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Applicant Name</th>
                                        <th>Email</th>
                                        <th>Contact No.</th>
                                       <th>Resume</th>
                                        <th>Date applied</th>
                                        <th>Delete</th>
                                   </thead>
                    <tbody>
                    
                          @foreach($application as $row)
                            <tr>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->contact}}</td>
                                    <td><a href="/storage/resume/{{$row->resume}}" download="{{$row->resume}}"><div class="icon material-icons">file_copy</div>{{$row->resume}}</a></td>
                                    <td>{{$row->created_at}}</td>
                                    <form action="{{route('destroy_application',[$row->id])}}" method="POST">
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
                        
                        {{ $application->links() }}
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
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label for="pic">Picture:</label>
                            <input class="mdl-textfield__input" type="file" name="pic" id="pic" >
                        </div>
                  <div class="form-group">
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
    </div>




@endsection




            

    
                
  
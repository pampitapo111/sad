


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
                        <legend class="tbl-title">Jobs Available</legend>
                        <div class="tbl-widg">
                          <div>
                            <a href="" data-toggle="modal" data-target="#exampleModal" class="btn  btn-xs">Add Job</a>
                            <a href="{{url('admin/jobs/export/excel')}}"class="btn  btn-xs"><i class="far fa-file-excel"></i> Export to Excel</a>
                          </div>
                          <div class="form-group">
                            <form action = "{{route('search_job')}}" role="search" method="get"enctype="multipart/form-data">
                              <input type="text" class="form-control" name="search" id="search" placeholder="Search">
                            </form>
                          </div>
                        </div>
                        
                        <div class="table-responsive">
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                        <th>Job Title</th>
                                        <th>Job Description</th>
                                        <th>Experience</th>
                                        <th>Requirements</th>
                                        <th>Qualifications</th>
                                       <th>Salary</th>
                                       <th>Date Created</th>
                                       <th>Delete</th>
                                   </thead>
                    <tbody>
                    
                        
                            <tr>
                                    @foreach($jobs as $row)
                                    <tr>
                                      
                                        <td><a href="/admin/jobs/applications/{{$row->id}}">{{$row->title}}</a></td>
                                        <td>{{$row->description}}</td>
                                        <td>{{$row->exp ?? 'Not Specified'}}</td>
                                        <td>{{$row->requirement}}</td>
                                        <td>{{$row->qualification}}</td>
                                        <td>₱ {{number_format($row->salary, 2)}}</td>
                                        <td>{{$row->updated_at}}</td>
                                        <form action="{{route('destroy_job',[$row->id])}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="far fa-trash-alt"></i></button></p></td>
                                            </form>
                                    </tr>
                                      @endforeach  
                           
                            </tr>
                      
      
                   
                    </div>
                   
                    
                    </tbody>
                        
                </table>
                <div class="text-center">
                        {{ $jobs->links() }}
                        </div>
    </div>










    <form action = "{{route('add_job')}}" method="post"  enctype="multipart/form-data">
            {{csrf_field() }}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                 
                  <div class="form-group">
                        <label for="title">Job Title:</label>
                        <input type="text" name="title" id="title" class="form-control"> 
                        <label for="exp">Experience:</label>
                        <input type="text" name="exp" id="exp" class="form-control"> 
                        <label for="description">Job Description:</label>
                        <textarea rows="4" name="description" id="description" class="form-control"> </textarea>
                        <label for="requirement">Requirements:</label>
                        <textarea rows="4" name="requirement" id="requirement" class="form-control"> </textarea>
                        <label for="qualification">Qualifications:</label>
                        <textarea rows="4" name="qualification" id="qualification" class="form-control"> </textarea>
                        <label for="salary">Salary:</label>
                        <input type="number" name="salary" id="salary" class="form-control"> 
                        
               
                       
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




            

    
                
  
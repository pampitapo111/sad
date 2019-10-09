


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
                        <legend class="tbl-title">Projects</legend>
                        <div class="tbl-widg">
                          <div>
                            <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-xs">Add Project </a>
                            <a href="{{url('admin/projects/export/excel')}}"class="btn btn-primary btn-xs"><i class="far fa-file-excel"></i> Export to Excel</a>
                           </div>
                           <div class="form-group">
                              <form action = "{{route('search_project')}}" role="search" method="get"enctype="multipart/form-data">
                                <input type="text" class="form-control" name="search" id="search" placeholder="Search">
                              </form>
                          </div>
                        </div>
                        
                        <div class="table-responsive">
                              <table id="mytable" class="table table-bordred table-striped">
                                   <thead>
                                   
                                        <th>Project Name</th>
                                        <th>Picture</th>
                                        <th>Description</th>
                                        <th>Budget</th>
                                        <th>Date Started</th>
                                        <th>Date Finished</th>
                                        <th>% of completion</th>
                                       <th>Status</th>
                                        <th colspan="2" style="text-align:center;">Action</th>
                                    </thead>
                    <tbody>
                    
                            <tr>
                                    @foreach($projects as $row)
                                    <tr>
                                      
                                        <td>{{$row->name}}</td>
                                        <td><img src="/storage/images/{{$row->pic}}"></td>
                                        <td>{{$row->description}}</td>
                                        <td>₱ {{number_format($row->budget, 2)}}</td>
                                        <td>{{$row->date_started}}</td>
                                        <td>{{$row->date_finish}}</td>
                                        <td>{{$row->percent}}%</td>
                                        <td>{{$row->status}}</td>
                                        <td><p data-placement="top" data-toggle="tooltip"  title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-id="{!! $row->id !!}" data-target="#edit-{{$row->id}}" ><i class="fas fa-edit"></i></button></p></td>
                                        <form action = "{{route('remove_project', $row->id)}}" method="post" enctype="multipart/form-data">
            
                                            {{csrf_field() }}
                                            <input name="_method" type="hidden" value="PUT">
                                        <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="far fa-trash-alt"></i></button></p></td>
                                        </form>
                                      </tr>
                                      @endforeach  
                                
                            </tr>
                      
      
                   
                    </div>
                   
                    
                    </tbody>
                        
                </table>
                <div class="text-center">
                      
                        {{ $projects->links() }}
                        </div>
    </div>










    <form action = "{{route('add_project')}}" method="post"  enctype="multipart/form-data">
            {{csrf_field() }}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
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
                        <label for="name">Project Name:</label>
                        <input type="text" name="name" id="name" class="form-control"> 
                        <label for="description">Description:</label>
                        <textarea rows="4" name="description" id="description" class="form-control"> </textarea>
                        <label for="budget">Budget:</label>
                        <input type="text" name="budget" id="budget" class="form-control"> 
                        <label for="date_started"> Date Started:</label>
                        <div class="input-group date">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" name="date_started" id="date_started" class="form-control pull-right" >
                              </div>
                              <label for="date_finish"> Date Finish:</label>
                              <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="date" name="date_finish" id="date_finish" class="form-control pull-right" >
                                    </div>
                        <label for="percent">% of completion:</label>
                        <input type="number" name="percent" id="percent" class="form-control"> 
                        <label for="status"> Status:</label>
                        <select class="form-control" name="status" id="status">
                              <option value="ongoing">On Going</option>
                              <option value="finished">Finished</option>
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







        @foreach($projects as $row)
        <form action = "{{route('edit_project', $row->id)}}" method="post" enctype="multipart/form-data">
            
            {{csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <div class="modal fade" id="edit-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editLabel">Edit Project</h5>
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
                        <label for="name">Project Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value={{$row->name}}> 
                        <label for="description">Description:</label>
                        <textarea rows="4" name="description" id="description" class="form-control">{{$row->description}} </textarea>
                        <label for="name">Budget:</label>
                        <input type="text" name="budget" id="budget" class="form-control" value={{$row->budget}}> 
                        <label for="date_started"> Date Started:</label>
                        <div class="input-group date">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" name="date_started" id="date_started" class="form-control pull-right" value={{$row->date_started}}>
                              </div>
                              <label for="date_finish"> Date Finish:</label>
                              <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="date" name="date_finish" id="date_finish" class="form-control pull-right" value={{$row->date_finish}} >
                                    </div>
                        <label for="percent">% of completion:</label>
                        <input type="number" name="percent" id="percent" class="form-control" value={{$row->percent}}> 
                        <label for="status"> Status:</label>
                        <select class="form-control" name="status" id="status">
                              <option value="ongoing">On Going</option>
                              <option value="finished">Finished</option>
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




            

    
                
  
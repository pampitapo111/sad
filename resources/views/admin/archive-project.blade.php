


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
                        <legend class="tbl-title">Projects</legend>
                        <div class="tbl-widg">
                            <div>
                             <a href="{{route('archive_project.excel')}}"class="btn btn-primary btn-xs"><i class="far fa-file-excel"></i> Export to Excel</a>
                            </div>
                            <div class="form-group">
                                <form action = "{{route('search_archive_project')}}" role="search" method="get"enctype="multipart/form-data">
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
                                   </thead>
                    <tbody>
                    
                            <tr>
                                    @foreach($projects as $row)
                                    <tr>
                                      
                                        <td>{{$row->name}}</td>
                                        <td><img src="/storage/images/{{$row->pic}}"></td>
                                        <td>{{$row->description}}</td>
                                        <td>₱  {{number_format($row->budget)}}</td>
                                        <td>{{$row->date_started}}</td>
                                        <td>{{$row->date_finish}}</td>
                                        <td>{{$row->percent}}%</td>
                                        <td>{{$row->status}}</td>
                                        
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


   



@endsection




            

    
                
  
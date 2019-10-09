


@extends('layouts.admin')
<style>
    #picture{
      position: absolute;
      height: 30;
      width: 50;
    }
  </style>
@section('content')

            <div class="container">
                    <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                              @if(Session::has('alert-' . $msg))
                        
                              <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                              @endif
                            @endforeach
                          </div> <!-- end .flash-message -->
                    <div class="row">
                        
                        
                        <div class="col-md-12">
                        <legend>Admins</legend>
            
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                        
                                        <th>Name</th>
                                        <th>Email</th>
                                       <th>Delete</th>
                                       <th><a href="/admin/admins/create"> <button type="button" class="btn btn-primary">Add</button></a></th>
                                       
                                   </thead>
                    <tbody>
                    
                           @foreach($admin as $i)
                            <tr>
                               <td>{{$i->name}}</td>
                               <td>{{$i->email}}</td>
                               <form action="/admin/admins/{{$i->id}}" method="POST">
                                   {{ csrf_field() }}
                                   {{ method_field('DELETE') }}
                               <td><p data-placement="top"  onclick="return confirm('Are you sure?')" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                               </form>
                            </tr>
                @endforeach
                 
                    <div class="text-center">
                
                   
                    </div>
                   
                    
                    </tbody>
                        
                </table>
    </div>
    </div>
                    </div>

        
            </div>

    
    
@endsection




            

    
                
  
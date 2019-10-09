


   


@extends('layouts.admin')

@section('content')

<style>
        #submit{
            position: absolute;
            left: 80%;
        }
    </style>
<div class="container" id="view">
      
  
        <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
            
                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
                @endforeach
              </div> <!-- end .flash-message -->
              
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
     
     
     
            <legend>Create Admin</legend>
            <form action = "{{route('add-admin')}}" method="post" enctype="multipart/form-data">
                                          
                    {{csrf_field() }}
 
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" > 
            </div>   
              <div class="form-group">

                <label for="email">Email:</label>
                <input type="email"  name="email" id="email" class="form-control" > 
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" > 
            </div> 
            <div class="form-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" > 
                </div> 
            <button type="submit" id="submit" class="btn btn-primary">Create</button>
           
        
        </form>                           

    </div>
@endsection

            

    
                
  
        
        

   

            

    
                
  
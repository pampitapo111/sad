






nde ko na to ginamet hahaha para isang page nalang ung sa career surry






@extends('layouts.website')

@section('content')
<div class="container">
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
    <h1><a href="" data-toggle="modal" data-target="#exampleModal">Apply Now!</a></h1>
    <br><br><br><br>
    <legend><h2>{{$jobs->get(0)['title']}}</h2></legend>
    <p>Description: {{$jobs->get(0)['description']}}</p>
    <hr>
    <p>Requirements: {{$jobs->get(0)['requirement']}}</p>
    <hr>
    <p>Qualifications: {{$jobs->get(0)['qualification']}}</p>
    <hr>
    <p>Salary: PHP {{$jobs->get(0)['salary']}}</p>
    <h1>PAAYOS NALANG HAHA</h1>
</div>




<form action = "{{route('application',$jobs->get(0)->id)}}" method="post"  enctype="multipart/form-data">
    {{csrf_field() }}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Application</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control"> 
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control"> 
                <label for="contact">Contact Number:</label>
                <input type="number" name="contact" id="contact" class="form-control"> 
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label for="resume">Upload your resume:</label>
                        <input class="mdl-textfield__input" type="file" name="resume" id="resume" >
                    </div>
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
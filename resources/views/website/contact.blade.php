@extends('layouts.website')

@section('content')

<div class="contact-head">
    <h1>CONTACT US</h1>
    <img src="/storage/images/contact.jpeg">
    <div class="overlay"></div>
</div>

<div class="contact-cont">
    <div class="header">
        <h1>Got projects on mind?</h1>
        <div class="overlay"></div>
    </div>
    <p>Feel free to discuss it with us! 
        For inquiries about employment, subcontracting for us, or information about our current project,
         fill up the form below, so we can connect you to the best person to help you.</p>

   
        <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">{{ Session::get('alert-' . $msg) }}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>
            @endif
        @endforeach
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
           Something went wrong, please try again. 
        </div>
        @endif

<form action = "{{route('add_contact')}}" method="post"  enctype="multipart/form-data">
    {{csrf_field() }}
    <div class="contact-form">
        <div class="inner-addon left-addon">
        <i class="fas fa-user"></i>      
        <input type="text" class="form-control" placeholder="Name"  name="name" id="name" required/>
        </div>

        <div class="inner-addon left-addon">
        <i class="fas fa-envelope"></i>      
        <input type="email" name="email" id="email" class="form-control" placeholder="Email"   required/>
        </div>

        <div class="inner-addon left-addon">
        <i class="fas fa-phone-alt"></i>      
        <input type="text" class="form-control" placeholder="Contact"   name="contact" id="contact" required/>
        </div>

        <div class="inner-addon left-addon">
        <i class="fas fa-thumbtack"></i>      
        <input type="text" class="form-control" placeholder="Subject"   name="subject" title="subject" required/>
        </div>

        <div class="inner-addon left-addon">
        <i class="fas fa-comment-dots"></i>      
        <textarea class="form-control" placeholder="Message"  name="message" id="message" required></textarea>
        </div>
        <div class="btn-submit">
            <input type="submit" class="btn btn-green" value="Submit Information">
        </div>
    </div>
</form> 

</div>



















<!--div class="container">
        <div class="flash-message">
                @ foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @ if(Session::has('alert-' . $msg))
            
                  <p class="alert alert-{ { $msg }}">{ { Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @ endif
                @ endforeach
              </div>
              @ if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @ foreach ($errors->all() as $error)
                          <li>{ { $error }}</li>
                      @ endforeach
                  </ul>
              </div>
          @ endif
        <legend> How can we help? </legend>
    <br>
        <h1>Contact Us! </h1>
        <p>Please feel free to call us to discuss your upcoming project! For inquiries about employment, subcontracting for us, or information about our current project, please use the form below so we can connect you to the best person to help you. </p>
    <br><br><hr>

    
    <form action = "{ {route('add_contact')}}" method="post"  enctype="multipart/form-data">
        { {csrf_field() }}
    <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control"> 
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control"> 
            <label for="contact">Contact Number:</label>
            <input type="number" name="contact" id="contact" class="form-control"> 
            <label for="subject"> Subject:</label>
            <input type="text" name="subject" title="subject" class="form-control">
            <label for="message">Message:</label>
            <textarea rows="4" name="message" id="message" class="form-control"> </textarea>
            <br>
            <input type="submit" class="btn btn-primary" value="Submit Information">
        </div>
    </form> 
    </div-->
@endsection
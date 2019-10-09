@extends('layouts.website')
@section('js')
    <script>
            $(document).ready(function(){
                $('#jobModal').on('hidden.bs.modal', function () {
                        $(this).find("input,textarea,select").val('').end();

                });

                $('#applicationForm').on("keyup", "input.is-invalid", function(){
                        $(this).removeClass("is-invalid");
                });

                $("#applicationForm").on('submit', function(event){
                        
                        event.preventDefault();
                        var formData = new FormData(this);
                        formData.append("_token", "{{ csrf_token() }}");
                        $.ajax({
                                url : "/application",
                                type: 'post',
                                data : formData,
                                contentType: false,
                                processData: false,
                                success: function(response){ 
                                        $("#jobModal").modal('hide');
                                        $("#jobModal").find("input,textarea,select").val('').end();
                                        $('.alert').show();
                                        $(".alert").fadeTo(4000, 0).slideUp(500, function(){
                                                $(this).alert('close'); 
                                         });
                                }, 
                                error: function (error){
                                         $.each(error.responseJSON.errors, function(i, item) {
                                                $("#v"+i).addClass('invalid-feedback').text(item);
                                                $("#"+i).addClass('is-invalid');
                                                
                                        });                                    
                                }
                        });
                });
            });
        function getJobInfo(id){
                $.get('/careers/'+ id, function(data){

                    $.each(data[0], function(i, item) {
                             if(item!=null){
                                     if(i=="id"){
                                        $("#j"+i).val(item);
                                     }else{
                                        $("#"+i).text(item);
                                     }
                             }
                     });
                       
                        
                });
        }
    </script>
@endsection
@section('content')

    <form enctype="multipart/form-data" id="applicationForm">
        <div class="modal" tabindex="-1" id="jobModal" role="dialog">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Apply now!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                                        <h4 id="title"></h4>
                                        <p><i class="fas fa-business-time"></i><span  id="exp">Not Specified</span></p>
                                        <p style="margin-bottom: 13px;"><i class="fas fa-money-bill"></i> <span id="salary">Not Specified</span></p>
                                       
                                 <div class="modal-job">
                                        <strong>Description</strong>
                                        <hr/><p  id="description"></p>
                                        <strong>Qualifications</strong><hr/><p id="qualification"></p>    
                                        <strong>Requirements</strong><hr/><p id="requirement"></p> 
                                 </div>
                                 <div class="form-group">
                                        <input type="text" id="jid" style="display:none" name="jid">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name" class="form-control"> 
                                        <div id="vname"></div>
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" id="email" class="form-control"> 
                                        <div id="vemail"></div>
                                        <label for="contact">Contact Number:</label>
                                        <input type="number" name="contact" id="contact" class="form-control"> 
                                        <div id="vcontact"></div>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label for="resume">Upload your resume:</label>
                                                <input class="mdl-textfield__input form-control"  type="file" name="resume" id="resume" >
                                                <div id="vresume"></div>
                                        </div>
                                </div> 
                        </div>
                        <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Apply</button>
                                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                        </div>
                </div>
                </div>
        </div>
</form>
        <div class="career-head">
                <h1>CAREERS</h1>
                <img src="/storage/images/career.jpeg">
                <div class="overlay"></div>
        </div>
        <div class="career-cont">
                <div class="intro">
                        <h1>Current Openings</h1>
                        <p>Our most valuable resource is our people and we invest the time and energy to recruit,
                                 train and develop the best talent in our industry. JOIN US!
                        </p>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Thank you for applying!</strong>We'll get back to you as soon as we can.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="job-list">
                         @foreach($jobs as $job)
                         <div class="jobs">
                                <h4>{{$job->title}}</h4>
                                <p><span><i class="fas fa-business-time"></i> </span>{{$job->exp ?? 'Not Specified'}}</p>
                                <p><span><i class="fas fa-money-bill"></i> </span>{{number_format($job->salary,2) ?? 'Not Specified'}}</p>
                                <p><strong>Description: </strong>{{$job->description ?? 'Not specified'}} </p>
                                <div><p>Posted on: {{$job->created_at}}</p><button onclick="getJobInfo({{$job->id}})"  data-toggle="modal" data-target="#jobModal" class="btn btn-green sm">Apply</button></div>
                         </div>
                         @endforeach
                </div>
        </div>

<!--div class="container">
        <legend>
           JOIN THE TEAM
        </legend>
<br>
        <h1>Careers</h1>
        <p>
            Our most valuable resource is our people and we invest the time and energy to recruit, train and develop the best talent in our industry.
        </p>
        <p>Please see the below job openings and contact us with inquiries about joining our team.
        </p>
        <br><br>
        <hr>
        <h3>Current Openings</h3>
        <br>
        @ foreach($jobs as $job)
        <a href="/careers/{ {$job->id}}"><legend><h1>{ {$job->title}}</h1></legend></a>
        <p>{ {$job->description}}</p>
        <br><br>
        @ endforeach
</div-->
@endsection
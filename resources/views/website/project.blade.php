@extends('layouts.website')

@section('content')
    <div class="proj-head">
        <h1>PROJECTS & SERVICES</h1>
        <img src="/storage/images/proj.jpeg">
        <div class="overlay"></div>
    </div>
    <div class="proj">
        <div class="title"><h1>Recent Projects</h1></div>
         @foreach($projects as $proj)
        <div class="proj-grid">
            <img src="/storage/images/{{$proj->pic}}">
        <div class="proj-info-cont">
            <div class="proj-info"><h1>{{$proj->name}}</h1><h4>₱ {{number_format($proj->budget, 2)}}</h4><p>{{$proj->description}}</p></div>
        </div>
        </div>
        @endforeach
    </div>
    <div class="services">
        <div class="title"><h1>Services Offered</h1></div>
        <div class="serv-grid">
            <div><h2>Design and Construction</h2><h4> Derfir schléit fergiess as mir, geet spilt derfir dee op. Oft Räis schéi d'Pied et. Gaas Kënnt Blieder am ass.</h4></div>
            <div><h2>Architectural Design</h2><h4>Gewëss derbei da dan, ke ass iwer gehéiert prächteg. Rëm Hémecht d'Musek d'Vullen dé, derbei zwëschen rou hu, no dan Schiet Fielse Dauschen.</h4></div>
            <div><h2>Structural Design</h2><h4>Gewëss derbei da dan, ke ass iwer gehéiert prächteg. Rëm Hémecht d'Musek d'Vullen dé, derbei zwëschen rou hu, no dan Schiet Fielse Dauschen. </h4></div>
            <div><h2>Electrical Design</h2><h4>Gewëss derbei da dan, ke ass iwer gehéiert prächteg. Rëm Hémecht d'Musek d'Vullen dé, derbei zwëschen rou hu, no dan Schiet Fielse Dauschen. </h4></div>
            <div><h2>Plumbing/Sanitary Design</h2><h4>Gewëss derbei da dan, ke ass iwer gehéiert prächteg. Rëm Hémecht d'Musek d'Vullen dé, derbei zwëschen rou hu, no dan Schiet Fielse Dauschen. </h4></div>
            <div><h2>CAD/Drafting Works</h2><h4>Gewëss derbei da dan, ke ass iwer gehéiert prächteg. Rëm Hémecht d'Musek d'Vullen dé, derbei zwëschen rou hu, no dan Schiet Fielse Dauschen. </h4></div>
        </div>
        
    </div>

    <!--div class="proj-gallery">
         <div class="title"><h1>Gallery</h1></div>
        <div class="proj-grid">
             @ foreach($imgs as $img)
             @ if($img["pic"])
                 <div>
                    <img src="/storage/images/{ {$img["pic"]}}">
                </div>
                @ else
            <div></div>
             @ endif  
            @ endforeach
            
        </div>
    </div-->
@endsection
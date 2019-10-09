@extends('layouts.website')

@section('content')
<div class="home-cont">
    <div class="vid-container">
        <video id="home-vid" src="/storage/images/homeVid.mp4" autoplay="true" muted="true"  loop="true"></video>
    </div>
    <div class="vid-content">
        <h1>“ Pioneering <span>HOMES</span>,</h1>
        <h1>&nbsp;&nbsp;Linking <span>DREAMS</span>. ”</h1>
    </div>
    <div class="home-about">
        <div class="intro">
            <h3>PioLinx Engineering Services</h3><p>is a firm specializing in Architectural Design, Structural Design and Construction.
            Our team aims to deliver all projects in the committed time frame with at most care and consideration for quality. 
            Every client is our asset and customer satisfaction is our main priority.</p>
        </div>
        <div class="grid">
            <div >
                <p>Architectural Design</p>
                <div class="overlay">Hch drun d'Wéën Blieder en. Dat op ma'n brét Dauschen,
                 mä mat botze Stréi Faarwen. Ass Zalot d'Loft un, net Kirmesdag d'Meereische am. Jo gét ruffen Stieren.</div>
                 <img src="/storage/images/ad.JPG">
            </div>
            <div>
                <p>Structural Design</p>
                <div class="overlay" >Hch drun d'Wéën Blieder en. Dat op ma'n brét Dauschen,
                 mä mat botze Stréi Faarwen. Ass Zalot d'Loft un, net Kirmesdag d'Meereische am. Jo gét ruffen Stieren.</div>
                <img src="/storage/images/sd.JPG">
            </div>
            <div>
                <p>Construction</p>
                <div class="overlay">Hch drun d'Wéën Blieder en. Dat op ma'n brét Dauschen,
                 mä mat botze Stréi Faarwen. Ass Zalot d'Loft un, net Kirmesdag d'Meereische am. Jo gét ruffen Stieren.</div>
                <img src="/storage/images/cons.JPG">
            </div>
        </div>
    </div>
    <div class="home-proj">
        <div class="intro">
            <h3><strong>OUR PROJECTS</strong></h3>
        </div>
        <div class="proj-overview">
             <div style="grid-column:1/3">
                <img src="/storage/images/proj3.jpg">
            </div>
            <div>
                <img src="/storage/images/proj2.jpg">
                <div class="proj-desc">
                    <h4>RECEPTION COUNTER AND SHELVES FABRICATION</h4>
                    <p> 
                        Ké Land Schuebersonndeg déi. Wa wéi weisen Nuechtegall.
                    </p>
                </div>
            </div>
            <div>
                <img src="/storage/images/proj4.jpg">
                <div class="proj-desc">
                    <h4>MODERN STYLE 2-STOREY RESIDENTIAL BUILDING WITH 4 BEDROOMS</h4>
                    <p>Ké Land Schuebersonndeg déi. Wa wéi weisen Nuechtegall, 
                        an nun Hierz gewalteg Kolrettchen. 
                        Nët voll ruffen d'Vioule wa, d'Wise d'Hiezer gei fu.</p>
                </div>
            </div>
             
             <div>
                <img src="/storage/images/proj1.jpg">
                 <div class="proj-desc last">
                    <h4>FOUR-STOREY SCHOOL BUILDING, ALFONSO CAVITE</h4>
                    <p> 
                        Ké Land Schuebersonndeg déi. Wa wéi weisen Nuechtegall, an nun Hierz gewalteg Kolrettchen. 
                        Nët voll ruffen d'Vioule wa, d'Wise d'Hiezer gei fu.
                    </p>
                </div>
            </div>
            <div>
                <div class="txt">
                    <h3>We just might have the service you've been looking for.</h3>
                    <a href="/projects">Find out more<span> >></span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="home-career">
        <div class="txt">
            <h1><strong>CAREERS</strong></h1>
            <h2>"Great vision without <strong style="color: #7fbf46;">great people</strong> is irrelevant."<span> —Jim Collins</span></h2>  
            <h4>Piolinx is looking for a great person like you!</h4>
            <a href="/careers">See our current openings >></a>
        </div>
    </div>
    @endsection
</div>

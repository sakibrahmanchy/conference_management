<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{$conference->title}}</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
    
  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">
  
  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">
  
  <!-- Place your favicon.ico and apple-touch-icon.png in the template root directory -->
  <link href="favicon.ico" rel="shortcut icon">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet"> 
  
  <!-- Bootstrap CSS File -->
  <link href="{{ asset("src/lib/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
  
  <!-- Libraries CSS Files -->
  <link href="{{ asset("src/lib/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet">
  <link href="{{ asset("src/lib/animate-css/animate.min.css")}}" rel="stylesheet">
  
  <!-- Main Stylesheet File -->
  <link href="{{ asset("src/css/style.css") }}" rel="stylesheet">
  
<!-- =======================================================
  Theme Name: Imperial
  Theme URL: https://bootstrapmade.com/imperial-free-onepage-bootstrap-theme/
  Author: BootstrapMade.com
  Author URL: https://bootstrapmade.com
======================================================= -->
</head>

<body>
  <div id="preloader"></div>
  
<!--==========================
  Hero Section
============================-->
  <section id="hero" style="background: url({{ route('speaker_image',['conference_id'=>$conference->id,'filename' => 'conference-cover-'.$conference->id.'.jpg']) }}) top center fixed">
    <div class="hero-container">
      <div class="wow fadeIn">
        <div class="hero-logo">
          {{--<img class="" src="img/logo.png" alt="Imperial">--}}

        </div>
        
        <h1>Welcome to {{$conference->title}}</h1>
        <h2> <span class="rotating">{{$conference->tag_lines}}</span></h2>
        <div class="actions">
          <a href="#about" class="btn-get-started">Get Started</a>
          <a href="#services" class="btn-services">Important Dates</a>
        </div>
      </div>
    </div>
  </section>
  
<!--==========================
  Header Section
============================-->
  <header id="header">
    <div class="container">
    
      <div id="logo" class="pull-left">
        <a href="#hero">{{--<img src="img/logo.png" alt="" title="" /></img>--}}</a>
        <!-- Uncomment below if you prefer to use a text image -->
        <h1><a href="#hero"> {{$conference->title}}</a></h1>
      </div>
        
      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#hero">Home</a></li>
          <li><a href="#about">Welcome</a></li>
          <li><a href="#services">Important Dates</a></li>
          <li><a href="#testimonials">Speakers</a></li>
          <li><a href="#scopes">Scopes</a></li>
          <li><a href="#committee">Committee</a></li>
          <li class="menu-has-children"><a href="#submission">Submission Terms</a>
            <ul>
                <li><a href="#submission_guidelines">Submission Guidelines</a></li>
                <li><a href="#plagiarism_policy">Plagiarism Policy</a></li>
                <li><a href="#review_policy">Review Policy</a></li>
                <li><a href="#best_paper_award">Best Paper Award</a></li>

            </ul>
          </li>
          <li><a href="#contact">Contact Us</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
    
<!--==========================
  About Section
============================-->
  <section id="about">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Welcome to {{$conference->title}}</h3>
          <div class="section-title-divider"></div>
          <p class="section-description"></p>
        </div>
      </div>
    </div>
    <div class="container about-container wow fadeInUp">
      <div class="row">
        <div class="col-md-12  about-content">
          <h2 class="about-title"></h2>
          <p class="about-text">
            {!! $conference->welcome_text !!}
          </p><br>
          <div class="text-center col-md-offset-3 col-md-6">
                <h1>Organized By</h1>
                <img width="300px" height="300px" style="margin:auto;border-radius:120px" src="{{ route('account.image',['filename' => "user-".$conference->user->id . '.jpg']) }}" alt="" class="img-responsive"/><br>
                <h3><strong>{{$conference->user->name}}</strong></h3>
                <p>{!! $conference->user->description !!}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  
<!--==========================
  Important Dates Section
============================-->
  <section id="services">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Important Dates</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Note important dates in your notebook.</p>
        </div>
      </div>
        
      <div class="row">
        <div class="col-md-4 service-item">
          <div class="service-icon"><i class="fa fa-star"></i></div>
          <h4 class="service-title"><a href="">Paper Submission Deadline</a></h4>
          <p class="service-description">{{date("F jS, Y", strtotime($conference->paper_submission_deadline))}}</p>
        </div>
        <div class="col-md-4 service-item">
          <div class="service-icon"><i class="fa fa-star"></i></div>
          <h4 class="service-title"><a href="">Notification of Acceptance Date</a></h4>
          <p class="service-description">{{date("F jS, Y", strtotime($conference->notification_of_acceptance_date))}}</p>
        </div>

        <div class="col-md-4 service-item">
          <div class="service-icon"><i  class="fa fa-star"></i></div>
          <h4 class="service-title"><a href="">Camera ready paper date</a></h4>
          <p class="service-description">{{date("F jS, Y", strtotime($conference->camera_ready_paper_date))}}</p>
        </div>
        <div class="col-md-4 service-item">
         &nbsp;
        </div>
        <div class="col-md-4 service-item">
          <div class="service-icon"><i class="fa fa-warning"></i></div>
          <h4 class="service-title"><a href="">Registration Deadline</a></h4>
          <p class="service-description">{{date("F jS, Y", strtotime($conference->registration_deadline))}}</p>
        </div>
        <div class="col-md-4 service-item">
          <div class="service-icon"><i class="fa fa-bullhorn"></i></div>
          <h4 class="service-title"><a href="">Conference Start Date</a></h4>
          <p class="service-description">{{date("F jS, Y", strtotime($conference->conference_start_date))}}</p>
        </div>
        <div class="col-md-4 service-item">
          <div class="service-icon"><i class="fa fa-bullhorn"></i></div>
          <h4 class="service-title"><a href="">Conference End Date</a></h4>
          <p class="service-description">{{date("F jS, Y", strtotime($conference->conference_start_date))}}</p>
        </div>
      </div>
    </div>  
  </section>
  
<!--==========================
  Subscrbe Section
============================-->  
  <section id="subscribe">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-8">
          <h1 class="subscribe-title">Submit Paper Now</h1>
          <p class="subscribe-text">Submit before the time is out.(View submission guideline before for proper submission)</p>
        </div>
        <div class="col-md-4 subscribe-btn-container">
          <a class="subscribe-btn" target = "_blank" href="{{route('submit_welcome',["conference_id"=>$conference->id])}}">Submit Now</a>
        </div>
      </div>
    </div>
  </section>
    

<!--==========================
  Testimonials Section
============================--> 
  <section id="testimonials" >
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Speakers</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Our Honorable Speakers</p>
        </div>
      </div>

      <?php $speakerCounter = 1; ?>
      @foreach($conference->speakers as $aSpeaker)
            @if($speakerCounter%2!=0)
               <div class="row">
                <div class="col-md-3">
                  <div class="profile">
                    <div class="pic"><img class="img-responsive" src="{{ route('speaker_image',['conference_id'=>$conference->id,'filename' => 'speaker-'.$aSpeaker->id.'.jpg']) }}" alt=""></div>
                    <h4>{{$aSpeaker->name}}</h4>
                    <span>{{$aSpeaker->profession}},{{$aSpeaker->name}}</span>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="quote">
                    <b><img src={{asset("src/img/quote_sign_left.png")}}  alt=""></b> {{$aSpeaker->biography}} <small><img src="{{asset("src/img/quote_sign_right.png")}}" alt=""></small>
                  </div>
                </div>
              </div>
            @else
                 <div class="row">
                <div class="col-md-9">
                  <div class="quote">
                    <b><img class="img-responsive" src={{asset("src/img/quote_sign_left.png")}}  alt=""></b> {{$aSpeaker->biography}} <small><img src="{{asset("src/img/quote_sign_right.png")}}" alt=""></small>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="profile">
                    <div class="pic"><img src="{{ route('speaker_image',['conference_id'=>$conference->id,'filename' => 'speaker-'.$aSpeaker->id.'.jpg']) }}" alt=""></div>
                    <h4>{{$aSpeaker->name}}</h4>
                    <span>{{$aSpeaker->profession}},{{$aSpeaker->name}}</span>
                  </div>
                </div>
              </div>
            @endif
            <?php $speakerCounter++; ?>
      @endforeach



    </div>

  </section>


 <!--==========================
  Scopes Section
============================-->
  <section id="scopes">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title" style="margin-top:50px">Scopes</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Conference Scopes</p>
        </div>
      </div>
<br><br><br>
       <?php $trackCounter = 1; ?>
    @foreach($conference->tracks as $aTrack)
   <div class="panel-group" id="accordion" style="color:black   ">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a  onclick = collapseBar({{$trackCounter}})      >Track {{$trackCounter}}: {{ $aTrack->track_name }} </a>

        </h4>
      </div>
      <div id="collapse{{ $trackCounter }}" class="panel-collapse collapse @if($trackCounter==1) in @endif" >
        <div class="panel-body" >{{$aTrack->description}}
        <br><br>
        <div class="col-md-6">
            <ul>
            @foreach($aTrack->scopes as $aScope)
                <li>{{@$aScope->name}}

                </li>
            @endforeach
            <br><br>
            <?php $trackCounter++ ?>
            </ul>
            <br><br>

        </div>
        <div class="col-md-6 thumbnail">
           <img src="{{ route('track_image',['conference_id'=>$conference->id,'filename' => 'track-'.$aTrack->id . '.jpg']) }}" alt="" class="img-responsive"/>
        </div>
      </div>
    </div>
    </div>
    @endforeach
    </div>
   </div>
  </section>


 <!--==========================
  Committee Section
============================-->
  <section id="committee" class="alternate">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title" >Committee</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Conference Committee</p>
        </div>
      </div>

        <?php $committeeCounter = 1; ?>
    @foreach($conference->committees as $aCommittee)
       <div class="panel-group" id="accordion" style="color:black   ">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a  onclick = collapseBarCommittee({{$committeeCounter}})  >Committee {{$committeeCounter}}: {{ $aCommittee->name }} </a>
            </h4>
          </div>
          <div id="collapse-committee{{$committeeCounter}}" class="panel-collapse collapse @if($committeeCounter == 1) in @endif" >
            <div class="panel-body">{!! $aCommittee->description !!}</div>
            @php $committeeCounter++; @endphp
        </div>
        </div>
    @endforeach


    </div>
   </div>
  </section>







<!--==========================
  Submission Section
============================-->

<section id="submission" >
    <div class="container wow fadeInUp">

      <div class="row alternate-2" id ="submission_guidelines">
        <div class="col-md-12">
          <h3 class="section-title">Submission Guidelines</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">{!! $conference->submission_guideline !!}</p>
        </div>
      </div>


      <div class="row" id ="plagiarism_policy" >
        <div class="col-md-12">
          <h3 class="section-title">Plagiarism Policy</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">{!!$conference->plagiarism_policy !!}</p>
        </div>
      </div>


      <div class="row" style="margin-top:20px" id ="review_policy" >
        <div class="col-md-12">
          <h3 class="section-title">Review Policy</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">{!! $conference->review_policy !!}</p>
        </div>
      </div>


      <div class="row" style="margin-top:20px" id ="best_paper_award">
        <div class="col-md-12">
          <h3 class="section-title">Best Paper Award</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">{!! $conference->best_paper_award !!}</p>
        </div>
      </div>


    </div>
  </section>


    
<!--==========================
  Contact Section
============================--> 
  <section id="contact" class="text-center">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Contact Us</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Contact us for any inquiries</p>
        </div>
      </div>

        <div>{!! $conference->venue !!}</div>
        
      </div>
    </div>
  </section>
  
<!--==========================
  Footer
============================--> 
  <footer id="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="copyright">
              &copy; Copyright <strong>Conf-Master</strong>. All Rights Reserved
            </div>
            <div class="credits">
              <!-- 
                All the links in the footer should remain intact. 
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Imperial
              -->
              {{--Bootstrap Themes by <a href="https://bootstrapmade.com/">BootstrapMade</a>--}}
            </div>
          </div>
        </div>
      </div>
  </footer><!-- #footer -->


  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    
  <!-- Required JavaScript Libraries -->
  <script src="{{ asset("src/lib/jquery/jquery.min.js")}}"></script>
  <script src="{{ asset("src/lib/bootstrap/js/bootstrap.min.js")}}"></script>
  <script src="{{ asset("src/lib/superfish/hoverIntent.js")}}"></script>
  <script src="{{ asset("src/lib/superfish/superfish.min.js")}}"></script>
  <script src="{{ asset("src/lib/morphext/morphext.min.js")}}"></script>
  <script src="{{ asset("src/lib/wow/wow.min.js")}}"></script>
  <script src="{{ asset("src/lib/stickyjs/sticky.js")}}"></script>
  <script src="{{ asset("src/lib/easing/easing.js")}}"></script>
  
  <!-- Template Specisifc Custom Javascript File -->
  <script src="{{ asset("src/js/custom.js")}}"></script>

  
  <script src="{{ asset("src/contactform/contactform.js")}}"></script>

   <script>

   function collapseBar(id){
         $("#collapse"+id).fadeToggle();
   }

   function collapseBarCommittee(id){
        $("#collapse-committee"+id).fadeToggle();
   }

  </script>

    
</body>
</html>
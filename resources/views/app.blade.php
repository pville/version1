<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
       
        <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/media.css') }}">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css" media="all" />
		<link href='//fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
        <script src="{{ asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
<header>
<div class="container">
    	<div class="row">
        	<div class="col-md-4 col-sm-4">
            	<h1><a href="#"><img class="logo" src="images/logo.jpg" alt="Pleasent"></a></h1>
            </div>
            <div class="col-md-8 col-sm-8">
            	<nav class="navbar navbar-inverse" role="navigation">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
					<ul>
              		@if (Auth::guest())
              		
                        <li class="signup"><a class="signupbtn" href="{{ url('/register/volunteer') }}">Sign up</a><a class="loginbtn" href="{{ url('/login') }}">Log in</a></li>
                   
						
					@else
						<li class="signup"><a class="signupbtn" href="{{ url('/dashboard') }}">{ Auth::user()->email }}</a></li>
						
					@endif
                	 </ul>
                </div><!--/.navbar-collapse -->
    			</nav>
            </div>
    	</div>
    </div>
</header>   



@yield('content')

<footer>
	<div class="container">
    	<div class="row">
        	<div class="col-md-12 col-sm-12">  
            	<ul>
                	<li><h2>COMPANY</h2></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Meet the team</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
                <ul>
                	<li><h2>ACCOUNT</h2></li>
                    <li><a href="#">Payments</a></li>
                    <li><a href="#">Subscription</a></li>
                    <li><a href="#">Gift Card</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
                <ul>
                	<li><h2>HELP</h2></li>
                     <li><a href="#">Payments</a></li>
                    <li><a href="#">Subscription</a></li>
                    <li><a href="#">Gift Card</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
                <ul>
                	<li><h2>LEGAL</h2></li>
                     <li><a href="#">Payments</a></li>
                    <li><a href="#">Subscription</a></li>
                    <li><a href="#">Gift Card</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
                <ul>
                	<li><h2>FOLLOW US</h2></li>
                     <li class="smedia">
                     	<a class="gplus">Gplus</a>
                        <a class="faceicon">Facebook</a>
                        <a class="twitter">twitter</a>                     
                     </li>
                    
                </ul>
            </div>
       </div>
       
       	<div class="row copyright">
        	<div class="col-md-7 col-sm-7">  
            	<ul>
                	<li><img src="images/phone_icon.png" alt="" />(0) 123-456-789-00</li><li>|</li>
                    <li><img src="images/chart_icon.png" alt="" />awesomemail@ourmail.com</li>
                </ul>
            </div>
            <div class="col-md-5 col-sm-5 text-right">  
            	<p>Copyright 2015.All rights resrved.</p>
            </div>
       	</div>
   </div>
</footer>	
<div class="container footerwrap">
    	<div class="row">
        	<div class="col-md-12 col-sm-12">
				<p>Copyright 2015.All rights resrved.</p>
                <a id="top" href="#">Top</a>
            </div>
       </div>
</div>
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/animate.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/main.js') }}"></script>

       
    </body>
</html>


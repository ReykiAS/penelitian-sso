<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('fonts/nunito.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fonts/muli.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/codebase.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cropper.css') }}" rel="stylesheet">
    <style>
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Lato', 'Arial', sans-serif;
        }

        /* HEADINGS */

        h1, p {
        color: #fff;
        text-align: center;
        line-height: 1.4;
        }

        h1 {
        font-size: 2.2rem;
        }

        h2 {
        color: #000;
        font-size: 1.3rem;
        text-align: center;
        line-height: 1.4;
        margin-bottom: 10px;
        }

        /* BASIC SETUP */

        .page-wrapper {
        width: 100%;
        height: auto;
        }

        .nav-wrapper {
        width: 100%;
        position: -webkit-sticky; /* Safari */
        position: sticky;
        top: 0;
        background-color: #fff;
        }

        .grad-bar {
        width: 100%;
        height: 5px;
        background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);
        background-size: 400% 400%;
            -webkit-animation: gradbar 15s ease infinite;
            -moz-animation: gradbar 15s ease infinite;
            animation: gradbar 15s ease infinite;
        }

        /* NAVIGATION */

        .navbar {
        display: grid;
        grid-template-columns: 1fr 3fr;
        align-items: center;
        height: 50px;
        overflow: hidden;
        }

        .navbar img {
        height: 16px;
        width: auto;
        justify-self: start;
        margin-left: 20px;
        }

        .navbar ul {
        list-style: none;
        /*display: grid;*/
        /*grid-template-columns: repeat(6,1fr);*/
        justify-self: end;
        
        }

        .nav-item a {
        color: #000;
        font-size: 0.9rem;
        font-weight: 400;
        text-decoration: none;
        transition: color 0.3s ease-out;
        }

        .nav-item a:hover {
        color: #3498db;
        }

        /* SECTIONS */

        .headline {
        width: 100%;
        height: 20vh;
        min-height: 150px;
        background-color: #a10000;
        background-size: cover;
        display: flex;
        flex-direction: column;
        justify-content: center;
        }

        .features {
        width: 100%;
        height: auto;
        background-color: #f1f1f1;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        padding: 10px 10px;
        justify-content: flex-start;
        }

        .features h3 {
        width: 100%;
        height: auto;
        background-color: #f1f1f1;
        display: block;
        padding: 10px 20px;
        }

        .feature-container {
        flex-basis: 30%;
        margin-top: 10px;
        }

        .feature-container p {
        color: #000;
        text-align: center;
        line-height: 1.4;
        margin-bottom: 15px;
        }

        .feature-container img {
        width: 100%;
        margin-bottom: 15px;
        }

        /* SEARCH FUNCTION */

        #search-icon {
        font-size: 0.9rem;
        margin-top: 3px;
        margin-left: 15px;
        transition: color 0.3s ease-out;
        }

        #search-icon:hover {
        color: #3498db;
        cursor: pointer;
        }

        .search {
        transform: translate(-35%);
        -webkit-transform: translate(-35%);
        transition: transform 0.7s ease-in-out;
        color: #3498db;
        }

        .no-search {
        transform: translate(0);
        transition: transform 0.7s ease-in-out;
        }

        .search-input {
        position: absolute;
        top: -4px;
        right: -125px;
        opacity: 0;
        z-index: -1;
        transition: opacity 0.6s ease;
        }

        .search-active {
        opacity: 1;
        z-index: 0;
        }

        input {
        border: 0;
        border-left: 1px solid #ccc;
        border-radius: 0; /* FOR SAFARI */
        outline: 0;
        padding: 5px;
        }

        /* MOBILE MENU & ANIMATION */

        .menu-toggle .bar{
        width: 25px;
        height: 3px;
        background-color: #3f3f3f;
        margin: 5px auto;
        -webkit-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        }

        .menu-toggle {
        justify-self: end;
        margin-right: 25px;
        display: none;
        }

        .menu-toggle:hover{
        cursor: pointer;
        }

        #mobile-menu.is-active .bar:nth-child(2){
        opacity: 0;
        }

        #mobile-menu.is-active .bar:nth-child(1){
        -webkit-transform: translateY(8px) rotate(45deg);
        -ms-transform: translateY(8px) rotate(45deg);
        -o-transform: translateY(8px) rotate(45deg);
        transform: translateY(8px) rotate(45deg);
        }

        #mobile-menu.is-active .bar:nth-child(3){
        -webkit-transform: translateY(-8px) rotate(-45deg);
        -ms-transform: translateY(-8px) rotate(-45deg);
        -o-transform: translateY(-8px) rotate(-45deg);
        transform: translateY(-8px) rotate(-45deg);
        }

        /* KEYFRAME ANIMATIONS */

        @-webkit-keyframes gradbar {
            0% {
                background-position: 0% 50%
            }
            50% {
                background-position: 100% 50%
            }
            100% {
                background-position: 0% 50%
            }
        }

        @-moz-keyframes gradbar {
            0% {
                background-position: 0% 50%
            }
            50% {
                background-position: 100% 50%
            }
            100% {
                background-position: 0% 50%
            }
        }

        @keyframes gradbar {
            0% {
                background-position: 0% 50%
            }
            50% {
                background-position: 100% 50%
            }
            100% {
                background-position: 0% 50%
            }
        }

        /* Media Queries */

        /* Mobile Devices - Phones/Tablets */

        @media only screen and (max-width: 720px) { 
        .features {
            flex-direction: column;
            padding: 50px;
        }
        
        /* MOBILE HEADINGS */
        
        h1 {
            font-size: 1.9rem;
        }
        
        h2 {
            font-size: 1rem;
        }
        
        p {
            font-size: 0.8rem;
        }
        
        /* MOBILE NAVIGATION */
            
        .navbar ul {
            display: flex;
            flex-direction: column;
            position: fixed;
            justify-content: start;
            top: 55px;
            background-color: #fff;
            width: 100%;
            height: calc(100vh - 55px);
            transform: translate(-101%);
            text-align: center;
            overflow: hidden;
            float: right;
        }
        
        .navbar li {
            padding: 15px;
        }
        
        .navbar li:first-child {
            margin-top: 50px;
        }
        
        .navbar li a {
            font-size: 1rem;
        }
        
        .menu-toggle, .bar {
            display: block;
            cursor: pointer;
        }
        
        .mobile-nav {
        transform: translate(0%)!important;
        }
        
        /* SECTIONS */
        
        .headline {
            height: 20vh;
        }
            
        .feature-container p {
            margin-bottom: 25px;
        }
        
        .feature-container {
            margin-top: 20px;
        }
        
        .feature-container:nth-child(2) {
            order: -1;
        }
        
        /* SEARCH DISABLED ON MOBILE */
        
        #search-icon {
            display: none;
        }
        
        .search-input {
        display: none;
        }
        
        }
    </style>
</head>
<body>
<div class="page-wrapper">
                <header>
                <div class="content-header">
                    <div class="content-header-section">
                        <a class="logo" href="#">
                            <img src="{{url('/images/logo_sso.png')}}" width="100px" height="60" alt="home" />
                        </a>
                    </div>
                    <div class="content-header-section">
                        <ul class="nav-main-header">
                            <li>
                            <form method="POST" id="logout" action="{{ route('logout') }}">
                            @csrf
                            <a type="submit" onClick="$('#logout').submit();"><i class="fas fa-sign-out-alt"></i>Logout</a>
                            </form>
                                <!-- <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i>Logout</a> -->
                            </li>
                        </ul>
                        <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button>
                    </div>
                </div>
                <div id="page-header-loader" class="overlay-header bg-primary">
                    <div class="content-header content-header-fullrow text-center">
                        <div class="content-header-item">
                            <i class="fa fa-sun-o fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
            </header>
    <section class="headline">
        @yield('header')
    </section>
    <section class="features">
        @yield('content')
    </section>
</div>
</body>
<script>
$(document).ready(function() {
    $('.menu-toggle').click(function(){
        $(".nav").toggleClass("mobile-nav");
        $(this).toggleClass("is-active");
    });
});
</script>
</html>

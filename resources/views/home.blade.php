@extends('layouts.app')

@section('header')
    <h1>Responsive Navigation</h1>
    <p>Using CSS grid and flexbox to easily build navbars!</p>
@endsection

@section('content')
<style>
    .block {
        display: block;
        width: 100%;
        height: 100%;
        border: none;
        background-color: #FFFFFF;
        color: white;
        padding: 14px 28px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
    }
    .block i {
        margin-top: 5%;
    }
</style>
<h3>Internal Application</h3>
<div class="feature-container">
    <a class="button block" href="{{ $loginUrl }}" ><span><i class="fa-solid fa-comment fa-2x" style="color: #013880"></i><p class="" style="color: #013880">Login Wifi Manual</p></span></a>
</div>
<div class="feature-container">
    <form action="{{ $loginPostUrl }}" method="POST">
        <input type="hidden" name="authtype" value="{{ $authtype }}">
        <input type="hidden" name="usrName" value="{{ $usrName }}">
        <input type="hidden" name="pwd" value="{{ $pwd }}">
        <input type="hidden" name="portalType" value="{{ $portalType }}">
        <input type="hidden" name="gw_ip" value="{{ $gw_ip }}">
        <input type="hidden" name="ip" value="{{ $ip }}">
        <input type="hidden" name="mac" value="{{ $mac }}">
        <input type="hidden" name="net" value="{{ $net }}">
        <input type="hidden" name="rmac" value="{{ $rmac }}">
        <input type="hidden" name="tabs" value="{{ $tabs }}">
        <input type="hidden" name="cf" value="{{ $cf }}">
        <input type="hidden" name="mobile" value="{{ $mobile }}">
        <input type="hidden" name="hq" value="{{ $hq }}">
        <input type="hidden" name="poup" value="{{ $poup }}">
        <input type="hidden" name="langSw" value="{{ $langSw }}">
        <input type="hidden" name="url" value="{{ $url }}">
        <button class="button block" type="submit" ><span><i class="fa-solid fa-comment fa-2x" style="color: #013880"></i><p class="" style="color: #013880">Login Wifi Otomatis</p></span></button>
    </form>
</div>
<div class="feature-container">
    <a class="button block" href="https://igracias.ittelkom-sby.ac.id/" ><span><i class="fa-solid fa-comment fa-2x" style="color: #013880"></i><p class="" style="color: #013880">I-Gracias</p></span></a>
</div>
<div class="feature-container">
    <a class="button block" href="https://igracias.ittelkom-sby.ac.id/" ><span><i class="fa-solid fa-comment fa-2x" style="color: #013880"></i><p class="" style="color: #013880">I-Gracias</p></span></a>
</div>
<div class="feature-container">
    <a class="button block" href="https://igracias.ittelkom-sby.ac.id/" ><span><i class="fa-solid fa-comment fa-2x" style="color: #013880"></i><p class="" style="color: #013880">I-Gracias</p></span></a>
</div>
<div class="feature-container">
    <a class="button block" href="https://igracias.ittelkom-sby.ac.id/" ><span><i class="fa-solid fa-comment fa-2x" style="color: #013880"></i><p class="" style="color: #013880">I-Gracias</p></span></a>
</div>
<h3>Services</h3>
<div class="feature-container">
    <a class="button block" href="https://igracias.ittelkom-sby.ac.id/" ><span><i class="fa-solid fa-comment fa-2x" style="color: #013880"></i><p class="" style="color: #013880">I-Gracias</p></span></a>
</div>
<div class="feature-container">
    <a class="button block" href="https://igracias.ittelkom-sby.ac.id/" ><span><i class="fa-solid fa-comment fa-2x" style="color: #013880"></i><p class="" style="color: #013880">I-Gracias</p></span></a>
</div>
<div class="feature-container">
    <a class="button block" href="https://igracias.ittelkom-sby.ac.id/" ><span><i class="fa-solid fa-comment fa-2x" style="color: #013880"></i><p class="" style="color: #013880">I-Gracias</p></span></a>
</div>
<div class="feature-container">
    <a class="button block" href="https://igracias.ittelkom-sby.ac.id/" ><span><i class="fa-solid fa-comment fa-2x" style="color: #013880"></i><p class="" style="color: #013880">I-Gracias</p></span></a>
</div>
<div class="feature-container">
    <a class="button block" href="https://igracias.ittelkom-sby.ac.id/" ><span><i class="fa-solid fa-comment fa-2x" style="color: #013880"></i><p class="" style="color: #013880">I-Gracias</p></span></a>
</div>
<div class="feature-container">
    <a class="button block" href="https://igracias.ittelkom-sby.ac.id/" ><span><i class="fa-solid fa-comment fa-2x" style="color: #013880"></i><p class="" style="color: #013880">I-Gracias</p></span></a>
</div>
@endsection

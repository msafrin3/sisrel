@extends('layouts.admin')
@section('admin', 'active')
@section('title', 'Welcome')
@section('content')

    <div class="row row-eq-spacing-lg">
        <div class="col-lg-9">
            <div class="content">
                <h1 class="content-title">
                    Welcome to Laravel Admin 7
                </h1>
            </div>
            <div class="card">
                <h2 class="card-title">
                    INTRODUCTION
                </h2>
                
                <span><a href="#">Laravel Admin</a> is administrative interface builder for laravel which can help you build CRUD backends just with few lines of code.</span>
                
            </div>
            <div class="card">
                <h2 class="card-title">
                    INSTALLATION GUIDE
                </h2>
                
                <ul>
                    <li>Configure <code class="code">.env</code> file</li>
                    <li>run <code>composer install</code></li>
                    <li>run <code>php artisan key:generate</code></li>
                    <li>run <code class="code">php artisan migrate</code></li>
                </ul>
                
            </div>
            <div class="card">
                <h2 class="card-title">
                    PACKAGE INCLUDED
                </h2>
                
                <ul>
                    <li><a href="https://laravel.com/docs/7.x/authentication" target="_blank">Laravel Authentication</a></li>
                    <li><a href="https://laratrust.readthedocs.io/en/4.0/index.html" target="_blank">Laratrust 4.0</a></li>
                    <li><a href="https://laravel.com/docs/5.8/eloquent#soft-deleting" target="_blank">SoftDeletes</a></li>
                    <li><a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">Bootstrap Notify</a></li>
                    <li><a href="https://datatables.net/" target="_blank">Bootstrap DataTable</a></li>
                    <li><a href="https://fontawesome.com/" target="_blank">Font Awesome</a></li>
                    <li><a href="https://jquery.com/" target="blank">jQuery</a></li>
                    <li><a href="https://craftpip.github.io/jquery-confirm/" target="_blank">jQuery Confirm</a></li>
                </ul>
                
            </div>
        </div>
        <!-- <div class="col-lg-3 d-none d-lg-block">
            <div class="content">
                <h2 class="content-title font-size-20">
                    On this page
                </h2>
                <div class="fake-content"></div>
                <div class="fake-content"></div>
                <div class="fake-content"></div>
                <div class="fake-content"></div>
                <div class="fake-content"></div>
            </div>
        </div> -->
    </div>

@endsection
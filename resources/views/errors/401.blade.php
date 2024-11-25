<!-- run the command:
     php artisan vendor:publish --tag=laravel-errors
-->

@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))
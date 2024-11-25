<!-- run the command:
     php artisan vendor:publish --tag=laravel-errors
-->

@extends('errors::layout')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))

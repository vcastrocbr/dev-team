<!-- run the command:
     php artisan vendor:publish --tag=laravel-errors
-->

@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

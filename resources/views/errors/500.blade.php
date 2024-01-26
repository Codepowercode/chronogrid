@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@if($exception->getMessage())
        @section('message', __($exception->getMessage()))
    @else
        @section('message', __('Server Error'))
@endif


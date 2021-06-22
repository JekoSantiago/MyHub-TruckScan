{{-- @extends('errors::minimal')

@section('title', __('Laravel Error'))
@section('code', '405')
@section('message', __('Laravel Error')) --}}

@extends('errors::custom_error_layout')

@section('title', __('405 | Laravel Error'))
@section('code', '405')
@section('header', 'Laravel Error')
@section('message', __('Please contact your system administrator'))
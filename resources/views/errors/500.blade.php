@extends('errors::custom_error_layout')

@section('title', __('500 | Server Error'))
@section('code', '500')
@section('header', 'Server Error')
@section('message', __('Please contact your system administrator'))

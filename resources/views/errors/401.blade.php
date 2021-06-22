{{-- @extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error')) --}}

@extends('errors::custom_error_layout')

@section('title', __('401 | Unauthorized User'))
@section('code', '401')
@section('header', 'Unauthorized User')
@section('message', __('Please login from MyHub to restart your session'))


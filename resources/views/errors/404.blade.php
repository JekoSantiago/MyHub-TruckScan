{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}

@extends('errors::custom_error_layout', ['code' => '404'])

@section('title', __('404 | Page not found'))
@section('code', '404')
@section('header', 'Page not found')
@section('message', __('Unidentified page URL, please contact your system administrator'))
{{-- @extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired')) --}}

@extends('errors::custom_error_layout')

@section('title', __('419 | Page Expired'))
@section('code', '419')
@section('header', 'Page Expired')
@section('message', __('Please contact your system administrator'))
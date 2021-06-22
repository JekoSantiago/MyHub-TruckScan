@extends('errors::custom_error_layout')

@section('title', __('5PM | Already Locked'))
@section('code', '501')
@section('header', 'TMS is already locked')
@section('message', __('TMS is locked after 5PM. Please contact your system administrator'))

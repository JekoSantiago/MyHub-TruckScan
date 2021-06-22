{{-- @extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden')) --}}

@extends('errors::custom_error_layout')

@section('title', __('403 | Permission Denied'))
@section('code', '403')
@section('header', 'Permission Denied')
@section('message', __('You don`t have permission to access on this server, please contact your system administrator'))
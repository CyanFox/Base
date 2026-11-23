@extends('errors::minimal')

@section('title', __('Request Timeout'))
@section('code', '408')
@section('message', __('The request took longer than the server was prepared to wait'))

@extends('errors::minimal')

@section('title', __('Payload Too Large'))
@section('code', '413')
@section('message', __('The server will not accept the request, because the request entity is too large'))

@extends('errors::minimal')

@section('title', __('Proxy Authentication Required'))
@section('code', '407')
@section('message', __('You must authenticate with a proxy server before this request can be served'))


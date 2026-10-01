@extends('errors::minimal')

@section('title', __('Length Required'))
@section('code', '411')
@section('message', __('The "Content-Length" is not defined. The server will not accept the request without it'))

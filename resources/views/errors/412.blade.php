@extends('errors::minimal')

@section('title', __('Precondition Failed'))
@section('code', '412')
@section('message', __('The pre condition given in the request evaluated to false by the server'))

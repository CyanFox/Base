@extends('errors::minimal')

@section('title', __("I'm a teapot"))
@section('code', '418')
@section('message', __('Attempt to brew coffee with a teapot is not supported'))

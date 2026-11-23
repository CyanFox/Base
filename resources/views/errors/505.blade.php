@extends('errors::minimal')

@section('title', __('HTTP Version Not Supported'))
@section('code', '505')
@section('message', __('The server does not support the "http protocol" version'))

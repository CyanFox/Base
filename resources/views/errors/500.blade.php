@extends('errors::minimal')

@section('title', __('Internal Server Error'))
@section('code', '500')
@section('message', __('The server met an unexpected condition'))

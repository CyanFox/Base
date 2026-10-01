@extends('errors::minimal')

@section('title', __('Requested Range Not Satisfiable'))
@section('code', '416')
@section('message', __('The requested byte range is not available and is out of bounds'))

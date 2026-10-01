@extends('errors::minimal')

@section('title', $exception->getMessage() ?: __('Unknown error'))
@section('code', $exception->getStatusCode())
@section('message', $exception->getMessage() ?: __('An unknown error has occurred'))

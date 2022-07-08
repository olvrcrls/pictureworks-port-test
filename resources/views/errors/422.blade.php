@extends('errors::minimal')

@section('title', $exception->getMessage())
@section('code', '422')
@section('message', $exception->getMessage())
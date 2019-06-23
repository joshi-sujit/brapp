@extends('layouts.app')

@section('title',"Customers")

@section('content')

    <h1>Customers</h1>
    <customer-manager v-bind:customers="{{ $customers }}"></customer-manager>


@endsection

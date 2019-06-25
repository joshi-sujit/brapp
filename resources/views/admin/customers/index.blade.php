@extends('layouts.app')

@section('title',"Customers")

@section('content')

    <h1>Customers</h1>
    <customer-manager :initial-customers="{{ $customers }}"></customer-manager>


@endsection

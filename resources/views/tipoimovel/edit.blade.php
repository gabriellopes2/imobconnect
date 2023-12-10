@extends('adminlte::page')

@section('content')
@php
    //dd($tipoimovel);
@endphp
<x-tipoimovel.form :model="$tipoimovel"/>
@endsection
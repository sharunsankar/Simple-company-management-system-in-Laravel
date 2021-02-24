@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-2">
    <div class="navbar">
    <div class="navbar-inner">
        <ul class="nav">
            <li><a href="{{ route('companies.index') }}">All Companies</a></li>
            <li><a href="{{ route('companies.create') }}">Add Company</a></li>
            <li><a href="{{ route('employees.index') }}">All Employees</a></li>
            <li><a href="{{ route('employees.create') }}">Add Employee</a></li>
        </ul>
    </div>
</div>
    </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome {{ Auth::user()->name }}!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

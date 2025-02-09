@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Profile</h2>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Joined:</strong> {{ $user->created_at->format('d M, Y') }}</p>
</div>
@endsection

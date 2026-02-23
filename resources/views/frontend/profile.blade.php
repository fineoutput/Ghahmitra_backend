@extends('frontend.common.app')
@section('title','Profile')
@section('content')
<section class="py-5">
  <div class="container">
    <h4 class="mb-4">Profile</h4>
    <div class="card p-4">
      <p><strong>Name:</strong> {{ auth()->user()->name ?? 'Raj' }}</p>
      <p><strong>Phone:</strong> {{ auth()->user()->phone ?? '9461937396' }}</p>
      <p class="text-muted">Edit profile details here.</p>
    </div>
  </div>
</section>
@endsection
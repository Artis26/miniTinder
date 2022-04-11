@extends('layouts.app')
@section('content')
    @foreach ($users as $user)
        <div>
            <div>
                <p>This is: {{ $user->name }} {{ $user->surname }}</p>
                <p>Age: {{ $user->age }}</p>
                <p>Gender: {{ $user->gender }}</p>
                <p>Country: {{ $user->country }}</p>
                <p>City: {{ $user->city }}</p>
            </div>
            <div class="btn-group">
                <form method="post" action="/swipe_right/{{ $user->id }}">
                    @csrf
                    <button type="submit">+</button>
                </form>

                <form method="post" action="/swipe_left/{{ $user->id }}">
                    @csrf
                    <button type="submit">-</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection

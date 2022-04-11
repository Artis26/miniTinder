@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="/update">
                    @csrf
                    <div>
                        <h1>Profile setup: </h1>
                        <p>Edit your profile:</p>
                        <hr>
                        <label for="name"><b>Name</b></label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}" required>

                        <label for="surname"><b>Surname</b></label>
                        <input type="text" name="surname" id="surname" value="{{ $user->surname }}" required>

                        <label for="gender"><b>Gender</b></label>
                        <select name="gender" id="gender">
                            <option value="{{ $user->gender }}" selected hidden>{{ $user->gender }}</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>

                        <label for="age"><b>Age</b></label>
                        <input type="number" name="age" id="age" value="{{ $user->age }}" required>

                        <label for="country"><b>Country</b></label>
                        <input type="text" name="country" id="country" value="{{ $user->country }}" required>

                        <label for="city"><b>City</b></label>
                        <input type="text" name="city" id="city" value="{{ $user->city }}" required>
                        <hr>
                        <button type="submit" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

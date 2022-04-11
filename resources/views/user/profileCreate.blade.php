@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="/user/create_profile" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <h1>Profile setup: </h1>
                        <p>Please fill in this form, to finish registration.</p>
                        <hr>
                        <label for="name"><b>Name</b></label>
                        <input type="text" name="name" id="name" required>

                        <label for="surname"><b>Surname</b></label>
                        <input type="text" name="surname" id="surname" required>

                        <label for="gender"><b>Gender</b></label>
                        <select name="gender" id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>

                        <label for="age"><b>Age</b></label>
                        <input type="number" name="age" id="age" required>

                        <label for="country"><b>Country</b></label>
                        <input type="text" name="country" id="country" required>

                        <label for="city"><b>City</b></label>
                        <input type="text" name="city" id="city" required>

                        <input type="file" name="picture" id="picture" required>

                        <label for="description"><b>Description</b></label>
                        <input type="text" name="description" id="description" value="This is description" required>
                        <hr>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layout')

@section('content')
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $profile->first_name }}"
                required>
            <button type="submit" class="btn btn-primary mt-2">Save First Name</button>
        </div>
    </form>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $profile->last_name }}"
                required>
            <button type="submit" class="btn btn-primary mt-2">Save Last Name</button>
        </div>
    </form>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="birthday_date" class="form-label">Birthday</label>
            <input type="date" class="form-control" id="birthday_date" name="birthday_date"
                value="{{ $profile->birthday_date }}" required>
            <button type="submit" class="btn btn-primary mt-2">Save Birthday</button>
        </div>
    </form>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="sex" class="form-label">Sex</label>
            <select class="form-control" id="sex" name="sex" required>
                <option value="0" {{ $profile->sex == '0' ? 'selected' : '' }}>Male</option>
                <option value="1" {{ $profile->sex == '1' ? 'selected' : '' }}>Female</option>
                <option value="2" {{ $profile->sex == '2' ? 'selected' : '' }}>Other</option>
            </select>
            <button type="submit" class="btn btn-primary mt-2">Save Sex</button>
        </div>
    </form>
@endsection

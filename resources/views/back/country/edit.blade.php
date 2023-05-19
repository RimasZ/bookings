@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Edit country</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('countries-update', $country)}}" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Country title</label>
                            <input type="text" class="form-control" name="title" value={{old('title', $country->title)}}>
                            <div class="form-text">Please add Country title here</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Season</label>
                            <input type="text" class="form-control" name="title" value={{old('season', $country->season)}}>
                            <div class="form-text">Please add season name here</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
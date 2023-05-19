@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Add Hotel</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('hotels-store')}}" method="post">

                        <div class="container">
                            <div class="row">
                                <div class="col-8">


                                    <div class="mb-3">
                                        <label class="form-label">Hotel Title</label>
                                        <input type="text" class="form-control" name="title" value={{old('title', $hotel->title)}}>
                                        <div class="form-text">Please add Hotel title here</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Hotel Price</label>
                                        <input type="text" class="form-control" name="price" value={{old('price', $hotel->price)}}>
                                        <div class="form-text">Please add product here</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Holiday duration</label>
                                        <input type="text" class="form-control" name="duration" value={{old('duration', $hotel->duration)}}>
                                        <div class="form-text">Please add holiday duration here</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Hotel country</label>
                                    <select class="form-select --country--select" name="country_id" data-url="{{route('products-colors')}}" data-url-name="{{route('products-color-name')}}">
                                        <option value="0">Countries list</option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->title}} ({{$country->season}})</option>
                                        @endforeach
                                    </select>
                                    <div class="form-text">Please select hotel country here</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Hotel picture photo</label>
                                    <input type="file" class="form-control" name="photo">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="mt-5 btn btn-outline-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
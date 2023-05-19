@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Hotels List</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($hotels as $hotel)
                        <li class="list-group-item">
                            <div class="products-list">
                                <div class="product">
                                    <div class="title-price container">
                                        <div class="row">
                                        <div class="photo col-4">
                                            @if($hotel->photo)
                                            <img src="{{asset('hotel-photo') .'/t_'. $hotel->photo}}">
                                            @else
                                            <img src="{{asset('hotel-photo') .'/no.png'}}">
                                            @endif
                                        </div>
                                        <div class="col-8">
                                            <h2>{{$hotel->title}}</h2>
                                            <h3>{{$hotel->price}} EUR</h3>
                                            <h3>{{$countries->find($hotel->country_id)->title}}</h3>
                                            
                                        </div>
                                    </div>
                                        @if(Auth::user()->role < 5)
                                        <div class="buttons">
                                            <a href="{{route('hotels-edit', $hotel)}}" class="btn btn-outline-success">Edit</a>
                                            <form action="{{route('hotels-delete', $hotel)}}" method="post">
                                                <button type="submit" class="btn btn-outline-danger">delete</button>
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                    {{-- <div><h3>{{$hotel->title}}</h3></div> --}}
                                </div>
                            

                        </li>
                        @empty
                        <li class="list-group-item">
                            <div class="cat-line">No products</div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
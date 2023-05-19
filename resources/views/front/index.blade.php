@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
                    
            <div class="card mt-5">
                <div class="card-header">
                    <h2>Hotels</h2>
                    <form action="{{route('front-index')}}" method="get">

                        <div class="container">
                            <div class="row">

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Sort</label>
                                        <select class="form-select" name="sort">
                                            @foreach($sortSelect as $value => $text)
                                            <option value="{{$value}}" @if($value===$sort) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">Please select your sort preferences</div>
                                    </div>
                                </div>
                            </div>
                                <div class="col-2">
                                    <div class="sort-filter-buttons">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{route('front-index')}}" class="btn btn-danger">clear</a>
                                    </div>
                                </div>

                            
                        </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($hotels as $hotel)
                        <li class="list-group-item">
                        <div class="hotel-line">
                            <div class="hotel-info">
                                <div class="row justify-content-between">
                                    <div class="photo col-4">
                                        @if($hotel->photo)
                                        <img src="{{asset('hotel-photo') .'/t_'. $hotel->photo}}">
                                        @else
                                        <img src="{{asset('hotel-photo') .'/no.png'}}">
                                        @endif
                                    </div>
                                    <div class="hotel-name col-6">
                                        <a href="{{route('front-show-hotel', $hotel)}}">
                                            <h2>{{$hotel->title}}</h2>
                                        </a>
                                        <h3>{{$countries->find($hotel->country_id)->title}}</h3>
                                        
                                    </div>
                                
                                
                                <div class="buy col-2">
                                    <span>{{$hotel->price}} eur</span>
                                    <form action="{{route('orders-buy')}}" method="post">
                                        
                                        <input type="hidden" name="id" value={{$hotel}}>
                                        <input type="hidden" name="price" value={{$hotel->price}}>
                                        <button type="submit" class="btn btn-primary">Order</button>
                                    </form>
                                    {{-- <span>{{$hotel->price}} eur</span>
                                    <section class="--add--to--cart" data-url="">
                                        <button type="button" class="btn btn-primary">Order</button>
                                        <input type="hidden" name="id" value={{$hotel->id}}>
                                    </section> --}}
                                </div>
                            </div>
                            </div>
                        </div>
                    </li>
                        @empty
                        <li class="list-group-item">
                            No products
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
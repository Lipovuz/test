@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 center-div">
            <div class="card">
                <div class="wrapper">
                    <div class="left_block">
                        <img class="image" alt="" src="{{$user->image}}">
                    </div>
                    <div class="right_block">
                        <b>{{'Імя'}} :</b> {{$user->name}}
                        <br>
                        <b>{{'Email'}}  :</b> {{$user->email}}
                    </div>
                </div>
                <a href="{{ route('profile.update') }}" class="btn btn-sm btn-success ml-3 pull-right">
                    {{ __('Редагувати') }}
                </a>
            </div>
        </div>
    </div>
@stop

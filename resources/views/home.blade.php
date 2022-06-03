@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>{{ __('Нотатки') }}</b>
                    <a href="{{route('get.note.create')}}" class="btn btn-sm btn-success ml-3 pull-right">
                        {{ __('Створити нотатку') }}
                    </a>
                </div>

                <div class="card-body">
                    @foreach($user->notes as $note)
                        <div class="wrapper" style="display: inline-block; vertical-align: middle;">
                            <div class="left_block">
                                <img class="img" alt="" src="{{$user->image}}">
                            </div>
                            <div>
                                <b>{{$note->name}}</b>
                                <br>
                                <p>{{$note->text}}</p>

                            </div>
                            <div class="pull-right">
                                <a href="{{route('note.remove', $note->id)}}" class="btn btn-sm btn-danger">
                                    {{ __('Видалити') }}
                                </a>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

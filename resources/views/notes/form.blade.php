@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 center-div">
            <div class="card">
                <form method="post">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="col-md-10 center-div">
                            <div class="form-group">
                                <label> {{ __('Назва')}} </label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name">
                                @error('name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label> {{ __('Опис') }} </label>
                                <input type="text" class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" name="text">
                                @error('text') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-flat pull-right">
                                {{ __('Зберегти') }}
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-danger pull-right btn-flat">
                                {{ __('Відмінити') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 center-div">
            <div class="card">
                <form method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$user->id}}}">
                    <div class="card-body">
                        <div class="col-md-10 center-div">
                            <div class="form-group">
                                <label> {{__('Фото')}} </label>
                                <input type="file" class="form-control {{ $errors->has('local_path') ? 'is-invalid' : '' }}" name="local_path" value="{{ $user->image }}">
                                @error('local_path') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label> {{ __('Ім\'я')}} </label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ $user->name }}">
                                @error('name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label> {{ __('Пошта') }} </label>
                                <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ $user->email }}">
                                @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>

                            <div class="form-group">
                                <label> {{ __('Пароль') }} </label>
                                <input type="text" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password">
                                @error('password') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>

                            <div class="form-group">
                                <label> {{ __('Повторіть пароль') }} </label>
                                <input type="text" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation">
                                @error('password_confirmation') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                                <button type="submit" class="btn btn-primary btn-flat pull-right">
                                    {{ __('Редагувати') }}
                                </button>
                                <a href="{{ route('profile') }}" class="btn btn-danger pull-right btn-flat">
                                    {{ __('Відмінити') }}
                                </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

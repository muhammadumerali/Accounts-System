@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.credential.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.credentials.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="platform">{{ trans('cruds.credential.fields.platform') }}</label>
                <input class="form-control {{ $errors->has('platform') ? 'is-invalid' : '' }}" type="text" name="platform" id="platform" value="{{ old('platform', '') }}">
                @if($errors->has('platform'))
                    <span class="text-danger">{{ $errors->first('platform') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.credential.fields.platform_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.credential.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.credential.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="password">{{ trans('cruds.credential.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.credential.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.credential.fields.comment') }}</label>
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{{ old('comment') }}</textarea>
                @if($errors->has('comment'))
                    <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.credential.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>
                <div class="card-body">
                    @if(Session::get('success'))
                        <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                      {{Session::get('error')}}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('updatepassword') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="oldpassword" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                            <div class="col-md-6" id="oldpwderror">
                                <input id="oldpassword" type="password" class="form-control{{ $errors->has('oldpassword') ? ' is-invalid' : '' }}" name="oldpassword" placeholder="******" data-validation="required" data-validation-error-msg-container="#oldpwderror">

                                @if($errors->has('oldpassword'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('oldpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6" id="pwderror">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="******" data-validation="required" data-validation-error-msg-container="#pwderror">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('New Confirm Password') }}</label>

                            <div class="col-md-6" id="conpwderror">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" data-validation="required" placeholder="******" data-validation-error-msg-container="#conpwderror">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="captcha" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6" id="captchaerror">
                                @captcha
                                <input type="text" id="captcha" name="captcha" class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}" style="margin-top: 10px;" placeholder="Captcha" data-validation="required" data-validation-error-msg-container="#captchaerror"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('captcha') }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <button type="reset" class="btn btn-danger">
                                    {{ __('Reset') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

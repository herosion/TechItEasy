@extends('layouts.master')

@section('title', 'Administration')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Please Sign In</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url' => '/auth/login', 'method' => 'post')) !!}
                    <fieldset>
                        
                    @if($errors->has('login'))
                      <div class="form-group has-error">
                        <div class="input-group">
                          <span class="input-group-addon connec-icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                          <input type="text" value="{{ old('login') }}" name="login" class="form-control" placeholder="Login" autofocus>
                          <span class="input-group-addon"><i class="fa fa-exclamation" aria-hidden="true"></i></span>
                        </div>
                      </div>
                    @else
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon connec-icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" value="{{ old('login') }}" name="login" class="form-control" placeholder="Login" autofocus>
                          </div>
                        </div>
                    @endif

                    @if($errors->has('password'))
                      <div class="form-group has-error">
                        <div class="input-group">
                          <span class="input-group-addon connec-icon"><i class="fa fa-lock" aria-hidden="true"></i> </span>
                          <input type="password" name="password" class="form-control" placeholder="Password" autofocus>
                          <span class="input-group-addon"><i class="fa fa-exclamation" aria-hidden="true"></i></span>
                        </div>
                      </div>
                    @else
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon connec-icon"><i class="fa fa-lock" aria-hidden="true"></i></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Password" autofocus>
                          </div>
                        </div>
                    @endif

                        <div class="form-group">
                            <div id="remember" class="checkbox">
                              <label>
                                <input type="checkbox" value="yes" name="remember"> Remember me
                              </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-lg btn-extia btn-block">Connection <i class="fa fa-rocket"></i></i></button>
                    </fieldset>
                    
                {!! Form::close() !!}

                    <br>

                    <div class="text-right">
                        <a href="{{ route('email') }}" class="text-right forgot-password">
                          Forgotten password ?
                        </a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @if (count($errors) > 0)

        new Noty({
          type: 'error',
          layout: 'topRight',
          theme: 'mint',
          text: '{{ $errors->first() }}',
          timeout: 2500,
          progressBar: true,
          closeWith: ['click', 'button'],
          animation: {
            open: 'noty_effects_open',
            close: 'noty_effects_close'
          },
          id: false,
          force: false,
          killer: false,
          queue: 'global',
          container: false,
          buttons: [],
          sounds: {
            sources: [],
            volume: 1,
            conditions: []
          },
          titleCount: {
            conditions: []
          },
          modal: false
        }).show()
    @endif
@stop
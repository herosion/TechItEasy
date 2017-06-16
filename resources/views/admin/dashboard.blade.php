@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="page-header"><i class="fa fa-tachometer"></i> Dashboard</h1>
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
    
    @if (session('success'))

		  new Noty({
          type: 'success',
          layout: 'topRight',
          theme: 'mint',
          text: '{{ session('success') }}',
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
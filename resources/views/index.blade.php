@extends('layouts.master')

@section('title', 'Index')

@section('content')


<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Choisissez le questionnaire:</h3>
            </div>
            <div class="panel-body">
               <table class="table table-striped">
				    <thead>
				        <tr>
				            <th>#</th>
				            <th>title</th>
				            <th>Actions</th>
				        </tr>	
				    </thead>
				    <tbody>
			        @foreach($questionnaires as $questionnaire)
				        <tr>
				            <td>{{ $questionnaire->id }}</td>
				            <td>{{ $questionnaire->title }}</td>
				            <td>
				            	  <a class="question-badge edition-badge" href="{!! route('questionnaire.launch',$questionnaire->id) !!}" value="{{ $questionnaire->id }}" >GO</a>
				            </td>
				        </tr>
			        @endforeach
	    			</tbody>
    			</table>
    			{!! str_replace('/?', '?', $questionnaires->render()) !!}
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
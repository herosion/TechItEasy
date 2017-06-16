@extends('layouts.master')

@section('title', 'Questionnaire Extia')

@section('content')


 {!! Form::open(array('url' => '/valider', 'method' => 'post')) !!}
<div class="row">
    <div class="col-md-12">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Questionnaire Extia:</h3>
            </div>
            <div class="panel-body">
            	@if (count($aQuestionnaire) == 0)
					  No records
				@else
					<?php $i = 1; ?>
					@foreach($aQuestionnaire as $question)
						<div>
							<div><strong>Question {{$i++}}</strong></div>
						</div>
						<div>
							<div>{{ $question["label"] }}
								{!! Form::hidden('questionnaire_id', $question["questionnaire_id"]) !!}
							</div>
							<div>
								@foreach($answers[$question["id"]] as $reponses)
									<div>
										<div>{!! Form::checkbox($reponses["id"], '1' , []) !!} {{ $reponses["label"] }}</div>
									</div>
									<div class="clear"></div>
								@endforeach
							</div>
						</div>
					@endforeach

    			<div class="footer pull-right">
    				<button type="submit" class="btn btn-lg btn-extia btn-block">VALIDER</button>
				</div>
				<br /><br /><br />
				@endif
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection
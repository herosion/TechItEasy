@extends('layouts.admin')

@section('title', $questionnaire->id ? 'Modifier' : 'Ajouter' . ' un Questionnaire')

@section('page', $page)

@section('content')
<h1 class="page-header"><i class="fa fa-bookmark"></i> Questionnaire <small>"<i>{{ $questionnaire->id? 'Edition': 'Création'}}</i>"</small></h1>

<ol class="breadcrumb">
	<li><a href="{!! route('admin.questionnaire.index') !!}"><i class="fa fa-arrow-circle-left"></i> Retour</a></li>
</ol>

<div class="row">
	<div class="col-md-12">
	@if($questionnaire->id)
		<h2>Modifier le questionnaire "<i>{{ $questionnaire->title}}</i>"</h2>
	@else
		<h2>Ajouter un Questionnaire</h2>
	@endif
	</div>
</div>


<div class="row">
	<div class="col-md-6">
		{!! Form::open(array('url' => $questionnaire->id ? URL::route('admin.questionnaire.update', $questionnaire->id) : URL::route('admin.questionnaire.store'), 'method' => $questionnaire->id ? 'put' : 'post')) !!}
		{{ csrf_field() }}
		<br>
		<div class="form-group">
			{!! Form::text('title', $questionnaire->title, array('class' => 'form-control', 'placeholder' => 'Nom', '	')) !!}
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		@forelse($categories->chunk(3) as $chunk)
		<div class="col-md-2">
			<table id="cat-table">
				@forelse($chunk as $category)
				<tr>
					<td id="category-name-{{ $category->id }}">{{ $category->name }}</td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>
						 <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ $questionnaire->isCat($category->id) ? 'checked' : '' }} />
					</td>
				</tr>
				@empty
	        	@endforelse
			</table>
		</div>
		@empty
		@endforelse
	</div>
</div>

<br>
<br>

<div class="row">
	@if($questionnaire->id)
	<div class="col-md-3 ">
        <select id="search-category2" class="form-control btn-info">
            <option selected class="filtre">Filtrer par catégorie</option>
          @foreach( $categories as $category )
            <option>{{isset($category->name)? $category->name : ''}}</option>
          @endforeach
        </select>
    </div>
    <div class="col-md-1">
        <button id="eraseFiltre" type="button" class="btn btn-extia ">Effacer</button>
    </div>
    @endif

    @if($questionnaire->id)
	<div class="col-md-2 col-md-offset-3 form-group">
    	<button id="addQ" type="button" class="btn btn-extia" data-toggle="modal" data-target="#myModalQuestions" data-url="{{ route('questionsBycat') }}" data-token="{{ csrf_token() }}"> Ajouter/Supprimer des questions <i class="fa fa-plus"></i>
		</button>
    </div>
    @else
    <div class="col-md-2 form-group">
    	<button id="addQ" type="button" class="btn btn-extia" data-toggle="modal" data-target="#myModalQuestions" data-url="{{ route('questionsBycat') }}" data-token="{{ csrf_token() }}">
		  Ajouter des questions <i class="fa fa-plus"></i>
		</button>
    </div>
	@endif
</div>

<!-- Tableau des questions associées au questionnaire -->
<div class="row">
	<div class="col-md-12">
		<table id="mytable3" class="table table-striped">
		    <thead>
		        <tr>
		            <th>n°</th>
		            <th>Catégorie</th>
		            <th>Question</th>
		            <th>Description</th>
		            <th>Difficulté</th>
		            <th>Actions</th>
		        </tr>	
		    </thead>
		    <tbody class="questionsQuestionnaire">
		    	@if($questionnaire->id)
		        @foreach($questions as $question)
		        
		        <tr id="sp-{{$question->id}}" data-t="{{ $question->id}}">
		        
		            <td>{{ $question->id }}</td>
		            <td>{{ $question->category->name }}</td>
		            <td>{{ $question->label }}</td>
		            <td>{{ $question->description }}</td>
		            <td>{{ $question->level }}</td>
		            <td>
		                <a class="question-badge edition-badge" href="{!! route('admin.question.show', $question->id) !!}" value="{{ $questionnaire->id }}" ><i class="fa fa-eye"></i></a>
		            </td>
		        </tr>
		        @endforeach
		        @endif
		    </tbody>
		</table>
		{!! $questions->render() !!}
	</div>
</div>

<!-- Modal pour ajout/suppression questions -->
<div class="modal fade" id="myModalQuestions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel"><i class="fa fa-question-circle" aria-hidden="true"></i> Questions</h2>
      </div>
      <div class="modal-body">
        
		<div class="row">
			<div class="col-md-12">
				<table id="mytable4" class="table table-striped">
				    <thead>
				        <tr>
				            <th>n°</th>
				            <th>Catégorie</th>
				            <th>Question</th>
				            <th>Description</th>
				            <th>Difficulté</th>
				            <th>Sélection</th>
				        </tr>	
				    </thead>
				    <tbody class="questBycat">
				    
				    </tbody>
				</table>
			</div>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button id="addQuestions" type="button" class="btn btn-extia">Valider <i class="fa fa-check"></i></button>
      </div>
    </div>
  </div>
</div>

<div class="footer pull-right">
    <a href="{!! route('admin.questionnaire.index') !!}" class="btn btn-default ">Annuler</a>
    <button type="submit" class="btn btn-extia ">{!! $questionnaire->id ? 'Sauvegarder <i class="fa fa-check"></i>' : 'Créer <i class="fa fa-plus"></i>' !!}</i></button>
	{!! Form::close() !!}
</div>
@endsection
@extends('layouts.admin')

@section('title', $questionnaire->id ? 'Modifier' : 'Ajouter' . ' un Questionnaire')

@section('page', $page)

@section('content')
<h1 class="page-header"><i class="fa fa-bookmark"></i> Questionnaire <small>"<i>{{ $questionnaire->title}}</i>"</small></h1>

<ol class="breadcrumb">
	<li><a href="{!! route('admin.questionnaire.index') !!}"><i class="fa fa-arrow-circle-left"></i> Retour</a></li>
</ol>

<div class="row">
	<div class="col-md-6">
		<br>
		<div class="form-group">
			{!! Form::text('title', $questionnaire->title, array('class' => 'form-control', 'placeholder' => 'Nom', 'disableb' => 'disableb', '  ')) !!}
		</div>
		
		<br>

		<table>
			@forelse($categories as $category)
			<tr>
				<td id="category-name-{{ $category->id }}">{{ $category->name }}</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>
					<input type="checkbox" name="category" {{ ($questionnaire->isCat($category->id))? 'checked' : 'disabled' }} />
				</td>
			</tr>
			@empty
        	@endforelse
		</table>
	</div>
</div>

<br>

<div class="row">
	<div class="col-md-12">
		<table class="table table-striped">
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
		    <tbody>
		        @forelse($questions as $question)
		        <tr>
		            <td>{{ $question->id }}</td>
		            <td>
		            	<span class="badge btn-cat">
		            		{{ $question->category->name }}
		            	</span>
		            </td>
		            <td>{{ $question->label }}</td>
		            <td>{{ $question->description }}</td>
		            <td>{{ $question->level }}</td>
		            <td>
		                <a class="question-badge edition-badge" href="{!! route('admin.question.show', $question->id) !!}" value="{{ $questionnaire->id }}" ><i class="fa fa-eye"></i></a>
		            </td>
		        </tr>
		        @empty
		        @endforelse
		    </tbody>
		</table>
	</div>
</div>

<div class="footer pull-right">
    <a href="{!! route('admin.questionnaire.index') !!}" class="btn btn-default ">Retour</a>
    <a href="{!! route('admin.questionnaire.edit', $questionnaire->id) !!}" class="btn btn-extia ">Editer <i class="fa fa-pencil-square-o"></i></a>
</div>
@endsection
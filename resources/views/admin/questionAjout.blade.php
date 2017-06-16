@extends('layouts.admin')

@section('title', $question->id ? 'Modifier' : 'Ajouter' . ' une question')

@section('page', $page)

@section('content')

@if($question->id)
<h2 class="text-center page-header">Edition question n° {{$question->id}}</h2>
@else
<h2 class="text-center page-header">Création question</h2>
@endif

<ol class="breadcrumb">
  <li><a href="{!! route('admin.question.index') !!}"><i class="fa fa-arrow-circle-left"></i> Retour</a></li>
</ol>

{!! Form::open(array('url' => $question->id ? URL::route('admin.question.update', $question->id) : URL::route('admin.question.store'), 'method' => $question->id ? 'put' : 'post')) !!}
<div class="form-group">
    <label for="category">Catégorie</label>
    {!! Form::select('categories', $categories, $question->category_id, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="description">Question</label>
    {!! Form::text('description', $question->label, array('class' => 'form-control', 'placeholder' => 'description', 'required' => 'required')) !!}
</div>
<div class="form-group">
    <label for="question">Description</label>
    {!! Form::textArea('question', $question->description, array('class' => 'form-control', 'placeholder' => 'question', 'rows' => '3', 'required' => 'required')) !!}
</div>
<div class="form-group">
    <label for="difficulty">Difficulté</label>
    {!! Form::select('difficulties', $difficulties, $question->level, ['class' => 'form-control']) !!}
</select>
</div>

<div class="form-group">
     <label for="answer">Validité réponse 1</label>
      @if (isset($aReponses[0]))
       {!! Form::hidden('reponse_1_id', $aReponses[0]->id) !!}
       {!! Form::checkbox('reponse_valide_1', 1, $aReponses[0]->verify) !!}
       {!! Form::text('answer1', $aReponses[0]->label, array('class' => 'form-control', 'placeholder' => 'réponse 1', 'required' => 'required')) !!}
    @else
       {!! Form::checkbox('reponse_valide_1', 1) !!}
       {!! Form::text('answer1', null, array('class' => 'form-control', 'placeholder' => 'réponse 1', 'required' => 'required')) !!}
    @endif
</div>
<div class="form-group">
     <label for="answer">Validité réponse 2</label>
        @if (isset($aReponses[1]))
        {!! Form::hidden('reponse_2_id', $aReponses[1]->id) !!}
        {!! Form::checkbox('reponse_valide_2', 1,$aReponses[1]->verify) !!}
        {!! Form::text('answer2', $aReponses[1]->label, array('class' => 'form-control', 'placeholder' => 'réponse 2', 'required' => 'required')) !!}
        @else
        {!! Form::checkbox('reponse_valide_2', 1) !!}
        {!! Form::text('answer2', null, array('class' => 'form-control', 'placeholder' => 'réponse 2', 'required' => 'required')) !!} 
        @endif
</div>
<div class="form-group">
      <label for="answer">Validité réponse 3</label>
        @if (isset($aReponses[2]))
         {!! Form::hidden('reponse_3_id', $aReponses[2]->id) !!}
        {!! Form::checkbox('reponse_valide_3', 1, $aReponses[2]->verify) !!}
        {!! Form::text('answer3', $aReponses[2]->label, array('class' => 'form-control', 'placeholder' => 'réponse 3')) !!}
        @else
        {!! Form::checkbox('reponse_valide_3', 1) !!}
        {!! Form::text('answer3', null, array('class' => 'form-control', 'placeholder' => 'réponse 3')) !!}
        @endif
</div>
<div class="form-group">
       <label for="answer">Validité réponse 4</label>
        @if (isset($aReponses[3]))
         {!! Form::hidden('reponse_4_id', $aReponses[3]->id) !!}
        {!! Form::checkbox('reponse_valide_4', 1, $aReponses[3]->verify) !!}
        {!! Form::text('answer4', $aReponses[3]->label, array('class' => 'form-control', 'placeholder' => 'réponse 4')) !!}
        @else
        {!! Form::checkbox('reponse_valide_4', 1) !!}
        {!! Form::text('answer4', null, array('class' => 'form-control', 'placeholder' => 'réponse 4')) !!}
        @endif
</div>
<div class="form-group">
      <label for="answer">Validité réponse 5</label>
        @if (isset($aReponses[4]))
        {!! Form::hidden('reponse_5_id', $aReponses[4]->id) !!}
        {!! Form::checkbox('reponse_valide_5', 1, $aReponses[4]->verify) !!}
        {!! Form::text('answer5', $aReponses[4]->label, array('class' => 'form-control', 'placeholder' => 'réponse 5')) !!}
        @else
        {!! Form::checkbox('reponse_valide_5', 1) !!}
        {!! Form::text('answer5', null, array('class' => 'form-control', 'placeholder' => 'réponse 5')) !!}
        @endif 
</div>
<div class="form-group">
       <label for="answer">Validité réponse 6</label>
      @if (isset($aReponses[5]))
          {!! Form::hidden('reponse_6_id', $aReponses[5]->id) !!}
          {!! Form::checkbox('reponse_valide_6', 1, $aReponses[5]->verify) !!}
          {!! Form::text('answer6', $aReponses[5]->label, array('class' => 'form-control', 'placeholder' => 'réponse 6')) !!}
      @else
         {!! Form::checkbox('reponse_valide_6', 1) !!}
         {!! Form::text('answer6', null, array('class' => 'form-control', 'placeholder' => 'réponse 1')) !!}
      @endif
</div>

       
<div class="footer pull-right">
    <a href="{!! route('admin.question.index') !!}" class="btn btn-default ">Annuler</a>
    @if($question->id)
    <button type="submit" class="btn btn-extia">Sauvegarder <i class="fa fa-check"></i></button>
    @else
    <button type="submit" class="btn btn-extia">Créer <i class="fa fa-plus" aria-hidden="true"></i></button>
    @endif
</div>

{!! Form::close() !!}
<div>
</div>

@endsection

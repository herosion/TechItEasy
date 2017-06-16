@extends('layouts.admin')

@section('title', 'Administration')

@section('content')
<h1 class="page-header"><i class="fa fa-question-circle"></i> Ajout de réponses</h1>
<input id="nbReponse" type="hidden" value="0"/>
{!! Form::open(array('url' => route('admin.reponse.store'), 'method' => 'post')) !!}
<h4>Il y a <span id="nbReponseText">0</span> réponse(s)</h4>
<div class="margin-bottom">
    <input id="removeReponse" type="button" class="btn btn-default" value="Supprimer la dernière reponse"/>
    <input id="addReponse" type="button" class="btn btn-extia" value="Ajouter 1 réponse"/>
</div>
<div class="form-group">
</div>
<div class="footer pull-right">
    <a href="{!! route('admin.question.index') !!}" class="btn btn-default ">Annuler</a>
    <button type="submit" class="btn btn-extia">Sauvegarder</button>
</div>
{!! Form::close() !!}
<div>
</div>

@endsection

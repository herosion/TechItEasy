@extends('layouts.admin')

@section('title', 'Administration')

@section('content')

<h1 class="page-header"><i class="fa fa-question-circle"></i> Questionnaires</h1>

<div class="col-md-1 form-group">
    <a href="{!! route('admin.questionnaire.index') !!}" class="btn btn-extia">Effacer <i class="fa fa-eraser" aria-hidden="true"></i></a>
</div>

<table id="mytable2" class="table table-striped">
    <thead>
        <tr>
            <th>n°</th>
            <th>Titre</th>
            <th>Catégories</th>
            <th>Dernière MAJ</th>
            <th>Actions</th>
            <th></th>
        </tr>	
    </thead>
    <tbody>
        @foreach($questionnaires as $questionnaire)
        <tr>
            <td>{{ $questionnaire->id }}</td>
            <td>{{ $questionnaire->title }}</td>
            <td>
            @foreach($questionnaire->categories as $category)
                <span class="badge btn-cat">
                  {{ $category->name }}
                </span>
            @endforeach
            </td>
            <td>{{ $questionnaire->updated_at->format('d/m/Y') }}</td>
            <td>
                <a class="question-badge view-badge" href="{!! route('admin.questionnaire.show', $questionnaire->id) !!}" value="{{ $questionnaire->id }}" alt="voir question"><i class="fa fa-eye"></i></a>
                <a class="question-badge edition-badge" href="{!! route('admin.questionnaire.edit', $questionnaire->id) !!}" value="{{ $questionnaire->id }}" ><i class="fa fa-pencil-square-o"></i></a>
                <a class="question-badge suppression-badge" href="#" data-url="{!! route('admin.questionnaire.destroy', $questionnaire->id) !!}" data-toggle="modal" data-target="#modalSup"><i class="fa fa-times"></i></a>
            </td>
            <td>
                <input type="checkbox" name="" value="{{ $questionnaire->id }}">
            </td>
        </tr>
        @endforeach
      

    </tbody>
</table>

<div>
    <a href="{!! route('admin.questionnaire.create') !!}" class="btn btn-extia pull-right">Ajouter un questionnaire <i class="fa fa-plus"></i></a>
</div>

{!! $questionnaires->render() !!}

<!-- modal -->
<div class="modal fade" id="modalSup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">
                    <i class="fa fa-times"></i>
                    Suppression
                </h4>
            </div>
            <form id="delete-form" action="" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input id="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <p id="delete-text"> Etes vous sure de vouloir supprimer ce questionnaire ? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Annuler</button>
                    <button id="delete-btn" type="submit" class="btn btn-extia ok">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

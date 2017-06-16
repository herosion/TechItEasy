@extends('layouts.admin')

@section('title', 'Administration')

@section('content')
<h1 class="page-header"><i class="fa fa-question-circle"></i> Questions</h1>

<div class="row">
    <div class="col-md-3 ">
        <select id="search-category" class="form-control btn-info" name="categorie">
            <option selected class="filtre">Filtrer par catégorie</option>
          @foreach( $categories as $category )
            <option>{{isset($category->name)? $category->name : ''}}</option>
          @endforeach
        </select>
    </div>
    <div class="col-md-3 form-group">
        <select id="search-difficulte" class="form-control btn-info" name="difficulte" >
            <option selected class="filtre">Filtrer par difficulté</option>
          @foreach( $difficulties as $dif )
            <option>{{ $dif }}</option>
          @endforeach
        </select>
    </div>

    <div id="eraseFiltre" class="col-md-2 form-group">
        <a href="{!! route('admin.question.index') !!}" class="btn btn-extia">Effacer <i class="fa fa-eraser" aria-hidden="true"></i></a>
    </div>
</div>

<br>

<table id="mytable" class="table table-striped">
    <thead>
        <tr>
            <th>n°</th>
            <th>Catégorie</th>
            <th>Question</th>
            <th>Description</th>
            <th>Difficulté</th>
            <th>Actions</th>
            <th></th>
        </tr>	
    </thead>
    <tbody>

        @foreach($questions as $question)
        <tr>
            <td>{{ $question->id }}</td>
            <td>{{ $question->name }}</td>
            <td>{{ $question->label }}</td>
            <td>{{ $question->description }}</td>
            <td>{{ $question->level }}</td>
            <td>
                <a class="question-badge view-badge" href="{!! route('admin.question.show', $question->id) !!}" value="{{ $question->id }}" alt="voir question"><i class="fa fa-eye"></i></a>
                <a class="question-badge edition-badge" href="{!! route('admin.question.edit', $question->id) !!}" value="{{ $question->id }}" ><i class="fa fa-pencil-square-o"></i></a>
                <a class="question-badge suppression-badge" href="#" data-url="{!! route('admin.question.destroy', $question->id) !!}" data-toggle="modal" data-target="#modalSup"><i class="fa fa-times"></i></a>
            </td>
            <td>
                <input type="checkbox" name="" value="{{ $question->id }}">
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

<div>
    <a href="{!! route('admin.question.create') !!}" class="btn btn-extia pull-right">Ajouter une question <i class="fa fa-plus"></i></a>
</div>

{!! $questions->render() !!}

<!-- Modal -->
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
            <form id="delete-form" action="{{ route('admin.question.destroy', $question->id) }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="{{$question->id}}">

                <input id="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <p id="delete-text"> Etes vous sure de vouloir supprimer cette question? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Annuler</button>
                    <button id="delete-btn" type="submit" class="btn btn-extia">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

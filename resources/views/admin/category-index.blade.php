@extends('layouts.admin')

@section('title', 'Gestion des catégories')

@section('page', $page)

@section('content')
<h1 class="page-header"><i class="fa fa-bookmark"></i> Catégories</h1>
<ol class="breadcrumb">
	<li><a href="{!! route('dashboard') !!}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
	<li><a href="{!! route('admin.category.create') !!}"><i class="fa fa-plus-square"></i> Ajouter une catégorie</a></li>
</ol>
<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Nom</th>
			<th>Actions</th>
		</tr>	
	</thead>
	<tbody>
@foreach($categories as $category)
		<tr>
			<td>{{ $category->id }}</td>
			<td id="category-name-{{ $category->id }}">{{ $category->name }}</td>
			<td>
				<a href="{!! route('admin.category.edit', $category->id) !!}" class="btn btn-default btn-xs" title="Éditer la catégorie"><i class="fa fa-pencil-square-o"></i></a>
				<button class="btn btn-default btn-xs btn-delete-category" data-toggle="modal" data-target="#categoryDeleteModal" title="Supprimer la catégorie" data-id="{{ $category->id }}" data-urldelete="{!! route('admin.category.destroy', $category->id) !!}"><i class="fa fa-times"></i></button>
			</td>
		</tr>
@endforeach
	</tbody>
</table>
{!! $categories->render() !!}
<div id="categoryDeleteModal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
    	<div class="modal-content">
    		{!! Form::open(array('url' => URL::route('admin.category.destroy', 0), 'method' => 'DELETE', 'id' => 'category-delete-form')) !!}
	    		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title">Supprimer la catégorie "<span id="category-name-delete"></span>"</h4>
	      		</div>
	      		<div class="modal-body">
	        		<p>Attention en supprimant cette catégorie toute les questions liées n'y seront plus attribuées. Êtes vous certain de de vouloir supprimer cette catégorie ?</p>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
	        		<button type="submit" class="btn btn-extia">Supprimer</button>
	      		</div>
	      	{!! Form::close() !!}
    	</div>
  	</div>
</div>
@endsection
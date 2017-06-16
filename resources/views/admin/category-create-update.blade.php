@extends('layouts.admin')

@section('title', $category->id ? 'Modifier' : 'Ajouter' . ' une catégorie')

@section('page', $page)

@section('content')
<h1 class="page-header"><i class="fa fa-bookmark"></i> Catégories</h1>
<ol class="breadcrumb">
	<li><a href="{!! route('admin.category.index') !!}"><i class="fa fa-arrow-circle-left"></i> Retour</a></li>
</ol>
<div class="row">
	<div class="col-md-12">
	@if($category->id)
		<h2>Modifier la catégorie "<i>{{ $category->name}}</i>"</h2>
	@else
		<h2>Ajouter une catégorie</h2>
	@endif
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		{!! Form::open(array('url' => $category->id ? URL::route('admin.category.update', $category->id) : URL::route('admin.category.store'), 'method' => $category->id ? 'put' : 'post')) !!}
			<div class="form-group">
				<label>Nom</label>
				{!! Form::text('name', $category->name, array('class' => 'form-control', 'placeholder' => 'Nom', '	')) !!}
			</div>
			<button type="submit" class="btn btn-lg btn-extia btn-block">{!! $category->id ? 'Modifier <i class="fa fa-check"></i>' : 'Ajouter <i class="fa fa-plus"></i>' !!}</i></button>
		{!! Form::close() !!}
	</div>
</div>
@endsection
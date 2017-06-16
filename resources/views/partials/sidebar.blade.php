<ul class="nav nav-sidebar">
	<li{!! isset($page) && $page == 'dashboard' ? ' class="active"' : '' !!}>
        <a href="{!! route('dashboard') !!}"><i class="fa fa-tachometer"></i> Dashboard</a>
    </li>
    <li{!! isset($page) && $page == 'questionnaire' ? ' class="active"' : '' !!}>
        <a href="{!! route('admin.questionnaire.index') !!}"><i class="fa fa-file-text"></i></i> Questionnaire</a>
    </li>
    <li{!! isset($page) && $page == 'question' ? ' class="active"' : '' !!}>
        <a href="{!! route('admin.question.index') !!}"><i class="fa fa-question-circle"></i> Questions</a>
    </li>
    <li{!! isset($page) && $page == 'category' ? ' class="active"' : '' !!}>
        <a href="{!! route('admin.category.index') !!}"><i class="fa fa-bookmark"></i> Catégories</a>
    </li>
</ul>

<li class="{{ Request::is('experts*') ? 'active' : '' }}">
    <a href="{!! route('experts.index') !!}"><i class="fa fa-edit"></i><span>experts</span></a>
</li>

<li class="{{ Request::is('experts*') ? 'active' : '' }}">
    <a href="{!! route('experts.index') !!}"><i class="fa fa-edit"></i><span>Experts</span></a>
</li>

<li class="{{ Request::is('expertsQuestions*') ? 'active' : '' }}">
    <a href="{!! route('expertsQuestions.index') !!}"><i class="fa fa-edit"></i><span>ExpertsQuestions</span></a>
</li>

<li class="{{ Request::is('expertAnswers*') ? 'active' : '' }}">
    <a href="{!! route('expertAnswers.index') !!}"><i class="fa fa-edit"></i><span>ExpertAnswers</span></a>
</li>

<li class="{{ Request::is('subCategories*') ? 'active' : '' }}">
    <a href="{!! route('subCategories.index') !!}"><i class="fa fa-edit"></i><span>SubCategories</span></a>
</li>


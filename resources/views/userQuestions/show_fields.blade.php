<!-- Rel User Id Field -->
<div class="form-group">
    {!! Form::label('rel_user_id', 'Rel User Id:') !!}
    <p>{!! $userQuestions->rel_user_id !!}</p>
</div>

<!-- Rel Question Id Field -->
<div class="form-group">
    {!! Form::label('rel_question_id', 'Rel Question Id:') !!}
    <p>{!! $userQuestions->rel_question_id !!}</p>
</div>

<!-- Rel Answer Field -->
<div class="form-group">
    {!! Form::label('rel_answer', 'Rel Answer:') !!}
    <p>{!! $userQuestions->rel_answer !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $userQuestions->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $userQuestions->updated_at !!}</p>
</div>


<!-- Rel User Id Field -->
<div class="form-group">
    {!! Form::label('rel_user_id', 'Rel User Id:') !!}
    <p>{!! $expertAnswers->rel_user_id !!}</p>
</div>

<!-- Rel Question Id Field -->
<div class="form-group">
    {!! Form::label('rel_question_id', 'Rel Question Id:') !!}
    <p>{!! $expertAnswers->rel_question_id !!}</p>
</div>

<!-- Rel Answer Field -->
<div class="form-group">
    {!! Form::label('rel_answer', 'Rel Answer:') !!}
    <p>{!! $expertAnswers->rel_answer !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $expertAnswers->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $expertAnswers->updated_at !!}</p>
</div>


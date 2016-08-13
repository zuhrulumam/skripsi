<!-- Rel User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rel_user_id', 'Rel User Id:') !!}
    {!! Form::number('rel_user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Rel Question Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rel_question_id', 'Rel Question Id:') !!}
    {!! Form::number('rel_question_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Rel Answer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rel_answer', 'Rel Answer:') !!}
    {!! Form::number('rel_answer', null, ['class' => 'form-control']) !!}
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    {!! Form::date('created_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    {!! Form::date('updated_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('expertAnswers.index') !!}" class="btn btn-default">Cancel</a>
</div>

<!-- Question Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question_id', 'Question Id:') !!}
    {!! Form::number('question_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Question Slug Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question_slug', 'Question Slug:') !!}
    {!! Form::text('question_slug', null, ['class' => 'form-control']) !!}
</div>

<!-- Question Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question_category_id', 'Question Category Id:') !!}
    {!! Form::number('question_category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Question Text Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('question_text', 'Question Text:') !!}
    {!! Form::textarea('question_text', null, ['class' => 'form-control']) !!}
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
    <a href="{!! route('questions.index') !!}" class="btn btn-default">Cancel</a>
</div>

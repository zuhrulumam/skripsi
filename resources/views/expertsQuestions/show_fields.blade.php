<!-- Question Id Field -->
<div class="form-group">
    {!! Form::label('question_id', 'Question Id:') !!}
    <p>{!! $expertsQuestions->question_id !!}</p>
</div>

<!-- Question Slug Field -->
<div class="form-group">
    {!! Form::label('question_slug', 'Question Slug:') !!}
    <p>{!! $expertsQuestions->question_slug !!}</p>
</div>

<!-- Question Category Id Field -->
<div class="form-group">
    {!! Form::label('question_category_id', 'Question Category Id:') !!}
    <p>{!! $expertsQuestions->question_category_id !!}</p>
</div>

<!-- Question Text Field -->
<div class="form-group">
    {!! Form::label('question_text', 'Question Text:') !!}
    <p>{!! $expertsQuestions->question_text !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $expertsQuestions->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $expertsQuestions->updated_at !!}</p>
</div>


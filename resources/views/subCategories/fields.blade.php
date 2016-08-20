<!-- Sub Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sub_category_id', 'Sub Category Id:') !!}
    {!! Form::number('sub_category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Rel Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rel_category_id', 'Rel Category Id:') !!}
    {!! Form::number('rel_category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Sub Category Slug Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sub_category_slug', 'Sub Category Slug:') !!}
    {!! Form::text('sub_category_slug', null, ['class' => 'form-control']) !!}
</div>

<!-- Sub Category Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sub_category_name', 'Sub Category Name:') !!}
    {!! Form::text('sub_category_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Sub Category Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('sub_category_description', 'Sub Category Description:') !!}
    {!! Form::textarea('sub_category_description', null, ['class' => 'form-control']) !!}
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
    <a href="{!! route('subCategories.index') !!}" class="btn btn-default">Cancel</a>
</div>

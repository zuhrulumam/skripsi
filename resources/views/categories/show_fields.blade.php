<!-- Category Id Field -->
<div class="form-group">
    {!! Form::label('category_id', 'Category Id:') !!}
    <p>{!! $categories->category_id !!}</p>
</div>

<!-- Category Slug Field -->
<div class="form-group">
    {!! Form::label('category_slug', 'Category Slug:') !!}
    <p>{!! $categories->category_slug !!}</p>
</div>

<!-- Category Name Field -->
<div class="form-group">
    {!! Form::label('category_name', 'Category Name:') !!}
    <p>{!! $categories->category_name !!}</p>
</div>

<!-- Category Description Field -->
<div class="form-group">
    {!! Form::label('category_description', 'Category Description:') !!}
    <p>{!! $categories->category_description !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $categories->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $categories->updated_at !!}</p>
</div>


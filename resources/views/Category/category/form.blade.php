<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('descr') ? 'has-error' : ''}}">
    {!! Form::label('descr', 'Descr', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('descr', null, ['class' => 'form-control']) !!}
        {!! $errors->first('descr', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('img_url') ? 'has-error' : ''}}">
    {!! Form::label('img_url', 'Img Url', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('img_url', null, ['class' => 'form-control']) !!}
        {!! $errors->first('img_url', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('parent_id') ? 'has-error' : ''}}">
    {!! Form::label('parent_id', 'Parent Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('parent_id', ['1', '2', '3', '4'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
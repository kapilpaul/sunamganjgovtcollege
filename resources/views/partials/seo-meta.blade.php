<div class="block">
    {!! Form::open(['method' => 'POST', 'url' => route('post.seocontent'), 'class' =>"form-bordered"])  !!}

        {!! Form::hidden('post_id', $postid) !!}

        <div class="form-group @if ($errors->has('meta_title')) has-error @endif">
            {!! Form::label('meta_title', 'Meta Title') !!}
            {!! Form::text('meta_title', getMeta('meta_title', $postid), ['id' => 'meta_title', 'class'=>'form-control',
            'placeholder' => 'Meta Title']) !!}

            @if ($errors->has('meta_title'))
                <span class="help-block">{{ $errors->first('meta_title') }}</span>
            @endif
        </div>

        <div class="form-group @if ($errors->has('meta_desc')) has-error @endif">
            {!! Form::label('meta_desc', 'Meta Description') !!}
            {!! Form::textarea('meta_desc', getMeta('meta_desc', $postid), ['id' => 'meta_desc', 'class'=>'form-control',
            'placeholder' => 'Meta Description']) !!}

            @if ($errors->has('meta_desc'))
                <span class="help-block">{{ $errors->first('meta_desc') }}</span>
            @endif
        </div>

        <div class="form-group @if ($errors->has('meta_desc')) has-error @endif">
            {!! Form::label('meta_keywords', 'Meta Keywords') !!}
            {!! Form::textarea('meta_keywords', getMeta('meta_keywords', $postid), ['id' => 'meta_keywords', 'class'=>'form-control',
            'placeholder' => 'Meta Keywords']) !!}

            @if ($errors->has('meta_keywords'))
                <span class="help-block">{{ $errors->first('meta_keywords') }}</span>
            @endif
        </div>

        <div class="form-group form-actions">
            <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-user"></i> Update</button>
        </div>
    {!! Form::close() !!}
</div>
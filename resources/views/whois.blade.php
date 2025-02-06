@extends('layouts.master')

@section('title')
    @parent
    @lang('whois.title')
@endsection
@section('body')
    <div class="row">
        {!! Form::open([
            'url' => route('api.whois'),
            'class' => 'ajax col d-flex justify-content-center my-4',
        ]) !!}

        <div class="form-outline mb-4">
            {!! Form::label('domain', trans('whois.label.name'), ['class' => 'form-label']) !!}
            {!! Form::text('domain', null, ['placeholder' => trans('whois.placeholder.name'), 'class' => 'form-control']) !!}
            {!! Form::submit(trans('whois.button.submit'), ['class' => 'btn btn-primary btn-block my-4']) !!}
            <div id="response-errors" class="alert alert-danger visually-hidden" role="alert"></div>
        </div>

        {!! Form::close() !!}
    </div>

    <div id="response-data" class="row col d-flex justify-content-center my-4"></div>
@endsection

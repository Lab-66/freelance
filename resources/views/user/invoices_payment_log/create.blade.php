@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
@section('content')
    <div class="page-header clearfix">
    </div>
    <div class="panel panel-primary">
        <div class="panel-body">
            {!! Form::open(array('url' => $type, 'method' => 'post', 'files'=> true)) !!}
            <div class="form-group required {{ $errors->has('invoice_id') ? 'has-error' : '' }}">
                {!! Form::label('invoice_id', trans('invoice.invoice_number'), array('class' => 'control-label required')) !!}
                <div class="controls">
                    {!! Form::select('invoice_id', $invoices, null, array('id'=>'invoice_id', 'class' => 'form-control select2')) !!}
                    <span class="help-block">{{ $errors->first('invoice_id', ':message') }}</span>
                </div>
            </div>
            <div class="form-group required {{ $errors->has('payment_date') ? 'has-error' : '' }}">
                {!! Form::label('payment_date', trans('invoice.payment_date'), array('class' => 'control-label required')) !!}
                <div class="controls">
                    {!! Form::text('payment_date', null, array('class' => 'form-control date')) !!}
                    <span class="help-block">{{ $errors->first('payment_date', ':message') }}</span>
                </div>
            </div>
            <div class="form-group required {{ $errors->has('payment_method') ? 'has-error' : '' }}">
                {!! Form::label('payment_method', trans('invoice.payment_method'), array('class' => 'control-label required')) !!}
                <div class="controls">
                    {!! Form::select('payment_method', $payment_methods, null, array('id'=>'payment_method', 'class' => 'form-control select2')) !!}
                    <span class="help-block">{{ $errors->first('payment_method', ':message') }}</span>
                </div>
            </div>
            <div class="form-group required {{ $errors->has('payment_received') ? 'has-error' : '' }}">
                {!! Form::label('payment_received', trans('invoice.payment_received'), array('class' => 'control-label required')) !!}
                <div class="controls">
                    {!! Form::text('payment_received', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('payment_received', ':message') }}</span>
                </div>
            </div>
            <!-- Form Actions -->
            <div class="form-group">
                <div class="controls">
                    <a href="{{ route($type.'.index') }}" class="btn btn-primary"><i
                                class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                    <button type="submit" class="btn btn-success"><i
                                class="fa fa-check-square-o"></i> {{trans('table.ok')}}</button>
                     
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
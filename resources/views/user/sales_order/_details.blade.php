<div class="panel panel-primary">
    <div class="panel-body">
        <div class="form-group">
            {!! Form::label('invoice_number', trans('sales_order.sale_number'), array('class' => 'control-label')) !!}
            <div class="controls">
                {{ $saleorder->sale_number }}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('customer', trans('quotation.customer'), array('class' => 'control-label')) !!}
            <div class="controls">
                {{ is_null($saleorder->customer)?"":$saleorder->customer->full_name }}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="title">{{trans('quotation.date')}}</label>
            <div class="controls">
                {{ $saleorder->date }}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="title">{{trans('quotation.exp_date')}}</label>
            <div class="controls">
                {{ $saleorder->exp_date }}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('payment_term', trans('quotation.payment_term'), array('class' => 'control-label')) !!}
            <div class="controls">
                {{ $saleorder->payment_term.' '.trans('quotation.days') }}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('sales_team_id', trans('quotation.sales_team_id'), array('class' => 'control-label')) !!}
            <div class="controls">
                {{ is_null($saleorder->salesTeam)?"":$saleorder->salesTeam->salesteam }}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('sales_person_id', trans('quotation.sales_person'), array('class' => 'control-label')) !!}
            <div class="controls">
                {{ is_null($saleorder->salesPerson)?"":$saleorder->salesPerson->full_name }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label">{{trans('quotation.products')}}</label>
                <table class="table">
                    <thead>
                    <tr style="font-size: 12px;">
                        <th>{{trans('quotation.product')}}</th>
                        <th>{{trans('quotation.description')}}</th>
                        <th>{{trans('quotation.quantity')}}</th>
                        <th>{{trans('quotation.unit_price')}}</th>
                        <th>{{trans('quotation.taxes')}}</th>
                        <th>{{trans('quotation.subtotal')}}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="InputsWrapper">
                    @if(isset($saleorder) && $saleorder->products->count()>0)
                        @foreach($saleorder->products as $index => $variants)
                            <tr class="remove_tr">
                                <td>
                                {{$variants->product_name}}
                                <td>
                                    {{$variants->description}}
                                </td>
                                <td>
                                    {{$variants->quantity}}
                                </td>
                                <td>
                                    {{$variants->price}}
                                </td>
                                <td>
                                    {{number_format($variants->quantity * $variants->price * floatval(Settings::get('sales_tax')) / 100, 2,
                        '.', '')}}</td>
                                <td>
                                    {{$variants->sub_total}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('total', trans('sales_order.untaxed_amount'), array('class' => 'control-label')) !!}
            <div class="controls">
                {{ $saleorder->total}}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('total', trans('quotation.taxes'), array('class' => 'control-label')) !!}
            <div class="controls">
                {{ $saleorder->tax_amount}}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('total', trans('quotation.total'), array('class' => 'control-label')) !!}
            <div class="controls">
                {{ $saleorder->grand_total}}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('total', trans('quotation.discount').' (%)', array('class' => 'control-label')) !!}
            <div class="controls">
                {{ $saleorder->discount}}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('total', trans('quotation.final_price'), array('class' => 'control-label')) !!}
            <div class="controls">
                {{ $saleorder->final_price}}
            </div>
        </div>
        <div class="form-group">
            <div class="controls">
                @if (@$action == 'show')
                    <a href="{{ url($type) }}" class="btn btn-primary"><i
                                class="fa fa-arrow-left"></i> {{trans('table.close')}}</a>
                @else
                    <a href="{{ url($type) }}" class="btn btn-primary"><i
                                class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                    <button type="submit" class="btn btn-danger"><i
                                class="fa fa-trash"></i> {{trans('table.delete')}}</button>
                @endif
            </div>
        </div>
    </div>
</div>
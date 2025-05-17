{{ Form::model($productService, array('route' => array('productservice.update', $productService->id), 'method' => 'PUT','enctype' => "multipart/form-data", 'class'=>'needs-validation', 'novalidate')) }}
<div class="modal-body">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('name', __('Name'),['class'=>'form-label']) }}<x-required></x-required>
                {{ Form::text('name',null, array('class' => 'form-control','required'=>'required', 'placeholder' => __('Enter Name'))) }}
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('sale_price', __('Sale Price'),['class'=>'form-label']) }}<x-required></x-required>
                {{ Form::number('sale_price', null, array('class' => 'form-control','required'=>'required','step'=>'0.01', 'placeholder' => __('Enter Sale Price'))) }}
            </div>
        </div>
       
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('purchase_price', __('Purchase Price'),['class'=>'form-label']) }}<x-required></x-required>
                {{ Form::number('purchase_price', null, array('class' => 'form-control','required'=>'required','step'=>'0.01', 'placeholder' => __('Enter Purchase Price'))) }}
            </div>
        </div>
       

      
        <div class="form-group  col-md-6">
            {{ Form::label('category_id', __('Category'),['class'=>'form-label']) }}<x-required></x-required>
            {{ Form::select('category_id', $category,null, array('class' => 'form-control select','required'=>'required')) }}
        </div>
    

        <div class="form-group col-md-6 quantity {{$productService->type=='service' ? 'd-none':''}}">
            {{ Form::label('quantity', __('Quantity'),['class'=>'form-label']) }}<x-required></x-required>
            {{ Form::text('quantity',null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('description', __('Description'),['class'=>'form-label']) }}
            {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']) !!}
        </div>

    </div>

</div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>
{{Form::close()}}
<script>
    document.getElementById('pro_image').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('image').src = src
    }

    //hide & show quantity

    $(document).on('click', '.type', function ()
    {
        var type = $(this).val();
        if (type == 'product') {
            $('.quantity').removeClass('d-none')
            $('.quantity').addClass('d-block');
            $('input[name="quantity"]').prop('required', true);
        } else {
            $('.quantity').addClass('d-none')
            $('.quantity').removeClass('d-block');
            $('input[name="quantity"]').val('').prop('required', false);
        }
    });
</script>


<script>
$(document).ready(function() {
   

    // Handle category change
    $(document).on('change', '.category', function() {
        var category_id = $(this).val();
        var url = $(this).data('url');
        var productSelect = $("#product_id");
        
        // Show loading state
        productSelect.html('<option value="">Loading...</option>').trigger('change');

        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'category_id': category_id
            },
            success: function(response) {
                // Clear existing options
                productSelect.empty();
                
                // Add default option
                productSelect.append('<option value="">Select Product</option>');
                
                // Add new options
                if(response && Object.keys(response).length > 0) {
                    $.each(response, function(key, value) {
                        productSelect.append($('<option></option>').attr('value', key).text(value));
                    });
                } else {
                    productSelect.append('<option value="">No products found</option>');
                }
                
                // Trigger select2 update
                productSelect.trigger('change');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                productSelect.html('<option value="">Error loading products</option>').trigger('change');
            }
        });
    });
});
</script>

{{ Form::open(array('url' => 'production', 'class'=>'needs-validation', 'novalidate')) }}
<div class="modal-body">

    <div class="row">

        {{-- Select Date Field --}}
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('select_date', __('Select Date'), ['class' => 'form-label']) }}<x-required></x-required>
                {{ Form::text('select_date', null, ['class' => 'form-control', 'id' => 'select_date', 'required' => 'required']) }}
            </div>
        </div>

        <div class="form-group col-md-6">
            <label for="shift" class="form-label">Select Shift <span style="color:red">*</span></label>
            <select name="shift" id="shift" class="form-control select" required>
                <option value="">Shift Shift</option>
                <option value="A">Shift A</option>
                <option value="B">Shift B</option>
            </select>
        </div>

        <div class="col-md-6">
            <div class="form-group">
            <label for="category" class="form-label">Select Category<span style="color:red">*</span></label>
                <select name="category" class="form-control select category" data-url="{{ route('bill.getProduct') }}" required="required">
                    <option value="">Select Category</option>
                    @foreach($category as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md-6">
            <label for="product_id" class="form-label">Select Product<span style="color:red">*</span></label>
            <select name="product_id" id="product_id" class="form-control select product_list" required>
                <option value="">Select Product</option>
            </select>
            <div class="text-xs">
                Please add product. <a href="{{route('productservice.index')}}"><b>Add Product</b></a>
            </div>
        </div>

        
        @if(\Auth::user()->companyTitle() == 'gio')
        {{-- Shift --}}
       

        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('thikness', __('Thikness'),['class'=>'form-label']) }}
                {{ Form::text('thikness', '', array('class' => 'form-control', 'placeholder' => __('Enter product thikness'))) }}
            </div>
        </div>
       

        {{-- GSM --}}
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('gsm', __('GSM'),['class'=>'form-label']) }}
                {{ Form::text('gsm', '', array('class' => 'form-control', 'placeholder' => __('Enter product GSM'))) }}
            </div>
        </div>

        {{-- Dia --}}
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('dia', __('Dia'),['class'=>'form-label']) }}
                {{ Form::text('dia', '', array('class' => 'form-control', 'placeholder' => __('Enter product dia'))) }}
            </div>
        </div>
        @endif
        
        @if(\Auth::user()->companyTitle() == 'jut')
        {{-- Size --}}
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('size', __('Size'),['class'=>'form-label']) }}
                {{ Form::text('size', '', array('class' => 'form-control', 'placeholder' => __('Enter product size'))) }}
            </div>
        </div>
        @endif

       {{-- Weight --}}
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('weight', __('Weight'),['class'=>'form-label']) }}
                {{ Form::text('weight', '', array('class' => 'form-control', 'placeholder' => __('Enter product weight'))) }}
            </div>
        </div>

        {{-- Porter Sort --}}
        @if(\Auth::user()->companyTitle() == 'jut')
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('porter_sort', __('Porter Sort'),['class'=>'form-label']) }}
                {{ Form::text('porter_sort', '', array('class' => 'form-control', 'placeholder' => __('Enter product porter sort'))) }}
            </div>
        </div>
        @endif

        {{-- Quantity --}}
        <div class="form-group col-md-6 quantity">
            {{ Form::label('quantity', __('Quantity'),['class'=>'form-label']) }}<x-required></x-required>
            {{ Form::number('quantity',null, array('class' => 'form-control', 'required'=>'required', 'placeholder' => __('Enter Quantity'))) }}
        </div>


    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}

<script>
    $(document).ready(function () {
        $('#select_date').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true
        });
    });
</script>



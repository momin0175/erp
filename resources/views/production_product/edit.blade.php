@foreach($production_product_data as $production_product_data)
<form action="{{ route('production.update', $production_product_data->id) }}" method="POST"  class="needs-validation" novalidate>
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="old_qty" value="{{ $production_product_data->qty }}">
    
    <div class="modal-body">
        <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="select_date" class="form-label">Select Date</label><x-required></x-required>
                <input type="text" name="select_date" id="select_date" class="form-control" required value="{{ date('d-m-Y', strtotime($production_product_data->production_date)) }}">
            </div>
        </div>

         <div class="form-group col-md-6">
        <label for="product_id" class="form-label">Select Product<span style="color:red">*</span></label>
        <select name="product_id" id="product_id" class="form-control select" required>
            <option value="">Select Product</option>
            @foreach($productServices as $p_data)
                <option value="{{ $p_data->id }}" {{ $production_product_data->product_id == $p_data->id ? 'selected' : '' }}>
                    {{ $p_data->name }}
                </option>
            @endforeach
        </select>
    </div>

        <div class="form-group col-md-6">
            <label for="shift" class="form-label">Select Shift <span style="color:red">*</span></label>
            <select name="shift" id="shift" class="form-control select" required>
                <option value="">Shift Shift</option>
                <option value="A" {{ $production_product_data->shift == "A" ? 'selected' : '' }}>Shift A</option>
                <option value="B" {{ $production_product_data->shift == "B" ? 'selected' : '' }}>Shift B</option>
            </select>
        </div>
        @if(\Auth::user()->companyTitle() == 'gio')
        {{-- Shift --}}
      

        <div class="col-md-6">
            <div class="form-group">
                <label for="thikness" class="form-label">Thikness</label>
                <input type="text" name="thikness" id="thikness" class="form-control" placeholder="Enter product thikness" value="{{ $production_product_data->thikness }}">
            </div>
        </div>
       

        {{-- GSM --}}
        <div class="col-md-6">
            <div class="form-group">
                <label for="gsm" class="form-label">GSM</label>
                <input type="text" name="gsm" id="gsm" class="form-control" placeholder="Enter product GSM" value="{{ $production_product_data->gsm }}">
            </div>
        </div>

        <!-- Dia -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="dia" class="form-label">Dia</label>
                <input type="text" name="dia" id="dia" class="form-control" placeholder="Enter product dia" value="{{ $production_product_data->dia }}">
            </div>
        </div>
        @endif




                @if(\Auth::user()->companyTitle() == 'jut')
                <!-- Size -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="size" class="form-label">Size</label>
                        <input type="text" name="size" id="size" class="form-control" placeholder="Enter product size" value="{{ $production_product_data->size }}">
                    </div>
                </div>
                @endif

                <!-- Weight -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="weight" class="form-label">Weight</label>
                        <input type="text" name="weight" id="weight" class="form-control" placeholder="Enter product weight" value="{{ $production_product_data->weight }}">
                    </div>
                </div>

                <!-- Porter Sort -->
                @if(\Auth::user()->companyTitle() == 'jut')
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="porter_sort" class="form-label">Porter Sort</label>
                        <input type="text" name="porter_sort" id="porter_sort" class="form-control" placeholder="Enter product porter sort" value="{{ $production_product_data->proter_sort }}">
                    </div>
                </div>
                @endif

                <!-- Quantity -->
                <div class="form-group col-md-6 quantity">
                    <label for="quantity" class="form-label">Quantity</label><x-required></x-required>
                    <input type="text" name="quantity" id="quantity" class="form-control" required placeholder="Enter Quantity" value="{{ $production_product_data->qty }}">
                </div>



        </div>
    </div>

    <div class="modal-footer">
        <input type="button" value="Cancel" class="btn btn-secondary" data-bs-dismiss="modal">
        <input type="submit" value="Update" class="btn btn-primary">
    </div>
</form>
@endforeach
<script>
    $(document).ready(function () {
        $('#select_date').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true
        });
    });
</script>
@extends('layouts.dashboard')

@section('title', 'Edit Product')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @if(session()->has('message')) {{-- if there is a message in session --}}
              @if(session()->get('type') == 'success') {{-- if the message is a success message --}}
              <div class="alert alert-success" role="alert">
                {{session()->get('message')}}
              </div>
              @elseif(session()->get('type') == 'fail') {{-- if the message is a failed message --}}
              <div class="alert alert-danger" role="alert">
                {{session()->get('message')}}
              </div>
              @endif
            @endif
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ url('/admin/update_product', [$product->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                  <div class="row">

                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') ? old('name') : $product->name }}" class="form-control text-capitalize @error('name') is-invalid @enderror" autofocus required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="weight">Weight<span class="text-danger">*</span></label>
                            <input type="number" id="weight" name="weight" value="{{ old('weight') ? old('weight') : $product->weight }}" class="form-control text-capitalize @error('weight') is-invalid @enderror" required>
                            @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Price<span class="text-danger">*</span></label>
                            <input type="text" id="price" name="price" value="{{ old('price') ? old('price') : $product->price }}" class="form-control text-capitalize @error('price') is-invalid @enderror" required>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sales_price">Sales Price<span class="text-danger">*</span> <small>(Enter 0 if you don't have any special sales for this product)</small></label>
                            <input type="text" id="sales_price" name="sales_price" value="{{ old('sales_price') ? old('sales_price') : $product->sales_price }}" class="form-control text-capitalize @error('sales_price') is-invalid @enderror" required>
                            @error('sales_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="supermarket">Supermarket<span class="text-danger">*</span></label>
                            <select id="supermarket" name="supermarket" class="form-control text-capitalize @error('supermarket') is-invalid @enderror" required>
                                <option value="{{ $product->supermarket->id }}" selected>{{ $product->supermarket->name }}</option>
                                @foreach($supermarkets as $supermarket)
                                    @if($supermarket->id == $product->supermarket->id)
                                        @continue
                                    @endif
                                    <option value="{{ $supermarket->id }}">{{ $supermarket->name }}nn</option>
                                @endforeach
                            </select>
                            @error('supermarket')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Category<span class="text-danger">*</span></label>
                            <select id="category" name="category" class="form-control text-capitalize @error('category') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    @if($category->id == $product->category_id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @continue
                                    @endif
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">Type<span class="text-danger">*</span></label>
                            <select id="type_select" name="type" class="form-control text-capitalize @error('type') is-invalid @enderror" required>
                                <option value="">Select Type</option>
                                @foreach($types->where('category_id', $product->category_id) as $type)
                                    @if($type->id == $product->type_id)
                                        <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                                        @continue
                                    @endif
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image1">Primary Product Image<small> Leave empty to use current image (255px by 291px recommended)</small></label>
                            <input type="file" id="image1" name="image1" class="form-control text-capitalize @error('image1') is-invalid @enderror">
                            @error('image1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <br>
                            <label for="logo">Current Primary Product Image</label> <br>
                            <img width="100" src="{{ $product->get_product_image(1) ? asset('storage/uploads/products/images/' . $product->get_product_image(1)) : asset('storage/uploads/products/images/'. 'avatar.png') }}"/>
                            <br/>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image2">Product Image 2<small> Leave empty to use current image (255px by 291px recommended)</small></label>
                            <input type="file" id="image2" name="image2" class="form-control text-capitalize @error('image2') is-invalid @enderror">
                            @error('image2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <label for="logo">Current Product Image 2</label> <br>
                            <img width="100" src="{{ $product->get_product_image(2) ? asset('storage/uploads/products/images/' . $product->get_product_image(2)) : asset('storage/uploads/products/images/'. 'avatar.png') }}"/>
                            <br/>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image3">Product Image 3<small> Leave empty to use current image (255px by 291px recommended)</small></label>
                            <input type="file" id="image3" name="image3" class="form-control text-capitalize @error('image3') is-invalid @enderror">
                            @error('image3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <label for="logo">Current Product Image 3</label> <br>
                            <img width="100" src="{{ $product->get_product_image(3) ? asset('storage/uploads/products/images/' . $product->get_product_image(3)) : asset('storage/uploads/products/images/'. 'avatar.png') }}"/>
                            <br/>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image4">Product Image 4<small> Leave empty to use current image (255px by 291px recommended)</small></label>
                            <input type="file" id="image4" name="image4" class="form-control text-capitalize @error('image4') is-invalid @enderror">
                            @error('image4')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <label for="logo">Current Product Image 4</label> <br>
                            <img width="100" src="{{ $product->get_product_image(4) ? asset('storage/uploads/products/images/' . $product->get_product_image(4)) : asset('storage/uploads/products/images/'. 'avatar.png') }}"/>
                            <br/>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image5">Product Image 5<small> Leave empty to use current image (255px by 291px recommended)</small></label>
                            <input type="file" id="image5" name="image5" class="form-control text-capitalize @error('image5') is-invalid @enderror">
                            @error('image5')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <label for="logo">Current Product Image 5</label> <br>
                            <img width="100" src="{{ $product->get_product_image(5) ? asset('storage/uploads/products/images/' . $product->get_product_image(5)) : asset('storage/uploads/products/images/'. 'avatar.png') }}"/>
                            <br/>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image6">Product Image 6<small> Leave empty to use current image (255px by 291px recommended)</small></label>
                            <input type="file" id="image6" name="image6" class="form-control text-capitalize @error('image6') is-invalid @enderror">
                            @error('image6')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <label for="logo">Current Product Image 6</label> <br>
                            <img width="100" src="{{ $product->get_product_image(6) ? asset('storage/uploads/products/images/' . $product->get_product_image(6)) : asset('storage/uploads/products/images/'. 'avatar.png') }}"/>
                            <br/>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">Description<span class="text-danger">*</span></label>
                            <textarea rows="5" id="description" name="description" value="{{ old('description') }}" class="form-control text-capitalize @error('description') is-invalid @enderror" required>{{ $product->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                  </div>
                  
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('js')

<script>
    $(document).ready(function(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        // when user selects a new satte, get the cities for that state
        $('#category').on('change', function(e) {

            
            
            $('#type_select').attr('disabled', 'disabled')
            $('#type_select').empty()
            $('#type_select').append(`<option value="" class="text-capitalize">Select type</option>`)

            let category_id = $(this).val();

            $.ajax({
            type: 'POST',
            url: "{{ url('/get_category_type')}}",
            data: {id: category_id},
            dataType: 'json',

            success: function (types) {
               
                if(Object.keys(types).length > 0 ) {

                for(key in types) {

                    if(types.hasOwnProperty(key)) {

                    let type_id = types[key]['id']
                    let type_name = types[key]['name']

                    $('#type_select').append(`<option value="` + type_id + `" class="text-capitalize">` + type_name + `</option>`)
                    }
                }

                $('#type_select').removeAttr('disabled')


                }
            },

            error: function (data) {
                console.log('Error:', data);
            }
            });

        })
	})
</script>
@endsection
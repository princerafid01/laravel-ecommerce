@extends('admin.admin_master')
@section('admin-content')
<h1 class="text-center">Edit Product</h1>

    @if(Session::has('message'))
        <h3 style="font-family: cursive" class="alert alert-success  text-center">
            {{ session('message') }}
        </h3>
    @endif

{{-- {{ Form::open(['class' => "form-horizontal" , 'url' => '/save-category']) }} --}}
<form class="form-horizontal" action="{{ route('edit-product.submit' , $product->id) }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Product Title</label>
    <div class="col-sm-10">
      <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="Product title" value="{{ old('title') ?? $product->title }}">
    @if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
     @endif
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Product Description</label>
    <div class="col-sm-10">
        <textarea name="description" class="form-control" id="" cols="30" rows="5"> 
            {{ old('description') ?? $product->description }}
        </textarea>
    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
     @endif
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Price</label>
    <div class="col-sm-10">
      <input type="number" name="price" class="form-control" id="inputEmail3" placeholder="Price" value="{{ old('price') ?? $product->price }}">
     @if ($errors->has('price'))
        <span class="help-block">
            <strong>{{ $errors->first('price') }}</strong>
        </span>
     @endif
    </div>
  </div>

   <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Discounted Price</label>
    <div class="col-sm-10">
      <input type="number" name="discounted_price" class="form-control" id="inputEmail3" placeholder="Discounted Price" value="{{ old('discounted_price') ?? $product->discounted_price }}">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Select Category</label>
    <div class="col-sm-10">
        <select name="category_id" class="form-control" id="exampleFormControlSelect1">
            <option value="">Select a Category of your Product</option>
            @foreach ($categories as $category)
            @if (old('category_id') == $category->id)
                <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
            @elseif($product->category_id == $category->id)
                <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
            @else
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endif
            @endforeach
        </select>
    </div>
  </div>


    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Select Brand</label>
    <div class="col-sm-10">
        <select name="brand_id" class="form-control" id="exampleFormControlSelect1" >
            <option value="">Select a Brand for your Product</option>
            @foreach ($brands as $brand)            
             @if (old('brand_id') == $brand->id)
                <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
            @elseif($brand->id == $product->brand_id)
                <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
            @else
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endif
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    <div class="file-tab panel-body">
      <label for="" class="btn btn-default">
          <img src="{{ asset('storage/'.$product->img_one) }}" alt="" width='50' height='50'>
        <input type="file" name="img_one">
      </label>
    </div>
  </div>
    @if ($errors->has('img_one'))
        <span class="help-block">
            <strong>{{ $errors->first('img_one') }}</strong>
        </span>
     @endif


    <div class="form-group">
    <div class="file-tab panel-body">
      <label for="" class="btn btn-default">
          <img src="{{ asset('storage/'.$product->img_two) }}" alt="" width='50' height='50'>          
        <input type="file" name="img_two">
      </label>
      <span>*This is optional</span>
    </div>
  </div>


    <div class="form-group">
    <div class="file-tab panel-body">
      <label for="" class="btn btn-default">
          <img src="{{ asset('storage/'.$product->img_three) }}" alt="" width='50' height='50'>          
        <input type="file" name="img_three">
      </label>
      <span>*This is optional</span>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Edit Product</button>
    </div>
  </div>    

  
  {{-- {{ Form::close() }} --}}
</form>
@endsection
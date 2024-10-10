@extends('backend.blank')
@section('header_links')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"/>
<link rel="stylesheet" href="{{ asset('assets') }}/dropify/style.css">
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-capitalize">Inputs your product information</h6>
                @if (session('product_added'))
                    <div class="alert alert-success">{{ session('product_added') }}</div>
                @endif
                <form action="{{ route('product.insert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="category">Select Category</label>
                                <select class="form-control category" id="category" name="category">
                                    <option selected disabled>Select Category</option>
                                    @foreach ($categories as $category)                                        
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="subcategory">Select SubCategory</label>
                                <select class="form-control" id="subcats" name="subcategory">
                                    <option selected disabled>Select Sub-Category</option>                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="brand">Select Brand</label>
                                <select class="form-control" id="brand" name="brand">
                                    <option selected disabled>Select Brand</option>
                                    @foreach ($brands as $brand)                                        
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name">
                    </div>
                    <div class="form-group">
                        <label for="short_desp">Short Description</label>
                        <input type="text" class="form-control" id="short_desp" name="short_desp" placeholder="Product Description">
                    </div>
                    <div class="form-group">
                        <label for="long_desp">Long Description</label>
                        <textarea id="summernote2" class="form-control" name="long_desp" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="additional_info">Additional Information</label>
                        <textarea id="summernote" class="form-control" name="additional_info" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tags">Select Tags</label>
                        <select id="select-gear" name="tags[]" class="demo-default" multiple placeholder="Select Tags...">
                            <optgroup>
                                @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                @endforeach
                            </optgroup>
                          </select>                                  
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">                          
                                    <h6 class="card-title">Thumbnail</h6>                                    
                                    <div id="drop-area">
                                        <svg width="30" viewBox="0 0 65 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M55.9414 21.095C56.0247 20.7616 56.0872 20.4179 56.1289 20.0637C56.1706 19.7096 56.1914 19.345 56.1914 18.97C56.1914 16.22 55.2122 13.8658 53.2539 11.9075C51.2956 9.94914 48.9414 8.96997 46.1914 8.96997C45.7331 8.96997 45.2956 9.00122 44.8789 9.06372C44.4622 9.12622 44.0456 9.19914 43.6289 9.28247C42.8372 6.8658 41.3997 4.87622 39.3164 3.31372C37.2331 1.75122 34.8581 0.969971 32.1914 0.969971C29.4414 0.969971 27.0143 1.78247 24.9102 3.40747C22.806 5.03247 21.3997 7.09497 20.6914 9.59497C19.9831 9.38664 19.2539 9.23039 18.5039 9.12622C17.7539 9.02205 16.9831 8.96997 16.1914 8.96997C13.9831 8.96997 11.8997 9.38664 9.94141 10.22C8.02474 11.0533 6.33724 12.1991 4.87891 13.6575C3.42057 15.1158 2.27474 16.8033 1.44141 18.72C0.608073 20.6783 0.191406 22.7616 0.191406 24.97C0.191406 27.1783 0.608073 29.2616 1.44141 31.22C2.27474 33.1366 3.42057 34.8241 4.87891 36.2825C6.33724 37.7408 8.02474 38.8866 9.94141 39.72C11.8997 40.5533 13.9831 40.97 16.1914 40.97H24.1914V52.97H40.1914V40.97H54.1914C56.9414 40.97 59.2956 39.9908 61.2539 38.0325C63.2122 36.0741 64.1914 33.72 64.1914 30.97C64.1914 28.5116 63.3997 26.3658 61.8164 24.5325C60.2331 22.6991 58.2747 21.5533 55.9414 21.095ZM36.1914 36.97V48.97H28.1914V36.97H18.1914L32.1914 22.97L46.1914 36.97H36.1914Z" fill="#7E7E7E"/>
                                            </svg>
                                        <p>Drag & Drop Files Here <span>or</span></p>
                                        <button id="browse-files" type="button">Browse Files</button>
                                        <input type="file" id="fileElem" class="hidden" name="thumbnail">
                                    </div>
                                    <div class="preview-container" id="preview-container"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">                          
                                    <h6 class="card-title">Product Gallery</h6>                                    
                                    <div id="drop-area2">
                                        <svg width="30" viewBox="0 0 65 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M55.9414 21.095C56.0247 20.7616 56.0872 20.4179 56.1289 20.0637C56.1706 19.7096 56.1914 19.345 56.1914 18.97C56.1914 16.22 55.2122 13.8658 53.2539 11.9075C51.2956 9.94914 48.9414 8.96997 46.1914 8.96997C45.7331 8.96997 45.2956 9.00122 44.8789 9.06372C44.4622 9.12622 44.0456 9.19914 43.6289 9.28247C42.8372 6.8658 41.3997 4.87622 39.3164 3.31372C37.2331 1.75122 34.8581 0.969971 32.1914 0.969971C29.4414 0.969971 27.0143 1.78247 24.9102 3.40747C22.806 5.03247 21.3997 7.09497 20.6914 9.59497C19.9831 9.38664 19.2539 9.23039 18.5039 9.12622C17.7539 9.02205 16.9831 8.96997 16.1914 8.96997C13.9831 8.96997 11.8997 9.38664 9.94141 10.22C8.02474 11.0533 6.33724 12.1991 4.87891 13.6575C3.42057 15.1158 2.27474 16.8033 1.44141 18.72C0.608073 20.6783 0.191406 22.7616 0.191406 24.97C0.191406 27.1783 0.608073 29.2616 1.44141 31.22C2.27474 33.1366 3.42057 34.8241 4.87891 36.2825C6.33724 37.7408 8.02474 38.8866 9.94141 39.72C11.8997 40.5533 13.9831 40.97 16.1914 40.97H24.1914V52.97H40.1914V40.97H54.1914C56.9414 40.97 59.2956 39.9908 61.2539 38.0325C63.2122 36.0741 64.1914 33.72 64.1914 30.97C64.1914 28.5116 63.3997 26.3658 61.8164 24.5325C60.2331 22.6991 58.2747 21.5533 55.9414 21.095ZM36.1914 36.97V48.97H28.1914V36.97H18.1914L32.1914 22.97L46.1914 36.97H36.1914Z" fill="#7E7E7E"/>
                                            </svg>
                                        <p>Drag & Drop Files Here <span>or</span></p>
                                        <button id="browse-files2" type="button">Browse Files</button>
                                        <input type="file" id="fileElem2" class="hidden" multiple name="gallery[]">
                                    </div>
                                    <div class="preview-container" id="preview-container2"></div>
                                </div>
                            </div>                           
                        </div>
                    </div>                    
                    <button class="btn btn-success mt-3" type="submit">Add Product</button>
                </form>     
            </div>
        </div>
    </div>
</div>    
@endsection
@section('footer-script')
<script>$('#select-gear').selectize({ sortField: 'text' })</script>
<script>
$(document).ready(function() {
  $('#summernote').summernote();
  $('#summernote2').summernote();
});
</script>
<script>
    $('.category').change(function() {
        let category_id = $(this).val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/products/getsubcategory',
        data: {'category_id' : category_id},
        success: function(data) {
            $('#subcats').html(data);
        },
    });
})
</script>
<script src="{{ asset('assets') }}/dropify/dropify.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
@endsection
<!DOCTYPE html>
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="section-title position-relative text-center mb-5">
        <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">About Section Management</h6>
        <h1 class="font-secondary display-4">Edit {{ ucfirst($section) }} Section</h1>
        <i class="fas fa-music text-dark"></i>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form method="POST" action="{{ route('about-sections.update', $section) }}" class="editor-form bg-white p-4 rounded shadow-sm">
                @csrf
                <div class="form-group">
                    <label for="editor" class="font-weight-bold">Section Content:</label>
                    <textarea id="editor" name="content" class="form-control bg-secondary border-0 py-4 px-3" rows="12">{!! old('content', $aboutSection->content ?? '') !!}</textarea>
                    <small class="form-text text-muted mt-2">
                        <strong>Tip:</strong> For images, use <code>img/your-image.jpg</code> as the src.<br>
                        Example: <code>&lt;img src="img/about-dj.jpg"&gt;</code>
                    </small>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary font-weight-bold px-5 py-2" data-loading="Saving...">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="submit-text">Save Section</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


<script src="https://cdn.tiny.cloud/1/j7igf9f47rt49s2pn7bms4u2g5sa3e7jwuvokyv3zpnnwlef/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
tinymce.init({
  selector: '#editor',
  height: 500,
  menubar: false,
  plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount code',
  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat | code',
  branding: false,
  document_base_url: '{{ url('/') }}/',
  content_css: [
    '/css/style.css',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
    '{{ asset("lib/owlcarousel/assets/owl.carousel.min.css") }}',
    'https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600&display=swap'
  ],
  valid_elements: '*[*]', // Allow all elements and attributes
  valid_children: '+body[style]', // Allow style in body if needed
  forced_root_block: false // Prevents TinyMCE from wrapping content in <p> if you want raw HTML
});


</script>


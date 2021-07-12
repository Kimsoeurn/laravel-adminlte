@props([
    'title' => '',
    'breadcrumb' => []
])

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark text-lg">{{ $title }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach($breadcrumb as $value => $link)
                        @if ($link)
                            <li class="breadcrumb-item"><a href="{{ $link }}">{{ $value }}</a></li>
                        @else
                            <li class="breadcrumb-item active">{{ $value }}</li>
                        @endif
                    @endforeach
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

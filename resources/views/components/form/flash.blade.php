@if (session('message'))
    <?php $type = session('type') && session('type') == 'danger' ? 'text-danger' : 'text-success'; ?>
    <span class="{{ $type }} ml-1"><i class="fa fa-check-circle"></i> {{ session('message') }}</span>
@endif

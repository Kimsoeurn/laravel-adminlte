<x-admin-layout :title="$title" active-route="{{$activeRoute ?? ''}}">
    <x-slot name="header">
        <x-admin-content-header :title="$title" :breadcrumb="$breadcrumb"/>
    </x-slot>
    <div class="card">
        <div class="card-header">
            <i class="fa fa-user-secret"></i> {{ $role->exists ? __('Edit') : __('Create') }}
        </div>
        <!-- /.card-header -->
        <form method="POST" action="{{ $role->exists ? route('roles.update', $role->id) : route('roles.store') }}">
            @csrf
            @if($role->exists)
                @method('put')
            @endif
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="name" class="control-label">{{ __('Name') }}
                            <span class="text-danger">*</span></label>
                        <x-form.input type="text" name="name"
                                      value="{{ $role->exists ? $role->name : old('name') }}"/>
                        <x-form.error key="name"/>
                    </div>
                    <div class="form-group">
                        <x-form.submit-and-cancel url="{{ route('roles.index') }}"/>
                    </div>
                </div>
                <div class="col-lg-8">
                    @foreach($permissions as $key => $value)
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input check-all" id="{{ $key }}" value="{{ $key }}">
                                <label class="form-check-label text-primary" for="{{ $key }}">{{ __(ucfirst($key)) }}</label>
                            </div>
                            <hr class="mt-1">
                            <div class="row">
                                @foreach($value as $g)
                                    <div class="col-md-3">
                                        <div class="checkbox">
                                            <label>
                                                <?php
                                                $checked = false;
                                                if (isset($rolePermissions)) {
                                                    if (in_array($g['name'] , $rolePermissions)) $checked = true;
                                                }
                                                ?>
                                                <div class="form-check">
                                                    <input type="checkbox" name="perm[]" class="form-check-input {{ $key }}" id="p-{{ $g->id }}" value="{{ $g->id }}" @if($checked) checked @endif>
                                                    <label class="form-check-label" for="p-{{ $g->id }}">{{ __($g->name) }}</label>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        </form>
        <!-- /.card-body -->
    </div>
    @push('script')
        <script>
            $(function () {
                $('.check-all').change(function () {
                    var me = $(this);
                    if(me.prop('checked')) {
                        $('.' + me.val()).prop('checked', true);
                    } else {
                        $('.' + me.val()).prop('checked', false);
                    }
                });
            });
        </script>
    @endpush
</x-admin-layout>



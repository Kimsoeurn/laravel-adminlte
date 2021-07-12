@if ($role->id === 1 && $role->name === 'super-admin')
<div class="row">
    <?php
    $colors = ['badge-info', 'badge-default', 'badge-danger', 'badge-warning', 'badge-success'];
    ?>
    <div class="col-12 col-lg-3">
        <span class="badge {{ $colors[rand(0, count($colors) -1)] }} font-weight-normal p-1">All</span>
    </div>
</div>
@endif
@if (count($role->permissions))
    <div class="row">
        <?php
        $colors = ['badge-info', 'badge-default', 'badge-danger', 'badge-warning', 'badge-success'];
        ?>
        <div class="col-12 col-lg-3">
            <span class="badge {{ $colors[rand(0, count($colors) -1)] }} font-weight-normal p-1">{{ count($role->permissions) }}</span>
        </div>
    </div>

@endif
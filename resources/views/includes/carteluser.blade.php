<?php $principal = App\Principal::first(); ?>
@if ($principal->msjfront == '0')

@else
<div class="alert alert-info" role="alert">
  {!! $principal->msjuser !!}
</div>
@endif
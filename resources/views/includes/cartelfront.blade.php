@if ($principal->msjfront == '0')

@else
<div class="alert alert-warning" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
{!! $principal->msjfront !!}
</div>
@endif
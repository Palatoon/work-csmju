<!-- begin page-header -->
<h1 class="page-header">
    @if(isset($room->name))
    {{ $room->name }} @if(!is_null(request()->segment(4))) > {{ ucfirst(request()->segment(4)) }} @endif
    @elseif(isset($building->name))
    {{ $building->name }} @if(!is_null(request()->segment(4))) > {{ ucfirst(request()->segment(4)) }} @endif
    @elseif(isset($area->name))
    {{ $area->name }} @if(!is_null(request()->segment(4))) > {{ ucfirst(request()->segment(4)) }} @endif
    @elseif(isset($model->name))
    {{ $model->name }} @if(!is_null(request()->segment(4))) > {{ ucfirst(request()->segment(4)) }} @endif
    @elseif(!is_null(request()->segment(2)))
    @if(request()->segment(2) == "historytype")
    History Type
    @else
    {{ str_replace("-", " ", ucfirst(request()->segment(2)))  }}
    @endif
    @else
    {{ str_replace("-", " ", ucfirst(request()->route()->getName())) }}
    @endif
</h1>
<!-- end page-header -->
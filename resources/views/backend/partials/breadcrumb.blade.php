<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
	@if(null !== request()->segment(1))<li class="breadcrumb-item">{{ ucfirst(request()->segment(1)) }}</li>@endif
	@if(null !== request()->segment(2))<li class="breadcrumb-item">{{ ucfirst(request()->segment(2)) }}</li>@endif
	@if(null !== request()->segment(3))<li class="breadcrumb-item">{{ ucfirst(request()->segment(3)) }}</li>@endif
	@if(null !== request()->segment(4))<li class="breadcrumb-item">{{ ucfirst(request()->segment(4)) }}</li>@endif
</ol>
<!-- end breadcrumb -->
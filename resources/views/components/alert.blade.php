<div>
    @if (session('message'))
    <div class="alert alert-success alert-dismissable custom-success-box">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong> {{ session('message') }} </strong>
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger alert-dismissable custom-success-box">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong> {{ session('error') }} </strong>
    </div>
    @endif
</div>
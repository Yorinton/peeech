@extends('layouts.app')

@section('content')
<div class="container mb30 mt50">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<h2>{{ $exception->getMessage() }}</h2>
        	<p>サーバーから応答がありません</p>
		</div>
	</div>
</div>
@endsection

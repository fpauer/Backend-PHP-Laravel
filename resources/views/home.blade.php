@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                	My articles
                </div>

                <div class="panel-body">
                	
                @if ( isset($action) )
                	@if ( strcmp($action, "success") == 0  )
						<a href="/article/create" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> New Article</a>
	                	<br/><br/>
               			<div class="alert alert-success" role="alert">{{ $message }}</div>
                	@elseif ( strcmp($action, "confirmation") == 0 )
               			<div class="alert alert-warning" role="alert">{{ $message }}</div>
                	@elseif ( strcmp($action, "error") == 0 )
               			<div class="alert alert-error" role="alert">{{ $message }}</div>
                	@endif
                @else
					<a href="/article/create" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> New Article</a>
                	<br/><br/>
                @endif
                	
                	
                <?php 
                	$maxCell = 3; 
                	$cells = 0;
                ?>
                @if( sizeof($articles) == 0 && !isset($action) )
                <div class="alert alert-info" role="alert">Hi! You don't have any article yet! Lets create the first.</div>
                @endif
                
				@foreach($articles as $article)
				
					@if ( $cells == 0 || $maxCell == $cells)
						<div class="row">
				  	@endif
				  	
				  	<div class="col-sm-6 col-md-4">
					    <div class="thumbnail">
					      
					      @if ( !empty($article->photo_path) )
					      <img src="{{ $article->photo_path }}" style="height: 100%; width: 280; display: block;">
					      @else
					      <img data-src="holder.js/100%x200" alt="100%x200" 
					      	src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTUzOTBmNmNmYWUgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMnB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNTM5MGY2Y2ZhZSI+PHJlY3Qgd2lkdGg9IjI0MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI4OS44NTkzNzUiIHk9IjEwNS4xIj4yNDJ4MjAwPC90ZXh0PjwvZz48L2c+PC9zdmc+" 
					      	data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
					      @endif
					      <div class="caption">
					        <h3><a href="article/{{ $article->link }}" target="_blank">{{ $article->title }}</a></h3>
					        <span class="glyphicon glyphicon-time" aria-hidden="true"></span> {!! $article->created_at->format('d F Y g:i A') !!}
					       <p>
					       		<div class="btn-group" role="group" aria-label="Actions">
					       		  
					       		  <?php 
					       		  	$visibleClass = "btn-success";
					       		  	$hiddenClass = "btn-default";
					       		  	if ( !$article->active )
					       		  	{
						       		  	$visibleClass = "btn-default";
						       		  	$hiddenClass = "btn-warning";
					       		  	}
					       		  ?>
								  <button type="button" class="btn btn-sm {{ $visibleClass }}" onclick="toggleArticle(this, '{{ Crypt::encrypt($article->id) }}',1);" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Visible</button>
								  <button type="button" class="btn btn-sm {{ $hiddenClass }}" onclick="toggleArticle(this, '{{ Crypt::encrypt($article->id) }}',0);" ><span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> Hidden</button>
								  
								</div>
								<a href="javascript: confirmDelete('{{ $article->title }}' ,'{{ Crypt::encrypt($article->id) }}');" class="btn btn-sm btn-danger pull-right" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a> 
						        
					       </p>
					      </div>
					    </div>
					</div>
				    
					<?php $cells++;?>
					@if ( $maxCell == $cells)
						</div> 
						<?php $cells = 0;?>
				  	@endif
				@endforeach
				
				@if ( $cells != 0 || $maxCell != $cells)
					</div> 
			  	@endif
                </div>
            </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="confirmModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body">
        <h3 id="modalMessage">Message</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-success" id="btModalYes">Yes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('javascript')
<script src="{{ URL::asset('js/home.js') }}"></script>
@endsection

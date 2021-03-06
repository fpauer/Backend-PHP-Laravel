@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                	My articles
                </div>

	            <div id="app">
	                <div class="panel-body" id="list">
	                	
		                <a href="#/new" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> New Article</a>
		                <br/><br/>
		                <div id="message-box"></div>
		                
	                	<div id="loading"><img src='/img/spinner.gif'></div>
	                	<div id="articles"></div>
	                </div>
	            </div>
                
                <div class="panel-body" id="edit"></div>
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
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-success" id="btModalYes">Yes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/template" id="tmpConfirmModal">
<h3 id="modalMessage"><%- message %></h3>
</script>

<script type="text/template" id="tmpMessageBox">
<div class="alert alert-<%= action %>" role="alert"><%- message %></div>
</script>

<script type="text/template" id="tmpArticleThumbnail">
						<div class="thumbnail">
					      <% if ( photo_path != "" ) { %>
					      <img src="<%=photo_path%>" style="height: 100%; width: 280; display: block;">
					      <% } else { %>
					      <img data-src="holder.js/100%x200" alt="100%x200" 
					      	src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTUzOTBmNmNmYWUgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMnB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNTM5MGY2Y2ZhZSI+PHJlY3Qgd2lkdGg9IjI0MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI4OS44NTkzNzUiIHk9IjEwNS4xIj4yNDJ4MjAwPC90ZXh0PjwvZz48L2c+PC9zdmc+" 
					      	data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
					      <% } %>
					      <div class="caption">
					        <h3><a href="article/<%= link %>" target="_blank"><%- title %></a></h3>
					        <span class="glyphicon glyphicon-time" aria-hidden="true"></span><%= created_at %> 
					       <p>
					       		<div class="btn-group" role="group" aria-label="Actions">
					       		  
					       		  <% 
					       		  	var visibleClass = "btn-success";
					       		  	var hiddenClass = "btn-default";
					       		  	if ( active )
					       		  	{
						       		  	visibleClass = "btn-default";
						       		  	hiddenClass = "btn-warning";
					       		  	}
					       		  %>
								  <button type="button" class="btn btn-sm  <%= visibleClass %>" onclick="toggleArticle(this, '<%= id_crypt %>',1);" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Visible</button>
								  <button type="button" class="btn btn-sm  <%= hiddenClass %> " onclick="toggleArticle(this, '<%= id_crypt %>',0);" ><span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> Hidden</button>
								  
								</div>
								<a class="destroy btn btn-sm btn-danger pull-right" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a> 
						        
					       </p>
					      </div>
					    </div>
</script>

<script type="text/template" id="tmpArticleNew">
				<form method="POST" enctype="multipart/form-data">
				  <div class="form-group required">
				    <label for="inputTitle">Title</label>
				    <input type="title" class="form-control" id="Title" name="Title" placeholder="What is the title ?" value="<%= title%>">
				  </div>
				  <div class="form-group">
				    <label for="inputTitle">Photo</label>
				    <input name="file" type="file" 
					   class="cloudinary-fileupload" data-cloudinary-field="image_id" 
					   data-form-data=" ... html-escaped JSON data ... " valeu="Select a file or drag and drop here"></input>
				  </div>
				  <div class="form-group required">
				    <label for="inputTitle">Content</label>
				    <input type="hidden" id="Content" name="Content"></input>
					<div id="summernote"></div>
  				  </div>
				  <div class="form-group">
				    <label for="inputTitle">Reporter Name</label>
				    <input type="title" class="form-control" id="ReporterName" name="ReporterName" placeholder="What is the reporter name ?"  value="<%= author_name %>">
				  </div>
				  <div class="form-group">
				    <label for="inputTitle">Reporter E-mail</label>
				    <input type="title" class="form-control" id="ReporterEmail" name="ReporterEmail" placeholder="What is the email ?"  value="<%= author_email %>">
				  </div>
				  
 	 			  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save</button>
  				  <a class="btn btn-default" href="#"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Cancel</a>

                	
				</form>
</script>

@endsection
@section('javascript')
  <script src="https://code.jquery.com/jquery-1.12.3.min.js" type="text/javascript"></script>
  <script src="http://underscorejs.org/underscore-min.js" type="text/javascript"></script>
  <script src="http://backbonejs.org/backbone-min.js" type="text/javascript"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="{{ URL::asset('js/home.app.js') }}"></script>
@endsection

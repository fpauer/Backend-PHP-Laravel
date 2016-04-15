'use strict';

var app = {}; // create namespace for the app

//--------------
// Models
//--------------

var ArticleModel = Backbone.Model.extend({
	defaults:{
		id_crypt: null,
		user_id: null,
		title: null,
		body: null,
		photo_path: null,
		link: null,
		author_name: null,
		author_email: null,
		created_at: null,
		updated_at: null,
		active: null
	}
}); 

//--------------
// Collections
// RESTful Resources
// 
// GET  /articles/ ...... Reads all Muppets.
// POST /articles/ ...... Creates a new Muppet.
// GET  /articles/:id ... Reads a Muppet.
// PUT  /articles/:id ... Updates a Muppet.
// DEL  /articles/:id ... Destroys a Muppet.
//--------------
var ArticleCollection = Backbone.Collection.extend({
	  url: '/articles',
	  model: ArticleModel
});

var articles = new ArticleCollection();

//--------------
// Views
//--------------

// renders an individual Message Box (div)
app.MessageBoxView = Backbone.View.extend({
  el: '#message-box',
  template: _.template($('#tmpMessageBox').html()),
  data: {action:'', message:''},
  render: function(){
	if( this.data.action != '' ) this.$el.html(this.template(this.data));
    return this;
  },
  showMessage(data)
  {
	  this.data = data;
	  this.render();
  }
});
app.messageBoxView = new app.MessageBoxView(); 
//app.messageBoxView.showMessage({action:'danger', message:'Teste'});

//renders an Article (div)
app.ArticleView = Backbone.View.extend({
    tagName: 'div',
    className: 'thumbnail',
	template: _.template($('#tmpArticle').html()),
	render: function(){
		//console.log( this.template(this.model.toJSON()) );
        this.$el.html(this.template(this.model.toJSON()));
        //this.input = this.$('.edit');
        return this; // enable chained calls
	},
    initialize: function(){
        //this.model.on('change', this.render, this);
        //this.model.on('destroy', this.remove, this); // remove: Convenience Backbone
    },
    /*
    events: {
        'dblclick label' : 'edit',
        'keypress .edit' : 'updateOnEnter',
        'blur .edit' : 'close',
        'click .toggle': 'toggleCompleted',
        'click .destroy': 'destroy'
    },
    edit: function(){
        this.$el.addClass('editing');
        this.input.focus();
    },
	  toggleCompleted: function(){
		  this.model.toggle();
	  },
    close: function(){
        var value = this.input.val().trim();
        if(value) {
          this.model.save({title: value});
        }
        this.$el.removeClass('editing');
    },
    updateOnEnter: function(e){
        if(e.which == 13){
          this.close();
        }
    },
    destroy: function(){
  	  if( confirm('Do you really want to remove \n the to-do: ' + this.model.get('title') + ' ?' ) )
  		  this.model.destroy();
    }
    */
});

articles.fetch({

    dataType: "json",
    success: function(data) {
    	var articleView = new app.ArticleView({model: data.at(0)});
    	$("#app").append( articleView.render().$el );
    },
    error: function() {
        console.log('error');
    }

});

//renders the full list of todo items calling TodoView for each one.
/*
app.AppView = Backbone.View.extend({
  el: '#app',
  initialize: function () {
      this.input = this.$('#new-todo');
      app.todoList.on('add', this.addAll, this);//(model, collection, options) — when a model is added to a collection.
      app.todoList.on('reset', this.addAll, this);//(collection, options) — when the collection's entire contents have been reset.
      app.todoList.fetch(); // Loads list from local storage
  },
  events: {
      'keypress #new-todo': 'createTodoOnEnter'
  },
  createTodoOnEnter: function(e){
    if ( e.which !== 13 || !this.input.val().trim() ) { // ENTER_KEY = 13
      return;
    }
    app.todoList.create(this.newAttributes());
    this.input.val(''); // clean input box
  },
  addOne: function(todo){
    //var view = new app.TodoView({model: todo});
    //$('#todo-list').append(view.render().el);
  },
  addAll: function(){
    this.$('#todo-list').html(''); // clean the todo list
	// filter todo item list
	switch(window.filter){
		case 'pending':
			_.each(app.todoList.remaining(), this.addOne);
			break;
		case 'completed':
			_.each(app.todoList.completed(), this.addOne);
			 break;
		default:
			app.todoList.each(this.addOne, this);
			break;
	}
  },
  newAttributes: function(){
      return {
        title: this.input.val().trim(),
        completed: false
      }
  }
});  
*/

//--------------
// Routers
//--------------

//--------------
// Initializers
//--------------

//app.appView = new app.AppView(); 
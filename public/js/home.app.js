'use strict';
var ARTICLE_MODE_NEW = 'New'; 
var ARTICLE_MODE_EDIT = 'Edit'; 
var ARTICLE_MODE_THUMBNAIL = 'Thumbnail'; 
var ARTICLE_MODE_FULL = 'Full'; 

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

app.articleList = new ArticleCollection();

//--------------
// Views
//--------------

// renders an individual Message Box (div)
app.MessageBoxView = Backbone.View.extend({
  el: '#message-box',
  template: _.template($('#tmpMessageBox').html()),
  data: {action:'', message:''},
  render: function(){
	this.$el.html(this.template(this.data));
    return this;
  },
  showMessage(data)
  {
	  this.data = data;
	  this.render();
  },
  clear()
  {
	  this.$el.html('');
  }
});
app.messageBoxView = new app.MessageBoxView(); 
//app.messageBoxView.showMessage({action:'danger', message:'Teste'});

//renders a Modal Confirm (div)
app.ConfirmModalView = Backbone.View.extend({
	el: '#confirmModal',
	template: _.template($('#tmpConfirmModal').html()),
	data: {message:'', view:null},
	render: function(){
		this.$el.find('.modal-body').html(this.template(this.data));
		return this;
	},
    events: {
        'click #btModalYes': 'callBack'
    },
	showMessage: function(data)
	{
		this.data = data;
		this.render();
		this.$el.modal('show');
	},
	callBack: function()
	{
		if( this.data.view !== 'undefined' && this.data.view !=null )
		{
			this.data.view.callBack();
		}
		this.$el.modal('hide');
	}
});
app.confirmModalView = new app.ConfirmModalView(); 

//renders an Article (div)
app.ArticleView = Backbone.View.extend({
    tagName: 'div',
    className: 'col-sm-6 col-md-4',
	mode: ARTICLE_MODE_THUMBNAIL,
	template: _.template($('#tmpArticleThumbnail').html()),
	render: function(){
		console.log(this.model.toJSON());
        this.$el.html(this.template(this.model.toJSON()));
        //this.input = this.$('.edit');
        return this;
	},
    initialize: function(obj){
    	this.mode = obj.mode;
    	this.template = _.template($('#tmpArticle'+this.mode).html());
        this.model.on('change', this.render, this);
        this.model.on('destroy', this.confirmDestroy, this);
    },
    changeMode: function(mode){
    	this.mode = mode;
    	this.template = _.template($('#tmpArticle'+this.mode).html());
    },
    events: {
        //'dblclick label' : 'edit',
        //'keypress .edit' : 'updateOnEnter',
        //'blur .edit' : 'close',
        //'click .toggle': 'toggleCompleted',
        'click .destroy': 'confirmDestroy'
    },
    /*
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
    */
    confirmDestroy: function(){
    	var message = 'The article "'+this.model.get('title')+'" will be deleted, please confirm ?';
    	this.callBack = this.destroy;
    	app.confirmModalView.showMessage({message: message, view: this});
    },
    //not working yet
    destroy: function(){
    	
    	app.articleList.remove(this.model);
    	app.articleList.trigger('reset');
    	//app.articleList.sync();
    }
});

//renders the full list of Artciles calling ArticleView for each one.
app.AppView = Backbone.View.extend({
  el: '#app',
  loading: '#loading',
  max_per_line: 3,
  curr_per_line: 0,
  initialize: function () {
      //this.input = this.$('#new-todo');
      app.articleList.on('add', this.addAllinList, this);//(model, collection, options) — when a model is added to a collection.
      app.articleList.on('reset', this.addAllinList, this);//(collection, options) — when the collection's entire contents have been reset.
      app.articleList.fetch({
	  	    dataType: "json",
	  	    success: function()
	  	    {
	  	    	app.appView.checkListArticles();
	  	    	app.appView.stopLoading();
	  	    },
	  	    error: function() {
	  	        console.log('error');
	  	    }
	  });
      
  },
  events: {
      'keypress #new-article': 'createArticleOnEnter'
  },
  
  /**
   * Display a loading indication whenever the Collection is fetching.
   */
  showLoading()
  {
	  $(loading).hide();
  },
  
  /**
   * Hide a loading indication whenever the Collection is fetching.
   */
  stopLoading()
  {
	  $(loading).hide();
  },
  checkListArticles: function()
  {
      if( app.articleList.length == 0 )
      {
    	  app.messageBoxView.showMessage(
    			  { action:'info', 
    			   message:"Hi! You don't have any article yet! Lets create the first."
    			  });
      }
      else app.messageBoxView.clear();
  },
  createArticleOnEnter: function(e){
    if ( e.which !== 13 || !this.input.val().trim() ) { // ENTER_KEY = 13
      return;
    }
    app.articleList.create(this.newAttributes());
    this.input.val(''); // clean input box
  },
  
  /**
   * Add an article inside the list
   */
  addOneInList: function(article){
	var articleView = new app.ArticleView({model: article, mode:ARTICLE_MODE_THUMBNAIL});
	this.curr_per_line += 1;
	if( this.curr_per_line == this.max_per_line || '' == this.$('#articles').html() )
	{
	  	$("#articles").append('<div class="row"></div>');
	  	this.curr_per_line = 0;
	}
	
	$("#articles").last().append( articleView.render().$el );
  },
  
  /**
   * for each in Article List and render each article
   */
  addAllinList: function(){
    this.$('#articles').html(''); // clean the todo listF
	app.articleList.each(this.addOneInList, this);
    this.checkListArticles();
  },
  
  /**
   * Open the form to add a new article
   */
  newArticle: function(){
	    this.$('#articles').html(''); // clean the todo list
	    this.$('#list').hide(); // clean the todo list

		var articleView = new app.ArticleView({model: app.articleList.create(), mode:ARTICLE_MODE_NEW});
		$("#edit").html( articleView.render().$el.html() );
	    this.$('#edit').show(); // clean the todo list
  },
  newAttributes: function(){
      return {
        title: this.input.val().trim(),
        completed: false
      }
  }
});  


//--------------
// Routers
//--------------
app.Router = Backbone.Router.extend({
    routes: {
      '*filter' : 'setFilter'
    },
    setFilter: function(params) {
      if( params != null ) window.filter = params.trim() || '';
      else window.filter = '';

      console.log('app.router.params = ' + params); // just for didactical purposes.

	  //filter app
	  switch(window.filter){
	  		case 'new':
	  			app.appView.newArticle();
	  			break;
	  		case 'edit':
	  			//_.each(app.todoList.completed(), this.addOneInList);
	  			 break;
	  		case 'detail':
	  			//_.each(app.todoList.completed(), this.addOneInList);
	  			 break;
	  		default:
	  	        app.articleList.trigger('reset');
	  			break;
	  }
    }
 });

//--------------
// Initializers
//--------------
app.appView = new app.AppView(); 
app.router = new app.Router();
Backbone.history.start();
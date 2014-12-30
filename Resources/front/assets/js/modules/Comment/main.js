define(['app'], function(App){

  return App.module('Ticket.View.Comment', function(Comment, App, Backbone, Marionette, $, _){

    Comment.startWithParent = false;

    Comment.on('start', function(options){

      require(['Comment/controllers/list'], function(List){
        List.Controller(options);
      });

    });

  });

});
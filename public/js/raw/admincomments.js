;(function($)
{
	var mustacheTmpl = {
		commentview: '<div class="row"><ul><li>Content: {{content}}</li><li>Added On: {{added}}</li><li>By: {{user}}</li>',
		commentnew: '<div class="row"><form action="{{route}}" method="POST" id="newcommentform" class="col-md-12">
						<div class="control-group"><label class="control-label">Content:</label><textarea class="form-control" name="content"></textarea></div>
						<input type="hidden" name="post_id" value="{{postid}}">
						</form>
					</div>',
		commentreply: '<div class="row"><form action="{{route}}" method="POST" id="{{postid}}-replyform" class="col-md-12">
						<div class="control-group"><label class="control-label">Content:</label><textarea class="form-control" name="content"></textarea></div>
						<input type="hidden" name="parent_id" value="{{commentid}}">
						<input type="hidden" name="post_id" value="{{postid}}">
						</form></div>'
	};

	$('.commentReply').on('click', function(e) 
	{
		e.preventDefault();

		var data = {
			postid: $(this).data('post'),
			commentid: $(this).data('comment'),
			route: $(this).data('route')
		};

		bootbox.dialog(
		{
			message: Mustache.render(mustacheTmpl.commentreply, data),
			title: 'Add New Reply',
			buttons: {
				success: {
					label: 'Post Comment',
					className: 'btn-success',
					callback: function() {
						$('#'+data.postid+'-replyform').submit();
					}
				},
				danger: {
					label: "Cancel",
					className: "btn-danger",
					callback: function() {
						return;
					}
				}
			}
		});
	});

	$('.viewCommentParent').on('click', function(e) {
		e.preventDefault();
		var data = {
			content: $(this).data('content'),
			added: $(this).data('added'),
			user: $(this).data('user')
		};
		bootbox.alert(Mustache.render(mustacheTmpl.commentview, data));
	});

	$('.addNewComment').on('click', function(e) 
	{
		e.preventDefault();
		var data = {
			route: $(this).data('route'),
			postid: $(this).data('post')			
		};
		bootbox.dialog({
			message: Mustache.render(mustacheTmpl.commentnew, data),
			title: "Add new comment",
			buttons: {
				success: {
					label: 'Add Comment',
					className: 'btn-success',
					callback: function() {
						$('#newcommentform').submit();
					}
				},
				danger: {
					label: "Cancel",
					className: "btn-danger",
					callback: function() {
						return;
					}
				}
			}
		});
	});
	
})(jQuery);
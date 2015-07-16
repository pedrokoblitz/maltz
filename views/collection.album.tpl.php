<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

<script>
	
$(document).ready(function(){
	$("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    $("[data-toggle=tooltip]").tooltip();
});

</script>


<!--table-->
<div id="recordList" class="col-md-8">
    <table class="table">
      <caption>Optional table caption.</caption>
		<thead>
			<th><input type="checkbox" id="checkall" /></th>
			<th>Slug</th>
			<th>Name</th>
			<th>Title</th>
			<th>Subtitle</th>
			<th>Excerpt</th>
			<th>Edit</th>
			<th>Delete</th>
		</thead>
		<tbody>
		    <tr>
		    <td><input type="checkbox" class="checkthis" /></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
		    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
		    </tr>
	    </tbody>
    </table>
</div>
<div class="col-md-4">
	teste
</div>


<!--form-->

<div id="mainForm">
	<form class="form-horizontal">
	<fieldset>

	<legend>Form Name</legend>

	<div class="form-group">
	  <label class="col-md-4 control-label" for="title">Title</label>  
	  <div class="col-md-6">
	  <input id="title" name="title" placeholder="placeholder" class="form-control input-md" type="text">
	  <span class="help-block">help</span>
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-4 control-label" for="subtitle">Subtitle</label>  
	  <div class="col-md-8">
	  <input id="subtitle" name="subtitle" placeholder="placeholder" class="form-control input-md" type="text">
	  <span class="help-block">help</span>  
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-4 control-label" for="excerpt">Excerpt</label>
	  <div class="col-md-4">                     
	    <textarea class="form-control" id="excerpt" name="excerpt">default text</textarea>
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-4 control-label" for="description">Description</label>
	  <div class="col-md-4">                     
	    <textarea class="form-control" id="description" name="description">default text</textarea>
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-4 control-label" for="body">Body</label>
	  <div class="col-md-4">                     
	    <textarea class="form-control" id="body" name="body">default text</textarea>
	  </div>
	</div>

	</fieldset>


	<!--select and dropdown-->
	<fieldset>

	<legend>Form Name</legend>

	<div class="form-group">
	  <label class="col-md-4 control-label" for="selectmultiple">Select Multiple</label>
	  <div class="col-md-4">
	    <select id="selectmultiple" name="selectmultiple" class="form-control" multiple="multiple">
	      <option value="1">Option one</option>
	      <option value="2">Option two</option>
	    </select>
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-4 control-label" for="selectbasic">Select Basic</label>
	  <div class="col-md-4">
	    <select id="selectbasic" name="selectbasic" class="form-control">
	      <option value="1">Option one</option>
	      <option value="2">Option two</option>
	    </select>
	  </div>
	</div>

	</fieldset>

	<!-- buttons -->
	<fieldset>

	<legend>Form Name</legend>

	<div class="form-group">
	  <label class="col-md-4 control-label" for="button1id">Double Button</label>
	  <div class="col-md-8">
	    <button id="button1id" name="button1id" class="btn btn-success">Good Button</button>
	    <button id="button2id" name="button2id" class="btn btn-danger">Scary Button</button>
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-4 control-label" for="singlebutton">Single Button</label>
	  <div class="col-md-4">
	    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Button</button>
	  </div>
	</div>

	</fieldset>

	</form>
</div>

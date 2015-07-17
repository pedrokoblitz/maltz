<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>
    Bootstrap &middot; The world's most popular mobile-first and responsive front-end framework.
    </title>
    <link href="/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/assets/css/sheet.css" rel="stylesheet">
    <!--[if lt IE 9]><script src="/public/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/public/assets/js/ie-emulation-modes-warning.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/public/assets/img/apple-touch-icon.png">
    <link rel="icon" href="/favicon.ico">
  </head>
  <body>
    <body>
      <div class="container-fluid">
        <div id="screen" class="row">
          <div id="menu" class="col-md-3">
            <nav class="navbar navbar-inverse sidebar" role="navigation">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">Brand</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                    <li ><a href="#">Profile<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a></li>
                    <li ><a href="#">Messages<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span></a>
                      <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                      </ul>
                    </li>
                    <li><a href="#">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                    <li ><a href="#">Profile<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a></li>
                    <li ><a href="#">Messages<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span></a>
                      <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
          
          <div id="panel" class="panel col-md-9">
            
            <div id="recordList" class="row recordList">
              
              <table id="mytable" class="col-md-12 table table-bordred table-striped">
                
                <thead>
                  
                  <th><input type="checkbox" id="checkall" /></th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>Contact</th>
                  <th>Edit</th>
                  
                  <th>Delete</th>
                </thead>
                <tbody>
                  
                  <tr>
                    <td><input type="checkbox" class="checkthis" /></td>
                    <td>Mohsin</td>
                    <td>Irshad</td>
                    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
                    <td>isometric.mohsin@gmail.com</td>
                    <td>+923335586757</td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                  </tr>
                  
                  <tr>
                    <td><input type="checkbox" class="checkthis" /></td>
                    <td>Mohsin</td>
                    <td>Irshad</td>
                    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
                    <td>isometric.mohsin@gmail.com</td>
                    <td>+923335586757</td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                  </tr>
                  
                  
                  <tr>
                    <td><input type="checkbox" class="checkthis" /></td>
                    <td>Mohsin</td>
                    <td>Irshad</td>
                    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
                    <td>isometric.mohsin@gmail.com</td>
                    <td>+923335586757</td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                  </tr>
                  
                  
                  
                  <tr>
                    <td><input type="checkbox" class="checkthis" /></td>
                    <td>Mohsin</td>
                    <td>Irshad</td>
                    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
                    <td>isometric.mohsin@gmail.com</td>
                    <td>+923335586757</td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                  </tr>
                  
                  
                  <tr>
                    <td><input type="checkbox" class="checkthis" /></td>
                    <td>Mohsin</td>
                    <td>Irshad</td>
                    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
                    <td>isometric.mohsin@gmail.com</td>
                    <td>+923335586757</td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                  </tr>
                  
                  
                  
                  
                  
                </tbody>
                
              </table>
            </div>
            
            <div id="singleRecord" class="row">
              
              <div id="mainForm" class="mainForm col-md-7">
                <!--content form-->
                <form>
                  <!--hidden fields-->
                  <fieldset id="" class="">
                    <input id="" type="hidden" name="" value="">
                  </fieldset>
                  <fieldset id="" class="row">
                    <legend>Form Name</legend>
                    <label class="col-md-4 control-label" for="activity">Activity</label>
                    <select id="activity" name="activity" class="form-control">
                      <option value="3">Draft</option>
                      <option value="4">Pending</option>
                      <option value="5">Published</option>
                    </select>
                    
                    <label class="col-md-4 control-label" for="type">Type</label>
                    <select id="type" name="type" class="form-control">
                    </select>
                    
                    <label class="col-md-4 control-label" for="date_pub">Published</label>
                    <input id="date_pub" name="date_pub" placeholder="placeholder" class="form-control input-md" type="text">
                    <span class="help-block">help</span>
                    
                    <label class="col-md-4 control-label" for="title">Title</label>
                    <input id="title" name="title" placeholder="placeholder" class="form-control input-md" type="text">
                    <span class="help-block">help</span>
                    
                    <label class="col-md-4 control-label" for="subtitle">Subtitle</label>
                    <input id="subtitle" name="subtitle" placeholder="placeholder" class="form-control input-md" type="text">
                    <span class="help-block">help</span>
                    
                    <label class="col-md-4 control-label" for="excerpt">Excerpt</label>
                    <textarea class="form-control" id="excerpt" name="excerpt"></textarea>
                    
                    <label class="col-md-4 control-label" for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                    
                    <label class="col-md-4 control-label" for="body">Body</label>
                    <textarea class="form-control" id="body" name="body"></textarea>
                    
                  </fieldset>
                </form>
              </div>
              
              <div id="attachmentForm" class="attachmentForm col-md-5">
                <form>
                  <!--hidden fields-->
                  <fieldset id="" class="">
                    <input id="" type="hidden" name="" value="">
                  </fieldset>
                  <fieldset>
                    <legend>Attachments</legend>
                    <div class="col-md-6 form-group">
                      <select id="attachment_type" name="attachment_type" class="form-control">
                      </select>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                  </fieldset>
                </form>
                
                <div id="attachmentList" class="attachmentList">
                  <div id="attachmentListItems" class="attachmentListItems">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            Column heading
                          </th>
                          <th>
                            Column heading
                          </th>
                          <th>
                            Column heading
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="active">
                          <td>
                            Column content
                          </td>
                          <td>
                            Column content
                          </td>
                          <td>
                            Column content
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Column content
                          </td>
                          <td>
                            Column content
                          </td>
                          <td>
                            Column content
                          </td>
                        </tr>
                        <tr class="success">
                          <td>
                            Column content
                          </td>
                          <td>
                            Column content
                          </td>
                          <td>
                            Column content
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Column content
                          </td>
                          <td>
                            Column content
                          </td>
                          <td>
                            Column content
                          </td>
                        </tr>
                        <tr class="warning">
                          <td>
                            Column content
                          </td>
                          <td>
                            Column content
                          </td>
                          <td>
                            Column content
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Column content
                          </td>
                          <td>
                            Column content
                          </td>
                          <td>
                            Column content
                          </td>
                        </tr>
                        <tr class="danger">
                          <td>
                            Column content
                          </td>
                          <td>
                            Column content
                          </td>
                          <td>
                            Column content
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <script src="/public/assets/jquery.min.js"></script>
        <script src="/public/assets/js/bootstrap.min.js"></script>
        <script src="/public/assets/js/ie10-viewport-bug-workaround.js"></script>
        <script src="/public/assets/js/init.js"></script>
        
      </div>
    </div>
  </body>
</html>
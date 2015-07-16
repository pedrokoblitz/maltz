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

<!--[if lt IE 9]><script src="../public/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
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
        
        <div id="" class="well">
        </div>

      </div>

      <div id="panel" class="col-md-9">

        <div id="recordList" class="row">
            <table class="table col-md-12">
              <caption></caption>
              <thead>
                <tr>

                </tr>
              </thead>
              <tbody>
                <tr>

                </tr>
              </tbody>
            </table>
        </div>

        <div id="main" class="row">
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

                  <label class="col-md-4 control-label" for="date_pub">Published</label>  
                  <input id="date_pub" name="date_pub" placeholder="placeholder" class="form-control input-md" type="text">
                  <span class="help-block">help</span>

                  <label class="col-md-4 control-label" for="title">Title</label>  
                  <input id="title" name="title" placeholder="placeholder" class="form-control input-md" type="text">
                  <span class="help-block">help</span>

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
            </form>              
          </div>

          <div id="attachmentForm" class="attachmentForm col-md-5">

            <form>

              <!--hidden fields-->
              <fieldset id="" class="">
                <input id="" type="hidden" name="" value="">
              </fieldset>

              <fieldset>

                <legend>Form Name</legend>

                  <label class="col-md-4 control-label" for="selectmultiple">Select Multiple</label>
                    <select id="selectmultiple" name="selectmultiple" class="form-control" multiple="multiple">
                      <option value="1">Option one</option>
                      <option value="2">Option two</option>
                    </select>

                <div class="form-group">
                  <label class="col-md-4 control-label" for="">Select Basic</label>
                  <div class="col-md-4">
                    <select id="" name="" class="form-control">
                      <option value="1">Option one</option>
                      <option value="2">Option two</option>
                    </select>
                  </div>
                </div>

              </fieldset>
            </form>

            <!--buttons-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="button1id">Double Button</label>
              <div class="col-md-8">
                <button id="button1id" name="button1id" class="btn btn-success">Good Button</button>
                <button id="button2id" name="button2id" class="btn btn-danger">Scary Button</button>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="">Single Button</label>
              <div class="col-md-4">
                <button id="" name="" class="btn btn-primary">Button</button>
              </div>
            </div>

            <div id="attachmentList" class="attachmentList col-md-4">

            </div>
          </div>
      
        </div>
      </div>

      <script src="/public/assets/jquery.min.js"></script>
      <script src="/public/assets/js/bootstrap.min.js"></script>
      <script src="/public/assets/js/ie10-viewport-bug-workaround.js"></script>

    </div>
  </div>

  </body>
</html>

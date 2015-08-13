  <div class="container-fluid">
    <div id="screen" class="row">
     
      <div id="panel" class="panel col-md-9">
        
        <div id="recordList" class="row recordList">
          

        </div>
        
        <div id="singleRecord" class="row singleRecord">
          

        </div>
        
        <div id="updateRecord" class="row updateRecord">
          
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
                        #
                      </th>
                      <th>
                        title
                      </th>
                      <th>
                        type
                      </th>
                      <th>
                        actions
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <input type='checkbox'>
                      </td>
                      <td>
                        {{attachment.title}}
                      </td>
                      <td>
                        {{attachment.type}}
                      </td>
                      <td>
                        <a id="" class="" href="#">add</a>
                        <a id="" class="" href="#">edit</a>
                        <a id="" class="" href="#">delete</a>
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
  </div>
</div>

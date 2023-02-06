<div class="modal fade" id="addTodoModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Add Todo</h4>
          </div>
          <div class="modal-body">
  
                  <div class="form-group">
                      <label for="name" class="col-sm-2">Task</label>
                      <div class="col-sm-12">
                          <input type="text" class="form-control" id="task" name="todo" placeholder="Enter task">
                          <span id="taskError" class="alert-message"></span>
                      </div>
                  </div>
  
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="addTodo()">Save</button>
          </div>
      </div>
  </div>
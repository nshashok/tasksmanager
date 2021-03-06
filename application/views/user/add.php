<?php echo form_open('user/add',array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="admin" class="col-md-4 control-label">Admin</label>
		<div class="col-md-8">
			<input type="checkbox" name="admin" value="1" id="admin" />
		</div>
	</div>
	<div class="form-group">
		<label for="login" class="col-md-4 control-label">Login</label>
		<div class="col-md-8">
			<input type="text" name="login" value="<?php echo $this->input->post('login'); ?>" class="form-control" id="login" />
		</div>
	</div>
	<div class="form-group">
		<label for="hash" class="col-md-4 control-label">Hash</label>
		<div class="col-md-8">
			<input type="text" name="hash" value="<?php echo $this->input->post('hash'); ?>" class="form-control" id="hash" />
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-md-4 control-label">Firstname</label>
		<div class="col-md-8">
			<input type="text" name="firstname" value="<?php echo $this->input->post('firstname'); ?>" class="form-control" id="firstname" />
		</div>
	</div>
	<div class="form-group">
		<label for="surname" class="col-md-4 control-label">Surname</label>
		<div class="col-md-8">
			<input type="text" name="surname" value="<?php echo $this->input->post('surname'); ?>" class="form-control" id="surname" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>

<?php echo form_close(); ?>
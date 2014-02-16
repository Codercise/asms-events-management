    <div id="attendModal" class="modal hide" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Your details</h3>
      </div>
      <div class="modal-body">
        <p>As part of our continual commitment to professional development we need some more details for you so we can tailor make our programs to suit the needs
          of the people attending our programs. Unfortuantely we won't be able to let you attend an event without adding in these extra details.</p>
      </div>
        {{Form::open('user/attend_modal', 'POST', array('id' => '#event-modal-form', 'class' =>'event-modal-form'))}}
        <div class="control-group">
          {{Form::label('position', "Position: ", array('class' => 'control-label'))}}
        <div class="controls">
          {{Form::text('position', '', array('placeholder' => "Your job title please, acronyms are okay!"))}}
        </div>
        </div>

        <div class="control-group">
          {{Form::label('gender', "Gender: ", array('class' => 'control-label'))}}
        <div class="controls">
        <?php echo Form::select('gender', array(
          '' => 'Select Your Gender',
          'M' => 'Male',
          'F' => 'Female',
          'N/A' => 'No Answer'
        )); ?>
        </div>
        </div>

        <div class="control-group">
          {{Form::label('years_taught', "Years Taught: ", array('class' => 'control-label'))}}
        <div class="controls">
          <?php echo Form::select('years_taught', array(
          '' => 'What year levels do you teach? (If more than one pick your favorite)',
          'Primary' => 'Primary',
          'Middle' => 'Middle',
          'Senior Secondary' => 'Senior Secondary',
          'Tertiary' => 'Tertiary',
          'Other' => 'Other'
          )); ?>
        </div>
        </div>

        <div class="control-group">
        {{Form::label('organization_name', "Organization Name: ", array('class' => 'control-label'))}}
        <div class="controls">
        {{Form::text('organization_name', '', array('placeholder' => 'The name of your school please'))}}
        </div>
        </div>

        <div class="control-group">
        {{Form::label('sector', "Education Sector: ", array('class' => 'control-label'))}}
        <div class="controls">
        <?php echo Form::select('sector', array(
          '' => 'What education sector are you from?',
          'Public' => 'Public',
          'Catholic Ed' => 'Catholic Ed',
          'Independent' => 'Independent',
          'Tertiary' => 'Tertiary',
          'Other' => 'Other'
          )); ?>
        </div>
        </div>
        <?php echo "<input name='pdevent_id' type='hidden' class='hidden' value='{$pdevent->id}' />"; ?>
      <div class="modal-footer">
        <a href="#"><button class="btn btn-primary">Sign me up!</button></a>
        <a href="#" class="btn btn-danger" data-dismiss="modal">I'll do it later.</a>
      </div>
      <?php echo Form::close(); ?>
    </div>
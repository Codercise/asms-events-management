    <div id="unattendModal" class="modal hide" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>We'll miss you</h3>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to leave this event? We <strong>can't</strong> hold your place for other teachers, if you've booked this spot but want to give it to someone else
          <a href="/contact">please contact us</a>.</p>

        <p>If you don't want to come to the event for other reasons that's okay we'll still be your friend.</p>
      </div>
      <div class="modal-footer">
        <a href="/event/{{$pdevent->id}}/unattend"><button class="btn btn-danger">I want to unattend</button></a>
        <a href="#" class="btn btn-primary" data-dismiss="modal">I still want to attend</a>
      </div>
    </div>
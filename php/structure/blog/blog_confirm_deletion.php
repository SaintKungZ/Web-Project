<div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <p>Do you want to Delete this Blog ?</p>
      </div>
      
      <form action="" id="form_confirm_deletion" method="POST">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="delete-blog" class="btn btn-danger px-4" data-bs-dismiss="modal">Delete</button>
        </div>
      </form>

    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

    $('.delete_button').on('click', function() 
      {
        var location = $(this).attr("id");
        
        $('#form_confirm_deletion').attr('action',location);  
        
        $('#delete-modal').modal('show');  
            
      });

  });
</script>
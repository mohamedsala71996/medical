<!-- Modal Structure -->
<div class="modal fade" id="deleteCommentModal{{ $comment->id }}" tabindex="-1" aria-labelledby="deleteCommentModalLabel{{ $comment->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteCommentModalLabel{{ $comment->id }}">{{ __('Confirm Delete') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              {{ __('Are you sure you want to unassign this agent?') }}
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
              <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
              </form>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="modal-delete">
    <form action="{{$modalAction ?? ""}}" method="post" role="form" id="form-delete" >
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{$modalTitle}}</h4>
                </div>
                <div class="modal-body">
                    {{$slot}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Si</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->
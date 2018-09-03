<div id="modal-form" class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <form id="ps-form" class="form-horizontal" method="post">
        {{ csrf_field() }}
        <input type="hidden" id="id" name="id" value="">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="parent_id" class="pull-left">Parent Warna <span style="color: red">*</span></label>
                    <select id="parent_id" name="parent_id" class="js-example-responsive" data-placeholder="Pilih Parent Warna" style="width: 100%;">
                        @include('becolor::partials.select')
                    </select>
                </div>
                <div class="form-group">
                    <label for="name" class="pull-left">Nama Warna <span style="color: red">*</span></label>
                    <input required type="text" name="name" class="form-control" id="name" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-rounded btn-danger waves-effect" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-lg btn-rounded btn-success waves-effect ">Simpan</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->


<div id="modal-detail" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <input type="hidden" id="id" name="id" value="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                    <table id="" class="table table-bordered sticky-table-header fixed-solution">
                        <tbody>
                        <tr>
                            <td class="">Nama</td>
                            <td class=""><span id="d_name"></span></td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



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
                    <label for="product_id" class="pull-left">Nama Produk<span style="color: red">*</span></label>
                    <select id="product_id" name="product_id" class="js-example-responsive" data-placeholder="Pilih Produk" style="width: 100%;">
                        @include('bediscount::partials.select')
                    </select>
                </div>
                <div class="form-group">
                    <label for="name" class="pull-left">Persen<span style="color: red">*</span></label>
                    <input style="width: 95%;" required type="text" name="percent" class="form-control" id="percent" value="">
                        <span style="float: right; margin: -24px 15px 0px;">%</span>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Mulai</label>
                    <input required type="date" value="" name="date_start" class="form-control" id="date_start">
                </div>
                <div class="form-group">
                    <label for="">Tanggal Berakhir</label>
                    <input required type="date" value="" name="date_end" class="form-control" id="date_end">
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
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                    <table id="" class="table table-bordered sticky-table-header fixed-solution">
                        <tbody>
                        <tr>
                            <td class="">Produk ID</td>
                            <td class=""><span id="d_product"></span></td>
                        </tr>
                        <tr>
                            <td class="">Persen</td>
                            <td class=""><span id="d_percent"></span></td>
                        </tr>
                        <tr>
                            <td class="">Tanggal Mulai</td>
                            <td class=""><span id="d_date_start"></span></td>
                        </tr>
                        <tr>
                            <td class="">Tanggal Berakhir</td>
                            <td class=""><span id="d_date_end"></span></td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




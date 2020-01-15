<section class="card">
      <div class="card-header">
        <h4 class="card-title">Edit item</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <form method="post" action="<?php echo base_url().$action ?>" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">id_item</label>
              <div class="col-sm-10">
                <input type="text" name="id_item" class="form-control" placeholder="" value="<?php echo $dataedit->id_item?>" readonly>
              </div>
            </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">id_menu</label>
              <div class="col-sm-10">
                <input type="text" name="id_menu" class="form-control" value="<?php echo $dataedit->id_menu?>">
              </div>
              </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">qty</label>
              <div class="col-sm-10">
                <input type="text" name="qty" class="form-control" value="<?php echo $dataedit->qty?>">
              </div>
              </div>

        </div>
        <input type="hidden" id="deleteFiles" name="deleteFiles">
        <div class="col-12">
          <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect
           waves-light float-right">Simpan</button>
        </div>
      </form>
      </div>
    </section>

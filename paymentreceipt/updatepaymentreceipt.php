<form action="../paymentreceipt/function_paymentreceipt.php?act=detailpayments"
                                  method="post" role="form" enctype="multipart/form-data">                                
                                <?php
                                  $GApayment_id = $row['GApayment_id'];
                                  $query = "SELECT 
                                  GApayment_id,
                                  nama_request,
                                  keterangandepartment,
                                  source_id,
                                  namabarang,
                                  DATE_FORMAT(tanggal_pembelian,'%d/%m/%Y') AS tanggal_pembelian,
                                  kategori,
                                  usagegeneralaffair,
                                  deskripsi_items,
                                  jumlah_items,
                                  keterangansatuan,
                                  hargaitems,
                                  (jumlah_items*hargaitems) AS total_harga,
                                  price_estimate,
                                  keterangan,
                                  inputdate,
                                  CASE STATUS
                                    WHEN 'Checked' THEN 'Checked'
                                    WHEN 'Processed' THEN 'Processed'
                                    WHEN 'Pending' THEN 'Pending'
                                    WHEN 'Cancelled' THEN 'Cancelled'
                                    WHEN 'Finished' THEN 'Finished'
                                    END AS statustransaksi
                                FROM
                                  paymentreceipt_apps.generalaffairspayment
                                  LEFT JOIN requests ON generalaffairspayment.request_id = requests.request_id
                                  LEFT JOIN department ON generalaffairspayment.department_id = department.department_id
                                  LEFT JOIN sourcesproc ON generalaffairspayment.source_id = sourcesproc.sources_id
                                  LEFT JOIN satuan ON generalaffairspayment.units_id = satuan.unit_id
                                  LEFT JOIN categories ON generalaffairspayment.kategori_id = categories.categories_id
                                  WHERE GApayment_id='$GApayment_id'";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">Nama Request: 
                                      <span class="text-red">*</span></label>
                                    <div class="col-sm-5">
                                      <select class="form-control" name="request_id" id="requestdata">
                                        <option value="">- Nama Request -</option>
                                        <?php 
                                        $datareq = mysqli_query($koneksi,"SELECT 
                                        nama_request 
                                        FROM paymentreceipt_apps.requests");
                                        while($d = mysqli_fetch_array($datareq)){
                                            // Cek apakah nilai dari data yang akan ditampilkan sama dengan nilai dari data yang akan diedit
                                            $selected = ($d['request_id'] == $row['request_id']) ? 'selected' : '';
                                        ?>
                                        <option readonly value="<?php echo $d['request_id']; ?>" <?php echo $selected; ?>><?php echo $d['nama_request']; ?></option>
                                        <?php 
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">Department: 
                                      <span class="text-red">*</span></label>
                                    <div class="col-sm-5">
                                      <select class="form-control" name="department_id" id="departmentdata">
                                        <option value="">Choose Department</option>
                                        <?php 
                                        $datadepartment = mysqli_query($koneksi,"SELECT 
                                        keterangandepartment 
                                        FROM paymentreceipt_apps.department 
                                        ORDER BY nama_department ASC");
                                        while($d = mysqli_fetch_array($datadepartment)){
                                            // Cek apakah nilai dari data yang akan ditampilkan sama dengan nilai dari data yang akan diedit
                                            $selected = ($d['department_id'] == $row['department_id']) ? 'selected' : '';
                                        ?>
                                        <option readonly value="<?php echo $d['department_id']; ?>" <?php echo $selected; ?>><?php echo $d['keterangandepartment']; ?></option>
                                        <?php 
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>


                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">Categories: 
                                      <span class="text-red">*</span></label>
                                    <div class="col-sm-5">
                                      <select class="form-control" name="kategori_id" id="categoriesdata">
                                        <option value="">Choose Categories</option>
                                        <?php 
                                        $datacategories = mysqli_query($koneksi,"SELECT 
                                        kategori 
                                        FROM paymentreceipt_apps.categories 
                                        ORDER BY kategori ASC");
                                        while($d = mysqli_fetch_array($datacategories)){
                                            // Cek apakah nilai dari data yang akan ditampilkan sama dengan nilai dari data yang akan diedit
                                            $selected = ($d['categories_id'] == $row['categories_id']) ? 'selected' : '';
                                        ?>
                                        <option readonly value="<?php echo $d['categories_id']; ?>" <?php echo $selected; ?>><?php echo $d['kategori']; ?></option>
                                        <?php 
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-4 control-label text-right">Tanggal Pembelian: <span
                                          class="text-red">*</span></label>
                                      <div class="col-sm-5">
                                        <input type="date" class="form-control" name="tanggal_pembelian" placeholder="Tanggal Pembelian ..." value="<?php echo $row['tanggal_pembelian']; ?>" ></div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-4 control-label text-right">Peruntukan/Usage: <span
                                          class="text-red">*</span></label>
                                      <div class="col-sm-5">
                                        <!-- <textarea name="usagegeneralaffair" class="form-control ckeditor" id="usagegeneralaffair" cols="3" rows="3" value="<?php echo $row['usagegeneralaffair']; ?>"></textarea> -->
                                          <input type="text" name="usagegeneralaffair" id="usagegeneralaffair" class="form-control" value="<?php echo $row['usagegeneralaffair']; ?>"  readonly>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-4 control-label text-right">Description Items: <span
                                          class="text-red">*</span></label>
                                      <div class="col-sm-5">
                                        <!-- <textarea name="deskripsi_items" id="deskripsi_items" class="form-control ckeditor" cols="3" rows="3" value="<?php echo $row['deskripsi_items']; ?>"></textarea> -->
                                        <input type="text" name="deskripsi_items" id="deskripsi_items" value="<?php echo $row['deskripsi_items']; ?>" class="form-control"  readonly>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Quantity: <span
                                          class="text-red">*</span></label>
                                      <div class="col-sm-2">
                                        <input type="number" class="form-control" name="jumlah_items" placeholder="xxx" value="<?php echo $row['jumlah_items']; ?>" onkeyup="OnChange(this.value)"onKeyPress="return isNumberKey(event)" align="center" >
                                      </div>
                                      <label class="col-sm-2 control-label text-right">Units: <span
                                          class="text-red">*</span></label>
                                      <div class="col-sm-3">
                                        <select class="form-control" name="units_id" id="sourcesatuan">
                                          <option value=""> - </option>
                                          <?php 
                                        $datasatuan = mysqli_query($koneksi,"SELECT 
                                        * 
                                        FROM paymentreceipt_apps.satuan
                                        ORDER BY keterangansatuan ASC
                                        ");
                                        while($d = mysqli_fetch_array($datasatuan)){
                                            ?>
                                          <option value="<?php echo $d['unit_id']; ?>"
                                            value="<?php echo $row['units_id']; ?>">

                                            <?php echo $d['keterangansatuan']; ?>
                                          </option>
                                          <?php 
                      }
                      ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Harga Items: 
                                        <span class="text-red">*</span></label>
                                      <div class="col-sm-3 input-group">
                                        <div class="input-group-prepend"></div>
                                          <!-- <span class="input-group-text" style="font-size: 14px;">Rp</span> -->
                                          <label>Rp</label>
                                        <input type="number" class="form-control" name="hargaitems" id="hargaitems" placeholder="xxx" value="<?php echo $row['hargaitems']; ?>" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)" >
                                        <div class="input-group-append">
                                          <span class="input-group-text" style="font-size: 14px;">,00</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>


                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Total Harga: <span
                                          class="text-red">*</span></label>
                                      <div class="col-sm-5">
                                        <!-- <span class="input-group-addon">Rp </span> -->
                                        <input type="number" class="form-control" name="total_harga" id="total_harga" placeholder="Rp xxx" value="<?php echo $row['total_harga']; ?>" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)" readonly>
                                        <span class="input-group-addon">,00</span>
                                      </div>
                                    </div>
                                  </div>

                                  <!-- <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Link Pembelian:
                                        <span class="text-red">*</span>
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="url" name="linkpembelian" id="linkpembelian" class="form-control"
                                          value="<?php echo $row['linkpembelian']; ?>">
                                      </div>
                                    </div>
                                  </div> -->

                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Price Estimated: <span
                                          class="text-red">*</span></label>
                                      <div class="col-sm-5">
                                        <span class="input-group-addon">Rp </span>
                                        <input type="number" class="form-control" name="price_estimate"
                                          placeholder="xxx" value="<?php echo $row['price_estimate']; ?>">
                                        <span class="input-group-addon">,00</span>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-4 control-label text-right">Keterangan Barang: 
                                        <span class="text-red">*</span></label>
                                      <div class="col-sm-5">
                          <textarea name="keterangan"  readonly id="keterangan" class="form-control" cols="3" rows="3" value=""><?php echo $row['keterangan']; ?></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Status : </label>
                                      <!-- <span class="text-red"></span> -->
                                      <div class="col-sm-4">
                                <select name="status" class="form-control select2" style="width: 100%;">
                                  <option value="" selected="selected">-- Status Transaksi --</option>
                                  <option value="Checked <?php echo $row['status']=='Checked'? 'selected':'';?>">Checked</option>
                                  <option value="Processed <?php echo $row['status']=='Processed'? 'selected':'';?>">Processed</option>
                                  <option value="Pending <?php echo $row['status']=='Pending'? 'selected':'';?>">Pending</option>
                                  <option value="Cancelled <?php echo $row['status']=='Cancelled'? 'selected':'';?>">Cancelled</option>
                                  <option value="Finished <?php echo $row['status']=='Finished'? 'selected':'';?>">Finished</option>
                                </select>
                                      </div>
                                    </div><br>
                                    <?php
                                  }
                                  ?>
                                  </div>
                                </form>
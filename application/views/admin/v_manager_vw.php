<?php $this->load->view('template/v_header'); ?>
<?php $this->load->view('template/v_menu'); ?>



<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>Personal Overview</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i
                                                    class="feather icon-chevron-left open-card-option"></i></li>
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table class="table table-hover m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>Personel</th>
                                                    <th>Telefon</th>
                                                    <th>Bellek_boyutu</th>
                                                    <th>SON_GİRİS</th>
                                                    <th>FAK_KOD</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-inline-block align-middle">
                                                            <img src="<?php echo base_url(); ?>html/files/assets/images/avatar.jpg"
                                                                alt="user image"
                                                                class="img-radius img-40 align-top m-r-15">
                                                            <div class="d-inline-block">
                                                                <h6><?php echo "FURKAN KAHVECİ" ; ?></h6>
                                                                <p class="text-muted m-b-0">
                                                                    <?php echo "furkankahveci@klu.edu.tr" ?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo "XXXX XXX XX XX" ?></td>
                                                    <td><?php echo "1000 MB"; ?></td>
                                                    <td><?php echo "2020-03-02 21:34:13"; ?></td>
                                                    <td><?php echo "5"; ?></td>
                                                    <td>
                                                        <form action="<?php echo base_url();?>Manager" method="post"
                                                            style="display:inline-block;">
                                                            <button type="submit" title="Update" class="btn"
                                                                style="padding:2px 4px 4px 2px; margin:0px;">
                                                                <i
                                                                    class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </button>
                                                        </form>
                                                        <form action="<?php echo base_url();?>Manager" method="post"
                                                            style="display:inline-block;">
                                                            <button type="submit" title="Update" class="btn"
                                                                style="padding:2px 4px 4px 2px; margin:0px;">
                                                                <i
                                                                    class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('template/v_footer'); ?>
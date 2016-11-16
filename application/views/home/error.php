<?php $this->load->view('frontend/header') ?>
    <div class="container">
        <div class="box box-solid" style="margin-top: 10px">
            <div class="box-body">
                <?php
                if(file_exists(MY_IMAGEPATH."404.png")) {
                    ?>
                    <img src="<?=MY_IMAGEURL."404.png"?>" width="100%" alt="Page Not Found" />
                    <?php
                } else {
                    ?>
                    <p style="font-size: 36px">Maaf, halaman tidak ditemukan</p>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php $this->load->view('frontend/footer') ?>
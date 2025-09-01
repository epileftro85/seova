<section class="contact-section section" id="contact">
    <div class="container">
        <div class="title">
            <h3>Contact Us</h3>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-6 mb-4 contact-form">
                <div class="form tm-contact-item-inner">
                    <form action="<?php echo $this->siteUrl; ?>/contact" method="POST">
                        <div class="form-group">
                            <input name="name" required type="text" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input name="email" required type="text" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <textarea name="message" required class="textarea form-control" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-white" value="Send it">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
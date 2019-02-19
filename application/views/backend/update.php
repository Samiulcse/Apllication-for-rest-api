<section class="content">
    <div class="container-fluid">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Add New Book
                    </h2>

                </div>
                <div class="body">
                    <form method="post" action="<?php echo base_url('admin/update/').$id ?>">
                        <label for="email_address">Book Title</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="title" id="title" value=" <?php echo $book['title'] ?>" class="form-control"
                                       placeholder="Enter Book Title">
                            </div>
                        </div>
                        <label for="password">Author Name</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="author" id="author" value=" <?php echo $book['author'] ?>"  class="form-control"
                                       placeholder="Enter Author Name">
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Upadate Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

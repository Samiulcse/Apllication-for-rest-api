<section class="content">
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            All Books
                            <a href="<?php echo base_url('admin/create')?>" class="pull-right btn btn-primary">Add New Book</a>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable"
                                       id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info">
                                    <thead>
                                    <tr>
                                        <th rowspan="1" colspan="1">Id</th>
                                        <th rowspan="1" colspan="1">Title</th>
                                        <th rowspan="1" colspan="1">Author</th>
                                        <th rowspan="1" colspan="1">Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Id</th>
                                        <th rowspan="1" colspan="1">Title</th>
                                        <th rowspan="1" colspan="1">Author</th>
                                        <th rowspan="1" colspan="1">Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($books as $book){?>
                                    <tr role="row" class="even">
                                        <td class="sorting_1"><?php echo $book['id'];?></td>
                                        <td><?php echo $book['title'];?></td>
                                        <td><?php echo $book['author'];?></td>
                                        <td>
                                            <a href="<?php echo base_url() ?>admin/detail/<?php echo $book['id']; ?>" class="btn btn-primary">Update</a>
                                            <a href="#" id="<?php echo $book['id']; ?>" class="btn delete btn-danger ">Delete</a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>

<script>
    $(document).ready(function () {
        $(".delete").click(function (e) {
            var id=$(this).attr("id");

            if(confirm("Are you sure you want to delete this?"))
            {
                window.location="<?php echo base_url(); ?>admin/delete/"+id;
            }
            else
            {
                return false;
            }
        });
    });
</script>
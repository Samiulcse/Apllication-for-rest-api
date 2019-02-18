<section class="content">
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            All Books
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another
                                            action</a></li>
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else
                                            here</a></li>
                                </ul>
                            </li>
                        </ul>
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
                                        <td></td>
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
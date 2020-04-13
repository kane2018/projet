<!-- Dépendances -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-offset-1 col-md-10">

                <h1>Utilisateurs</h1>
            
            <a class="btn btn-info" href="<?php echo site_url('user/create_user'); ?>">Ajouter un utilsateur</a>
              

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">La liste des utilsateurs</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">

                        <table id="table" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>N°</th>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Téléphone</th>
                                <th>adresse</th>
                                <th>Email</th>
                                <th >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                    </div>
                </div>

                


            </div>
            <!-- /.row -->

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#table').DataTable({

            // On indique qu'on veut un traitement côté serveur
            "processing": true,
            "serverSide": true,

            // On charge les données à partir d'une source Ajax
            "ajax": {
                "url": "<?php echo site_url('user/getList')?>",
                "type": "POST"
            },

            "order": [], // Pas d'ordre
            // Permet de définir les propriétés des colonnes
            "columnDefs": [
                {
                    "targets": [ 0 ], // On cible la première colonne
                    "orderable": false, // On fait en sorte que ce soit pas ordonnable
                },
            ],

            // // Création de filtres personnalisés sous chaques colonnes pour faire une recherche par colonne
            // initComplete: function(){
            //     $('#table tfoot th').each( function () {
            //         var title = $(this).text();
            //         $(this).html( '<input type="text" placeholder="Rechercher '+title+'" />' );
            //     } );
            //     table.columns().every( function () {
            //         var that = this;
            //
            //     } );
            // }
        });
    });
</script>



<?php

class User_model extends CI_Model
{

    var $table = 'utilisateur';
    var $column_order = array(null , 'prenom', 'nom', 'telephone','adresse','email'); //set column field database for datatable orderable
    var $column_search = array('prenom', 'nom', 'adresse');  //set column field database for datatable searchable
    var $order = array('nom' => 'DESC'); // default order




    private function _get_query() {
        $this->db->select('idUser,prenom,nom,telephone,adresse,email');
        $this->db->from('utilisateur');

        $i = 0;
        foreach ($this->column_search as $emp) { // loop column
            if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
                $_POST['search']['value'] = $_POST['search']['value'];
            } else
                $_POST['search']['value'] = '';
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start();
                    $this->db->like($emp, $_POST['search']['value']);
                } else {
                    $this->db->or_like($emp, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


//    public function get_datatables_query()
//    {
//        $this->table = 'utilisateur';
//
//        // Nom des colonnes de la table pour gérer l'ordre
//        $column_order = array(null , 'prenom', 'nom', 'telephone','adresse','email');
//        // Nom des colonnes de la table pour gérer la recherche
//        $column_search = array('prenom', 'nom', 'adresse');
//        // Ordre par default
//        $order = array('nom' => 'asc');
//
//        // Requête pour récupérer les données
//        $this->db->from('utilisateur');
//
//        // Appel de la bibliothèque perso pour gérer les filtres (cf. code de la bibliothèque)
//        $this->db = $this->datatables->filters($this->db, $column_order, $column_search, $order);
//    }


    function get_datatables()
    {
        $this->get_datatables_query();
        // Appel de la bibliothèque perso (cf. code de la bibliothèque)
        $this->db = $this->datatables->limit($this->db);
        $query = $this->db->get();

        return $query->result();
    }

    public function count_filtered() {
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    public function addUser()
    {

        $donnees = array(

            'prenom' => $this->input->post('prenom'),
            'nom' => $this->input->post('nom'),
            'telephone' => $this->input->post('telephone'),

            'adresse' => $this->input->post('adresse'),
            'email' => $this->input->post('email'),

        );

        $this->db->insert($this->table, $donnees);

        return $this->db->insert_id();
    }



    public function listeUser() {
        $query = $this->db->get($this->table);
        return $query->result_object();
    }

    public function getListes() {
        $this->_get_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
}
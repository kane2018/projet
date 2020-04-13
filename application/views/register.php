<?php $this->load->view('template/navbar') ?>


<?php $this->load->view('template/main_sidebar') ?>

<div class="card card-register mx-auto col-lg-6  ">
    <div class="card-heading">créer un compte</div>
    <div class="card-body">
    <?php if($this->session->has_userdata('register_error')): ?>
    <div class="alert alert-danger">
        <strong>Error!</strong> <?= $this->session->flashdata('register_error'); ?>
    </div>
    <?php elseif($this->session->has_userdata('register_success')): ?>
        <div class="alert alert-success">
        <strong>succés!</strong> <?= $this->session->flashdata('register_success'); ?>
    </div>
    <?php endif ?>
        <?=form_open('auth/create_user')?>
        <div class="form-group">
        <?php $error= form_error("user", "<div class='invalid-feedback'>", "</div>") ?>
            <label for="exempleInputUsername">Nom</label>
            <input class="form-control <?php echo $error ? 'is-invalid' : '' ?>"  type="text" value="<?= set_value('user') ?>" autocomplete="off"  name="username" placeholder="Nom">
        <?= $error ?>
        <?php $error= form_error("email", "<div class='invalid-feedback'>", "</div>") ?>
            <label for="exempleInputEmail">Email</label>
            <input class="form-control <?php echo $error ? 'is-invalid' : '' ?>"  type="email" value="<?= set_value('email') ?>" autocomplete="off"  name="email" placeholder="Adresse Email">
        <?= $error ?>
        <div class="row">
         <div class="col-md-6">
         <?php $error= form_error("pass1", "<div class='invalid-feedback'>", "</div>") ?>
            <label for="exempleInputPassword">Mot de Passe</label>
           <input class="form-control <?php echo $error ? 'is-invalid' : '' ?>" type="password"  name="pass1" placeholder="Entrez  mot de passe">
        <?= $error ?>
        </div>
        <div class="col-md-6">
         <?php $error= form_error("pass2", "<div class='invalid-feedback'>", "</div>") ?>
            <label for="exempleInputPassword">Confirmer mot de passe</label>
           <input class="form-control <?php echo $error ? 'is-invalid' : '' ?>" type="password"  name="pass2" placeholder="Confirmer mot de passe">
        <?= $error ?>
        </div>
        </div>        
      </div>
        <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
        <?=form_close()?>
    </div>
</div>

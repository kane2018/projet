
<div class="card mx-auto col-lg-6 ">
    <div class="card-body register-card-body">
    <?php if($this->session->has_userdata('register_error')): ?>
    <div class="alert alert-danger">
        <strong>Error!</strong> <?= $this->session->flashdata('register_error'); ?>
    </div>
    <?php elseif($this->session->has_userdata('register_success')): ?>
        <div class="alert alert-success">
        <strong>succés!</strong> <?= $this->session->flashdata('register_success'); ?>
    </div>
    <?php endif ?>
      <p class="login-box-msg">Ajouter un utilisateur</p>

      <?php echo form_open("user/create_user"); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Prénom" name="prenom" value="<?= set_value('prenom') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nom" name="nom" value="<?= set_value('nom') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Adresse" name="adresse" value="<?= set_value('adresse') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-home"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="tel" class="form-control telephone"  name="telephone" value="<?= set_value('telephone') ?>"  data-mask="(999)-999-9999" placeholder="(221)-999-99-99">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" value="<?= set_value('email') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Mot de passe" name="pass1" value="<?= set_value('pass1') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirmer mot de passse" name="pass2" value="<?= set_value('pass2') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Enregister</button>
          </div>
          <!-- /.col -->
        </div>
        <?php echo form_close(); ?>

      
     
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->


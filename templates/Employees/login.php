<div class="users form content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Saisissez votre identifiant et votre mot de passe svp') ?></legend>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
    </fieldset>
    <?= $this->Form->button(__('Se connecter')); ?>
    <?= $this->Form->end() ?>
</div>
<h3><img src="<?= $this->url->dir() ?>plugins/irccat/IRC_Logo_Small.png"/>&nbsp;irccat</h3>
<div class="panel">
    <?= $this->form->label(t('IRCCAT URL'), 'irccat_webhook_url') ?>
    <?= $this->form->text('irccat_webhook_url', $values) ?>

    <?= $this->form->label(t('Token'), 'irccat_webhook_auth') ?>
    <?= $this->form->text('irccat_webhook_auth', $values, array(), array('placeholder="auth"')) ?>

    <?= $this->form->label(t('Channel'), 'irccat_webhook_channel') ?>
    <?= $this->form->text('irccat_webhook_channel', $values, array(), array('placeholder="channel"')) ?>

    <p class="form-help"><a href="https://github.com/e-lisa/plugin-irccat#configureation" target="_blank"><?= t('Help on irccat integration') ?></a></p>

    <div class="form-actions">
        <input type="submit" value="<?= t('Save') ?>" class="btn btn-blue"/>
    </div>
</div>
